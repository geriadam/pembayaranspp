<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Santri;
use App\Transaction;
use App\TransactionItem;
use App\PesantrenProfile;
use Carbon\Carbon;
use CodeHelper;
use Datatables;
use Validator;
use Response;
use View;
use DB;
use PDF;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('admin.report.index');
    }

    public function santri()
    {
        Session::forget('filterSessionSantri');
        $santri = Transaction::dropdownSantri()->prepend("Pilih","");
        $model  = Santri::active()->get();
        
        return view('admin.report.santri.index', compact('model','santri'));
    }

    public function santriSearch(Request $request)
    {
        $santri        = Transaction::dropdownSantri()->prepend("Pilih","");
        $filterSession = array();
        $model         = Santri::query()->active();

        if(isset($request->santri_id) && !empty($request->santri_id)){
            $filterSession['santri_id'] = $request->santri_id;
            $model = $model->where('santri_id', $request->santri_id);
        }

        if(isset($request->start_date) && !empty($request->start_date)){
            $filterSession['start_date'] = $request->start_date;
            $model = $model->whereDate('transaction_date', ">=", Carbon::parse($request->start_date)->format('Y-m-d'));
        }

        if(isset($request->end_date) && !empty($request->end_date)){
            $filterSession['end_date'] = $request->end_date;
            $model = $model->whereDate('transaction_date', "<=", Carbon::parse($request->end_date)->format('Y-m-d'));
        }

        $model = $model->get();

        Session::put('filterSessionSantri', $filterSession);
        return view('admin.report.santri.search', compact('model','santri'));
    }

    public function santriExport()
    {
        $filter  = Session::get('filterSessionSantri');
        $profile = PesantrenProfile::first();
        $model   = Santri::query()->active();

        if(isset($filter['santri_id']) && !empty($filter['santri_id'])){
            $model = $model->where('santri_id', $filter['santri_id']);
        }

        if(isset($filter['start_date']) && !empty($filter['start_date'])){
            $model = $model->whereDate('transaction_date', ">=", Carbon::parse($filter['start_date'])->format('Y-m-d'));
        }

        if(isset($filter['end_date']) && !empty($filter['end_date'])){
            $model = $model->whereDate('transaction_date', "<=", Carbon::parse($filter['end_date'])->format('Y-m-d'));
        }
        
        $model = $model->get();

        //return view('admin.report.export', compact("model","filter","profile","total"));
        $pdf =  PDF::loadView('admin.report.santri.export', compact("model","filter","profile"));
        return $pdf->stream();
    }

    public function transaksi()
    {
        Session::forget('filterSessionTransaksi');
        $santri = Transaction::dropdownSantri()->prepend("Pilih","");
        $model  = Transaction::with('santri')->active()->get();
        
        return view('admin.report.transaksi.index', compact('model','santri'));
    }

    public function transaksiSearch(Request $request)
    {
        $santri        = Transaction::dropdownSantri()->prepend("Pilih","");
        $filterSession = array();
        $model         = Transaction::query()->active();
        $model         = $model->with('santri'); 

        if(isset($request->santri_id) && !empty($request->santri_id)){
            $filterSession['santri_id'] = $request->santri_id;
            $model = $model->where('santri_id', $request->santri_id);
        }

        if(isset($request->transaction_number) && !empty($request->transaction_number)){
            $filterSession['transaction_number'] = $request->transaction_number;
            $model = $model->where('transaction_number', $request->transaction_number);
        }

        if(isset($request->start_date) && !empty($request->start_date)){
            $filterSession['start_date'] = $request->start_date;
            $model = $model->whereDate('transaction_date', ">=", Carbon::parse($request->start_date)->format('Y-m-d'));
        }

        if(isset($request->end_date) && !empty($request->end_date)){
            $filterSession['end_date'] = $request->end_date;
            $model = $model->whereDate('transaction_date', "<=", Carbon::parse($request->end_date)->format('Y-m-d'));
        }

        $model = $model->get();

        Session::put('filterSessionTransaksi', $filterSession);
        return view('admin.report.transaksi.search', compact('model','santri'));
    }

    public function transaksiExport()
    {
        $filter  = Session::get('filterSessionTransaksi');
        $profile = PesantrenProfile::first();
        $model   = Transaction::query()->active();
        $model   = $model->with('santri');

        if(isset($filter['santri_id']) && !empty($filter['santri_id'])){
            $model = $model->where('santri_id', $filter['santri_id']);
        }

        if(isset($filter['transaction_number']) && !empty($filter['transaction_number'])){
            $model = $model->where('transaction_number', $filter['transaction_number']);
        }

        if(isset($filter['start_date']) && !empty($filter['start_date'])){
            $model = $model->whereDate('transaction_date', ">=", Carbon::parse($filter['start_date'])->format('Y-m-d'));
        }

        if(isset($filter['end_date']) && !empty($filter['end_date'])){
            $model = $model->whereDate('transaction_date', "<=", Carbon::parse($filter['end_date'])->format('Y-m-d'));
        }

        $model = $model->get();
        $total = $model->sum('transaction_total');
        //return view('admin.report.export', compact("model","filter","profile","total"));
        $pdf =  PDF::loadView('admin.report.transaksi.export', compact("model","filter","profile","total"));
        return $pdf->stream();
    }

    public function transaksiExportExcel()
    {
        $filter  = Session::get('filterSessionTransaksi');
        $profile = PesantrenProfile::first();
        $model   = Transaction::query()->active();
        $model   = $model->with('santri');

        if(isset($filter['santri_id']) && !empty($filter['santri_id'])){
            $model = $model->where('santri_id', $filter['santri_id']);
        }

        if(isset($filter['transaction_number']) && !empty($filter['transaction_number'])){
            $model = $model->where('transaction_number', $filter['transaction_number']);
        }

        if(isset($filter['start_date']) && !empty($filter['start_date'])){
            $model = $model->whereDate('transaction_date', ">=", Carbon::parse($filter['start_date'])->format('Y-m-d'));
        }

        if(isset($filter['end_date']) && !empty($filter['end_date'])){
            $model = $model->whereDate('transaction_date', "<=", Carbon::parse($filter['end_date'])->format('Y-m-d'));
        }

        $model = $model->get();
        $total = $model->sum('transaction_total');
        return view('admin.report.transaksi.excel', compact("model","filter","profile","total"));
    }
}
