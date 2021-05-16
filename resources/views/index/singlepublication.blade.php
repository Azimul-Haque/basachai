@extends('layouts.index')
@section('title')
    {{ $publication->title }}
@endsection

@section('css')
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/stylesheet.css') }}"> --}}
    @if($publication->image != null)
        <meta property="og:image" content="{{ asset('images/publications/'.$publication->image) }}" />
    @else
        <meta property="og:image" content="{{ asset('images/abc.png') }}" />
    @endif

    <meta property="og:title" content="{{ $publication->title }} | Publication"/>
    <meta name="description" property="og:description" content="{{ substr(strip_tags($publication->body), 0, 200) }}" />
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:site_name" content="Killa BD">
    <meta property="og:locale" content="en_US">
    <meta property="fb:admins" content="100001596964477">
    <meta property="fb:app_id" content="163879201229487">
    <meta property="og:type" content="article">
    <!-- Open Graph - Article -->
    <meta name="article:section" content="Publication">
    <meta name="article:published_time" content="{{ $publication->created_at}}">
    <meta name="article:author" content="Killa BD">
    <meta name="article:tag" content="Publication">
    <meta name="article:modified_time" content="{{ $publication->updated_at}}">

    <style type="text/css">
      .widget {
          margin-bottom: 30px;
      }
      .text-15 {
        font-size: 15px;
        word-wrap: break-word;
      }
      .badge-primary {
        background: #33BDF1;
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
                  <h1 class="black-text">{{ $publication->title }}</h1>
                  <!-- end page title -->
              </div>
             {{--  <div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase wow fadeInUp xs-display-none" data-wow-duration="600ms">
                  <ul>
                      <li><a href="{{ route('index.index') }}">Home</a></li>
                      <li><a href="#">Publication</a></li>
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
                  <div>
                    @foreach($publication->users as $member)
                      <a href="{{ route('index.profile', $member->unique_key) }}">
                        <span class="badge badge-primary">{{ $member->name }}</span>
                      </a>
                    @endforeach
                    <br/><br/>
                  </div>
                  <div class="text-15">
                    {!! $publication->body !!}
                  </div>
                </div>
                <div class="col-md-4">
                  @if($publication->image != null)
                    <img src="{{ asset('images/publications/'.$publication->image)}}" style="width: 180px; height: auto;" />
                  @else
                    <img src="{{ asset('images/pub.png')}}" style="width: 180px; height: auto;" />
                  @endif
                  <br/><br/>
                  <div class="widget">
                      <h5 class="widget-title font-alt">Publication Code</h5>
                      {{-- <div class="thin-separator-line bg-dark-gray no-margin-lr"></div> --}}
                      <div class="widget-body padding-three">
                        <big><b>{{ $publication->code }}</b></big>
                      </div>
                  </div>

                  <div class="widget">
                      <h5 class="widget-title font-alt">Published</h5>
                      {{-- <div class="thin-separator-line bg-dark-gray no-margin-lr"></div> --}}
                      <div class="widget-body">
                        <b>{{ date('F d, Y', strtotime($publication->publishing_date)) }}</b>
                      </div>
                  </div>

                  <div class="widget">
                      <h5 class="widget-title font-alt">File Download</h5>
                      {{-- <div class="thin-separator-line bg-dark-gray no-margin-lr"></div> --}}
                      <div class="widget-body padding-three">
                        @if(Auth::check())
                          @if($publication->file != null)
                            <a class="highlight-button btn btn-small btn-round button xs-margin-bottom-five" href="{{ asset('files/'.$publication->file)}}" title="You can download." download=""><i class="fa fa-download"></i> Download</a>
                          @else
                            No File Found.
                          @endif
                        @else
                          <a class="highlight-button btn btn-small btn-round button xs-margin-bottom-five" href="{{ url('login')}}" title="Login to download."><i class="fa fa-download"></i> Download</a>
                        @endif
                      </div>
                  </div>

                  <div class="widget">
                      <h5 class="widget-title font-alt">Share This Publication</h5>
                      {{-- <div class="thin-separator-line bg-dark-gray no-margin-lr"></div> --}}
                      <div class="widget-body padding-three">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ Request::url() }}" class="btn social-icon social-icon-small button" onclick="window.open(this.href,'newwindow', 'width=500,height=400'); return false;"><i class="fa fa-facebook"></i></a>
                        <a href="https://twitter.com/intent/tweet?url={{ Request::url() }}" class="btn social-icon social-icon-small button" onclick="window.open(this.href,'newwindow', 'width=500,height=400'); return false;"><i class="fa fa-twitter"></i></a>
                        {{-- <a href="https://plus.google.com/share?url={{ Request::url() }}" class="btn social-icon social-icon-small button" onclick="window.open(this.href,'newwindow', 'width=500,height=400');  return false;"><i class="fa fa-google-plus"></i></a> --}}
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ Request::url()}}&title=IIT%20Alumni%20Association&summary={{ $publication->title }}&source=Killa%20Consultancy" class="btn social-icon social-icon-small button" onclick="window.open(this.href,'newwindow', 'width=500,height=400');  return false;"><i class="fa fa-linkedin"></i></a>
                      </div>
                  </div>

                  <div class="widget">
                      <h5 class="widget-title font-alt">Other Publications</h5>
                      {{-- <div class="thin-separator-line bg-dark-gray no-margin-lr"></div> --}}
                      <div class="widget-body">
                        <ul class="widget-posts">
                          @foreach($publications as $publication)
                            <li class="clearfix">
                                <a href="{{ route('index.publication', $publication->code) }}">
                                    @if($publication->image != null)
                                      <img src="{{ asset('images/publications/'.$publication->image) }}" alt=""/>
                                    @else
                                      <img src="{{ asset('images/pub.png') }}" alt=""/>
                                    @endif
                                </a>
                                <div class="widget-posts-details">
                                    <a href="{{ route('index.publication', $publication->code) }}" class="overflowellipsis">{{ $publication->title }}</a>
                                    <span class="overflowellipsis">{{ date('F d, Y', strtotime($publication->publishing_date)) }}</span>
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