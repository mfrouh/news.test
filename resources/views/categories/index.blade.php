@extends('layouts.app')
@section('title')
الاقسام
@endsection
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto">الاقسام</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
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
 					<h4 class="card-title mg-b-0">الاقسام</h4>
 				</div>
 			</div>
 			<div class="card-body">
 				<div class="table-responsive">
 					<table id="example1" class="table key-buttons text-md-nowrap text-center">
 						<thead>
 							<tr>
 								<th class="border-bottom-0">الاسم</th>
 								<th class="border-bottom-0">الصورة</th>
                                <th class="border-bottom-0">الحالة</th>
                                <th class="border-bottom-0">عدد المقالات</th>
 								<th class="border-bottom-0">الصلاحيات</th>
 							</tr>
 						</thead>
 						<tbody>
						 @foreach ($categories as $category)
 							<tr>
 								<td>{{$category->name}}</td>
                                 <td>
                                    <img src="{{asset($category->image)}}" width="50px" height="50px" alt="">
                                </td>
                                <td>{{$category->getstatus()}}</td>
                                <td>{{$category->articles->count()}}</td>
 								<td>
                                     @can('مشاهدة قسم')
                                     <a class="btn btn-success btn-sm" href="/categories/{{$category->id}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                     @endcan
                                     @can('تعديل قسم')
                                     <a class="btn btn-primary btn-sm" href="/categories/{{$category->id}}/edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                     @endcan
                                     @can('حذف قسم')
                                     <a class="btn btn-danger btn-sm"  href="/categories/{{$category->id}}"
                                        onclick="event.preventDefault();
                                        document.getElementById('delete-category-{{$category->id}}').submit();"><i class="fa fa-trash" aria-hidden="true"></i>
                                     </a>
                                     <form id="delete-category-{{$category->id}}" action="/categories/{{$category->id}}" method="POST" class="d-none">
                                        @csrf
                                        @method("delete")
                                     </form>
                                     @endcan
                                </td>
 							</tr>
						 @endforeach
 						</tbody>
 					</table>
 				</div>
 			</div>
 		</div>
 	</div>
 </div>
</div>
</div>
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
@endsection
