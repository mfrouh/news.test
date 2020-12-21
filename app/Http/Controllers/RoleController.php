<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth','role_or_permission:SuperAdmin|show roles'])->only('index');
        $this->middleware(['auth','role_or_permission:SuperAdmin|create role'])->only(['create','store']);
        $this->middleware(['auth','role_or_permission:SuperAdmin|show role'])->only('show');
        $this->middleware(['auth','role_or_permission:SuperAdmin|edit role'])->only(['edit','update']);
        $this->middleware(['auth','role_or_permission:SuperAdmin|delete role'])->only('destroy');
    }
    public function index()
    {
       $roles=Role::all();
       return view('roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
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
            'name'=>'required|unique:roles'
        ]);
        Role::create(['name'=>$request->name]);
        return redirect('/roles')->with('success','Created Role Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $role=Role::findById($id);
       $permissions=Permission::all();
       $rolepermissions=Role::findById($id)->permissions->pluck('id')->toArray();
       return view('roles.show',compact('role','permissions','rolepermissions'));
    }
    public function role_permissions(Request $request)
    {
      $this->validate($request,[
          'permissions'=>'required',
          'role_id'=>'required',
      ]);
      $role=Role::findById($request->role_id);
      $role->syncPermissions($request->permissions);
      return back()->with('success','Role Permission Updated');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role=Role::findById($id);
        return view('roles.edit',compact('role'));
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
        $this->validate($request,[
            'name'=>'required|unique:roles,name,'.$id,
        ]);
        DB::table('roles')->where('id',$id)->update(['name'=>$request->name]);
        return redirect('/roles')->with('success','Updated Role Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('roles')->where('id',$id)->delete();
        return back()->with('success','Deleted Role Successfully');
    }
}
