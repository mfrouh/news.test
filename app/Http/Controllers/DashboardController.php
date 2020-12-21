<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
   public function dashboard()
   {
      return view('dashboard.index');
   }
   public function change_password()
   {
     return view('dashboard.change-password');
   }
   public function profile_setting()
   {
     return view('dashboard.profile-setting');
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
