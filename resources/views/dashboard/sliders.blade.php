@extends('adminlte::page')

@section('title', 'Sliders')

@section('css')

@stop

@section('content_header')
    <h1>
      Sliders
      <div class="pull-right">
      </div>
    </h1>
@stop

@section('content')
  <div class="row">
    <div class="col-md-8">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th width="45%">Title</th>
              <th width="40%">Image</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($sliders as $slider)
            <tr>
              <td>{{ $slider->title }}</td>
              <td>
                @if($slider->image != null)
                <img src="{{ asset('images/sliders/'.$slider->image)}}" style="height: 100px; width: auto;" />
                @else
                <img src="{{ asset('images/abc.png')}}" style="height: 100px; width: auto;" />
                @endif
              </td>
              <td>
                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#editModal{{ $slider->id }}" data-backdrop="static" title="Edit Slider"><i class="fa fa-pencil"></i></button>
                <!-- Edit Modal -->
                <!-- Edit Modal -->
                <div class="modal fade" id="editModal{{ $slider->id }}" role="dialog">
                  <div class="modal-dialog modal-md">
                    <div class="modal-content">
                      <div class="modal-header modal-header-success">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Slider</h4>
                      </div>
                      {!! Form::model($slider, ['route' => ['dashboard.slider.update', $slider->id], 'method' => 'PUT', 'class' => 'form-default', 'enctype' => 'multipart/form-data']) !!}
                      <div class="modal-body">
                        <div class="form-group no-margin-bottom">
                            <label for="title" class="text-uppercase">Title</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ $slider->title }}" required="">
                        </div>
                        <div class="form-group no-margin-bottom">
                            <label><strong>Image (400Kb Max, 1000 x 520 Recommended):</strong></label>
                            <input class="form-control" type="file" name="image" accept="image/*" required="">
                        </div>
                      </div>
                      <div class="modal-footer">
                            {!! Form::submit('Submit', array('class' => 'btn btn-success')) !!}
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      </div>
                      {!! Form::close() !!}
                    </div>
                  </div>
                </div>
                <!-- Edit Modal -->
                <!-- Edit Modal -->
                <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{ $slider->id }}" data-backdrop="static" title="Delete Slider"><i class="fa fa-trash-o"></i></button>
                <!-- Delete Modal -->
                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal{{ $slider->id }}" role="dialog">
                  <div class="modal-dialog modal-md">
                    <div class="modal-content">
                      <div class="modal-header modal-header-danger">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Delete Slider</h4>
                      </div>
                      <div class="modal-body">
                        Confirm Delete this slider?
                      </div>
                      <div class="modal-footer">
                        {!! Form::model($slider, ['route' => ['dashboard.slider.delete', $slider->id], 'method' => 'DELETE', 'class' => 'form-default', 'enctype' => 'multipart/form-data']) !!}
                            {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        {!! Form::close() !!}
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Delete Modal -->
                <!-- Delete Modal -->
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div>
        {{ $sliders->links() }}
      </div> 
    </div>
    <div class="col-md-4">
      <div class="box box-success">
        <div class="box-body">
          <p style="font-size: 20px; font-weight: bold;">Add New Slider</p>
          <form action="{{ route('dashboard.slider.store') }}" method="post" enctype='multipart/form-data' data-parsley-validate="">
              {!! csrf_field() !!}
              <div class="form-group no-margin-bottom">
                  <label for="title" class="text-uppercase">Title</label>
                  <input class="form-control" type="text" name="title" id="title" required="">
              </div>
              <div class="form-group no-margin-bottom">
                  <label><strong>Image (400Kb Max, 1000 x 520 Recommended):</strong></label>
                  <input class="form-control" type="file" id="image" name="image" accept="image/*" required="">
              </div>
              <img src="{{ asset('images/abc.png')}}" id='img-upload' class="img-responsive" style="max-height: 200px; width: auto; padding: 5px;" /><br/>
              <button class="btn btn-primary" type="submit">Submit</button>
          </form>
        </div>
      </div>
    </div>    
  </div>   
@stop

@section('js')
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
            if(filesize > 400) {
              $("#image").val('');
              toastr.warning('Filesize: '+filesize+' KB. Please upload within 400KB', 'WARNING').css('width', '400px;');
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