@extends('layouts.index')
@section('title')
    Projects
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
                    <h1 class="black-text">Projects</h1>
                    <!-- end page title -->
                </div>
                <div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase wow fadeInUp xs-display-none" data-wow-duration="600ms">
                    <!-- breadcrumb -->
                    <ul>
                        {{-- <li><a href="{{ route('index.index') }}">Home</a></li>
                        <li><a href="#">Projects</a></li> --}}
                    </ul>
                    <!-- end breadcrumb -->
                </div>
            </div>
        </div>
      </section>
      <!-- end head section -->
      <section class="work-4col gutter work-with-title wide wide-title no-padding-top xs-no-padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center margin-five no-margin-bottom">
                    <div class="text-center">
                        <!-- tour filter -->
                        <ul class="portfolio-filter nav nav-tabs nav-tabs-light wow fadeInUp travel-work-filter sm-margin-bottom-one xs-margin-bottom-ten">
                            <li class="nav active"><a href="#" data-filter="*">All</a></li>
                            <li class="nav"><a href="#" data-filter=".completed">Complete</a></li>
                            <li class="nav"><a href="#" data-filter=".ongoing">Ongoinig</a></li>
                        </ul>
                        <!-- end tour filter -->
                    </div>
                </div>
                <div class="col-md-12 grid-gallery overflow-hidden no-padding" >
                    <div class="tab-content">
                        <!-- tour grid -->
                        <ul class="grid masonry-items">
                            @foreach($projects as $project)
                                <!-- project -->
                                <li class="@if($project->status == 0) ongoing @else completed @endif">
                                    <figure>
                                        <div class="gallery-img">
                                            <a href="{{ route('index.project', $project->slug) }}">
                                                @if($project->image != null)
                                                  <img src="{{ asset('images/projects/'.$project->image)}}" />
                                                @else
                                                  <img src="{{ asset('images/abc.png')}}"  class="img-responsive" />
                                                @endif
                                            </a>
                                        </div>
                                        <figcaption>
                                            <p class="project-min-height" style="font-weight: bold;">{{ substr(strip_tags($project->title), 0, 50) }}...</p>
                                            <a class="btn inner-link btn-black btn-small" href="{{ route('index.project', $project->slug) }}">Explore Now</a>
                                        </figcaption>
                                    </figure>
                                </li>
                                <!-- end project -->
                            @endforeach
                        </ul>
                        <!-- end tour grid -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
   
@endsection