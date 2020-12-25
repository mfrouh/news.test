@extends('layouts.app')
@section('title')
انشاء تصويت
@endsection
@section('css')
<link href="{{URL::asset('assets/plugins/inputtags/inputtags.css')}}" rel="stylesheet">
@endsection
@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto"> انشاء تصويت</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
		</div>
	</div>
  </div>
  <!-- breadcrumb -->
@endsection
@section('content')
                <!-- row opened -->
<form action="/votes/{{$vote->id}}" method="post">
 @csrf
 @method('put')
 <div class="row row-sm">
 	<div class="col-xl-8">
 		<div class="card mg-b-20">
 			<div class="card-header pb-0">
 				<div class="d-flex justify-content-between">
 					<h4 class="card-title mg-b-0">انشاء تصويت</h4>
 				</div>
 			</div>
 			<div class="card-body">
                <div class="form-group">
                    <label for="">السؤال</label>
                    <input type="text" name="question" class="form-control  @error('question') is-invalid @enderror" value="{{$vote->question}}" placeholder="" aria-describedby="helpId">
                    @error('question')
                    <small id="helpId" class="text-muted">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">الاختيارات</label>
                    <input type="text" data-role="tagsinput" name="options" value="{{implode(",",$vote->options->pluck('name')->toArray())}}" class="form-control @error('options') is-invalid @enderror"   >
                    @error('options')
                    <small id="helpId" class="text-muted">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">بداية التصويت</label>
                    <input type="datetime-local" name="startvote" class="form-control  @error('startvote') is-invalid @enderror" value="{{$vote->startvote}}">
                    @error('startvote')
                    <small id="helpId" class="text-muted">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">نهاية التصويت</label>
                    <input type="datetime-local" name="endvote" class="form-control  @error('endvote') is-invalid @enderror" value="{{$vote->endvote}}">
                    @error('endvote')
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
                @foreach (auth()->user()->mycategories as $category)
                 <div class="form-check">
                   <label class="btn btn-light">
                     <input type="radio"   name="category_id" {{$category->id==$vote->category_id?'checked':''}}  value="{{$category->id}}" >
                       {{$category->name}}
                   </label>
                 </div>
                 @endforeach
                 @error('categories')
                 <small id="helpId" class="text-muted">{{$message}}</small>
                 @enderror
            </div>
        </div>
            <div class="card-body">
                <div class="form-group text-center">
                    <input type="submit" class="btn btn-primary" value="حفظ التصويت" >
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

