<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Schedule;
use App\Channel;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('authadmin');
        View::share('title','Schedules');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $channel = Channel::orderBy('name')->get();
        $jadwals = Channel::orderBy('name')->with(['schedule'=>function($query){$query->orderBy('day')->orderBy('start')->with('program');}])->paginate(1);
        //dd($jadwals);
        return view('admin.jadwal',['jadwals'=>$jadwals,'channels'=>$channel]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $channel = Channel::orderBy('name')->get();
        $program = \App\Program::orderBy('name')->get();
        return view('admin.createjadwal',['channels'=>$channel,'programs'=>$program]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $this->validate($request, [
            'start' => 'required',
            'end' => 'required',
            'day' => 'required',
            'channel' => 'required',
            'program' => 'required',
        ]);

        $cid = $request->channel[0];
        $pid = $request->program[0];

        if(!is_numeric($cid)){
            $ch = \App\Channel::create(['name'=>$request->channel[0]]);
            $cid = $ch->id;
        }

        if(!is_numeric($pid)){
            $pr = \App\Program::create(['name'=>$request->program[0]]);
            $pid = $pr->id;
        }

        /*$hari = strtolower($request->day);
        switch($hari){
            case "senin": $did = 1;
                break;
            case "selasa": $did = 2;
                break;
            case "rabu": $did = 3;
                break;
            case "kamis": $did = 4;
                break;
            case "jumat": $did = 5;
                break;
            case "sabtu": $did = 6;
                break;
            case "minggu": $did = 7;
                break;
        }*/

        Schedule::create([
            'start' => $request->start,
            'end' => $request->end,
            'day' => $request->day,
            'channel_id' => $cid,
            'program_id' => $pid,
        ]);

        return redirect()->route('jadwal.index')->with('success','Schedule successfully saved in the database!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $channel = Channel::orderBy('name')->get();
        $program = \App\Program::orderBy('name')->get();
        $schedule = Schedule::find($id);
        return view('admin.editjadwal',['channels'=>$channel,'programs'=>$program,'schedule'=>$schedule]);
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
            'start' => 'required',
            'end' => 'required',
            'day' => 'required',
            'channel' => 'required',
            'program' => 'required',
        ]);

        $cid = $request->channel[0];
        $pid = $request->program[0];

        if(!is_numeric($cid)){
            echo "masuk sini";
            $ch = \App\Channel::create(['name'=>$request->channel[0]]);
            $cid = $ch->id;
        }

        if(!is_numeric($pid)){
            $pr = \App\Program::create(['name'=>$request->program[0]]);
            $pid = $pr->id;
        }

        Schedule::find($id)->update([
            'start' => $request->start,
            'end' => $request->end,
            'day' => $request->day,
            'channel_id' => $cid,
            'program_id' => $pid,
        ]);

        return redirect()->route('jadwal.index')->with('success','Schedule successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Schedule::destroy($id);
        return redirect()->route('jadwal.index')->with('success','Schedule successfully deleted!');
    }

    public function filter(Request $request)
    {
        $cid = $request->filter;
        if($cid == 0){
            return redirect()->route('jadwal.index');
        }

        $channel = Channel::orderBy('name')->get();
        
        $jadwals = Channel::where('id',$cid)->orderBy('name')->with(['schedule'=>function($query){$query->orderBy('day')->orderBy('start')->with('program');}])->paginate(1);
        
        return view('admin.jadwal',['jadwals'=>$jadwals,'channels'=>$channel,'cid'=>$cid]);
    }
}
