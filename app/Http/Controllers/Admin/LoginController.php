<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;

class LoginController extends Controller
{
    public function index(Request $request)
    {
    	$error = $request->session()->get('alert');
    	return view("admin.login",['alert'=>$error]);
    }

    public function ceklogin(Request $request)
    {
    	$request->validate([
	        'email' => 'required|email',
	        'password' => 'required',
	    ]);

        //dd($request);

    	$pesan_error = "Email/Password tidak dikenali!";
    	$admin = Admin::where('email',$request->input('email'))->first();
    	if($admin != NULL){
    		if(password_verify($request->input('password'), $admin->password)){
    			$request->session()->put(['email'=>$admin->email,'name'=>$admin->name]);
    			return redirect()->route('dashboard');
    		}
    		else{
    			$request->session()->flash('alert', $pesan_error);
    			return redirect()->route('loginadmin');
    		}
    	}
    	else{
    		$request->session()->flash('alert', $pesan_error);
    		return redirect()->route('loginadmin');
    	}
    }

    public function out(Request $request)
    {
    	$request->session()->flush();
    	return redirect()->route('loginadmin');
    }
}
