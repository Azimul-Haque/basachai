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
        .call-button i{
            color: white;
        }
        .call-button:hover i{
            color: black;
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
    <section class="wow fadeIn no-margin-top padding-three">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset('images/dummyhome.png') }}">
                </div>
                <div class="col-md-8">
                    <div class="">
                        <span class="text-extra-large font-weight-600 letter-spacing-2 text-uppercase black-text margin-three no-margin-top display-block">Family House Tolet From July</span>
                        <span class="text-large font-weight-400 black-text margin-two no-margin-top display-block">20000/-</span>
                        <span><i class="fa fa-map-marker black-text"></i> Location: Mohammadpur, Dhaka</span><br/>
                        <span><i class="fa fa-bed black-text"></i> Bed: 2</span><br/>
                        <span><i class="fa fa-bath black-text"></i> Bath: 2</span><br/>
                        
                        <a href="#contact-us" class="btn inner-link btn-black btn-small no-margin call-button"><i class="fa fa-info"></i> Detail</a>
                        <a href="#contact-us" class="btn inner-link btn-black btn-small no-margin call-button"><i class="fa fa-phone"></i> Call</a>
                    </div>   
                </div>
            </div>
            <div class="wide-separator-line no-margin-lr margin-three"></div>
        </div>
    </section>
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