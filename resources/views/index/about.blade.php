@extends('layouts.index')
@section('title')
    About Us
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/stylesheet.css') }}">
@endsection

@section('content')
    <!-- head section -->
    <section class="content-top-margin wow fadeInUp bg-gray">
        <div class="container">
            <div class="row">
                <!-- section title -->
                <div class="col-md-6 col-sm-6 xs-margin-bottom-four">
                    <span class="text-large letter-spacing-2 black-text font-weight-600 text-uppercase agency-title">About</span>
                </div>
                <!-- end section title -->
                <!-- section highlight text -->
                <div class="col-md-6 col-sm-6 text-right xs-text-left">
                    <span class="text-extra-large font-weight-400"></span>
                </div>
                <!-- end section highlight text -->
            </div>
        </div>
    </section>
    <!-- end head section -->

    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 center-col">
            <center>
              <a href="{{ route('index.about') }}" class="{{ Request::is('about') ? 'highlight-button-dark' : 'highlight-button' }} btn btn-small btn-round button xs-margin-bottom-five">Board of Directors</a>
              <a href="{{ route('index.about.type', 'advisor') }}" class="{{ Request::is('about/advisor') ? 'highlight-button-dark' : 'highlight-button' }} btn btn-small btn-round button xs-margin-bottom-five">Advisors</a>
              <a href="{{ route('index.about.type', 'member') }}" class="{{ Request::is('about/member') ? 'highlight-button-dark' : 'highlight-button' }} btn btn-small btn-round button xs-margin-bottom-five">Members</a>
              <a href="{{ route('index.about.type', 'content-creator') }}" class="{{ Request::is('about/content-creator') ? 'highlight-button-dark' : 'highlight-button' }} btn btn-small btn-round button xs-margin-bottom-five">Content Creator</a>
              <a href="{{ route('index.about.type', 'intern') }}" class="{{ Request::is('about/intern') ? 'highlight-button-dark' : 'highlight-button' }} btn btn-small btn-round button xs-margin-bottom-five">Intern</a>
              {{-- <a href="{{ route('index.employees') }}" class="{{ Request::is('people/employees') ? 'highlight-button-dark' : 'highlight-button' }} btn btn-small btn-round button xs-margin-bottom-five">Employees</a> --}}
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
                          <a href="{{ route('blogger.profile', $single->unique_key) }}">
                            <img src="{{ asset('images/users/'. $single->image) }}" alt="{{ $single->name }}'s Photo" class="img-circle shadow xs-margin-bottom-ten" />
                          </a>
                        </center>
                      </div>
                      <div class="col-md-6 no-padding">
                        <center>
                          <div class="team-member xs-no-padding">
                              <span class="hidden-xs"><br/><br/></span>
                              <a href="{{ route('blogger.profile', $single->unique_key) }}">
                                <span class="team-name text-uppercase black-text display-block font-weight-600">{{ $single->name }}</span>
                              </a>
                              <span class="team-post text-uppercase letter-spacing-2 display-block">{{ $single->type }}</span>
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

    <!-- content section -->
    <section class="bg-black wow fadeIn">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-sm-10 text-center center-col">
                    <div class="about-year text-uppercase white-text"><span class="clearfix">1</span> Mission</div>
                    <p class="title-small letter-spacing-1 white-text font-weight-100">
                        Tenx empowers young people who are interested in self-development and social development as well as dreaming of an excellent career path in all private and public corporations that produce goods and/or provide nonfinancial services to the markets.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="padding-three">
        <div class="container">
            <div class="row">
                <!-- section title -->
                <div class="col-md-6 col-sm-6">
                    <span class="text-large letter-spacing-2 black-text font-weight-600 agency-title">Our
                        Vision</span>
                </div>
                <!-- end section title -->
                <!-- section highlight text -->
                <div class="col-md-6 col-sm-6 text-right xs-text-left">
                </div>
                <!-- end section highlight text -->
            </div>
        </div>
    </section>
    <section class="cover-background" style="background-image:url('/images/strategy.jpg');">
        <div class="opacity-full bg-dark-gray"></div>
        <div class="container position-relative">
            <div class="row">
                <div class="col-md-10 col-sm-11 center-col text-center">
                    <p class="text-large white-text margin-five no-margin-bottom">
                        Our vision is to express the potentiality of an individual for social development. We want community leaders to nurture them to influence their own community. We intend to invent the creative mind to do well. By improving your observation skills, you’ll tap into your creative energy and discover nuances and details you hadn’t noticed before.
                    <p>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('js')
   
@endsection