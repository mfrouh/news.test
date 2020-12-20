<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
				<a class="desktop-logo logo-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo.png')}}" class="main-logo" alt="logo"></a>
				<a class="desktop-logo logo-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="main-logo dark-theme" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="logo-icon" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon-white.png')}}" class="logo-icon dark-theme" alt="logo"></a>
			</div>
			<div class="main-sidemenu">
				<div class="app-sidebar__user clearfix">
					<div class="dropdown user-pro-body">
						<div class="">
							<img alt="user-img" class="avatar avatar-xl brround" src="{{URL::asset('assets/img/faces/6.jpg')}}"><span class="avatar-status profile-status bg-green"></span>
						</div>
						<div class="user-info">
							<h4 class="font-weight-semibold mt-3 mb-0">{{auth()->user()->name}}</h4>
						</div>
					</div>
				</div>
				<ul class="side-menu">
					<li class="side-item side-item-category">الرئسية</li>
					<li class="slide">
						<a class="side-menu__item" href="{{ url('/dashboard' ) }}"><span class="side-menu__label">الرئسية</a>
                    </li>
                   @can('show roles')
                    <li class="side-item side-item-category">الادوار</li>
                   @can('show roles')
					<li class="slide">
						<a class="side-menu__item" href="{{ url('/roles' ) }}"><span class="side-menu__label">الادوار</a>
                    </li>
                    @endcan
                    @can('create role')
                    <li class="slide">
						<a class="side-menu__item" href="{{ url('/roles/create' ) }}"><span class="side-menu__label">انشاء دور</a>
                    </li>
                    @endcan
                    @endcan
                    @can('show permissions')
                    <li class="side-item side-item-category">الصلاحيات</li>
                    @can('show permissions')
					<li class="slide">
						<a class="side-menu__item" href="{{ url('/permissions' ) }}"><span class="side-menu__label">الصلاحيات</a>
                    </li>
                    @endcan
                    @can('create permission')
                    <li class="slide">
						<a class="side-menu__item" href="{{ url('/permissions/create' ) }}"><span class="side-menu__label">انشاء صلاحية</a>
                    </li>
                    @endcan
                    @endcan
					<li class="side-item side-item-category">المستخدمين</li>
					@can('show users')
					<li class="slide">
						<a class="side-menu__item" href="{{ url('/users' ) }}"><span class="side-menu__label">المستخدمين</a>
					</li>
					@endcan
					@can('show writers')
					<li class="slide">
						<a class="side-menu__item" href="{{ url('/writers' ) }}"><span class="side-menu__label">الكتاب</a>
					</li>
					@endcan
					<li class="side-item side-item-category">الاقسام</li>
					@can('show categories')
					<li class="slide">
						<a class="side-menu__item" href="{{ url('/categories' ) }}"><span class="side-menu__label">الاقسام</a>
					</li>
					@endcan
					<li class="side-item side-item-category">المقالات</li>
					@can('show articles')
					<li class="slide">
						<a class="side-menu__item" href="{{ url('/articles' ) }}"><span class="side-menu__label">المقالات</a>
					</li>
					@endcan
					@can('show myarticles')
					<li class="slide">
						<a class="side-menu__item" href="{{ url('/myarticles' ) }}"><span class="side-menu__label">مقالاتي</a>
					</li>
					@endcan
					@can('create articles')
					<li class="slide">
						<a class="side-menu__item" href="{{ url('/articles/create' ) }}"><span class="side-menu__label">انشاء مقال</a>
					</li>
					@endcan
					@can('show myarticles')
					<li class="side-item side-item-category">الاعدادات</li>
					<li class="slide">
						<a class="side-menu__item" href="{{ url('/setting' ) }}"><span class="side-menu__label">الاعدادات</a>
					</li>
					@endcan
				</ul>
			</div>
		</aside>
<!-- main-sidebar -->
