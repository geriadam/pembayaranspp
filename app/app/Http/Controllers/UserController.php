<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Validator;
use App\User;

class UserController extends Controller
{   
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $model = User::all();
        return view('admin.user.index', compact('model'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('admin.login');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function loginPost(Request $request)
    {
        $email    = $request->email;
        $password = $request->password;
        $model    = User::where('email',$email)->first();

        if(count($model) > 0){ //apakah email tersebut ada atau tidak
            if(Hash::check($password,$model->password)){
                Session::put('name',$model->name);
                Session::put('email',$model->email);
                Session::put('login',TRUE);
                return redirect()->action('AdminController@index');
            }
            else{
                return redirect()->route('admin.login')->with('alert','Wrong Password !'.Hash::check($password,$model->password))->withInput();
            }
        }
        else{
            return redirect()->route('admin.login')->with('alert','Wrong Password or Email !')->withInput();
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('admin.login')->with('alert', 'Logout');
    }

    public function edit($id)
    {
        $model = User::findOrFail($id);
        if($model){
            return view('admin.user.edit', compact("model"));
        }
        else {
            abort(404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->except('_token'), User::rules(), User::message());
        if ($validator->fails()) 
            return redirect()->route('admin.user.edit', ["id" => $id])->withErrors($validator)->withInput(); 

        $request->request->add(["password" => bcrypt($request->password)]);
        $model = User::find($id)->update($request->except('_token'));
        return redirect()->route('admin.logout');
    }

    /*public function registerPost(Request $request){
        $data =  new User();
        $data->name = "admin";
        $data->email = "admin@admin.com";
        $data->password = bcrypt("admin");
        $data->save();
        return redirect('login')->with('alert-success','Kamu berhasil Register');
    }*/
}
