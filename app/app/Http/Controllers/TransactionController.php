<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\TransactionItem;
use App\PaymentType;
use App\PesantrenProfile;
use CodeHelper;
use Datatables;
use Validator;
use Response;
use View;
use DB;
use PDF;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($id = null)
    {
        $model = Transaction::with('santri')->active()->orderBy('created_at', 'DESC')->get();
        if(!empty($id) && $id != "")
            $model = Transaction::with('santri')->active()->where('santri_id', $id)->get();
        
        return view('admin.transaction.index', compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $santri              = Transaction::dropdownSantri();
        $dropDownPaymentType = TransactionItem::dropdownPaymentType()->prepend('Pilih', 0);
        $paymentType         = PaymentType::active()->get();
        
        return view("admin.transaction.create", compact('santri','paymentType','dropDownPaymentType'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $transaction_total = 0;
        $total             = 0;
    	$validator = Validator::make($request->except('_token'), Transaction::rules(), Transaction::message());
        if ($validator->fails()) 
            return redirect()->route('admin.transaction.create')->withErrors($validator)->withInput();	

        $request->request->add([
            'transaction_number' => CodeHelper::getLatestNumber("TR", "transaction_number", 'transaction'),
            'transaction_date'   => date('Y-m-d H:i:s'),
            'transaction_total'  => $transaction_total,
        ]);

        DB::beginTransaction();
            $transaction = Transaction::create($request->all());
            if($request->payment_type_id):
                foreach($request->transaction_month as $payment_type_id => $array_month):
                    $paymentType = PaymentType::find($payment_type_id);
                    foreach ($array_month as $month) {
                        $model = TransactionItem::create([
                            "transaction_id"    => $transaction->transaction_id,
                            "payment_type_id"   => $payment_type_id,
                            "transaction_month" => $month,
                            "transaction_year"  => $request->transaction_year,
                            "transaction_price" => $paymentType->payment_type_price,
                        ]);
                        $total += $paymentType->payment_type_price;
                    }
                endforeach;
                $transaction_total = $total;
                $transaction->update(["transaction_total" => $transaction_total]);
            endif;
        DB::commit();

        if($request->submit == 'save'){
            return redirect()->route('admin.transaction.index');
        } else {
            return redirect()->route('admin.transaction.print', ['id' => $transaction->transaction_id]);
        }
    }

    public function show($id)
    {
        $model = TransactionItem::with('paymenttype')->where('transaction_id', $id)->get();
        $month = [
            1  => "Januari",
            2  => "Februari",
            3  => "Maret",
            4  => "April",
            5  => "Mei",
            6  => "Juni",
            7  => "Juli",
            8  => "Agustus",
            9  => "September",
            10 => "Oktober",
            11 => "November",
            12 => "Desember"
        ];
        if($model){
            return view('admin.transaction.show', compact("model","month"));
        } else {
            abort(404);
        }
    }


    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::where("transaction_id", $id)->active()->firstOrFail();
        if($transaction){
            Transaction::where("transaction_id", $id)->update(["is_deleted" => Transaction::deactive]);
            return redirect()->route('admin.transaction.index');
        } else {
            abort(404);
        }
    }

    // Opotional
    public function getPaymentType($id)
    {
        $model  = PaymentType::where("payment_type_id", $id)->first();
        $result = [
                    "payment_type_id"    => $model->payment_type_id, 
                    "payment_type_price" => $model->payment_type_price, 
                    "payment_type_unit"  => $model->payment_type_unit
                ];

        return Response::json($result);
    }

    public function printPdf($id)
    {
        $model   = Transaction::with('santri')->where('transaction_id', $id)->first();
        $profile = PesantrenProfile::first();
        $month   = [
            1  => "Januari",
            2  => "Februari",
            3  => "Maret",
            4  => "April",
            5  => "Mei",
            6  => "Juni",
            7  => "Juli",
            8  => "Agustus",
            9  => "September",
            10 => "Oktober",
            11 => "November",
            12 => "Desember"
        ];
        if($model){
            $modelItem = TransactionItem::where('transaction_id', $id)->get();
            //return view('admin.transaction.print', compact("model","modelItem","month","profile"));
            $pdf =  PDF::loadView('admin.transaction.print', compact("model","modelItem","month","profile"))->setPaper("a6", "potrait");
            return $pdf->stream();
        } else {
            abort(404);
        }
    }
}
