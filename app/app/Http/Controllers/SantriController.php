<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Santri;
use App\Transaction;
use App\TransactionItem;
use Carbon\Carbon;
use Datatables;
use Validator;
use Response;
use View;
use DB;

class SantriController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $year[0] = "Pilih";
        for ($i = date('Y'); $i >= date('Y') - 10; $i--){
            $year[$i] = $i;
        }
        $model = Santri::active()->get();
        return view('admin.santri.index', compact('model',"year"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
    	$gender = Santri::dropdownGender();
        return view("admin.santri.create", compact('gender'));
    }


    public function show($id)
    {
        $santri = Santri::where('santri_id', $id)->active()->first();
        if($santri){
            return view('admin.santri.show', compact("santri"));
        } else {
            abort(404);
        }
    }

    public function detail($id)
    {
        $transactionItem = TransactionItem::with('paymenttype')
                            ->whereHas('transaction', function($transaction) use ($id){
                                $transaction->where('santri_id', $id)->active();
                            })
                            ->orderBy('transaction_year', 'DESC')
                            ->orderBy('transaction_month', 'ASC')
                            ->get()
                            ->groupBy(function($date){
                                return $date->transaction_year;
                            });

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

        return view('admin.santri.detail', compact("transactionItem", "month"));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    	$validator = Validator::make($request->except('_token'), Santri::rules(), Santri::message());
        if ($validator->fails()) 
            return redirect()->route('admin.santri.create')->withErrors($validator)->withInput();	

        $request->request->add(["santri_birth_date" => Carbon::parse($request->santri_birth_date)->format('Y-m-d')]);
        $santri = Santri::create($request->except('_token'));
        return redirect()->route('admin.santri.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $santri  = Santri::where("santri_id", $id)->active()->firstOrFail();
        $gender  = Santri::dropdownGender();

        $santri->santri_birth_date = Carbon::parse($santri->santri_birth_date)->format('d-m-Y');
        if($santri){
            return view('admin.santri.edit', compact("santri","gender"));
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
    	$validator = Validator::make($request->except('_token'), Santri::rules(), Santri::message());
        if ($validator->fails()) 
            return redirect()->route('admin.santri.edit', ["id" => $id])->withErrors($validator)->withInput();	

        $request->request->add(["santri_birth_date" => Carbon::parse($request->santri_birth_date)->format('Y-m-d')]);
        $santri = Santri::find($id)->update($request->except('_token'));
        return redirect()->route('admin.santri.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $santri = Santri::where("santri_id", $id)->active()->firstOrFail();
        if($santri){
            Santri::where("santri_id", $id)->update(["is_deleted" => Santri::deactive]);
            return redirect()->route('admin.santri.index');
        } else {
            abort(404);
        }
    }
}
