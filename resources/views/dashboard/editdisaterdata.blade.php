@extends('adminlte::page')

@section('title', 'Edit Data Description')

@section('css')
  {!!Html::style('css/parsley.css')!!}
@stop

@section('content_header')
    <h1>
      Edit Data Description
      <div class="pull-right">
        
      </div>
    </h1>
@stop

@section('content')
    <div class="row">
      <div class="col-md-10">
          <div class="box box-success">
            <div class="box-body">
              {{-- <form action="{{ route('dashboard.disasterdata.update', $disasterdata->id) }}" method="POST" enctype='multipart/form-data' data-parsley-validate=""> --}}
              {!! Form::model($disasterdata, ['route' => ['dashboard.disasterdata.update', $disasterdata->id], 'method' => 'PUT', 'class' => 'form-default', 'enctype' => 'multipart/form-data', 'data-parsley-validate' => '']) !!}
                  {!! csrf_field() !!}
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group no-margin-bottom">
                          <label for="title" class="text-uppercase">Title</label>
                          <input class="form-control" type="text" name="title" id="title" required="" value="{{ $disasterdata->title }}">
                      </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group no-margin-bottom">
                            <label>
                              <strong style="float: left;">File <small>(Optional, 2Mb Max), </small></strong> 
                              <div class="dropdown" style="float: left;">
                                <a href="#!" class="dropdown-toggle" type="button" data-toggle="dropdown">File types?</a>
                                <ul class="dropdown-menu">
                                  <li style="padding: 10px;">doc/docx/ppt/pptx/png/jpeg/jpg/<br/>pdf/gif/zip/xls/xlsx/csv/xml</li>
                                </ul>
                              </div>
                            </label>
                            <input class="form-control" type="file" id="file" name="file">
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="member_id">Disaster Category</label><br/>
                        <select class="form-control select" name="discategory_id" id="discategory_id" data-placeholder="Select Disaster Category" required="">
                          <option value="" disabled="" selected="">Select Disaster Category</option>
                          @foreach($discategories as $category)
                            <option value="{{ $category->id }}" @if($disasterdata->discategory->id == $category->id) selected="" @endif>{{ $category->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="member_id">Districts</label><br/>
                        <select class="form-control select" name="districtscord_id" id="districtscord_id" data-placeholder="Select District" required="">
                          <option value="" disabled="" selected="">Select District</option>
                          @foreach($districtscords as $district)
                            <option value="{{ $district->id }}" @if($disasterdata->districtscord->id == $district->id) selected="" @endif>{{ $district->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <button class="btn btn-primary" type="submit">Submit</button>
              {!! Form::close() !!}
            </div>
          </div>
      </div>
    </div>

@stop

@section('js')
  {!!Html::script('js/parsley.min.js')!!}
  <script>
    $(document).ready(function(){
      $('.select').select2();
    });
  </script>
@stop