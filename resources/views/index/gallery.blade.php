@extends('layouts.index')
@section('title')
    Gallery
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
                      <h1 class="black-text">Gallery...</h1>
                      <!-- end page title -->
                  </div>
                  <div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase wow fadeInUp xs-display-none" data-wow-duration="600ms">
                      <!-- breadcrumb -->
                      <ul>
                          <li><a href="{{ route('index.index') }}">Home</a></li>
                          <li><a href="#">Gallery</a></li>
                      </ul>
                      <!-- end breadcrumb -->
                  </div>
              </div>
          </div>
      </section>
      <!-- end head section -->
      <!-- feature section -->
      <section>
          <div class="container">
              <div class="row margin-six">
                <div class="col-md-8 col-md-offset-2">
                  <center>
                    <i class="icon-tools large-icon yellow-text text-center"></i>
                    <h1 class="margin-ten no-margin-bottom">Gallery</h1>
                    <p class="text-med margin-ten width-80 center-col">Under Construction!</p>
                  </center>
                </div>
              </div>
          </div>
      </section> 
      <!-- end feature section -->
@endsection

@section('js')
   
@endsection