@extends('layouts.app')
@section('title')
انشاء مستخدم
@endsection
@section('css')
<link href="{{URL::asset('assets/plugins/inputtags/inputtags.css')}}" rel="stylesheet">
@endsection
@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto"> انشاء مستخدم</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
		</div>
	</div>
  </div>
  <!-- breadcrumb -->
@endsection
@section('content')
                <!-- row opened -->
<form action="/users/{{$user->id}}" method="post">
 @csrf
 @method("PUT")
 <div class="row row-sm">
 	<div class="col-xl-8">
 		<div class="card mg-b-20">
 			<div class="card-header pb-0">
 				<div class="d-flex justify-content-between">
 					<h4 class="card-title mg-b-0">انشاء مستخدم</h4>
 				</div>
 			</div>
 			<div class="card-body">
                <div class="form-group">
                    <label for="">اسم المستخدم</label>
                    <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" value="{{$user->name}}">
                    @error('name')
                    <small id="helpId" class="text-muted">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">البريد الالكتروني</label>
                    <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror" value="{{$user->email}}">
                    @error('email')
                    <small id="helpId" class="text-muted">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">كلمة السر</label>
                    <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror" >
                    @error('password')
                    <small id="helpId" class="text-muted">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">تاكيد كلمة السر</label>
                    <input type="password" name="password_confirmation" class="form-control  @error('password') is-invalid @enderror" >
                    @error('password')
                    <small id="helpId" class="text-muted">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">الوظائف</label>
                    <hr>
                    @foreach ($roles as $k=> $role)
                    <label class="btn btn-light">
                     <input type="radio" name="role" {{in_array($k,$userRole)?'checked':''}} value="{{$role}}">
                     {{$k}}
                    </label>
                    @endforeach

                    @error('roles')
                    <small id="helpId" class="text-muted">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group text-center">
                    <input type="submit" class="btn btn-primary" value="حفظ">
                </div>
 			</div>
 		</div>
     </div>
 </div>
</form>
</div>
</div>
@endsection

