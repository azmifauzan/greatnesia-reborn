<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Channel;

class ChannelController extends Controller
{
    public function __construct()
    {
        $this->middleware('authadmin');
        View::share('title','Channels');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $channel = Channel::orderBy('name')->paginate(15);
        return view('admin.channel',['channels'=>$channel]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.createchannel');
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
            'website' => 'nullable|url',
            'logo' => 'image|max:2000',
        ]);


        if($request->hasFile('logo')){
            $uploadedFile = $request->file('logo');        
            $path = $uploadedFile->move('logo',md5(date('Y-m-d H:i:s')).".".$request->file('logo')->getClientOriginalExtension());
            Channel::create([
                'name' => $request->name,
                'description' => $request->description,
                'website' => $request->website,
                'logo' => $path
            ]);
        }
        else{
            Channel::create([
                'name' => $request->name,
                'description' => $request->description,
                'website' => $request->website,
            ]);
        }

        return redirect()->route('channel.index')->with('success','Channel successfully saved in the database!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $channel = Channel::find($id);
        return view('admin.editchannel',['channel' => $channel]);
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
            'website' => 'nullable|url',
            'logo' => 'image|max:2000',
        ]);

        if($request->hasFile('logo')){
            $uploadedFile = $request->file('logo');        
            $path = $uploadedFile->move('logo',md5(date('Y-m-d H:i:s')).".".$request->file('logo')->getClientOriginalExtension());
            Channel::find($id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'website' => $request->website,
                'logo' => $path
            ]);
        }
        else{
            Channel::find($id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'website' => $request->website,
            ]);
        }

        return redirect()->route('channel.index')->with('success','Channel successfully update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Channel::destroy($id);
        return redirect()->route('channel.index')->with('success','Channel successfully delete!');
    }
}
