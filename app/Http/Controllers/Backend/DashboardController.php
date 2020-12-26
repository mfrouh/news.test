<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Subscribers;
use App\Models\Tag;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
   public function dashboard()
   {
      $writers=User::role('كاتب')->count();
      $users=User::count();
      $supervisors=User::role('رئيس قسم')->count();
      $subscribers=Subscribers::count();
      $articles=Article::count();
      $pubarticles=Article::publish()->count();
      $unpubarticles=Article::unpublish()->count();
      $tags=Tag::count();
      $roles=Role::count();
      $permissions=Permission::count();
      $categories=Category::count();
      $actcategories=Category::active()->count();
      $inactcategories=Category::inactive()->count();
      $votes=Vote::count();
      $myarticles=auth()->user()->articles->count();
      $mycategories=auth()->user()->mycategories->count();
      return view('Backend.dashboard.index',
      compact('writers','users','supervisors',
      'subscribers','articles','tags','roles',
      'permissions','categories','votes',
      'myarticles','mycategories',
      'pubarticles','unpubarticles',
      'actcategories','inactcategories'));
   }
   public function change_password()
   {
     return view('Backend.dashboard.change-password');
   }
   public function profile_setting()
   {
     return view('Backend.dashboard.profile-setting');
   }

   public function post_change_password(Request $request)
    {
        $this->validate($request,[
            'old_password'=>'required|min:8',
            'password'=>'required|min:8|confirmed'
        ]);
        $user=User::where('id',auth()->user()->id)->first();
        if (Hash::check($request->old_password,$user->password)) {
            $user->password=Hash::make($request->password);
            $user->save();
                return back()->with('success','تمت تغير كلمة المرور بنجاح');
        }
        else {
                return back()->with('error','نريد كلمة المرور الحالية');
        }
    }
    public function post_profile_setting(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|unique:users,email,'.auth()->user()->id,
            'image'=>'image|nullable'
        ]);
        $user=User::where('id',auth()->user()->id)->first();
        $user->name=$request->name;
        $user->email=$request->email;
        if ($request->image) {
            $user->image=sorteimage('storage/users/',$request->image);
        }
        $user->save();
        return back()->with('success','تم التعديل البيانات بنجاح');

    }
}
