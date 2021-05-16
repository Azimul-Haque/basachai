@extends('layouts.index')
@section('title')
    {{ $strategy->title }}
@endsection

@section('css')
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/stylesheet.css') }}"> --}}
    <style type="text/css">
      .widget {
          margin-bottom: 30px;
      }
      .text-15 {
        font-size: 15px;
      }
    </style>
@endsection

@section('content')
    <!-- head section -->
    <section class="content-top-margin page-title page-title-small bg-gray">
      <div class="container">
          <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 wow fadeInUp" data-wow-duration="300ms">
                  <!-- page title -->
                  <h1 class="black-text">{{ $strategy->title }}</h1>
                  <!-- end page title -->
              </div>
              {{-- <div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase wow fadeInUp xs-display-none" data-wow-duration="600ms">
                  <ul>
                      <li><a href="{{ route('index.index') }}">Home</a></li>
                      <li><a href="#">Project</a></li>
                  </ul>
              </div> --}}
          </div>
      </div>
    </section>

    <!-- content section -->
    <section class="wow fadeIn padding-three">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <div class="text-15">
                    {!! $strategy->description !!}
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="widget">
                      <h5 class="widget-title font-alt">Key Components of Strategy</h5>
                      {{-- <div class="thin-separator-line bg-dark-gray no-margin-lr"></div> --}}
                      <div class="widget-body"><br/>
                        @foreach($strategies as $strategy)
                          <a href="{{ route('index.strategy', $strategy->id) }}">
                            <i class="fa fa-arrow-right" aria-hidden="true"></i> {{ $strategy->title }}
                          </a><br/>
                        @endforeach
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection

@section('js')
   
@endsection