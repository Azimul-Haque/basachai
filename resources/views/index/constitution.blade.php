@extends('layouts.index')
@section('title')
    Constitution
@endsection

@section('css')
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/stylesheet.css') }}"> --}}
@endsection

@section('content')
    <!-- head section -->
      <section class="content-top-margin page-title page-title-small bg-gray">
          <div class="container">
              <div class="row">
                  <div class="col-lg-8 col-md-7 col-sm-12 wow fadeInUp" data-wow-duration="300ms">
                      <!-- page title -->
                      <h1 class="black-text">Constitution...</h1>
                      <!-- end page title -->
                  </div>
                  <div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase wow fadeInUp xs-display-none" data-wow-duration="600ms">
                      <!-- breadcrumb -->
                      <ul>
                          <li><a href="{{ route('index.index') }}">Home</a></li>
                          <li><a href="#">About</a></li>
                          <li>Constitution</li>
                      </ul>
                      <!-- end breadcrumb -->
                  </div>
              </div>
          </div>
      </section>
      <!-- end head section -->
      <section class="wow fadeInUp ">
          <div class="container">
              <div class="row">
                  <!-- call to action -->
                  <div class="col-md-7 col-sm-12 text-center center-col">
                      <p class="title-large text-uppercase letter-spacing-1 black-text font-weight-600 wow fadeIn">Read out our Constitution</p>
                      <a href="{{ url('files/iitdualumni_constitution.pdf') }}" class="highlight-button-black-border btn margin-six wow fadeInUp" download="">Download</a>
                  </div>
                  <!-- end call to action -->
              </div>
          </div>
      </section>
@endsection

@section('js')
   
@endsection