@extends('adminlte::page')

@section('title', 'Strategies')

@section('css')
  <style type="text/css">
    textarea{
      min-height: 150px;
      resize: none;
    }
  </style>
  <link rel="stylesheet" type="text/css" href="{{ asset('vendor/summernote/summernote.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('vendor/summernote/summernote-bs3.css') }}">
@stop

@section('content_header')
    <h1>
      Strategies
      <div class="pull-right">
      </div>
    </h1>
@stop

@section('content')
  <div class="row">
    <div class="col-md-6">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th width="45%">Title</th>
              <th width="40%">Description</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($strategies as $strategy)
            <tr>
              <td>{{ $strategy->title }}</td>
              <td>{{ substr(strip_tags($strategy->description), 0, 50) }}...</td>
              <td>
                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#editModal{{ $strategy->id }}" data-backdrop="static" title="Edit Strategy"><i class="fa fa-pencil"></i></button>
                <!-- Edit Modal -->
                <!-- Edit Modal -->
                <div class="modal fade" id="editModal{{ $strategy->id }}" role="dialog">
                  <div class="modal-dialog modal-md">
                    <div class="modal-content">
                      <div class="modal-header modal-header-success">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Strategy</h4>
                      </div>
                      {!! Form::model($strategy, ['route' => ['dashboard.strategy.update', $strategy->id], 'method' => 'PUT', 'class' => 'form-default', 'enctype' => 'multipart/form-data']) !!}
                      <div class="modal-body">
                        <div class="form-group no-margin-bottom">
                            <label for="title" class="text-uppercase">Title</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ $strategy->title }}" required="">
                        </div>
                        <div class="form-group no-margin-bottom">
                            <label for="title" class="text-uppercase">Description</label>
                            <textarea class="summernote" name="description" required="">{{ $strategy->description }}</textarea>
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
                <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{ $strategy->id }}" data-backdrop="static" title="Delete Strategy"><i class="fa fa-trash-o"></i></button>
                <!-- Delete Modal -->
                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal{{ $strategy->id }}" role="dialog">
                  <div class="modal-dialog modal-md">
                    <div class="modal-content">
                      <div class="modal-header modal-header-danger">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Delete Strategy</h4>
                      </div>
                      <div class="modal-body">
                        Confirm Delete this Strategy?
                      </div>
                      <div class="modal-footer">
                        {!! Form::model($strategy, ['route' => ['dashboard.strategy.delete', $strategy->id], 'method' => 'DELETE', 'class' => 'form-default', 'enctype' => 'multipart/form-data']) !!}
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
        {{ $strategies->links() }}
      </div> 
    </div>
    <div class="col-md-6">
      <div class="box box-success">
        <div class="box-body">
          <p style="font-size: 20px; font-weight: bold;">Add New Strategy</p>
          <form action="{{ route('dashboard.strategy.store') }}" method="post" enctype='multipart/form-data' data-parsley-validate="">
              {!! csrf_field() !!}
              <div class="form-group no-margin-bottom">
                  <label for="title" class="text-uppercase">Title</label>
                  <input class="form-control" type="text" name="title" id="title" required="">
              </div>
              <div class="form-group no-margin-bottom">
                  <label for="title" class="text-uppercase">Description</label>
                  <textarea class="summernote" name="description" required=""></textarea>
              </div>
              <button class="btn btn-primary" type="submit">Submit</button>
          </form>
        </div>
      </div>
    </div>    
  </div>   
@stop

@section('js')
  <script type="text/javascript" src="{{ asset('vendor/summernote/summernote.min.js') }}"></script>
  <script>
      $(document).ready(function(){
          $('.summernote').summernote({
              placeholder: 'Write Biography',
              tabsize: 2,
              height: 200,
              dialogsInBody: true
          });
          $('div.note-group-select-from-files').remove();
      });
  </script>
@stop