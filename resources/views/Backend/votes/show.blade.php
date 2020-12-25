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
 <div class="row row-sm">
 	<div class="col-xl-8">
 		<div class="card mg-b-20">
 			<div class="card-header pb-0">
 				<div class="d-flex justify-content-between">
 					<h4 class="card-title mg-b-0">التصويت</h4>
 				</div>
 			</div>
            <div class="card-body">
                 <h1>{{$vote->question}}</h1>
                 <div class="btn-group" data-toggle="buttons">
                     @foreach ($vote->options as $option)
                     <label class="btn btn-primary-gradient p-2 m-2">
                         <input type="radio" name="" id="" autocomplete="off" checked>
                         {{$option->name}}
                     </label>
                     @endforeach
                 </div>
                 <h5>
                     <a class="btn btn-primary-gradient">{{$vote->category->name}}</a>
                 </h5>
            </div>
 		</div>
     </div>
 </div>
</div>
</div>
@endsection
@section('js')
<script src="{{URL::asset('assets/plugins/inputtags/inputtags.js')}}"></script>
@endsection

