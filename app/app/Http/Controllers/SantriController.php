<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Santri;
use Datatables;
use Validator;
use Carbon\Carbon;
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
        $model = Santri::where("is_deleted", Santri::active)->get();
        return view('admin.santri.index', compact('model'));
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
        $santri  = Santri::where("santri_id", $id)->where("is_deleted", "=", Santri::active)->firstOrFail();
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

        $santri = Santri::find($id)->update($request->except('_token'));
        return redirect()->route('admin.santri.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $santri = Santri::where("santri_id", $id)->where("is_deleted", "=", Santri::active)->firstOrFail();
        if($santri){
            Santri::where("santri_id", $id)->update(["is_deleted" => Santri::deactive]);
            return redirect()->route('admin.santri.index');
        } else {
            abort(404);
        }
    }
}
