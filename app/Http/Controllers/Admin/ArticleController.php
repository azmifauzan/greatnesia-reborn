<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Article;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('authadmin');
        View::share('title','Articles');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('created_at','desc')->paginate(15);
        return view('admin.article',['articles'=>$articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = \App\Category::orderBy('title')->get();
        $users = \App\User::orderBy('name')->get();
        return view('admin.createarticle',['categories'=>$categories,'users'=>$users]);
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
            'title' => 'required',
            'content' => 'required',            
        ]);

        $arus = explode('#', $request->user[0]);
        $user = \App\User::where('email',$arus[1])->get()->first();
        $usid = $user->id;

        $category = \App\Category::where('title',$request->category[0])->get()->first();
        $catid = $category->id;

        Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $usid,
            'category_id' =>$catid,
            'placement' => $request->placement
        ]);

        return redirect()->route('article.index')->with('success','Article successfully created in the database!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        $categories = \App\Category::orderBy('title')->get();
        $users = \App\User::orderBy('name')->get();
        return view('admin.editarticle',['article'=>$article,'categories'=>$categories,'users'=>$users]);
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
            'title' => 'required',
            'content' => 'required',            
        ]);

        $arus = explode('#', $request->user[0]);
        $user = \App\User::where('email',$arus[1])->get()->first();
        $usid = $user->id;

        $category = \App\Category::where('title',$request->category[0])->get()->first();
        $catid = $category->id;

        Article::find($id)->update([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $usid,
            'category_id' =>$catid,
            'placement' => $request->placement
        ]);

        return redirect()->route('article.index')->with('success','Article successfully updated in the database!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Article::destroy($id);
        return redirect()->route('article.index')->with('success','Article successfully delete!');
    }
}
