@extends('adminlte::page')

@section('title', 'Contact Form Messages')

@section('css')

@stop

@section('content_header')
    <h1>
      Contact Form Messages
      <div class="pull-right">
        {{-- <a class="btn btn-success" href="{{ route('index.application') }}" target="_blank"><i class="fa fa-fw fa-plus" aria-hidden="true"></i> Add Member</a> --}}
      </div>
    </h1>
@stop

@section('content')
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th width="35%">Message</th>
          <th>Timestamp</th>
          <th width="15%">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($messages as $message)
        <tr>
          <td>{{ $message->name }}</td>
          <td>{{ $message->email }}</td>
          <td>{{ $message->message }}</td>
          <td>{{ date('F d, Y h:i A', strtotime($message->created_at)) }}</td>
          <td>
            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{ $message->id }}" data-backdrop="static" title="Delete Message"><i class="fa fa-trash-o"></i></button>
            <!-- Delete Modal -->
            <!-- Delete Modal -->
            <div class="modal fade" id="deleteModal{{ $message->id }}" role="dialog">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-header modal-header-danger">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Message</h4>
                  </div>
                  <div class="modal-body">
                    Confirm Delete this Message?
                  </div>
                  <div class="modal-footer">
                    {!! Form::model($message, ['route' => ['dashboard.deletecontactmessage', $message->id], 'method' => 'DELETE', 'class' => 'form-default', 'enctype' => 'multipart/form-data']) !!}
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
    {{ $messages->links() }}
  </div>


    
@stop

@section('js')

@stop