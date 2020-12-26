<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
                @php
                    $setting=App\Models\Setting::first();
                @endphp
				<a class="desktop-logo logo-light active" href="{{ url('/') }}"><img src="{{URL::asset($setting->logo)}}" class="main-logo" alt="logo"></a>
				<a class="desktop-logo logo-dark active" href="{{ url('/') }}"><img src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="main-logo dark-theme" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-light active" href="{{ url('/') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="logo-icon" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-dark active" href="{{ url('/') }}"><img src="{{URL::asset('assets/img/brand/favicon-white.png')}}" class="logo-icon dark-theme" alt="logo"></a>
			</div>
			<div class="main-sidemenu">
				<div class="app-sidebar__user clearfix">
					<div class="dropdown user-pro-body">
						<div class="">
							<img class="avatar avatar-xl brround" src="{{URL::asset(auth()->user()->image)}}"><span class="avatar-status profile-status bg-green"></span>
						</div>
						<div class="user-info">
							<h4 class="font-weight-semibold mt-3 mb-0">{{auth()->user()->name}}</h4>
						</div>
					</div>
				</div>
				<ul class="side-menu">
					<li class="slide">
						<a class="side-menu__item" href="{{ url('/dashboard' ) }}"><span class="side-menu__label">الرئيسية</a>
                    </li>
                   @can('الوظائف')
                    <li class="slide">
                        <a class="side-menu__item" href="#" data-toggle="slide"><span class="side-menu__label">الوظائف</span><i class="angle fe fe-chevron-down"></i></a>
                        <ul class="slide-menu">
                         @can('الوظائف')
					     <li class="slide">
					     	<a class="side-menu__item" href="{{ url('/roles' ) }}"><span class="side-menu__label">الوظائف</a>
                         </li>
                         @endcan
                         @can('انشاء وظيفة')
                         <li class="slide">
					     	<a class="side-menu__item" href="{{ url('/roles/create' ) }}"><span class="side-menu__label">انشاء وظيفة</a>
                         </li>
                         @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('الصلاحيات')
                    <li class="slide">
                        <a class="side-menu__item" href="#" data-toggle="slide"><span class="side-menu__label">الصلاحيات</span><i class="angle fe fe-chevron-down"></i></a>
                        <ul class="slide-menu">
                         @can('الصلاحيات')
					     <li >
					     	<a class="side-menu__item" href="{{ url('/permissions' ) }}"><span class="side-menu__label">الصلاحيات</a>
                         </li>
                         @endcan
                         @can('انشاء صلاحية')
                         <li >
					     	<a class="side-menu__item" href="{{ url('/permissions/create' ) }}"><span class="side-menu__label">انشاء صلاحية</a>
                         </li>
                         @endcan
                       </ul>
                    </li>
                    @endcan
                    @can('الكتاب')
					<li class="slide">
                        <a class="side-menu__item" href="#" data-toggle="slide"><span class="side-menu__label">المستخدمين</span><i class="angle fe fe-chevron-down"></i></a>
                        <ul class="slide-menu">
                            @can('المستخدمين')
					        <li>
                               <a class="side-menu__item"  href="{{ url('/users') }}"><span class="side-menu__label">المستخدمين</a>
					        </li>
					        @endcan
                            @can('الكتاب')
                            <li>
                                <a class="side-menu__item" href="{{ url('/writers') }}"><span class="side-menu__label">الكتاب</a>
                            </li>
                            @endcan
                            @can('المشتركين')
                            <li>
                                <a class="side-menu__item" href="{{ url('/subscribers') }}"><span class="side-menu__label">المشتركين</a>
                            </li>
                            @endcan
                            @can('رؤساء الاقسام')
                            <li>
                                <a class="side-menu__item" href="{{ url('/supervisors') }}"><span class="side-menu__label">رؤساء الاقسام</a>
                            </li>
                            @endcan
                            @can('انشاء مستخدم')
                            <li>
                                <a class="side-menu__item" href="{{ url('/users/create') }}"><span class="side-menu__label">انشاء مستخدم</a>
                            </li>
                            @endcan
                            @can('انشاء كاتب')
                            <li>
                                <a class="side-menu__item" href="{{ url('/writers/create') }}"><span class="side-menu__label">انشاء كاتب</a>
                            </li>
                            @endcan

                        </ul>
                    </li>
                    @endcan
                    @can('الاقسام')
                    <li class="slide">
                        <a class="side-menu__item" href="#" data-toggle="slide"><span class="side-menu__label">الاقسام</span><i class="angle fe fe-chevron-down"></i></a>
                        <ul class="slide-menu">
					       @can('الاقسام')
					       <li>
					       	<a class="side-menu__item" href="{{ url('/categories' ) }}"><span class="side-menu__label">الاقسام</a>
                           </li>
                           @endcan
                           @can('انشاء قسم')
					       <li>
					       	<a class="side-menu__item" href="{{ url('/categories/create' ) }}"><span class="side-menu__label">انشاء قسم</a>
                           </li>
                           @endcan
                        </ul>
                    </li>
                    @endcan
                    @if (auth()->user()->hasRole('رئيس قسم'))
                    <li class="slide">
                        <a class="side-menu__item" href="#" data-toggle="slide"><span class="side-menu__label">التصويت</span><i class="angle fe fe-chevron-down"></i></a>
                        <ul class="slide-menu">
					       <li>
					       	<a class="side-menu__item" href="{{ url('/votes' ) }}"><span class="side-menu__label">التصويت</a>
                           </li>
					       <li>
					       	<a class="side-menu__item" href="{{ url('/votes/create' ) }}"><span class="side-menu__label">انشاء تصويت</a>
                           </li>
                        </ul>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" href="#" data-toggle="slide"><span class="side-menu__label">الكتاب في القسم</span><i class="angle fe fe-chevron-down"></i></a>
                        <ul class="slide-menu">
                            @can('انشاء كاتب في القسم')
                            <li>
                                <a class="side-menu__item" href="{{ url('/categories/writers/create') }}"><span class="side-menu__label">انشاء كاتب في القسم</a>
                            </li>
                            @endcan
                            @can('تعيين كاتب في القسم')
                            <li>
                                <a class="side-menu__item" href="{{ url('/categorywriter') }}"><span class="side-menu__label">تعيين كاتب في القسم</a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" href="#" data-toggle="slide"><span class="side-menu__label">الاقسام</span><i class="angle fe fe-chevron-down"></i></a>
                        <ul class="slide-menu">
                           @can("اقسامي")
                           @foreach (auth()->user()->mycategories as $category)
					       <li>
					       	<a class="side-menu__item" href="/categories/{{$category->id}}"><span class="side-menu__label">{{$category->name}}</a>
                           </li>
                           @endforeach
                           @endcan
                        </ul>
                    </li>
                    @endif
					<li class="slide">
                        <a class="side-menu__item" href="#" data-toggle="slide"><span class="side-menu__label">المقالات</span><i class="angle fe fe-chevron-down"></i></a>
                        <ul class="slide-menu">
					       @can('المقالات')
					       <li>
					       	<a class="side-menu__item" href="{{ url('/articles' ) }}"><span class="side-menu__label">المقالات</a>
					       </li>
					       @endcan
					       @can('مقالاتي')
					       <li>
					       	<a class="side-menu__item" href="{{ url('/myarticles' ) }}"><span class="side-menu__label">مقالاتي</a>
					       </li>
					       @endcan
					       @can('انشاء مقال')
					       <li>
					       	<a class="side-menu__item" href="{{ url('/articles/create' ) }}"><span class="side-menu__label">انشاء مقال</a>
					       </li>
                           @endcan
                        </ul>
                    </li>
					@can('تعديل الموقع')
					<li class="slide">
						<a class="side-menu__item" href="{{ url('/setting' ) }}"><span class="side-menu__label">الاعدادات</a>
					</li>
					@endcan
				</ul>
			</div>
		</aside>
<!-- main-sidebar -->
