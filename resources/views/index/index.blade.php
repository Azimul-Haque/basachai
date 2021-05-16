@extends('layouts.index')

@section('title')
    BasaChai (বাসা চাই) is the place where you can find your affordable home for rent! 
@endsection

@section('css')
    {!!Html::style('css/parsley.css')!!}
    <style type="text/css">
        body {
            overflow: hidden;
        }

        /* Preloader */
        #preloader {
            position: fixed;
            top:0;
            left:0;
            right:0;
            bottom:0;
            background-color:#fff; /* change if the mask should have another color then white */
            z-index:99999;
        }

        #status {
            width:200px;
            height:200px;
            position:absolute;
            left:50%;
            top:50%;
            background-image:url({{ asset('images/3362406.gif') }}); /* path to your loading animation */
            background-repeat:no-repeat;
            background-position:center;
            margin:-100px 0 0 -100px;
        }
        .parsley-errors-list li {
            color: #FFFFFF;
        }
    </style>
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/stylesheet.css') }}"> --}}
    <meta property="og:image" content="{{ asset('/images/banner.jpg') }}" />
    <meta property="og:title" content="BasaChai (বাসা চাই) is the place where you can find your affordable home for rent! "/>
    <meta name="description" property="og:description" content="BasaChai (বাসা চাই) is the place where you can find your affordable home for rent! Developed by A. H. M. Azimul Haque" />
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:site_name" content="BasaChai (বাসা চাই)">
    <meta property="og:locale" content="en_US">
    <meta property="fb:admins" content="100001596964477">
    <meta property="fb:app_id" content="163879201229487">
    <meta property="og:type" content="article">
    <!-- Open Graph - Article -->
    <meta name="article:section" content="Article">
    <meta name="article:published_time" content="2021">
    <meta name="article:author" content="A. H. M. Azimul Haque">
    <meta name="article:tag" content="Article">
    <meta name="article:modified_time" content="{{ date('F d, Y') }}">

@endsection

@section('content')
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    {{-- @include('partials._slider') --}}
    
    <!-- about section -->
    <section id="counter" class="fix-background content-top-margin" style="background-image:url('/images/mapback.png');">
        <div class="opacity-full bg-dark-gray"></div>
        <div class="container position-relative">
            <div class="row">
                <div class="col-md-8 col-sm-10 text-center center-col">
                    <div class="row">
                        <form action="{{ route('index.search') }}" method="post" data-parsley-validate="">
                            {!! csrf_field() !!}
                            <div class="col-md-5">
                              <div class="form-group no-margin-bottom">
                                  <select name="district" id="district" required="">
                                    <option value="" selected="" disabled="">Select District</option>
                                    <option value="Dhaka">Dhaka</option>
                                    <option value="Other ">Other</option>
                                  </select>
                              </div>
                            </div>
                            <div class="col-md-5">
                              <div class="form-group no-margin-bottom">
                                  <select name="upazilla" id="upazilla" required="">
                                    <option value="" selected="" disabled="">Select Area</option>
                                    <option value="tenant">Mohammadpur</option>
                                    <option value="landlord ">Adabor</option>
                                  </select>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <button class="btn highlight-button-dark btn-small margin-one" type="submit">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="wow fadeIn">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-10 text-center center-col">
                    <span class="margin-five no-margin-top display-block letter-spacing-2">Established-2021</span>
                    <span style="font-size: 20px; font-weight: bold;">BasaChai (বাসা চাই)</span>
                    <p class="text-med width-90 center-col margin-seven no-margin-bottom">BasaChai (বাসা চাই) is the place where you can find your affordable home for rent! </p>
                </div>
            </div>
        </div>
    </section>
    <!-- end about section -->
    <section class="padding-three bg-gray">
        <div class="container">
            <div class="row">
                <!-- section title -->
                <div class="col-md-6 col-sm-6">
                    <span class="text-large letter-spacing-2 black-text font-weight-600 agency-title">BasaChai Premiums</span>
                </div>
                <!-- end section title -->
                <!-- section highlight text -->
                <div class="col-md-6 col-sm-6 text-right xs-text-left">
                </div>
                <!-- end section highlight text -->
            </div>
        </div>
    </section>
    <section class="work-5col gutter work-with-title wide wide-title padding-five bg-yellow">
        <div class="container">
            <div class="row">
                <div class="col-md-12 grid-gallery overflow-hidden no-padding" >
                    <div class="tab-content">
                        <!-- tour grid -->
                        <ul class="grid masonry-items">
                            <li class="completed wow fadeInLeft" data-wow-duration="300ms">
                                <figure>
                                    <div class="gallery-img">
                                        <a href="#">
                                            <img src="{{ asset('images/dummyhome.png')}}"  class="img-responsive" />
                                        </a>
                                    </div>
                                    <figcaption>
                                        <h3><big>Apartment 1</big></h3>
                                        {{-- <p class="project-min-height">{{ substr(strip_tags($project->title), 0, 50) }}...</p> --}}
                                        <a class="btn inner-link btn-black btn-small" href="#">Explore Now</a>
                                    </figcaption>
                                </figure>
                            </li>
                            <li class="completed wow fadeInLeft" data-wow-duration="600ms">
                                <figure>
                                    <div class="gallery-img">
                                        <a href="#">
                                            <img src="{{ asset('images/dummyhome.png')}}"  class="img-responsive" />
                                        </a>
                                    </div>
                                    <figcaption>
                                        <h3><big>Apartment 2</big></h3>
                                        {{-- <p class="project-min-height">{{ substr(strip_tags($project->title), 0, 50) }}...</p> --}}
                                        <a class="btn inner-link btn-black btn-small" href="#">Explore Now</a>
                                    </figcaption>
                                </figure>
                            </li>
                            <li class="completed wow fadeInLeft" data-wow-duration="900ms">
                                <figure>
                                    <div class="gallery-img">
                                        <a href="#">
                                            <img src="{{ asset('images/dummyhome.png')}}"  class="img-responsive" />
                                        </a>
                                    </div>
                                    <figcaption>
                                        <h3><big>Apartment 3</big></h3>
                                        {{-- <p class="project-min-height">{{ substr(strip_tags($project->title), 0, 50) }}...</p> --}}
                                        <a class="btn inner-link btn-black btn-small" href="#">Explore Now</a>
                                    </figcaption>
                                </figure>
                            </li>
                            <li class="completed wow fadeInLeft" data-wow-duration="1200ms">
                                <figure>
                                    <div class="gallery-img">
                                        <a href="#">
                                            <img src="{{ asset('images/dummyhome.png')}}"  class="img-responsive" />
                                        </a>
                                    </div>
                                    <figcaption>
                                        <h3><big>Apartment 4</big></h3>
                                        {{-- <p class="project-min-height">{{ substr(strip_tags($project->title), 0, 50) }}...</p> --}}
                                        <a class="btn inner-link btn-black btn-small" href="#">Explore Now</a>
                                    </figcaption>
                                </figure>
                            </li>
                            <li class="completed wow fadeInLeft" data-wow-duration="1500ms">
                                <figure>
                                    <div class="gallery-img">
                                        <a href="#">
                                            <img src="{{ asset('images/dummyhome.png')}}"  class="img-responsive" />
                                        </a>
                                    </div>
                                    <figcaption>
                                        <h3><big>Apartment 5</big></h3>
                                        {{-- <p class="project-min-height">{{ substr(strip_tags($project->title), 0, 50) }}...</p> --}}
                                        <a class="btn inner-link btn-black btn-small" href="#">Explore Now</a>
                                    </figcaption>
                                </figure>
                            </li>
                        </ul>
                        <!-- end tour grid -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="padding-three bg-gray">
        <div class="container">
            <div class="row">
                <!-- section title -->
                <div class="col-md-6 col-sm-6">
                    <span class="text-large letter-spacing-2 black-text font-weight-600 agency-title">BasaChai Recent Ads</span>
                </div>
                <!-- end section title -->
                <!-- section highlight text -->
                <div class="col-md-6 col-sm-6 text-right xs-text-left">
                </div>
                <!-- end section highlight text -->
            </div>
        </div>
    </section>
    <section id="tour-package" class="padding-two sm-padding-top-nine sm-padding-bottom-nine">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- destinations items -->
                    <div class="col-md-4 col-sm-6 margin-two no-margin-top sm-margin-bottom-four xs-no-padding">
                        <div class="cover-background best-hotels-img" style="background-image:url('/images/offers/travel-17.jpg');">
                            <div class="col-md-6 col-sm-9 text-center best-hotels-text bg-white pull-right">
                                <div><i class="fa fa-star-o small-icon yellow-text"></i><i class="fa fa-star-o small-icon yellow-text"></i><i class="fa fa-star-o small-icon yellow-text"></i><i class="fa fa-star-o small-icon yellow-text"></i><i class="fa fa-star-o small-icon"></i></div>
                                <span class="text-uppercase font-weight-600 display-block black-text margin-ten no-margin-bottom letter-spacing-2">Essential Peru</span>
                                <span class="text-uppercase letter-spacing-2 margin-ten display-block no-margin-top">7 Days / $350</span>
                                <a href="#" class="highlight-button-dark btn btn-small button no-margin-lr">Book Now</a>
                            </div>
                            <div class="destinations-offer bg-fast-yellow text-center font-weight-600 text-uppercase black-text text-large no-letter-spacing">20% <span class="display-block text-small">off</span></div>
                        </div>
                    </div>
                    <!-- end destinations items -->
                    <!-- destinations items -->
                    <div class="col-md-4 col-sm-6 margin-two no-margin-top sm-margin-bottom-four xs-no-padding">
                        <div class="cover-background best-hotels-img" style="background-image:url('/images/offers/travel-18.jpg');">
                            <div class="col-md-6 col-sm-9 text-center best-hotels-text bg-white pull-right">
                                <div><i class="fa fa-star-o small-icon yellow-text"></i><i class="fa fa-star-o small-icon yellow-text"></i><i class="fa fa-star-o small-icon yellow-text"></i><i class="fa fa-star-o small-icon yellow-text"></i><i class="fa fa-star-o small-icon"></i></div>
                                <span class="text-uppercase font-weight-600 display-block black-text margin-ten no-margin-bottom letter-spacing-2">Maharaja Tour</span>
                                <span class="text-uppercase letter-spacing-2 margin-ten display-block no-margin-top">7 Days / $350</span>
                                <a href="#" class="highlight-button-dark btn btn-small button no-margin-lr">Book Now</a>
                            </div>
                            <div class="destinations-offer bg-fast-yellow text-center font-weight-600 text-uppercase black-text text-large no-letter-spacing">40% <span class="display-block text-small">off</span></div>
                        </div>
                    </div>
                    <!-- end destinations items -->
                    <!-- destinations items -->
                    <div class="col-md-4 col-sm-6 margin-two no-margin-top sm-margin-bottom-four xs-no-padding">
                        <div class="cover-background best-hotels-img" style="background-image:url('/images/offers/travel-19.jpg');">
                            <div class="col-md-6 col-sm-9 text-center best-hotels-text bg-white pull-right">
                                <div><i class="fa fa-star-o small-icon yellow-text"></i><i class="fa fa-star-o small-icon yellow-text"></i><i class="fa fa-star-o small-icon yellow-text"></i><i class="fa fa-star-o small-icon yellow-text"></i><i class="fa fa-star-o small-icon"></i></div>
                                <span class="text-uppercase font-weight-600 display-block black-text margin-ten no-margin-bottom letter-spacing-2">African Surprise</span>
                                <span class="text-uppercase letter-spacing-2 margin-ten display-block no-margin-top">7 Days / $350</span>
                                <a href="#" class="highlight-button-dark btn btn-small button no-margin-lr">Book Now</a>
                            </div>
                            <div class="destinations-offer bg-fast-yellow text-center font-weight-600 text-uppercase black-text text-large no-letter-spacing">35% <span class="display-block text-small">off</span></div>
                        </div>
                    </div>
                    <!-- end destinations items -->
                    <!-- destinations items -->
                    <div class="col-md-4 col-sm-6 sm-margin-bottom-four xs-no-padding md-margin-bottom">
                        <div class="cover-background best-hotels-img" style="background-image:url('/images/offers/travel-20.jpg');">
                            <div class="col-md-6 col-sm-9 text-center best-hotels-text bg-white pull-right">
                                <div><i class="fa fa-star-o small-icon yellow-text"></i><i class="fa fa-star-o small-icon yellow-text"></i><i class="fa fa-star-o small-icon yellow-text"></i><i class="fa fa-star-o small-icon yellow-text"></i><i class="fa fa-star-o small-icon"></i></div>
                                <span class="text-uppercase font-weight-600 display-block black-text margin-ten no-margin-bottom letter-spacing-2">Wonders India</span>
                                <span class="text-uppercase letter-spacing-2 margin-ten display-block no-margin-top">7 Days / $350</span>
                                <a href="#" class="highlight-button-dark btn btn-small button no-margin-lr">Book Now</a>
                            </div>
                            <div class="destinations-offer bg-fast-yellow text-center font-weight-600 text-uppercase black-text text-large no-letter-spacing">45% <span class="display-block text-small">off</span></div>
                        </div>
                    </div>
                    <!-- end destinations items -->
                    <!-- destinations items -->
                    <div class="col-md-4 col-sm-6 xs-margin-bottom-four xs-no-padding">
                        <div class="cover-background best-hotels-img" style="background-image:url('/images/offers/travel-21.jpg');">
                            <div class="col-md-6 col-sm-9 text-center best-hotels-text bg-white pull-right">
                                <div><i class="fa fa-star-o small-icon yellow-text"></i><i class="fa fa-star-o small-icon yellow-text"></i><i class="fa fa-star-o small-icon yellow-text"></i><i class="fa fa-star-o small-icon yellow-text"></i><i class="fa fa-star-o small-icon"></i></div>
                                <span class="text-uppercase font-weight-600 display-block black-text margin-ten no-margin-bottom letter-spacing-2">Pilgrimage</span>
                                <span class="text-uppercase letter-spacing-2 margin-ten display-block no-margin-top">7 Days / $350</span>
                                <a href="#" class="highlight-button-dark btn btn-small button no-margin-lr">Book Now</a>
                            </div>
                            <div class="destinations-offer bg-fast-yellow text-center font-weight-600 text-uppercase black-text text-large no-letter-spacing">60% <span class="display-block text-small">off</span></div>
                        </div>
                    </div>
                    <!-- end destinations items -->
                    <!-- destinations items -->
                    <div class="col-md-4 col-sm-6 xs-margin-bottom-four xs-no-padding">
                        <div class="cover-background best-hotels-img" style="background-image:url('/images/offers/travel-22.jpg');">
                            <div class="col-md-6 col-sm-9 text-center best-hotels-text bg-white pull-right">
                                <div><i class="fa fa-star-o small-icon yellow-text"></i><i class="fa fa-star-o small-icon yellow-text"></i><i class="fa fa-star-o small-icon yellow-text"></i><i class="fa fa-star-o small-icon yellow-text"></i><i class="fa fa-star-o small-icon"></i></div>
                                <span class="text-uppercase font-weight-600 display-block black-text margin-ten no-margin-bottom letter-spacing-2">Green Nepal</span>
                                <span class="text-uppercase letter-spacing-2 margin-ten display-block no-margin-top">7 Days / $350</span>
                                <a href="#" class="highlight-button-dark btn btn-small button no-margin-lr">Book Now</a>
                            </div>
                            <div class="destinations-offer bg-fast-yellow text-center font-weight-600 text-uppercase black-text text-large no-letter-spacing">36% <span class="display-block text-small">off</span></div>
                        </div>
                    </div>
                    <!-- end destinations items -->
                </div>
            </div>
        </div>
    </section>

    <section class="padding-three bg-gray">
        <div class="container">
            <div class="row">
                <!-- section title -->
                <div class="col-md-6 col-sm-6">
                    <span class="text-large letter-spacing-2 black-text font-weight-600 agency-title">BasaChai at a Glance</span>
                </div>
                <!-- end section title -->
                <!-- section highlight text -->
                <div class="col-md-6 col-sm-6 text-right xs-text-left">
                </div>
                <!-- end section highlight text -->
            </div>
        </div>
    </section>
    <!-- counter section -->
    <section id="counter" class="fix-background" style="background-image:url('/images/sliders/slider-img45.jpg');">
        <div class="opacity-full bg-dark-gray"></div>
        <div class="container position-relative">
            <div class="row">
                <!-- counter item -->
                <div class="col-md-4 col-sm-6 bottom-margin text-center counter-section wow fadeInUp sm-margin-bottom-ten" data-wow-duration="300ms">
                    <i class="icon-heart medium-icon"></i>
                    <span class="timer counter-number white-text main-font font-weight-600" data-to="1000" data-speed="7000"></span>
                    <span class="counter-title light-gray-text">People Served</span>
                </div>
                <!-- end counter item -->
                <!-- counter item -->
                <div class="col-md-4 col-sm-6 bottom-margin text-center counter-section wow fadeInUp sm-margin-bottom-ten" data-wow-duration="600ms">
                    <i class="icon-happy medium-icon"></i>
                    <span class="timer counter-number white-text main-font font-weight-600" data-to="100" data-speed="7000"></span>+
                    <span class="counter-title light-gray-text">Available Homes</span>
                </div>
                <!-- end counter item -->
                <!-- counter item -->
                <div class="col-md-4 col-sm-6 text-center counter-section wow fadeInUp" data-wow-duration="1200ms">
                    <i class="icon-chat medium-icon"></i>
                    <span class="timer counter-number white-text main-font font-weight-600" data-to="{{ $blogcount }}" data-speed="7000"></span>
                    <span class="counter-title light-gray-text">Articles</span>
                </div>
                <!-- end counter item -->
            </div>
        </div>
    </section>
    <!-- end counter section -->
    <!-- blog content section -->
    <section class="padding-five">
        <div class="container">
            <div class="row">
                <!-- call to action -->
                <div class="col-md-7 col-sm-12 text-center center-col">
                    <p class="title-large text-uppercase letter-spacing-1 black-text font-weight-600 wow fadeIn">Latest Articles</p><br/><br/>
                </div>
                <!-- end call to action -->
            </div>
            <div class="row">
                <!-- post item -->
                @php
                    $eventwaitduration = 600;
                @endphp
                @foreach($blogs as $blog)
                <div class="col-md-4 col-sm-4 wow fadeInRight blog-listing" data-wow-duration="{{ $eventwaitduration }}ms">
                    <div class="blog-image">
                        <a href="{{ route('blog.single', $blog->slug) }}">
                            @if($blog->featured_image != null)
                            <img src="{{ asset('images/blogs/'.$blog->featured_image) }}" alt=""/>
                            @else
                            <img src="{{ asset('images/abc.png') }}" alt=""/>
                            @endif
                        </a>
                    </div>
                    <div class="blog-details">
                        <div class="blog-date"><a href="{{ route('blogger.profile', $blog->user->unique_key) }}">{{ $blog->user->name }}</a> | {{ date('F d, Y', strtotime($blog->created_at)) }}</div>
                        <div class="blog-title" style="min-height: 65px;"><a href="{{ route('blog.single', $blog->slug) }}">{{ $blog->title }}</a></div>
                        <div class="blog-short-description" style="text-align: justify; text-justify: inter-word; width: 100%; min-height: 120px;">
                            @if(strlen(strip_tags($blog->body))>300)
                            {{ mb_substr(strip_tags($blog->body), 0, stripos($blog->body, " ", stripos(strip_tags($blog->body), " ")+200))." [...] " }}
                            @else
                                {{ strip_tags($blog->body) }}
                            @endif
                        </div>
                        <div class="separator-line bg-black no-margin-lr"></div>
                        {{-- <div>
                            <a href="#!" class="blog-like"><i class="fa fa-heart-o"></i>{{ $blog->likes }} Like(s)</a>
                            <a href="#" class="comment"><i class="fa fa-comment-o"></i>
                            <span id="comment_count{{ $blog->id }}"></span> comment(s)</a>
                            <script type="text/javascript" src="{{ asset('vendor/hcode/js/jquery.min.js') }}"></script>
                            <script type="text/javascript">
                                $.ajax({
                                    url: "https://graph.facebook.com/v2.2/?fields=share{comment_count}&id={{ url('/blog/'.$blog->slug) }}",
                                    dataType: "jsonp",
                                    success: function(data) {
                                        if(data.share) {
                                            $('#comment_count{{ $blog->id }}').text(data.share.comment_count);
                                        } else {
                                            $('#comment_count{{ $blog->id }}').text(0);
                                        }
                                        
                                    }
                                });
                            </script>
                        </div> --}}
                    </div>
                </div>
                @php
                    $eventwaitduration = $eventwaitduration + 300;
                @endphp
                @endforeach
                <!-- end post item -->
            </div>
        </div>
    </section>
    <!-- end blog content section -->
    <!-- highlight section -->
    <section class="bg-fast-yellow no-padding wow fadeInUp">
        <div class="container">
            <div class="row padding-five sm-text-center">
                <div class="col-md-1">
                    <i class="medium-icon black-text no-margin icon-toolbox"></i>
                </div>
                <div class="col-md-6 no-padding">
                    <span class="text-med text-uppercase letter-spacing-2 margin-two black-text font-weight-600 xs-margin-top-six xs-margin-bottom-six display-block">Want to Work With Us?</span>
                </div>
                <div class="col-md-5 no-padding">
                    <a class="highlight-button-dark btn btn-medium button xs-margin-bottom-five xs-no-margin-right" href="{{ route('blogs.index') }}">View Our Articles</a>
                    <a class="highlight-button btn btn-medium button xs-margin-bottom-five xs-no-margin-right" href="{{ route('index.contact') }}">Contact Us</a>
                </div>
            </div>
        </div>
    </section>
    <!-- end highlight section -->
@endsection

@section('js')
{!!Html::script('js/parsley.min.js')!!}
<!-- Preloader -->
<script type="text/javascript">
    //<![CDATA[
        $(window).load(function() { // makes sure the whole site is loaded
            $('#status').fadeOut(); // will first fade out the loading animation
            $('#preloader').delay(1000).fadeOut('slow'); // will fade out the white DIV that covers the website.
            $('body').delay(1000).css({'overflow':'visible'});
        })
    //]]>
</script>
<script>
    $("#owl-demo").owlCarousel ({
        slideSpeed : 800,
        autoPlay: 4000,
        items : 1,
        stopOnHover : false,
        itemsDesktop : [1199,1],
        itemsDesktopSmall : [979,1],
        itemsTablet :   [768,1],
      });
</script>
@endsection