@extends('layouts.app')
@section('title')
{{$category->name}}
@endsection
@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{$category->name}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
           @if ($category->status=="inactive")
             @can('تفعيل القسم')
              <a class="btn btn-success float-left" href="/categories/active"  onclick="event.preventDefault();
              document.getElementById('active-category').submit();">تفعيل القسم</a>
             <form id="active-category" action="/categories/active" method="POST" class="d-none">
                @csrf
                <input type="hidden" name="id" value="{{$category->id}}">
             </form>
             @endcan
           @else
             @can('تعطيل القسم')
              <a class="btn btn-danger float-left" href="/categories/inactive" onclick="event.preventDefault();
              document.getElementById('inactive-category').submit();">تعطيل القسم</a>
               <form id="inactive-category" action="/categories/inactive" method="POST" class="d-none">
                  @csrf
                  <input type="hidden" name="id" value="{{$category->id}}">
               </form>
             @endcan
           @endif
        </div>
	</div>
  </div>
  <!-- breadcrumb -->
@endsection
@section('content')
				<!-- row opened -->
 <div class="row row-sm">
 	<div class="col-xl-12">
 		<div class="card mg-b-20">
 			<div class="card-header pb-0">
 				<div class="d-flex justify-content-between">
 					<h4 class="card-title mg-b-0">{{$category->name}}</h4>
 				</div>
 			</div>
 			<div class="card-body">
                <a href="/categories/{{$category->id}}/writers" class="btn btn-success-gradient">الكتاب</a>
                <a href="/categories/{{$category->id}}/articles" class="btn btn-warning-gradient">المقالات</a>
 			</div>
 		</div>
 	</div>
 </div>
				<!-- /row -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
