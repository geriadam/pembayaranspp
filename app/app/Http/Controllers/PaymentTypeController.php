<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaymentType;
use Datatables;
use Validator;
use View;
use DB;

class PaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $model = PaymentType::active()->get();
        return view('admin.paymenttype.index', compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
    	$unit = PaymentType::dropdownUnit();
        return view("admin.paymenttype.create", compact('unit'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    	$validator = Validator::make($request->except('_token'), PaymentType::rules(), PaymentType::message());
        if ($validator->fails()) 
            return redirect()->route('admin.paymenttype.create')->withErrors($validator)->withInput();	

        $paymenttype = PaymentType::create($request->except('_token'));
        return redirect()->route('admin.paymenttype.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $paymenttype  = PaymentType::where("payment_type_id", $id)->active()->firstOrFail();
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
        $paymenttype = PaymentType::where("payment_type_id", $id)->active()->firstOrFail();
        if($paymenttype){
            PaymentType::where("payment_type_id", $id)->update(["is_deleted" => PaymentType::deactive]);
            return redirect()->route('admin.paymenttype.index');
        } else {
            abort(404);
        }
    }
}
