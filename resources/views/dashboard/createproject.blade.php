@extends('adminlte::page')

@section('title', 'Add Project')

@section('css')
  <link rel="stylesheet" type="text/css" href="{{ asset('vendor/summernote/summernote.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('vendor/summernote/summernote-bs3.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/DateTimePicker.css') }}">
@stop

@section('content_header')
    <h1>
      Add Project
      <div class="pull-right">
        
      </div>
    </h1>
@stop

@section('content')
    <div class="row">
      <div class="col-md-10">
          <div class="box box-success">
            <div class="box-body">
              <form action="{{ route('dashboard.project.store') }}" method="post" enctype='multipart/form-data' data-parsley-validate="">
                  {!! csrf_field() !!}
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group no-margin-bottom">
                          <label for="title" class="text-uppercase">Title</label>
                          <input class="form-control" type="text" name="title" id="title" required="">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group no-margin-bottom">
                          <label for="status" class="text-uppercase">Status</label>
                          <select class="form-control" name="status" id="status" required="">
                            <option value="" selected="" disabled="">Select Status</option>
                            <option value="0">Ongoing</option>
                            <option value="1">Complete</option>
                          </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group no-margin-bottom">
                          <label for="starts" class="text-uppercase">Starts</label>
                          <input class="form-control" type="text" name="starts" id="starts" data-field="date" autocomplete="off" required="">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group no-margin-bottom">
                          <label for="ends" class="text-uppercase">Ends</label>
                          <input class="form-control" type="text" name="ends" id="ends" data-field="date" autocomplete="off" required="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group no-margin-bottom">
                            <label>Image (500Kb Max, 1000 x 625 Suggested):</label>
                            <input class="form-control" type="file" id="image" name="image" required="">
                        </div>
                    </div>
                    <div class="col-md-6">
                      <img src="{{ asset('images/abc.png')}}" id='img-upload' style="height: 200px; width: auto; padding: 5px;" />
                    </div>
                  </div>
                
                  <div class="form-group no-margin-bottom">
                      <label for="body" class="text-uppercase">Body</label>
                      <textarea type="text" name="body" id="body" class="summernote" required=""></textarea>
                  </div>
                  <button class="btn btn-primary" type="submit">Submit</button>
              </form>
            </div>
          </div>
      </div>
    </div>

    {{-- datebox --}}
    <div id="dtBox"></div>
    {{-- datebox --}}
@stop

@section('js')
  <script type="text/javascript" src="{{ asset('vendor/summernote/summernote.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/DateTimePicker.min.js') }}"></script>
  <script>
      $(document).ready(function(){
        $("#dtBox").DateTimePicker({
            mode:"date",
            dateFormat: "dd-MM-yyyy"
        });
        $('.summernote').summernote({
            placeholder: 'Write Body',
            tabsize: 2,
            height: 200,
            dialogsInBody: true
        });
        $('div.note-group-select-from-files').remove();
      });
  </script>
    <script type="text/javascript">
    var _URL = window.URL || window.webkitURL;
    $(document).ready( function() {
      $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
      });

      $('.btn-file :file').on('fileselect', function(event, label) {
          var input = $(this).parents('.input-group').find(':text'),
              log = label;
          if( input.length ) {
              input.val(log);
          } else {
              if( log ) alert(log);
          }
      });
      function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function (e) {
                  $('#img-upload').attr('src', e.target.result);
              }
              reader.readAsDataURL(input.files[0]);
          }
      }
      $("#image").change(function(){
        readURL(this);
        var file, img;

        if ((file = this.files[0])) {
          img = new Image();
          img.onload = function() {
            var imagewidth = this.width;
            var imageheight = this.height;
            filesize = parseInt((file.size / 1024));
            if(filesize > 500) {
              $("#image").val('');
              toastr.warning('Filesize: '+filesize+' KB. Please upload within 500KB', 'WARNING').css('width', '400px;');
              setTimeout(function() {
                $("#img-upload").attr('src', '{{ asset('images/abc.png') }}');
              }, 1000);
            }
            // console.log(imagewidth/imageheight);
            // if(((imagewidth/imageheight) < 0.9375) || ((imagewidth/imageheight) > 1.07142)) {
            //   $("#image").val('');
            //   toastr.warning('Raio of the photograph should be 1:1', 'WARNING').css('width', '400px;');
            //   setTimeout(function() {
            //     $("#img-upload").attr('src', '{{ asset('images/abc.png') }}');
            //   }, 1000);
            // }
          };
          img.onerror = function() {
            $("#image").val('');
            toastr.warning('Select a photograph please', 'WARNING').css('width', '400px;');
            setTimeout(function() {
              $("#img-upload").attr('src', '{{ asset('images/abc.png') }}');
            }, 1000);
          };
          img.src = _URL.createObjectURL(file);
        }
      });
    });
  </script>
@stop