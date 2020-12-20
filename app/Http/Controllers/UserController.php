<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function __construct()
{
    $this->middleware(['auth','permission:show users'])->only('index');
    $this->middleware(['auth','permission:create user'])->only(['create','store']);
    $this->middleware(['auth','permission:show user'])->only('show');
    $this->middleware(['auth','permission:edit user'])->only(['edit','update']);
    $this->middleware(['auth','permission:delete user'])->only('destroy');
}
public function index(Request $request)
{
   $users = User::orderBy('id','DESC')->get();
   return view('users.index',compact('users'));
}


/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
    $roles = Role::pluck('name','name')->all();
    return view('users.create',compact('roles'));
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
        'roles' => 'required',
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
     ]);

     $input = $request->all();
     $input['password'] = Hash::make($input['password']);
     $user = User::create($input);
     $user->assignRole($request->input('roles'));
     return redirect()->route('users.index')
     ->with('success','تم اضافة المستخدم بنجاح');
}

/**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function show($id)
{
   $user = User::find($id);
   return view('users.show',compact('user'));
}
/**
* Show the form for editing the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function edit($id)
{
   $user = User::find($id);
   $roles = Role::pluck('name','name')->all();
   $userRole = $user->roles->pluck('name','name')->all();
   return view('users.edit',compact('user','roles','userRole'));
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
     'roles' => 'required',
     'name' => 'required|string|max:255',
     'email' => 'required|string|email|max:255|unique:users,email,'.$id,
     'password' => 'string|min:8|confirmed',
     ]);
     $user=User::find($id);
     $user->name=$request->name;
     $user->email=$request->email;
     if ($request->password) {
        $user->password=Hash::make($request->password);
     }
     $user->save();
     DB::table('model_has_roles')->where('model_id',$id)->delete();
     $user->assignRole($request->input('roles'));
     return redirect()->route('users.index')
     ->with('success','تم تحديث معلومات المستخدم بنجاح');
}
/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function destroy(Request $request)
{
   User::find($request->user_id)->delete();
   return redirect()->route('users.index')->with('success','تم حذف المستخدم بنجاح');
}

}
