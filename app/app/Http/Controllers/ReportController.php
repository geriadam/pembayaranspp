<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
        Session::forget('filterSession');
        $santri = Transaction::dropdownSantri()->prepend("Pilih","");
        $model  = Transaction::with('santri')->where("is_deleted", Transaction::active)->get();
        
        return view('admin.report.index', compact('model','santri'));
    }

    public function search(Request $request)
    {
        $santri        = Transaction::dropdownSantri()->prepend("Pilih","");
        $filterSession = array();
        $model         = Transaction::query();
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

        $model = $model->where('is_deleted', Transaction::active);
        $model = $model->get();

        Session::put('filterSession', $filterSession);
        return view('admin.report.search', compact('model','santri'));
    }

    public function export()
    {
        $filter  = Session::get('filterSession');
        $profile = PesantrenProfile::first();
        $model   = Transaction::query();
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

        $model = $model->where('is_deleted', Transaction::active);
        $model = $model->get();
        $total = $model->sum('transaction_total');
        //return view('admin.report.export', compact("model","filter","profile","total"));
        $pdf =  PDF::loadView('admin.report.export', compact("model","filter","profile","total"));
        return $pdf->stream();
    }
}
