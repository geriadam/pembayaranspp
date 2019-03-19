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

        $countDateNowSantri      = Santri::active()->whereDate('created_at', '=', Carbon::today()->toDateString())->count();
        $countDateNowTransaction = Transaction::whereDate('transaction_date', '=', Carbon::today()->toDateString())->count();

        $santri      = Santri::getDataThisWeek();
        $transaction = Transaction::getDataThisWeek();

        $chartSantri = Chart::title(["text" => "Jumlah Pendaftar Santri Minggu Ini"])
                            ->chart(["type" => "column", "renderTo" => "chartSantri"])
                            ->xaxis(["categories" => $santri['categories']])
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
                            ->yaxis(["title" => ["text" => "Jumlah Transaksi"]])
                            ->series([
                                [
                                    "name" => "Jumlah Transaksi",
                                    "data" => $transaction["series"]
                                ]
                            ])->display();

        return view('admin.home', compact('countDateNowSantri','countDateNowTransaction', 'chartSantri','chartTransaction'));
    }
}
