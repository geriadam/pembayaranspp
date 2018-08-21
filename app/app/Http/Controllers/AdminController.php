<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Santri;
use App\Transaction;
use Carbon\Carbon;
use DateHelper;
use Chart;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $countDateNowSantri      = Santri::whereDate('created_at', '=', Carbon::today()->toDateString())->count();
        $countDateNowTransaction = Transaction::whereDate('transaction_date', '=', Carbon::today()->toDateString())->count();

        $santri      = Santri::getDataThisWeek();
        $transaction = Transaction::getDataThisWeek();

        $chartSantri = Chart::title(["text" => "Jumlah Pendaftar Santri Minggu Ini"])
                            ->chart(["type" => "column", "renderTo" => "chartSantri"])
                            ->xaxis(["categories" => $santri['categories']])
                            ->tooltip(["split" => true, "valueSuffix" => " Santri"])
                            ->yaxis(["title" => ["text" => "Jumlah Santri"]])
                            ->series([
                                [
                                    "name" => "Jumlah Santri",
                                    "data" => $santri["series"]
                                ]
                            ])->display();

        $chartTransaction = Chart::title(["text" => "Jumlah Transaksi Mingguan"])
                            ->chart(["type" => "line", "renderTo" => "chartTransaction"])
                            ->xaxis(["categories" => $transaction['categories']])
                            ->tooltip(["split" => true, "valueSuffix" => ""])
                            ->yaxis(["title" => ["text" => "Jumlah Transaksi"]])
                            ->series([
                                [
                                    "name" => "Jumlah Transaksi",
                                    "data" => $transaction["series"]
                                ]
                            ])->display();

        return view('admin.home', compact('countDateNowSantri','countDateNowTransaction', 'chartSantri','chartTransaction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
