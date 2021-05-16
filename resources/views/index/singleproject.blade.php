@extends('layouts.index')
@section('title')
    {{ $project->title }}
@endsection

@section('css')
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/stylesheet.css') }}"> --}}
    @if($project->image != null)
        <meta property="og:image" content="{{ asset('images/projects/'.$project->image) }}" />
    @else
        <meta property="og:image" content="{{ asset('images/abc.png') }}" />
    @endif

    <meta property="og:title" content="{{ $project->title }} | Project"/>
    <meta name="description" property="og:description" content="{{ substr(strip_tags($project->body), 0, 200) }}" />
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:site_name" content="Killa BD">
    <meta property="og:locale" content="en_US">
    <meta property="fb:admins" content="100001596964477">
    <meta property="fb:app_id" content="163879201229487">
    <meta property="og:type" content="article">
    <!-- Open Graph - Article -->
    <meta name="article:section" content="Project">
    <meta name="article:published_time" content="{{ $project->created_at}}">
    <meta name="article:author" content="Killa BD">
    <meta name="article:tag" content="Project">
    <meta name="article:modified_time" content="{{ $project->updated_at}}">

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
                  <h1 class="black-text">{{ $project->title }}</h1>
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
                  @if($project->image != null)
                    <img src="{{ asset('images/projects/'.$project->image)}}"  class="img-responsive" style="width: 100%;" />
                  @else
                    <img src="{{ asset('images/abc.png')}}"  class="img-responsive" />
                  @endif
                  <br/><br/>

                  <div class="text-15">
                    {!! $project->body !!}
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="widget">
                      <h5 class="widget-title font-alt">Project Status</h5>
                      {{-- <div class="thin-separator-line bg-dark-gray no-margin-lr"></div> --}}
                      <div class="widget-body">
                        @if($project->status == 0)
                          <span class="text-muted">Ongoing</span>
                        @else
                          <span class="text-muted">Complete</span>
                        @endif
                      </div>
                  </div>

                  <div class="widget">
                      <h5 class="widget-title font-alt">Project Active</h5>
                      {{-- <div class="thin-separator-line bg-dark-gray no-margin-lr"></div> --}}
                      <div class="widget-body">
                        <b>{{ date('F d, Y', strtotime($project->starts)) }}</b> to
                        <b>{{ date('F d, Y', strtotime($project->ends)) }}</b>
                      </div>
                  </div>

                  <div class="widget">
                      <h5 class="widget-title font-alt">Share This Project</h5>
                      {{-- <div class="thin-separator-line bg-dark-gray no-margin-lr"></div> --}}
                      <div class="widget-body padding-three">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ Request::url() }}" class="btn social-icon social-icon-small button" onclick="window.open(this.href,'newwindow', 'width=500,height=400'); return false;"><i class="fa fa-facebook"></i></a>
                        <a href="https://twitter.com/intent/tweet?url={{ Request::url() }}" class="btn social-icon social-icon-small button" onclick="window.open(this.href,'newwindow', 'width=500,height=400'); return false;"><i class="fa fa-twitter"></i></a>
                        {{-- <a href="https://plus.google.com/share?url={{ Request::url() }}" class="btn social-icon social-icon-small button" onclick="window.open(this.href,'newwindow', 'width=500,height=400');  return false;"><i class="fa fa-google-plus"></i></a> --}}
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ Request::url()}}&title=IIT%20Alumni%20Association&summary={{ $project->title }}&source=IITAlumni" class="btn social-icon social-icon-small button" onclick="window.open(this.href,'newwindow', 'width=500,height=400');  return false;"><i class="fa fa-linkedin"></i></a>
                      </div>
                  </div>

                  <div class="widget">
                      <h5 class="widget-title font-alt">Other Projects</h5>
                      {{-- <div class="thin-separator-line bg-dark-gray no-margin-lr"></div> --}}
                      <div class="widget-body">
                        <ul class="widget-posts">
                          @foreach($projects as $project)
                            <li class="clearfix">
                                <a href="{{ route('index.project', $project->slug) }}">
                                    @if($project->image != null)
                                    <img src="{{ asset('images/projects/'.$project->image) }}" alt=""/>
                                    @else
                                    <img src="{{ asset('images/abc.png') }}" alt=""/>
                                    @endif
                                </a>
                                <div class="widget-posts-details">
                                    <a href="{{ route('index.project', $project->slug) }}" class="overflowellipsis">{{ $project->title }}</a>
                                    <span class="overflowellipsis">{{ date('F d, Y', strtotime($project->starts)) }}-{{ date('F d, Y', strtotime($project->ends)) }}</span>
                                </div>
                            </li>
                          @endforeach
                        </ul>
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection

@section('js')
   
@endsection