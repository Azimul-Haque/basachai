@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
    @stack('css')
    @yield('css')
@stop

@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? [
    'boxed' => 'layout-boxed',
    'fixed' => 'fixed',
    'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))

@section('body')
    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">
            @if(config('adminlte.layout') == 'top-nav')
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="navbar-brand">
                            {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
                        </a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
            @else
            <!-- Logo -->
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">{!! config('adminlte.logo_mini', '<b>A</b>LT') !!}</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">{{ trans('adminlte::adminlte.toggle_navigation') }}</span>
                </a>
            @endif
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">

                    <ul class="nav navbar-nav"> 
                      <li class="tasks-menu">
                          <a href="{{ url('/') }}" target="_blank" title="View Website" data-placement="bottom">
                              <i class="fa fa-fw fa-eye" aria-hidden="true"></i>
                          </a>
                      </li>
                      <li class="dropdown user user-menu"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                          @if(Auth::user()->image != '' && file_exists(public_path('images/users/'. Auth::user()->image)))
                            <img src="{{ asset('images/users/' . Auth::user()->image) }}" class="user-image" alt="{{ Auth::user()->name }}'s Image">
                          @else
                            <img src="{{ asset('images/user.png')}}" class="user-image" alt="User Image">
                          @endif
                          {{ Auth::User()->name }}</a>
                          <ul class="dropdown-menu" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            <!-- User image -->
                            <li class="user-header">
                              @if(Auth::user()->image != '' && file_exists(public_path('images/users/'. Auth::user()->image)))
                                <img src="{{ asset('images/users/' . Auth::user()->image)}}" class="img-circle" alt="{{ Auth::user()->name }}'s Image">
                              @else
                                <img src="{{ asset('images/user.png')}}" class="img-circle" alt="User Image">
                              @endif
                              <p>
                                {{ Auth::User()->name }}
                                <small>Member since {{ date('F, Y', strtotime(Auth::User()->created_at)) }}</small>
                              </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                              {{-- <div class="row">
                                <div class="col-xs-4 text-center">
                                  <a href="#">Followers</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                  <a href="#">Sales</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                  <a href="#">Friends</a>
                                </div>
                              </div> --}}
                              <!-- /.row -->
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                              <div class="pull-left">
                                <a href="{{ route('dashboard.personal.profile') }}" class="btn btn-default btn-flat">Profile</a>
                              </div>
                              <div class="pull-right">
                                @if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') && version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<'))
                                    <a href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" class="btn btn-default btn-flat">
                                        <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                    </a>
                                @else
                                    <a href="#"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">
                                        <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                    </a>
                                    <form id="logout-form" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" method="POST" style="display: none;" class="btn btn-default btn-flat">
                                        @if(config('adminlte.logout_method'))
                                            {{ method_field(config('adminlte.logout_method')) }}
                                        @endif
                                        {{ csrf_field() }}
                                    </form>
                                @endif
                              </div>
                            </li>
                          </ul>                            
                      </li>
                    </ul>
                </div>
                @if(config('adminlte.layout') == 'top-nav')
                </div>
                @endif
            </nav>
        </header>

        @if(config('adminlte.layout') != 'top-nav')
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

                <!-- Sidebar Menu -->
                <ul class="sidebar-menu" data-widget="tree">
                    {{-- @each('adminlte::partials.menu-item', $adminlte->menu(), 'item') --}}
                    <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.index') }}">
                            <i class="fa fa-fw fa-tachometer"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    @if(Auth::user()->role == 'admin')
                    {{-- <li class="{{ Request::is('dashboard/applications') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.applications') }}">
                            <i class="fa fa-fw fa-plus"></i>
                            <span>Applications</span>
                        </a>
                    </li> --}}
                    <li class="header">Articles Management</li>
                    <li class="{{ Request::is('dashboard/blogs') ? 'active' : '' }} {{ Request::is('dashboard/blogs/*') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.blogs') }}">
                            <i class="fa fa-fw fa-book"></i>
                            <span>Articles</span>
                        </a>
                    </li>
                    
                    <li class="header">Website Management</li>
                    <li class="{{ Request::is('dashboard/members') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.members') }}">
                            <i class="fa fa-fw fa-users"></i>
                            <span>Users</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('dashboard/sliders') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.sliders') }}">
                            <i class="fa fa-fw fa-list-alt"></i>
                            <span>Sliders</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('dashboard/contact/messages') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.contactmessages') }}">
                            <i class="fa fa-fw fa-envelope-o"></i>
                            <span>Contact Messages</span>
                        </a>
                    </li>

                    {{-- <li class="{{ Request::is('dashboard/strategies') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.strategies') }}">
                            <i class="fa fa-fw fa-briefcase"></i>
                            <span>Strategies</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('dashboard/expertises') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.expertises') }}">
                            <i class="fa fa-fw fa-flask"></i>
                            <span>Research Expertises</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('dashboard/projects') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.projects') }}">
                            <i class="fa fa-fw fa-cogs"></i>
                            <span>Projects</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('dashboard/publications/pending') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.publications.pending') }}">
                            <i class="fa fa-fw fa-hourglass-half"></i>
                            <span>Pending Publications</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('dashboard/publications') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.publications') }}">
                            <i class="fa fa-fw fa-book"></i>
                            <span>Publications</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('dashboard/disasterdatas') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.disasterdatas') }}">
                            <i class="fa fa-fw fa-tree"></i>
                            <span>Data Description</span>
                        </a>
                    </li> --}}
                    @endif
                    <li class="header">Personal Profile</li>
                    <li class="{{ Request::is('dashboard/personal/profile') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.personal.profile') }}">
                            <i class="fa fa-fw fa-user"></i>
                            <span>Your Profile</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('dashboard/personal/blogs') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.blogs.personal') }}">
                            <i class="fa fa-fw fa-pencil"></i>
                            <span>Your Articles</span>
                        </a>
                    </li>
                    {{-- <li class="{{ Request::is('dashboard/personal/publications') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.personal.pubs') }}">
                            <i class="fa fa-fw fa-files-o"></i>
                            <span>Your Publications</span>
                        </a>
                    </li> --}}
                    {{-- <li class="{{ Request::is('dashboard/personal/blogs') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.personal.pubs') }}">
                            <i class="fa fa-fw fa-files-o"></i>
                            <span>Your Publications</span>
                        </a>
                    </li> --}}
                </ul>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>
        @endif

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @if(config('adminlte.layout') == 'top-nav')
            <div class="container">
            @endif

            <!-- Content Header (Page header) -->
            <section class="content-header">
                @yield('content_header')
            </section>

            <!-- Main content -->
            <section class="content">

                @yield('content')

            </section>
            <!-- /.content -->
            @if(config('adminlte.layout') == 'top-nav')
            </div>
            <!-- /.container -->
            @endif
        </div>
        <!-- /.content-wrapper -->

        <!-- /.content-wrapper -->
        <footer class="main-footer">
          <div class="pull-right hidden-xs">
            <b>Version</b> 2.0.1
          </div>
          <strong>Copyright © {{ date('Y') }}</strong> 
          All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    <script type="text/javascript">
      $(function(){
       // $('a[title]').tooltip();
       // $('button[title]').tooltip();
       $('[title]').tooltip();
      });
    </script>
    @stack('js')
    @yield('js')
@stop
