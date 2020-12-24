@extends('layouts.app')
@section('title')
المقالات
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
			<h4 class="content-title mb-0 my-auto">المقالات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
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
 					<h4 class="card-title mg-b-0">المقالات</h4>
 				</div>
 			</div>
 			<div class="card-body">
 				<div class="table-responsive">
 					<table id="example1" class="table key-buttons text-md-nowrap text-center">
 						<thead>
 							<tr>
 								<th class="border-bottom-0">العنوان</th>
 								<th class="border-bottom-0">الصورة</th>
 								<th class="border-bottom-0">الحالة</th>
                                <th class="border-bottom-0">الاقسام</th>
                                <th class="border-bottom-0">كلمات لها علاقة</th>
 								<th class="border-bottom-0">الصلاحيات</th>
 							</tr>
 						</thead>
 						<tbody>
						 @foreach ($articles as $article)
 							<tr>
 								<td>{{$article->title}}</td>
                                 <td>
                                    <img src="{{$article->image}}" width="37px" height="37px">
                                 </td>
 								<td>{{$article->getstatus()}}</td>
                                <td>
                                    @foreach ($article->categories as $category)
                                       <a href="/categories/{{$category->id}}" class="btn btn-primary btn-sm">{{$category->name}} </a>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($article->tags as $tag)
                                    <a href="/tag/{{$tag->id}}" class="btn btn-danger btn-sm">{{$tag->name}} </a>
                                    @endforeach
                                </td>
 								<td>
                                    @can('مشاهدة مقال')
                                    <a class="btn btn-success btn-sm" href="/articles/{{$article->id}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    @endcan
                                    @can('تعديل مقال')
                                    <a class="btn btn-primary btn-sm" href="/articles/{{$category->id}}/edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                    @endcan
                                    @can('حذف مقال')
                                    <a class="btn btn-danger btn-sm"  href="/articles/{{$article->id}}"
                                        onclick="event.preventDefault();
                                        document.getElementById('delete-article-{{$article->id}}').submit();"><i class="fa fa-trash" aria-hidden="true"></i>
                                     </a>
                                    <form id="delete-article-{{$article->id}}" action="/articles/{{$article->id}}" method="POST" class="d-none">
                                        @csrf
                                        @method("delete")
                                    </form>
                                    @endcan
                                    @if ($article->status=="unpublish")
                                    @can('نشر مقال')
                                     <a class="btn btn-success float-left btn-sm" href="/articles/publish"  onclick="event.preventDefault();
                                     document.getElementById('publish-article').submit();">نشر مقال</a>
                                    <form id="publish-article" action="/articles/publish" method="POST" class="d-none">
                                       @csrf
                                       <input type="hidden" name="id" value="{{$article->id}}">
                                    </form>
                                    @endcan
                                  @else
                                    @can('الغاء نشر مقال')
                                     <a class="btn btn-danger float-left btn-sm" href="/articles/unpublish" onclick="event.preventDefault();
                                     document.getElementById('unpublish-article').submit();">الغاء نشر مقال</a>
                                      <form id="unpublish-article" action="/articles/unpublish" method="POST" class="d-none">
                                         @csrf
                                         <input type="hidden" name="id" value="{{$article->id}}">
                                      </form>
                                    @endcan
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
