<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\TransactionItem;
use App\PaymentType;
use CodeHelper;
use Datatables;
use Validator;
use Response;
use View;
use DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($id = "")
    {
        $model = Transaction::with('santri')->where("is_deleted", Transaction::active)->get();
        if(!empty($id) && $id != "")
            $model = Transaction::with('santri')->where("is_deleted", Transaction::active)->where('santri_id', $id)->get();
        
        return view('admin.transaction.index', compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
    	$santri      = Transaction::dropdownSantri();
        $paymenttype = TransactionItem::dropdownPaymentType()->prepend('Pilih', 0);
        return view("admin.transaction.create", compact('santri','paymenttype'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    	$validator = Validator::make($request->except('_token'), Transaction::rules(), Transaction::message());
        if ($validator->fails()) 
            return redirect()->route('admin.transaction.create')->withErrors($validator)->withInput();	

        $request->request->add([
            'transaction_number' => CodeHelper::getLatestNumber("TR", "transaction_number", 'transaction'),
            'transaction_date'   => date('Y-m-d H:i:s'),
        ]);

        DB::beginTransaction();
            $paymenttype = Transaction::create($request->except('_token'));
            if($request->payment_type_id):
                foreach($request->payment_type_id as $i => $val):
                    $model = TransactionItem::create([
                        "transaction_id"    => $paymenttype->transaction_id,
                        "payment_type_id"   => $request->payment_type_id[$i],
                        "transaction_price" => $request->transaction_price[$i],
                    ]);
                endforeach;
            endif;
        DB::commit();
        return redirect()->route('admin.transaction.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $paymenttype  = PaymentType::where("payment_type_id", $id)->where("is_deleted", "=", PaymentType::active)->firstOrFail();
        $unit         = PaymentType::dropdownUnit();

        if($paymenttype){
            return view('admin.paymenttype.edit', compact("paymenttype","unit"));
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
    	$validator = Validator::make($request->except('_token'), PaymentType::rules(), PaymentType::message());
        if ($validator->fails()) 
            return redirect()->route('admin.paymenttype.edit', ["id" => $id])->withErrors($validator)->withInput();	

        $paymenttype = PaymentType::find($id)->update($request->except('_token'));
        return redirect()->route('admin.paymenttype.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $paymenttype = PaymentType::where("payment_type_id", $id)->where("is_deleted", "=", PaymentType::active)->firstOrFail();
        if($paymenttype){
            PaymentType::where("payment_type_id", $id)->update(["is_deleted" => PaymentType::deactive]);
            return redirect()->route('admin.paymenttype.index');
        } else {
            abort(404);
        }
    }

    // Opotional
    public function getPaymentType($id)
    {
        $model  = PaymentType::find($id)->first();
        $result = ["payment_type_id" => $model->payment_type_id, "payment_type_price" => $model->payment_type_price];
        return Response::json($result);
    }
}
