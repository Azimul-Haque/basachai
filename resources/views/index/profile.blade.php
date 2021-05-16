@extends('layouts.index')
@section('title')
    {{ $user->name }}
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/stylesheet.css') }}">
@endsection

@section('content')
    <!-- head section -->
    <section class="content-top-margin page-title page-title-small bg-gray">
      <div class="container">
          <div class="row">
              <div class="col-lg-8 col-md-7 col-sm-12 wow fadeInUp" data-wow-duration="300ms">
                  <!-- page title -->
                  <h1 class="black-text">{{ $user->name }}</h1>
                  <!-- end page title -->
              </div>
              <div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase wow fadeInUp xs-display-none" data-wow-duration="600ms">
                  <!-- breadcrumb -->
                  <ul>
                      {{-- <li><a href="{{ route('index.index') }}">Home</a></li>
                      <li><a href="#">{{ $user->name }}</a></li> --}}
                  </ul>
                  <!-- end breadcrumb -->
              </div>
          </div>
      </div>
    </section>

    <!-- about user section -->
    <section id="features" class="border-bottom xs-onepage-section"> {{-- border-bottom no-padding-bottom --}}
        <div class="container">
            <div class="row">
                <!-- section title -->
                <div class="col-md-12 text-center">
                    <span class="title-number">Profile</span><h3 class="section-title no-padding">{{ $user->name }}</h3>
                </div>
                @if($user->activation_status == 0)
                <div class="row margin-three">
                    <div class="col-md-12 text-center">
                        <h2>Application submitted!</h2>
                        <h3>After the successfull activation, you will be able to do all the activities.</h3>
                    </div>
                </div>
                @endif
                <!-- end section title -->
            </div>
            <div class="row margin-five no-margin-bottom">
                <div class="col-md-6 col-sm-6 text-center xs-margin-bottom-ten">
                    <img src="{{ asset('images/users/'.$user->image) }}" alt="image of {{ $user->name }}" class="img-responsive img-circle shadow" style="width: 250px; height: auto;" />
                </div>
                <div class="col-md-6 col-sm-6 sm-margin-bottom-ten">
                    <div class="col-md-12 col-sm-12 no-padding">
                        {{-- <p class="text-large">Hello, I'm a UI/UX Designer & Front End Developer from Victoria, Australia. I hold a master degree of Web Design from the World University.</p> --}}
                        <ul class="list-line text-med"> {{-- margin-ten --}}
                            <li><span class="font-weight-600">Name:</span> {{ $user->name }}</li>
                            <li><span class="font-weight-600">Email:</span> {{ $user->email }}</li>
                            <li><span class="font-weight-600">Phone:</span> {{ $user->phone }}</li>
                            <li><span class="font-weight-600">Designation:</span> {{ $user->designation }}</li>
                            <li><span class="font-weight-600">Social:</span> 

                                <a href="@if($user->fb != null) {{ $user->fb }} @endif" style="font-size: 25px;" target="_blank"><i class="fa fa-facebook-official" style="color: #4267B0;"></i></a>
                                
                                <a href="@if($user->twitter != null) {{ $user->twitter }} @endif" style="font-size: 25px" target="_blank"><i class="fa fa-twitter-square" style="color: #20A1F0;"></i></a>
                                
                                <a href="@if($user->linkedin != null) {{ $user->linkedin }} @endif" style="font-size: 25px" target="_blank"><i class="fa fa-linkedin-square" style="color: #0874B1;"></i></a>
                                
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section> 
    <!-- end about user section -->

    <!-- about user's biography section -->
    <section id="features" class="border-bottom xs-onepage-section"> {{-- border-bottom no-padding-bottom --}}
        <div class="container">
            <div class="row">
                <!-- section title -->
                <div class="col-md-12 text-center">
                    <span class="title-number">Biography</span>
                </div>
                <!-- end section title -->
            </div>
            <div class="row margin-five no-margin-bottom">
                <div class="col-md-12">
                    {!! $user->bio !!}
                </div>
            </div>
        </div>
    </section> 
    <!-- end about user's biography section -->

    <!-- about user's publications section -->
    <section id="features" class="xs-onepage-section"> {{-- border-bottom no-padding-bottom --}}
        <div class="container">
            <div class="row">
                <!-- section title -->
                <div class="col-md-12 text-center">
                    <span class="title-number">Publications</span>
                </div>
                <!-- end section title -->
            </div>
            <div class="row margin-five no-margin-bottom">
                <div class="col-md-12">
                    @foreach($user->publications as $publication)
                      <!-- features item -->
                      <div class="features-section col-md-4 col-sm-6 no-padding wow fadeInUp" style="min-height: 100px;">
                          <div class="col-md-3 col-sm-2 col-xs-2 ">
                              <a href="{{ route('index.publication', $publication->code) }}">
                                @if($publication->image != null)
                                  <img src="{{ asset('images/publications/'.$publication->image)}}" />
                                @else
                                  <img src="{{ asset('images/pub.png')}}" />
                                @endif
                              </a>
                          </div>
                          <div class="col-md-9 col-sm-9 no-padding col-xs-9 text-left f-right">
                              <a href="{{ route('index.publication', $publication->code) }}"><h5 style="margin: 5px;">{{ substr(strip_tags($publication->title), 0, 60) }}...</h5></a>
                              <div class="separator-line bg-yellow"></div>{{ date('F d, Y', strtotime($publication->publishing_date)) }}

                          </div>
                      </div>
                      <!-- end features item -->
                    @endforeach
                </div>
            </div>
        </div>
    </section> 
    <!-- end about user's publications section -->
@endsection

@section('js')

@endsection