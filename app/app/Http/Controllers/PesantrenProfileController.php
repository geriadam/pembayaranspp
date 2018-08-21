<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PesantrenProfile;
use Datatables;
use Validator;
use File;
use View;
use DB;

class PesantrenProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = PesantrenProfile::all();
        return view('admin.pesantrenprofile.index', compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.pesantrenprofile.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->except('_token'), PesantrenProfile::rules(), PesantrenProfile::message());
        if ($validator->fails()) 
            return redirect()->route('admin.pesantrenprofile.create')->withErrors($validator)->withInput(); 

        $file = PesantrenProfile::upload($request);
        $request->request->add(['pesantren_profile_logo' => $file]);
        $model = PesantrenProfile::create($request->except('_token'));
        if($model){
            return redirect()->route('admin.pesantrenprofile.index');
        }
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
        $model = PesantrenProfile::findOrFail($id);
        if($model){
            return view('admin.pesantrenprofile.edit', compact('model'));
        } else {
            abort(404);
        }
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
        $validator = Validator::make($request->except('_token'), PesantrenProfile::rules(), PesantrenProfile::message());
        if ($validator->fails()) 
            return redirect()->route('admin.pesantrenprofile.edit', ["id" => $id])->withErrors($validator)->withInput(); 

        $pesantrenprofile = PesantrenProfile::find($id);

        //jika file tidak kosong
        if($request->hasFile("file")){
            $file = PesantrenProfile::upload($request);
            // jika gambar ada
            if(File::exists(PesantrenProfile::IMAGE_PATH.''.$pesantrenprofile->pesantren_profile_logo))
                File::delete(PesantrenProfile::IMAGE_PATH.''.$pesantrenprofile->pesantren_profile_logo);
        }

        $request->request->add(['pesantren_profile_logo' => isset($file) ? $file : $pesantrenprofile->pesantren_profile_logo]);

        $model = PesantrenProfile::find($id)->update($request->except('_token'));
        if($model){
            return redirect()->route('admin.pesantrenprofile.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = PesantrenProfile::findOrFail($id);
        if($model){
            Pesantrenprofile::find($id)->delete();
            return redirect()->route('admin.pesantrenprofile.index');
        } else {
            abort(404);
        }
    }
}
