<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
    	$jadwals = \App\Channel::orderBy('name')->with(['schedule'=>function($query){$query->where([['day',"=",date('N')],['start',"<=",date('H:i:s',time()+60*60*7)],['end',">=",date('H:i:s',time()+60*60*7)]])->orderBy('start')->with('program');}])->get();
    	//dd($jadwals);
    	return view('home',['jadwals'=>$jadwals]);
    }
}
