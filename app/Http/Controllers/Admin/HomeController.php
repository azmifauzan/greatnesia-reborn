<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
	public function __construct()
	{
		$this->middleware('authadmin');
	}

    public function index(){
    	return view('admin.home',['title'=>'Dashboard']);
    }
}
