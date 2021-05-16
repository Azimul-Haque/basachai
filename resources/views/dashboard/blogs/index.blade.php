@extends('adminlte::page')

@section('title', 'Articles')

@section('css')

@stop

@section('content_header')
    <h1>
      Articles
      <div class="pull-right">
        <a href="{{ route('dashboard.blogs.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Write Article</a>
      </div>
    </h1>
@stop

@section('content')
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th width="20%">Title</th>
          <th width="">Category</th>
          <th width="">Writer</th>
          <th width="">Published</th>
          <th width="">Image</th>
          <th width="10%">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($blogs as $blog)
        <tr>
          <td>
            <a href="{{ route('blog.single', $blog->slug) }}" title="View this Article" target="_blank">{{ $blog->title }}</a><br/>
            <span class="label label-success"><i class="fa fa-eye"></i> {{ $blog->views }} View(s)</span>
            <span class="label label-primary"><i class="fa fa-heart"></i> {{ $blog->likes }} Like(s)</span>
          </td>
          <td>{{ $blog->category->name }}</td>
          <td>{{ $blog->user->name }}</td>
          <td><b>{{ date('F d, Y', strtotime($blog->created_at)) }}</b></td>
          <td>
            @if($blog->featured_image != null)
              <img src="{{ asset('images/blogs/' . $blog->featured_image)}}" style="height: 80px; width: auto;" />
            @else
              <img src="{{ asset('images/abc.png')}}" style="height: 80px; width: auto;" />
            @endif
          </td>
          <td>
            <a href="{{ route('dashboard.blogs.edit', $blog->id) }}" class="btn btn-sm btn-primary" title="Edit Article"><i class="fa fa-pencil"></i></a>

            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{ $blog->id }}" data-backdrop="static" title="Delete Article"><i class="fa fa-trash-o"></i></button>
            <!-- Delete Modal -->
            <!-- Delete Modal -->
            <div class="modal fade" id="deleteModal{{ $blog->id }}" role="dialog">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-header modal-header-danger">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Article</h4>
                  </div>
                  <div class="modal-body">
                    Confirm Delete this Article:<br/>
                    <b><big>{{ $blog->title }}</big></b>?
                  </div>
                  <div class="modal-footer">
                    {!! Form::model($blog, ['route' => ['dashboard.blogs.delete', $blog->id], 'method' => 'DELETE', 'class' => 'form-default', 'enctype' => 'multipart/form-data']) !!}
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
    {{ $blogs->links() }}
  </div> 
@stop

@section('js')

@stop