@extends('layouts.index')
@section('title')
    People
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
                <h1 class="black-text">People</h1>
                <!-- end page title -->
            </div>
            <div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase wow fadeInUp xs-display-none" data-wow-duration="600ms">
                <!-- breadcrumb -->
                <ul>
                   {{--  <li><a href="{{ route('index.index') }}">Home</a></li>
                    <li><a href="#">People</a></li> --}}
                </ul>
                <!-- end breadcrumb -->
            </div>
        </div>
    </div>
  </section>

  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 center-col">
          <center>
            {{-- <a href="{{ route('index.advisors') }}" class="{{ Request::is('people/advisors') ? 'highlight-button-dark' : 'highlight-button' }} btn btn-small btn-round button xs-margin-bottom-five">Advisors</a> --}}
            {{-- <a href="{{ route('index.employees') }}" class="{{ Request::is('people/employees') ? 'highlight-button-dark' : 'highlight-button' }} btn btn-small btn-round button xs-margin-bottom-five">Employees</a> --}}
            <a href="{{ route('index.directors') }}" class="{{ Request::is('people/directors') ? 'highlight-button-dark' : 'highlight-button' }} btn btn-small btn-round button xs-margin-bottom-five">Board of Directors</a>
            {{-- <a href="{{ route('index.members') }}" class="{{ Request::is('people/members') ? 'highlight-button-dark' : 'highlight-button' }} btn btn-small btn-round button xs-margin-bottom-five">Members</a> --}}
          </center>
        </div>
      </div>
      <div class="row margin-five no-margin-bottom">
          @foreach($people as $single)
            <!-- model -->
            <div class="col-md-6 col-sm-6 xs-margin-bottom-ten sm-margin-bottom-ten">
                <div class="model-details clearfix xs-no-margin box">
                    <div class="col-md-6 no-padding">
                      <center>
                        <a href="{{ route('index.profile', $single->unique_key) }}">
                          <img src="{{ asset('images/users/'. $single->image) }}" alt="{{ $single->name }}'s Photo" class="img-circle shadow xs-margin-bottom-ten" />
                        </a>
                      </center>
                    </div>
                    <div class="col-md-6 no-padding">
                      <center>
                        <div class="team-member xs-no-padding">
                            <span class="hidden-xs"><br/><br/></span>
                            <a href="{{ route('index.profile', $single->unique_key) }}">
                              <span class="team-name text-uppercase black-text display-block font-weight-600">{{ $single->name }}</span>
                            </a>
                            <span class="team-post text-uppercase letter-spacing-2 display-block">{{ $single->designation }}</span>
                            <div class="separator-line bg-black no-margin-lr margin-ten"></div>
                            <span class="margin-ten display-block clearfix xs-no-margin"></span>
                            <div class="person-social margin-ten xs-no-margin">
                              <a href="#"><i class="fa fa-facebook black-text no-margin-left"></i></a>
                              <a href="#"><i class="fa fa-twitter black-text"></i></a>
                              <a href="#"><i class="fa fa-linkedin black-text"></i></a>
                            </div>
                        </div>
                      </center>
                    </div>
                </div>
            </div>
            <!-- end model -->
          @endforeach
      </div>
    </div>
  </section>
@endsection

@section('js')
   
@endsection