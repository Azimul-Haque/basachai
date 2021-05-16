@extends('adminlte::page')

@section('title', 'Publications')

@section('css')

@stop

@section('content_header')
    <h1>
      Publications
      <div class="pull-right">
        <a href="{{ route('dashboard.publication.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Publication</a>
      </div>
    </h1>
@stop

@section('content')
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th width="20%">Title</th>
          <th width="">Code</th>
          <th width="">Associates</th>
          <th width="">Published</th>
          <th width="25%">Body</th>
          <th width="">Image</th>
          <th width="">File</th>
          <th width="10%">Action</th>
        </tr>
      </thead>
      <tbody>
        @php $addmodalflag = 0; $editmodalflag = 0; @endphp
        @foreach($publications as $publication)
        <tr>
          <td>{{ $publication->title }}</td>
          <td>{{ $publication->code }}</td>
          <td>
            @foreach($publication->users as $member)
              <span class="badge badge-success">{{ $member->name }}</span> 
            @endforeach
          </td>
          <td><b>{{ date('F d, Y', strtotime($publication->publishing_date)) }}</b></td>
          <td><span class="">{{ substr(strip_tags($publication->body), 0, 100) }}...</span></td>
          <td>
            @if($publication->image != null)
            <img src="{{ asset('images/publications/'.$publication->image)}}" style="height: 80px; width: auto;" />
            @else
            <img src="{{ asset('images/abc.png')}}" style="height: 80px; width: auto;" />
            @endif
          </td>
          <td>
            @if($publication->file != null)
              <a href="{{ asset('files/'.$publication->file)}}"><i class="fa fa-download"></i> Attachement</a>
            @endif
          </td>
          <td>
            <a href="{{ route('dashboard.publication.edit', $publication->id) }}" class="btn btn-sm btn-primary" title="Edit Publication"><i class="fa fa-pencil"></i></a>
            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{ $publication->id }}" data-backdrop="static" title="Delete Publication"><i class="fa fa-trash-o"></i></button>
            <!-- Delete Publication Modal -->
            <!-- Delete Publication Modal -->
            <div class="modal fade" id="deleteModal{{ $publication->id }}" role="dialog">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-header modal-header-danger">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Publication</h4>
                  </div>
                  <div class="modal-body">
                    Confirm Delete this Publication: <b>{{ $publication->title }}</b>?
                  </div>
                  <div class="modal-footer">
                    {!! Form::model($publication, ['route' => ['dashboard.publication.delete', $publication->id], 'method' => 'DELETE', 'class' => 'form-default', 'enctype' => 'multipart/form-data']) !!}
                        {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    {!! Form::close() !!}
                  </div>
                </div>
              </div>
            </div>
            <!-- Delete Publication Modal -->
            <!-- Delete Publication Modal -->
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div>
    {{ $publications->links() }}
  </div> 
@stop

@section('js')

@stop