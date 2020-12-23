<?php
namespace App\Http\Controllers\Backend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function __construct()
{
    $this->middleware(['auth','permission:المستخدمين'])->only('index');
    $this->middleware(['auth','permission:انشاء مستخدم'])->only(['create','store']);
    $this->middleware(['auth','permission:مشاهدة مستخدم'])->only('show');
    $this->middleware(['auth','permission:تعديل مستخدم'])->only(['edit','update']);
    $this->middleware(['auth','permission:حذف مستخدم'])->only('destroy');
    $this->middleware(['auth','permission:تفعيل مستخدم'])->only('active');
    $this->middleware(['auth','permission:تعطيل مستخدم'])->only('inactive');
    $this->middleware(['auth','permission:الكتاب'])->only('writers');
    $this->middleware(['auth','permission:رؤساء الاقسام'])->only('supervisors');
    $this->middleware(['auth','permission:المشتركين'])->only('subscribers');
    $this->middleware(['auth','permission:انشاء كاتب'])->only(['createwrite','storewrite']);
    $this->middleware(['auth','permission:حذف مستخدم من القسم'])->only('writercategory');
    $this->middleware(['auth','permission:تعيين كاتب في القسم'])->only(['categorywriter','postcategorywriter']);

}
public function index()
{
   $users = User::orderBy('id','DESC')->get();
   $title='المستخدمين';
   return view('users.index',compact('users','title'));
}
public function writers()
{
   $users = User::role('كاتب')->orderBy('id','DESC')->get();
   $title='الكتاب';
   return view('users.index',compact('users','title'));
}
public function supervisors()
{
   $users = User::role('رئيس قسم')->orderBy('id','DESC')->get();
   $title='رؤساء الاقسام';
   return view('users.index',compact('users','title'));
}
public function subscribers()
{
   $users = User::role('مشترك')->orderBy('id','DESC')->get();
   $title='المشتركين';
   return view('users.index',compact('users','title'));
}

/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
    $roles = Role::where('name','!=','SuperAdmin')->pluck('id','name')->toArray();
    return view('users.create',compact('roles'));
}
public function createwrite()
{
    $categories=Category::all();
    return view('users.createwrite',compact('categories'));
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
     return redirect('/writers')
     ->with('success','تم اضافة الكاتب بنجاح');
}
public function categorywriter()
{
   $users=User::role('كاتب')->get();
   $categories=auth()->user()->mycategories;
   return view('users.categorywriter',compact('users','categories'));
}
public function postcategorywriter(Request $request)
{
   $this->validate($request, [
      'user_id' => 'required',
      'categories'=>'required',
   ]);
   $user=User::find($request->user_id);
   // $user->categories()->sync($request->categories);
   $user->categories()->attach($request->categories);
   return redirect('/writers')
   ->with('success','تم اضافة الكاتب في القسم بنجاح');
}

public function writercategory(Request $request)
{
   $this->validate($request,['user_id'=>'required','category_id'=>'required']);
   DB::table('user_category')->where('user_id',$request->user_id)->where('category_id',$request->category_id)->delete();
   return back()->with('success','تم حذف المستخدم من القسم بنجاح');
}

/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function active(Request $request)
{
    $this->validate($request,[
        'id'=>'required|integer',
    ]);
    $user=User::find($request->id);
    $user->status="active";
    $user->save();
    return back()->with('success','تم تفعيل مستخدم');
}
public function inactive(Request $request)
{
    $this->validate($request,[
        'id'=>'required|integer',
    ]);
    $user=User::find($request->id);
    $user->status="inactive";
    $user->save();
    return back()->with('success','تم تعطيل مستخدم');
}
public function store(Request $request)
{
     $this->validate($request, [
        'role' => 'required',
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
     ]);

     $input = $request->all();
     $input['password'] = Hash::make($input['password']);
     $user = User::create($input);
     $user->syncRoles($request->input('role'));
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
   $user=User::find($id);
   $permissions=Permission::whereNotIn('id',$user->getPermissionsViaRoles()->pluck('id')->toArray())->get();
   $userpermissions=$user->getAllPermissions()->pluck('id')->toArray();
   return view('users.show',compact('user','permissions','userpermissions'));
}
public function user_permissions(Request $request)
{
  $this->validate($request,[
      'user_id'=>'required',
  ]);
  $user=User::find($request->user_id);
  $user->syncPermissions($request->permissions);
  return back()->with('success','تم تعديل الصلاحيات بنجاح');
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
     'role' => 'required',
     'name' => 'required|string|max:255',
     'email' => 'required|string|email|max:255|unique:users,email,'.$id,
     'password' => 'nullable|string|min:8|confirmed',
     ]);
     $user=User::find($id);
     $user->name=$request->name;
     $user->email=$request->email;
     if ($request->password) {
        $user->password=Hash::make($request->password);
     }
     $user->save();
     DB::table('model_has_roles')->where('model_id',$id)->delete();
     $user->syncRoles($request->input('role'));
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
