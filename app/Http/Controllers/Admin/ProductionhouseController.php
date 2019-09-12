<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Productionhouse;

class ProductionhouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('authadmin');
        View::share('title','Production Houses');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $phs = Productionhouse::orderBy('name')->paginate(15);
        return view('admin.ph',['phs'=>$phs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.createph');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'website' => 'nullable|url',
        ]);

        Productionhouse::create([
            'name' => $request->name,
            'description' => $request->description,
            'address' => $request->address,
            'website' => $request->website
        ]);

        return redirect()->route('ph.index')->with('success','Production House successfully saved in the database!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ph = Productionhouse::find($id);
        return view('admin.editph',['ph'=>$ph]);
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
        $this->validate($request, [
            'name' => 'required',
            'website' => 'nullable|url',
        ]);

        Productionhouse::find($id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'address' => $request->address,
            'website' => $request->website
        ]);

        return redirect()->route('ph.index')->with('success','Production House successfully update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Productionhouse::destroy($id);
        return redirect()->route('ph.index')->with('success','Production House successfully delete!');
    }
}
