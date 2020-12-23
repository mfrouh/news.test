@extends('layouts.app')
@section('title')
{{$category->name}}
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
 				<div class="table-responsive">
 					<table id="example1" class="table key-buttons text-md-nowrap text-center">
 						<thead>
 							<tr>
 								<th class="border-bottom-0">الاسم</th>
 								<th class="border-bottom-0">البريد الالكتروني</th>
                                <th class="border-bottom-0">المقالات</th>
                                <th class="border-bottom-0">الصلاحيات</th>
 							</tr>
 						</thead>
 						<tbody>
						 @foreach ($category->users as $user)
 							<tr>
 								<td>{{$user->name}}</td>
 								<td>{{$user->email}}</td>
 								<td>{{$user->articles->count()}}</td>
 								<td>
                                    <a class="btn btn-danger btn-sm" href="/writercategory" onclick="event.preventDefault();
                                    document.getElementById('writercategory').submit();"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                     <form id="writercategory" action="/writercategory" method="POST" class="d-none">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name="category_id" value="{{$category->id}}">
                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                     </form>
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
				<!-- /row -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
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
