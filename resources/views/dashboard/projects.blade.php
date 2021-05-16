@extends('adminlte::page')

@section('title', 'Projects')

@section('css')

@stop

@section('content_header')
    <h1>
      Projects
      <div class="pull-right">
        <a href="{{ route('dashboard.project.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Project</a>
      </div>
    </h1>
@stop

@section('content')
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th width="20%">Title</th>
          <th width="15%">Status</th>
          <th width="30%">Body</th>
          <th width="25%">Image</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @php $addmodalflag = 0; $editmodalflag = 0; @endphp
        @foreach($projects as $project)
        <tr>
          <td>{{ $project->title }}</td>
          <td>
            @if($project->status == 0)
              <span class="text-muted">Ongoing</span>
            @else
              <span class="text-muted">Complete</span>
            @endif
            <br>
            <b>{{ date('F d, Y', strtotime($project->starts)) }}</b> to
            <b>{{ date('F d, Y', strtotime($project->ends)) }}</b>
          </td>
          <td><span class="">{{ substr(strip_tags($project->body), 0, 100) }}...</span></td>
          <td>
            @if($project->image != null)
            <img src="{{ asset('images/projects/'.$project->image)}}" style="height: 120px; width: auto;" />
            @else
            <img src="{{ asset('images/abc.png')}}" style="height: 120px; width: auto;" />
            @endif
          </td>
          <td>
            <a href="{{ route('dashboard.project.edit', $project->id) }}" class="btn btn-sm btn-primary" title="Edit Project"><i class="fa fa-pencil"></i></a>
            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{ $project->id }}" data-backdrop="static" title="Delete Project"><i class="fa fa-trash-o"></i></button>
            <!-- Delete Project Modal -->
            <!-- Delete Project Modal -->
            <div class="modal fade" id="deleteModal{{ $project->id }}" role="dialog">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-header modal-header-danger">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Project</h4>
                  </div>
                  <div class="modal-body">
                    Confirm Delete this project: <b>{{ $project->title }}</b>?
                  </div>
                  <div class="modal-footer">
                    {!! Form::model($project, ['route' => ['dashboard.project.delete', $project->id], 'method' => 'DELETE', 'class' => 'form-default', 'enctype' => 'multipart/form-data']) !!}
                        {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    {!! Form::close() !!}
                  </div>
                </div>
              </div>
            </div>
            <!-- Delete Project Modal -->
            <!-- Delete Project Modal -->
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div>
    {{ $projects->links() }}
  </div>    
@stop

@section('js')

@stop