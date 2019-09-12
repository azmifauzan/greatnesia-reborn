<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Program;

class ProgramController extends Controller
{
    public function __construct()
    {
        $this->middleware('authadmin');
        View::share('title','Programs');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $program = Program::orderBy('name')->paginate(15);
        return view('admin.program',['programs'=>$program]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $actors = \App\Actor::orderBy('name')->get();
        $phs = \App\Productionhouse::orderBy('name')->get();
        return view('admin.createprogram',['phs'=>$phs,'actors'=>$actors]);
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
            'description' => 'required',
            'ph' => 'required',
            'website' => 'nullable|url',
            'year' => 'required|size:4'
        ]);

        $phdetail = \App\Productionhouse::where('name',$request->ph[0])->get()->first();
        if(!$phdetail)
        {
            $ph = \App\Productionhouse::create(['name'=>$request->ph[0]]);
            $phid = $ph->id;
        }
        else{
            $phid = $phdetail->id;
        }

        $pid = Program::create([
            'name' => $request->name,
            'description' => $request->description,
            'productionhouse_id' => $phid,
            'production_year' => $request->year,
            'website' => $request->website,
        ]);

        foreach ($request->actors as $actor) {
            $act = \App\Actor::where('name',$actor)->get()->first();
            if($act){
                $aid[] = $act->id; 
            }
            else{
                $actor = \App\Actor::create(['name' => $actor]);
                $aid[] = $actor->id;
            }
        }

        $pid->actor()->attach($aid);

        return redirect()->route('program.index')->with('success','Program successfully saved in the database!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $program = Program::with('actor')->find($id);
        $actors = \App\Actor::orderBy('name')->get();
        $phs = \App\Productionhouse::orderBy('name')->get();
        return view('admin.editprogram',['program'=>$program,'actors'=>$actors,'phs'=>$phs]);
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
            'description' => 'required',
            'ph' => 'required',
            'website' => 'nullable|url',
            'year' => 'required|size:4'
        ]);

        $phid = $request->ph[0];
        if(!is_numeric($phid)){
            $ph = \App\Productionhouse::create(['name'=>$request->ph[0]]);
            $phid = $ph->id;
        }

        $pid = Program::find($id);

        $pid->update([
            'name' => $request->name,
            'description' => $request->description,
            'productionhouse_id' => $phid,
            'production_year' => $request->year,
            'website' => $request->website,
        ]);

        $pid->actor()->detach();

        foreach ($request->actors as $actor) {
            $act = \App\Actor::where('name',$actor)->get()->first();
            if($act){
                $aid[] = $act->id; 
            }
            else{
                $actor = \App\Actor::create(['name' => $actor]);
                $aid[] = $actor->id;
            }
        }

        $pid->actor()->attach($aid);

        return redirect()->route('program.index')->with('success','Program successfully update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prog = Program::find($id);
        $prog->actor()->detach();
        $prog->delete();
        return redirect()->route('program.index')->with('success','Program successfully delete!');
    }
}
