<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth','role_or_permission:SuperAdmin|show permissions'])->only('index');
        $this->middleware(['auth','role_or_permission:SuperAdmin|create permission'])->only(['create','store']);
        $this->middleware(['auth','role_or_permission:SuperAdmin|show permission'])->only('show');
        $this->middleware(['auth','role_or_permission:SuperAdmin|edit permission'])->only(['edit','update']);
        $this->middleware(['auth','role_or_permission:SuperAdmin|delete permission'])->only('destroy');
    }
    public function index()
    {
       $permissions=Permission::all();
       return view('permissions.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permissions.create');
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
            'name'=>'required|unique:permissions'
        ]);
        Permission::create(['name'=>$request->name]);
        return redirect('/permissions')->with('success','Created permission Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $permission=Permission::findById($id);
       return view('permissions.show',compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission=Permission::findById($id);
        return view('permissions.edit',compact('permission'));
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
            'name'=>'required|unique:permissions,name,'.$id,
        ]);
        DB::table('permissions')->where('id',$id)->update(['name'=>$request->name]);
        return redirect('/permissions')->with('success','Updated permission Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('permissions')->where('id',$id)->delete();
        return back()->with('success','Deleted permission Successfully');
    }
}
