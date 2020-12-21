<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
       $this->middleware(['auth','permission:show articles'])->only('index');
       $this->middleware(['auth','permission:create article'])->only(['create','store']);
       $this->middleware(['auth','permission:show article'])->only('show');
       $this->middleware(['auth','permission:edit article'])->only(['edit','update']);
       $this->middleware(['auth','permission:delete article'])->only('destroy');
    }
    public function index()
    {
        $articles=Article::with('categories','tags')->get();
        return view('articles.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'image'=>'required|image',
            'title'=>'required|min:20',
            'content'=>'required|min:100',
            'tags'=>'required',
            'categories'=>'required',
        ]);
        $article =new Article();
        $article->title=$request->title;
        $article->slug=$request->title;
        $article->content=$request->content;
        $article->user_id=auth()->user()->id;
        if ($request->image) {
        $article->image=sorteimage('storage/articles/',$request->image);
        }
        $article->save();
        $article->categories()->sync($request->categories);
        $tags=explode(',',$request->tags);
        $Ttags=array();
        foreach ($tags as $key => $tag) {
            $Ftag=Tag::where('name',$tag)->firstorcreate(['name'=>$tag]);
            $Ftag->id;
            $Ttags[]= $Ftag->id;
        }
        $article->tags()->sync($Ttags);
        return redirect('/articles')->with('success','Article Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('articles.show',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
       return view('articles.edit',compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $this->validate($request,[
            'image'=>'nullable|image',
            'title'=>'required|min:20',
            'content'=>'required|min:100',
            'tags'=>'required',
            'categories'=>'required',
        ]);
        $article->title=$request->title;
        $article->slug=$request->title;
        $article->user_id=auth()->user()->id;
        $article->content=$request->content;
        if ($request->image) {
            $article->image=sorteimage('storage/articles/',$request->image);
        }
        $article->save();
        $article->categories()->sync($request->categories);
        $tags=explode(',',$request->tags);
        $Ttags=array();
        foreach ($tags as $key => $tag) {
            $Ftag=Tag::where('name',$tag)->firstorcreate(['name'=>$tag]);
            $Ftag->id;
            $Ttags[]= $Ftag->id;
        }
        $article->tags()->sync($Ttags);
        return redirect('/articles')->with('success','Article Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return back()->with('success','Article Deleted Successfully');
    }
}
