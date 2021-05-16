@extends('layouts.index')
@section('title')
    Publications
@endsection

@section('css')
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/stylesheet.css') }}"> --}}
    <style type="text/css">
      .separator-line {
          margin: 5% auto;
      }
    </style>
@endsection

@section('content')
    <!-- head section -->
    <section class="content-top-margin page-title page-title-small bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-7 col-sm-12 wow fadeInUp" data-wow-duration="300ms">
                    <!-- page title -->
                    <h1 class="black-text">Publications</h1>
                    <!-- end page title -->
                </div>
                <div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase wow fadeInUp xs-display-none" data-wow-duration="600ms">
                    <!-- breadcrumb -->
                    <ul>
                        {{-- <li><a href="{{ route('index.index') }}">Home</a></li>
                        <li><a href="#">Publications</a></li> --}}
                    </ul>
                    <!-- end breadcrumb -->
                </div>
            </div>
        </div>
      </section>
      <!-- end head section -->
      
      <section id="features" class="features wow fadeIn" style="margin-bottom: 40px; padding: 60px 0;">
          <div class="container">
              <div class="row">
                  <div class="col-md-12 col-sm-12">
                    <div class="row">
                      @foreach($publications as $publication)
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
                    <br/>      
                  </div>
              </div>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-md-12 center-col">
                {{ $publications->links() }}
              </div>
            </div>
          </div>
      </section>
@endsection

@section('js')
   
@endsection