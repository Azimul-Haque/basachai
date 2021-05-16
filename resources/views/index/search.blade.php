@extends('layouts.index')
@section('title')
    Disaster Data
@endsection

@section('css')
  {{-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> --}}
  {{-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css"> --}}
  {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/KBmapmarkers.css') }}"> --}}
  {{-- <style type="text/css">
    body {
      overflow-x: hidden;
    }
    .KBmap__markerTitle{
      font-family: Arial;
      color: #56270c;
    }
    .KBmap__mapContainer{
      height: 85vh;
      max-height: 100vh;
    }
    .KBmap__mapHolder{
      height: 100%;
      -webkit-box-shadow: 0px 0px 15px 3px rgba(0, 0, 0, 0.15);
      box-shadow: 0px 0px 15px 3px rgba(0, 0, 0, 0.15);
    }
    .KBmap__mapHolder img{
        width: auto;
        height: 100%;
    }
  </style> --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('css/stylesheet.css') }}">

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" />

  <style type="text/css">
    #map {
      height: 650px;
      width: 100%;      
    }
  </style>
@stop

@section('content')
    <!-- head section -->
    <section class="content-top-margin page-title page-title-small bg-gray">
      <div class="container">
          <div class="row">
              <div class="col-lg-8 col-md-7 col-sm-12 wow fadeInUp" data-wow-duration="300ms">
                  <!-- page title -->
                  <h1 class="black-text">Disaster Data</h1>
                  <!-- end page title -->
              </div>
              <div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase wow fadeInUp" data-wow-duration="600ms">
                  <!-- breadcrumb -->
                  <ul>
                      {{-- <li><a href="{{ route('index.index') }}">Home</a></li>
                      <li><a href="#">Disaster Data</a></li> --}}
                  </ul>
                  <!-- end breadcrumb -->
                  <div class="input-group pull-right">
                      <input type="text" class="form-control" name="x" placeholder="Search Disaster Data" id="searchParam" style="float: left; height: 40px;" @if(!empty($searchparam)) value="{{ $searchparam }}" @endif required="">
                      <span class="input-group-btn">
                          <button type="submit" class="highlight-button-dark btn btn-small button xs-margin-bottom-five" id="searchBtn" style="float: left; height: 40px;"><i class="fa fa-search"></i></button>
                      </span>
                  </div>
              </div>
          </div>
      </div>
    </section>
    <!-- end head section -->
    
    <section id="" class="padding-two">
        <div class="container">
            <div class="row">
              <div class="col-sm-12">
                @if($disasterdatas->count() > 0)
                  <h3>About {{ $disasterdatas->count() }} results ({{ number_format((float)(microtime(true) - LARAVEL_START), 2, '.', '') }} seconds)</h3>
                @else
                  <h3>No disaster related data is found! ({{ number_format((float)(microtime(true) - LARAVEL_START), 2, '.', '') }} seconds)</h3>
                @endif
                <br/><br/>
              </div>
              @foreach($disasterdatas as $disasterdata)
                <div class="col-md-4 col-sm-6 wow fadeInUp" style="min-height: 150px; position: relative; margin-bottom: 10px;">
                  <h4>{{ $disasterdata->title }}</h4>
                  <p>
                    Category: <b>{{ $disasterdata->discategory->name }}</b>,
                    District: <b>{{ $disasterdata->districtscord->name }}</b>
                  </p>
                  @if(Auth::check())
                    @if($disasterdata->file != '')
                      <a href="{{ asset('files/' . $disasterdata->file) }}" class="highlight-button btn btn-small button xs-margin-bottom-five" download=""><i class="fa fa-download"></i> Download File</a>
                    @endif
                  @else
                    <a class="highlight-button btn btn-small btn-round button xs-margin-bottom-five" href="{{ url('login')}}" title="Login to download."><i class="fa fa-download"></i> Download</a>
                  @endif
                  <div class="separator-line bg-yellow" style="position: absolute; bottom: 0px;"></div>
                </div>
              @endforeach
            </div>
            <div class="row">
              <div class="col-md-12">
                <div id="map" class="shadow"></div>
              </div>
            </div>
        </div>
    </section>    
@endsection



@section('js')
  {{-- <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.slim.min.js') }}"></script> --}}
  {{-- <script type="text/javascript" src="{{ asset('js/KBmapmarkers.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/KBmapmarkersCords.js') }}"></script> --}}
  {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script> --}}

  <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"></script>
  <script type="text/javascript">
    var zoomlevel = 7;
    if($(window).width() < 768) {
      $('#map').css({"height": "550px"});
      zoomlevel = 6.6;
    }

    var map = L.map('map', {
        center: [23.7104, 90.40744],
        zoom: zoomlevel,
        zoomSnap: 0.1
    });

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '<a href="https://www.openstreetmap.org/copyright" target="_blank">© OpenStreetMap</a> contributor'
    }).addTo(map);

    var marker = [];
    var oldmarkercount = 0;
    @php
      // we need to filter as there will be multiple data for same district
      $disasterdatas_unique_data = $disasterdatas->unique('districtscord_id')->values()->all(); // make it unique, as multiple districts exists
      $i = 1;
    @endphp
    @foreach($disasterdatas_unique_data as $disasterdata)
      var cordsraw = '{{ $disasterdata->districtscord->coordinates }}';
      var cords = cordsraw.split(",");
      marker[{{ $i }}] = L.marker([cords[0], cords[1]]).bindPopup("<big>{{ $disasterdata->districtscord->name }}</big><br/><b>Total data count: {{ $disasterdata->districtscord->disdatas->count() }}</b><br/><a href='{{ route('index.disasterdata.search', $disasterdata->districtscord->name) }}'>⇲ Browse Data</a>").addTo(map);
      // marker1.bindPopup("Test<br/><a href='#!'>Click</a>"); // .openPopup() to open it onready
      @php
        $i++;
      @endphp
    @endforeach

    $('#searchBtn').click(function() {
      var searchParam = $('#searchParam').val();
      if(isEmptyOrSpaces(searchParam)) {
        if($(window).width() > 768) {
          toastr.warning('Write something on search box!', 'WARNING').css('width', '400px');
        } else {
          toastr.warning('Write something on search box!', 'WARNING').css('width', ($(window).width()-25)+'px');
        }
      } else {
        window.location.href = '/disasterdata/search/' + searchParam;
      }
    })

    // on enter search
    var input = document.getElementById("searchParam");
    input.addEventListener("keyup", function(event) {
      if (event.keyCode === 13) {
       event.preventDefault();
       document.getElementById("searchBtn").click();
      }
    });
    
    // on enter search
    function isEmptyOrSpaces(str){
        return str === null || str.match(/^ *$/) !== null;
    }

    $(document).ready(function(){
      // $('.select').select2();
    });
  </script>
@stop

