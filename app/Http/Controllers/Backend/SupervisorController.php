<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SupervisorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','permission:الكتاب في القسم'])->only('writers');
        $this->middleware(['auth','permission:المقالات في القسم'])->only('articles');
        $this->middleware(['auth','permission:انشاء كاتب في القسم'])->only(['createwrite','storewrite']);
        $this->middleware(['auth','permission:حذف مستخدم من القسم'])->only('writercategory');
        $this->middleware(['auth','permission:تعيين كاتب في القسم'])->only(['categorywriter','postcategorywriter']);
    }
    public function writers($id)
    {
        if (in_array($id,auth()->user()->mycategories->pluck('id')->toArray())) {
            $writers=Category::find($id)->users;
            $category=Category::find($id);
            return view('Backend.users.writers',compact('writers','category'));
        }else {
            return abort('404');
        }
    }
    public function articles($id)
    {
        if (in_array($id,auth()->user()->mycategories->pluck('id')->toArray())) {
            $articles=Category::find($id)->articles;
            return view('Backend.articles.index',compact('articles'));
        }else {
            return abort('404');
        }
    }
    public function createwrite()
    {
        $categories=auth()->user()->mycategories;
        if ($categories->count()!=0) {
            return view('Backend.supervisor.createwrite',compact('categories'));
        }
        else
        {
            return abort('404');
        }
    }

    public function storewrite(Request $request)
    {
         $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'categories'=>'required',
         ]);

         $input = $request->all();
         $input['password'] = Hash::make($input['password']);
         $user = User::create($input);
         $user->syncRoles('كاتب');
         $user->categories()->sync($request->categories);
         return back()
         ->with('success','تم اضافة الكاتب بنجاح');
    }

    public function categorywriter()
    {
       $users=User::role('كاتب')->get();
       $categories=auth()->user()->mycategories;
       return view('Backend.users.categorywriter',compact('users','categories'));
    }

    public function postcategorywriter(Request $request)
    {
       $this->validate($request, [
          'user_id' => 'required',
          'categories'=>'required',
       ]);
       $user=User::find($request->user_id);
       $user->categories()->detach($request->categories);
       $user->categories()->attach($request->categories);
       return back()
       ->with('success','تم اضافة الكاتب في القسم بنجاح');
    }

    public function writercategory(Request $request)
    {
       $this->validate($request,['user_id'=>'required','category_id'=>'required']);
       DB::table('user_category')->where('user_id',$request->user_id)->where('category_id',$request->category_id)->delete();
       return back()->with('success','تم حذف المستخدم من القسم بنجاح');
    }
}
