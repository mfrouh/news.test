@extends('layouts.app')
@section('title')
تعديل قسم
@endsection
@section('css')
<link href="{{URL::asset('assets/plugins/inputtags/inputtags.css')}}" rel="stylesheet">
@endsection
@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto"> تعديل قسم</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
		</div>
	</div>
  </div>
  <!-- breadcrumb -->
@endsection
@section('content')
                <!-- row opened -->
<form action="/categories/{{$category->id}}" method="post" enctype="multipart/form-data">
 @csrf
 @method('put')
 <div class="row row-sm">
 	<div class="col-xl-8">
 		<div class="card mg-b-20">
 			<div class="card-header pb-0">
 				<div class="d-flex justify-content-between">
 					<h4 class="card-title mg-b-0  ">تعديل قسم</h4>
 				</div>
 			</div>
 			<div class="card-body">
                <div class="form-group">
                    <label for="">اسم القسم</label>
                    <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" value="{{$category->name}}" placeholder="" aria-describedby="helpId">
                    @error('name')
                    <small id="helpId" class="text-muted">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">صورة القسم</label>
                    <input type="file" name="image" class="form-control  @error('image') is-invalid @enderror" placeholder="" aria-describedby="helpId">
                    @error('image')
                    <small id="helpId" class="text-muted">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">حالة القسم</label>
                    <select name="status" class="form-control  @error('status') is-invalid @enderror">
                        <option value="active" {{$category->status=="active"?'selected':''}}>مفعل</option>
                        <option value="inactive" {{$category->status=="inactive"?'selected':''}}>مغلق</option>
                    </select>
                    @error('status')
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

