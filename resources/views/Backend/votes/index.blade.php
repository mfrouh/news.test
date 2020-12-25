@extends('layouts.app')
@section('title')
التصويت
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
			<h4 class="content-title mb-0 my-auto">التصويت</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
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
 					<h4 class="card-title mg-b-0">التصويت</h4>
 				</div>
 			</div>
 			<div class="card-body">
 				<div class="table-responsive">
 					<table id="example1" class="table key-buttons text-md-nowrap text-center">
 						<thead>
 							<tr>
 								<th class="border-bottom-0">السؤال</th>
                                <th class="border-bottom-0">الاقسام</th>
                                <th class="border-bottom-0">الاختيارات</th>
 								<th class="border-bottom-0">الصلاحيات</th>
 							</tr>
 						</thead>
 						<tbody>
						 @foreach ($votes as $vote)
 							<tr>
 								<td>{{$vote->question}}</td>
                                <td>
                                    <a  class="btn btn-primary btn-sm">{{$vote->category->name}} </a>
                                </td>
                                <td>
                                    @foreach ($vote->options as $option)
                                    <a class="btn btn-danger btn-sm">{{$option->name}} </a>
                                    @endforeach
                                </td>
 								<td>
                                    <a class="btn btn-success btn-sm" href="/votes/{{$vote->id}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <a class="btn btn-primary btn-sm" href="/votes/{{$vote->id}}/edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                    <a class="btn btn-danger btn-sm"  href="/votes/{{$vote->id}}"
                                        onclick="event.preventDefault();
                                        document.getElementById('delete-vote-{{$vote->id}}').submit();"><i class="fa fa-trash" aria-hidden="true"></i>
                                     </a>
                                    <form id="delete-vote-{{$vote->id}}" action="/votes/{{$vote->id}}" method="POST" class="d-none">
                                        @csrf
                                        @method("delete")
                                    </form>
                                    @if ($vote->status=="unpublish")
                                         <a class="btn btn-success float-left btn-sm" href="/votes/publish"  onclick="event.preventDefault();
                                         document.getElementById('publish-vote').submit();">نشر تصويت</a>
                                        <form id="publish-vote" action="/votes/publish" method="POST" class="d-none">
                                           @csrf
                                           <input type="hidden" name="id" value="{{$vote->id}}">
                                        </form>
                                    @else
                                        <a class="btn btn-danger float-left btn-sm" href="/votes/unpublish" onclick="event.preventDefault();
                                        document.getElementById('unpublish-vote').submit();">الغاء نشر تصويت</a>
                                         <form id="unpublish-vote" action="/votes/unpublish" method="POST" class="d-none">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$vote->id}}">
                                         </form>
                                    @endif
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
