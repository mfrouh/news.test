<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth','permission:الاقسام'])->only('index');
        $this->middleware(['auth','permission:انشاء قسم'])->only(['create','store']);
        $this->middleware(['auth','permission:مشاهد قسم'])->only('show');
        $this->middleware(['auth','permission:تعديل قسم'])->only(['edit','update']);
        $this->middleware(['auth','permission:حذف قسم'])->only('destroy');
        $this->middleware(['auth','permission:تفعيل قسم'])->only('active');
        $this->middleware(['auth','permission:تعطيل قسم'])->only('inactive');

     }

    public function index()
    {
       $categories=Category::with(['articles','votes'])->get();
       return view('categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users=User::role('كاتب')->get();
        return view('categories.create',compact('users'));
    }
    public function active(Request $request)
    {
        $this->validate($request,[
            'id'=>'required|integer',
        ]);
        $user=Category::find($request->id);
        $user->status="active";
        $user->save();
        return back()->with('success','تم تفعيل مستخدم');
    }
    public function inactive(Request $request)
    {
        $this->validate($request,[
            'id'=>'required|integer',
        ]);
        $user=Category::find($request->id);
        $user->status="inactive";
        $user->save();
        return back()->with('success','تم تعطيل مستخدم');
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
            'name'=>'required|unique:categories',
            'image'=>'nullable|image',
            'status'=>'required|in:active,inactive',
            'user_id'=>'required'
        ]);
        $category=new Category();
        $category->name=$request->name;
        if ($request->image) {
            $category->image=sorteimage('storage/categories/',$request->image);
        }
        $category->status=$request->status;
        $category->user_id=$request->user_id;
        $category->save();
        $user=User::find($request->user_id);
        $user->syncRoles('رئيس قسم');
        return redirect('/categories')->with('success','تم انشاء القسم بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $users=User::role('كاتب')->get();
        return view('categories.edit',compact('category','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request,[
            'name'=>'required|unique:categories,name,'.$category->id,
            'image'=>'nullable|image',
            'status'=>'required|in:active,inactive',
            'user_id'=>'required'
        ]);
        $category->name=$request->name;
        if ($request->image) {
            $category->image=sorteimage('storage/categories/',$request->image);
        }
        $category->status=$request->status;
        $category->user_id=$request->user_id;
        $category->save();
        $user=User::find($request->user_id);
        $user->syncRoles('رئيس قسم');
        return redirect('/categories')->with('success','تم تعديل القسم بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success','تم حذف القسم بنجاح');
    }
}
