@extends('layouts.app')
@section('title')
تعيين كاتب في القسم
@endsection
@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto"> تعيين كاتب في القسم</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
		</div>
	</div>
  </div>
  <!-- breadcrumb -->
@endsection
@section('content')
                <!-- row opened -->
<form action="/categorywriter" method="post">
 @csrf
 <div class="row row-sm">
 	<div class="col-xl-8">
 		<div class="card mg-b-20">
 			<div class="card-header pb-0">
 				<div class="d-flex justify-content-between">
 					<h4 class="card-title mg-b-0">تعيين كاتب في القسم</h4>
 				</div>
 			</div>
 			<div class="card-body">
                <div class="form-group">
                    <label for="">الكاتب</label>
                    <hr>
                    <select name="user_id" class="form-control" >
                    @foreach ($users as $k=> $user)
                       <option value="{{$user->id}}">{{$user->name}}-{{$user->email}}</option>
                    @endforeach
                   </select>
                    @error('user_id')
                    <small id="helpId" class="text-muted">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">الاقسام</label>
                    <hr>
                    @foreach ($categories as $k=> $category)
                    <label class="btn btn-light">
                     <input type="checkbox" name="categories[]" value="{{$category->id}}">
                     {{$category->name}}
                    </label>
                    @endforeach
                    @error('categories')
                    <small id="helpId" class="text-muted">{{$message}}</small>
                    @enderror
                </div>
                </div>
                <div class="form-group text-center">
                    <input type="submit" class="btn btn-primary " value="حفظ">
                </div>
 			</div>
 		</div>
     </div>
 </div>
</form>
</div>
</div>
@endsection

