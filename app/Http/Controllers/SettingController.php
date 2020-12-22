<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
   public function __construct()
   {
       $this->middleware(['auth','permission:تعديل الموقع'])->only(['index','setting']);
   }

   public function index()
   {
    $setting=Setting::first();
    return view('setting.index',compact('setting'));
   }

   public function setting(Request $request)
   {
    $this->validate($request,[
        'name'=>'required',
        'logo'=>"nullable",
        'description'=>'required',
        'facebook'=>'url|nullable',
        'twitter'=>'url|nullable',
        'youtube'=>'url|nullable',
        'twitter'=>'url|nullable',
    ]);
    $setting=Setting::first();
    if($setting)
    {
        $setting=Setting::first();
    }
    else {
        $setting=new Setting();
    }
    $setting->name=$request->name;
    if ($request->logo) {
        $setting->logo=sorteimage('storage/logo/',$request->logo);
    }
    $setting->description=$request->description;
    $setting->facebook=$request->facebook;
    $setting->twitter=$request->twitter;
    $setting->instagram=$request->instagram;
    $setting->youtube=$request->youtube;
    $setting->save();
    return back()->with('success','تم تعديل الموقع بنجاح');
   }
   public function style($page)
   {
      return view($page);
   }
}
