<!-- navigation panel -->
<nav class="navbar navbar-default navbar-fixed-top nav-transparent overlay-nav sticky-nav nav-border-bottom" role="navigation">
    <div class="container">
        <div class="row">
            <!-- logo -->
            <div class="col-md-2 pull-left">
                <a class="logo-light" href="{{ route('index.index') }}">
                    <img alt="" src="{{ asset('images/logo.png') }}" class="logo" style="float: left;"/>
                    <span style="float: left; font-size: 30px; font-weight: bold; margin-top: 20px; display: block;"></span>
                    {{-- <span style="float: left; font-size: 15px; font-weight: bold; margin-top: 7px; display: block;" class="hidden-xs">TenX</span> --}}
                    {{-- <span style="float: left; font-size: 12px; font-weight: bold; margin-top: 7px; display: block;" class="visible-xs">TenX</span> --}}
                </a>
                <a class="logo-dark" href="{{ route('index.index') }}">
                    <img alt="" src="{{ asset('images/logo.png') }}" class="logo" style="float: left;"/>
                    <span style="float: left; font-size: 30px; font-weight: bold; margin-top: 20px; display: block;"></span>
                    {{-- <span style="float: left; font-size: 15px; font-weight: bold; margin-top: 7px; display: block;" class="hidden-xs">TenX</span> --}}
                    {{-- <span style="float: left; font-size: 12px; font-weight: bold; margin-top: 7px; display: block;" class="visible-xs">TenX</span> --}}
                </a>
            </div>
            <!-- end logo -->
            <!-- toggle navigation -->
            <div class="navbar-header col-sm-8 col-xs-2 pull-right">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- toggle navigation end -->
            <!-- main menu -->
            <div class="col-md-10 no-padding-right accordion-menu text-right">
                <div class="navbar-collapse collapse">
                    <ul id="accordion" class="nav navbar-nav navbar-right panel-group">
                        <li><a href="{{ route('index.index') }}" class="inner-link">Home</a></li>
                        {{-- <li><a href="{{ route('blog.categorywise', 'education') }}" class="inner-link">Education</a></li>
                        <li><a href="{{ route('blog.categorywise', 'business') }}" class="inner-link">Business</a></li>
                        <li class="dropdown panel simple-dropdown">
                            <a href="#nav_hisorical" class="dropdown-toggle collapsed" data-toggle="collapse" data-parent="#accordion" data-hover="dropdown">
                                Historical Place ▽
                            </a>
                            <ul id="nav_hisorical" class="dropdown-menu panel-collapse collapse" role="menu">
                                <li><a href="{{ route('blog.categorywise', 'dhaka') }}"><i class="icon-map-pin i-plain"></i> Dhaka</a></li>
                                <li><a href="{{ route('blog.categorywise', 'rajshahi') }}"><i class="icon-map-pin i-plain"></i> Rajshahi</a></li>
                                <li><a href="{{ route('blog.categorywise', 'sylhet') }}"><i class="icon-map-pin i-plain"></i> Sylhet</a></li>
                                <li><a href="{{ route('blog.categorywise', 'chittagong') }}"><i class="icon-map-pin i-plain"></i> Chittagong</a></li>
                                <li><a href="{{ route('blog.categorywise', 'barisal') }}"><i class="icon-map-pin i-plain"></i> Barisal</a></li>
                                <li><a href="{{ route('blog.categorywise', 'khulna') }}"><i class="icon-map-pin i-plain"></i> Khulna</a></li>
                                <li><a href="{{ route('blog.categorywise', 'rangpur') }}"><i class="icon-map-pin i-plain"></i> Rangpur</a></li>
                                <li><a href="{{ route('blog.categorywise', 'mymensingh') }}"><i class="icon-map-pin i-plain"></i> Mymensingh</a></li>
                            </ul>
                        </li>
                        <li class="dropdown panel simple-dropdown">
                            <a href="#nav_travel" class="dropdown-toggle collapsed" data-toggle="collapse" data-parent="#accordion" data-hover="dropdown">
                                Travel ▽
                            </a>
                            <ul id="nav_travel" class="dropdown-menu panel-collapse collapse" role="menu">
                                <li><a href="{{ route('blog.categorywise', 'bangladesh') }}"><i class="icon-map-pin i-plain"></i> Bangladesh</a></li>
                                <li><a href="{{ route('blog.categorywise', 'world-wide') }}"><i class="icon-map-pin i-plain"></i> World Wide</a></li>
                            </ul>
                        </li>
                        <li class="dropdown panel simple-dropdown">
                            <a href="#nav_biography" class="dropdown-toggle collapsed" data-toggle="collapse" data-parent="#accordion" data-hover="dropdown">
                                Biography ▽
                            </a>
                            <ul id="nav_biography" class="dropdown-menu panel-collapse collapse" role="menu">
                                <li><a href="{{ route('blog.categorywise', 'asia') }}"><i class="icon-map-pin i-plain"></i> Asia</a></li>
                                <li><a href="{{ route('blog.categorywise', 'africa') }}"><i class="icon-map-pin i-plain"></i> Africa</a></li>
                                <li><a href="{{ route('blog.categorywise', 'europe') }}"><i class="icon-map-pin i-plain"></i> Europe</a></li>
                                <li><a href="{{ route('blog.categorywise', 'north-america') }}"><i class="icon-map-pin i-plain"></i> North America</a></li>
                                <li><a href="{{ route('blog.categorywise', 'south-america') }}"><i class="icon-map-pin i-plain"></i> South America</a></li>
                                <li><a href="{{ route('blog.categorywise', 'australia') }}"><i class="icon-map-pin i-plain"></i> Australia</a></li>
                                <li><a href="{{ route('blog.categorywise', 'antarctica') }}"><i class="icon-map-pin i-plain"></i> Antarctica</a></li>
                            </ul>
                        </li> --}}
                        <li><a href="{{ route('index.about') }}" class="inner-link">About</a></li>
                        <li>
                            <a href="{{ route('index.contact') }}">Contact</a>
                        </li>
                        {{-- <li class="dropdown panel simple-dropdown">
                            <a href="#others_dropdown" class="dropdown-toggle collapsed" data-toggle="collapse" data-parent="#accordion" data-hover="dropdown">Others ▽
                            </a>
                            <ul id="others_dropdown" class="dropdown-menu panel-collapse collapse" role="menu">
                                <li>
                                    <a href="{{ route('index.news') }}"><i class="icon-newspaper i-plain"></i> News</a>
                                </li>
                                <li>
                                    <a href="{{ route('index.events') }}"><i class="icon-megaphone i-plain"></i> Events</a>
                                </li>
                                <li>
                                    <a href="{{ route('index.gallery') }}"><i class="icon-pictures i-plain"></i> Photo Gallery</a>
                                </li>
                            </ul>
                        </li> --}}
                        @if(Auth::check())
                        <li class="dropdown panel simple-dropdown">
                            <a href="#nav_auth_user" class="dropdown-toggle collapsed" data-toggle="collapse" data-parent="#accordion" data-hover="dropdown">
                                @php
                                    $nav_user_name = explode(' ', Auth::user()->name);
                                    $last_name = array_pop($nav_user_name);
                                @endphp
                                {{ $last_name }} ▽
                            </a>
                            <!-- sub menu single -->
                            <!-- sub menu item  -->
                            <ul id="nav_auth_user" class="dropdown-menu panel-collapse collapse" role="menu">
                                @if(Auth::user()->role != 'tenant')
                                    <li>
                                        <a href="{{ route('dashboard.index') }}"><i class="icon-speedometer i-plain"></i> Dashboard</a>
                                    </li>
                                @endif
                                <li>
                                    <a href="{{ route('index.profile', Auth::user()->unique_key) }}"><i class="icon-profile-male i-plain"></i> Profile</a>
                                </li>
                                <li>
                                    <a href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}"><i class="icon-key i-plain"></i> Logout</a>
                                </li>
                            </ul>
                        </li>
                        @else
                            <li>
                                <a href="{{ url('register') }}" class="inner-link">Register</a>
                            </li>
                            <li>
                                <a href="{{ url('login') }}" class="inner-link">Login</a>
                            </li>
                        @endif
                        <!-- end menu item -->
                    </ul>
                </div>
            </div>
            <!-- end main menu -->
        </div>
    </div>
</nav>
<!--end navigation panel -->