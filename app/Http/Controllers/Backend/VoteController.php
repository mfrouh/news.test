<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
      $this->middleware(['role:رئيس قسم']);
    }
    public function index()
    {
        $votes=Vote::all();
        return view('Backend.votes.index',compact('votes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.votes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
        [
            'question'=>'required|min:5',
            'options'=>'required',
            'category_id'=>'required',
            'startvote'=>'required|before_or_equal:endvote',
            'endvote'=>'required|after_or_equal:startvote',
        ]);
        $vote=new Vote();
        $vote->question=$request->question;
        $vote->category_id=$request->category_id;
        $vote->startvote=$request->startvote;
        $vote->endvote=$request->endvote;
        $vote->save();
        $options=explode(',',$request->options);
        foreach ($options as $key => $option) {
            Option::where('name',$option)->where('vote_id',$vote->id)->firstorcreate(['name'=>$option,'vote_id'=>$vote->id]);
        }
        return back()->with('success','تم انشاء التصويت بنجاح');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function show(Vote $vote)
    {
        return view('Backend.votes.show',compact('vote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function edit(Vote $vote)
    {
       return view('Backend.votes.edit',compact('vote'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vote $vote)
    {
        $this->validate($request,
        [
            'question'=>'required|min:5',
            'options'=>'required',
            'category_id'=>'required',
            'startvote'=>'required|before_or_equal:endvote',
            'endvote'=>'required|after_or_equal:startvote',
        ]);
        $vote->question=$request->question;
        $vote->category_id=$request->category_id;
        $vote->startvote=$request->startvote;
        $vote->endvote=$request->endvote;
        $vote->save();
        $options=explode(',',$request->options);
        foreach ($options as $key => $option) {
            Option::where('name',$option)->where('vote_id',$vote->id)->firstorcreate(['name'=>$option,'vote_id'=>$vote->id]);
        }
        return back()->with('success','تم تعديل التصويت بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vote $vote)
    {
        $vote->delete();
        return back()->with('success','تم حذف التصويت بنجاح');
    }
    public function publish(Request $request)
    {
        $this->validate($request,[
            'id'=>'required|integer',
        ]);
        $vote=Vote::find($request->id);
        $vote->status="publish";
        $vote->save();
        return back()->with('success','تم نشر التصويت');
    }
    public function unpublish(Request $request)
    {
        $this->validate($request,[
            'id'=>'required|integer',
        ]);
        $vote=Vote::find($request->id);
        $vote->status="unpublish";
        $vote->save();
        return back()->with('success','تم الغاء نشر التصويت');
    }
}
