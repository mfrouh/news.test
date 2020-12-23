@extends('layouts.app')
@section('title')
تعديل مقال
@endsection
@section('css')
<link href="{{URL::asset('assets/plugins/inputtags/inputtags.css')}}" rel="stylesheet">
@endsection
@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto"> تعديل مقال</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
		</div>
	</div>
  </div>
  <!-- breadcrumb -->
@endsection
@section('content')
                <!-- row opened -->
<form action="/articles/{{$article->id}}" method="post" enctype="multipart/form-data">
 @csrf
 @method('PUT')
 <div class="row row-sm">
 	<div class="col-xl-8">
 		<div class="card mg-b-20">
 			<div class="card-header pb-0">
 				<div class="d-flex justify-content-between">
 					<h4 class="card-title mg-b-0">تعديل مقال</h4>
 				</div>
 			</div>
 			<div class="card-body">
                <div class="form-group">
                    <label for="">عنوان المقال</label>
                    <input type="text" name="title" class="form-control  @error('title') is-invalid @enderror" value="{{$article->title}}" placeholder="" aria-describedby="helpId">
                    @error('title')
                    <small id="helpId" class="text-muted">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">محتوي المقال</label>
                    <textarea name="content" class="form-control @error('content') is-invalid @enderror"  rows="4" >{{$article->content}}</textarea>
                    @error('content')
                    <small id="helpId" class="text-muted">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">كلمات لها علاقة</label>
                    <input type="text" data-role="tagsinput" name="tags" class="form-control @error('tags') is-invalid @enderror" value="{{implode(",",$article->tags->pluck('name')->toArray())}}">
                    @error('tags')
                    <small id="helpId" class="text-muted">{{$message}}</small>
                    @enderror
                </div>
 			</div>
 		</div>
     </div>
     <div class="col-xl-4">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">الاقسام</h4>
                </div>
            </div>
            <div class="card-body">
                @foreach (auth()->user()->categories as $category)
                 <div class="form-check">
                   <label class="btn btn-light">
                     <input type="checkbox" class="" name="categories[]" {{in_array($category->id,$article->categories->pluck('id')->toArray())?'checked':''}}  value="{{$category->id}}" >
                      {{$category->name}}
                   </label>
                 </div>
                 @endforeach
                 @error('categories')
                 <small id="helpId" class="text-muted">{{$message}}</small>
                 @enderror
            </div>
        </div>
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">صورة المقال</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <input type="file" name="image" value="{{old('image')}}" class="form-control @error('image') is-invalid @enderror" >
                    @error('image')
                    <small id="helpId" class="text-muted">{{$message}}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0"></h4>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group text-center">
                    <input type="submit" class="btn btn-primary" value="حفظ المقال" >
                </div>
            </div>
        </div>
    </div>
 </div>
</form>
</div>
</div>
@endsection
@section('js')
<script src="{{URL::asset('assets/plugins/inputtags/inputtags.js')}}"></script>
@endsection

