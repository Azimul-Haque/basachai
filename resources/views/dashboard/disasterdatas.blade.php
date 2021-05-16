@extends('adminlte::page')

@section('title', 'Data Description')

@section('css')

@stop

@section('content_header')
    <h1>
      Data Description
      <div class="pull-right">
        
      </div>
    </h1>
@stop

@section('content')
  <div class="row">
    <div class="col-md-8">
      <div class="box box-primary">
        <div class="box-header with-border text-blue">
          <i class="fa fa-fw fa-tree"></i>
          <h3 class="box-title">Data Description</h3>
          <div class="box-tools pull-right">
            <a href="{{ route('dashboard.disasterdata.create') }}" class="btn btn-primary btn-sm" title="Add Data Description" data-placement="top"><i class="fa fa-plus"></i></a>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>File</th>
                  <th>Category</th>
                  <th width="">District</th>
                  <th width="15%">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($disasterdatas as $disasterdata)
                <tr>
                  <td>{{ $disasterdata->title }}</td>
                  <td>
                    @if($disasterdata->file != '')
                    <a href="{{ asset('files/'.$disasterdata->file)}}"><i class="fa fa-file-text-o"></i> File</a>
                    @endif
                  </td>
                  <td>{{ $disasterdata->discategory->name }}</td>
                  <td>
                    <span class="badge badge-success">{{ $disasterdata->districtscord->name }}</span> 
                  </td>
                  
                  <td>
                    <a href="{{ route('dashboard.disasterdata.edit', $disasterdata->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-pencil"></i></a>
                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteDisasterDataModal{{ $disasterdata->id }}" data-backdrop="static" title="Delete"><i class="fa fa-trash-o"></i></button>
                    <!-- Delete Data Description Modal -->
                    <!-- Delete Data Description Modal -->
                    <div class="modal fade" id="deleteDisasterDataModal{{ $disasterdata->id }}" role="dialog">
                      <div class="modal-dialog modal-md">
                        <div class="modal-content">
                          <div class="modal-header modal-header-danger">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Delete Data Description</h4>
                          </div>
                          <div class="modal-body">
                            Confirm Delete <b>{{ $disasterdata->name }}</b>
                          </div>
                          <div class="modal-footer">
                            {!! Form::model($disasterdata, ['route' => ['dashboard.disasterdata.delete', $disasterdata->id], 'method' => 'DELETE', 'class' => 'form-default', 'enctype' => 'multipart/form-data']) !!}
                                {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            {!! Form::close() !!}
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Delete Data Description Modal -->
                    <!-- Delete Data Description Modal -->
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      
    </div>
    <div class="col-md-4">
      <div class="box box-success">
        <div class="box-header with-border text-green">
          <i class="fa fa-fw fa-tags"></i>
          <h3 class="box-title">Disaster Category</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addDisCategoryModal" data-backdrop="static" title="Add New Disaster Category" data-placement="top"><i class="fa fa-plus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Title</th>
                  <th width="20%">Action</th>
                </tr>
              </thead>
              <tbody>
                @php $addmodalflag = 0; $editmodalflag = 0; @endphp
                @foreach($discategories as $category)
                <tr>
                  <td>{{ $category->name }}</td>
                  <td>
                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#editDisCategoryModal{{ $category->id }}" data-backdrop="static" title="Edit"><i class="fa fa-pencil"></i></button>
                    <!-- Edit Disaster Category Modal -->
                    <!-- Edit Disaster Category Modal -->
                    <div class="modal fade" id="editDisCategoryModal{{ $category->id }}" role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header modal-header-success">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Edit Disaster Category</h4>
                          </div>
                          {!! Form::model($category, ['route' => ['dashboard.discategory.update', $category->id], 'method' => 'PUT', 'class' => 'form-default', 'enctype' => 'multipart/form-data', 'data-parsley-validate' => '']) !!}
                            <div class="modal-body">
                              <div class="form-group">
                                {!! Form::label('name', 'Category') !!}
                                {!! Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Category Name', 'required')) !!}
                              </div>
                            </div>
                            <div class="modal-footer">
                              {!! Form::submit('Submit', array('class' => 'btn btn-success')) !!}
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          {!! Form::close() !!}
                        </div>
                      </div>
                    </div>
                    <!-- Edit Disaster Category Modal -->
                    <!-- Edit Disaster Category Modal -->
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>

  <!-- Add Disaster Category Modal -->
  <!-- Add Disaster Category Modal -->
  <div class="modal fade" id="addDisCategoryModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header modal-header-success">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Disaster Category</h4>
        </div>
        {!! Form::open(['route' => 'dashboard.discategory.store', 'method' => 'POST', 'class' => 'form-default', 'data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}
          <div class="modal-body">
            <div class="form-group">
              {!! Form::label('name', 'Category') !!}
              {!! Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Category Name', 'required')) !!}
            </div>
          </div>
          <div class="modal-footer">
            {!! Form::submit('Submit', array('class' => 'btn btn-success')) !!}
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
  <!-- Add Disaster Category Modal -->
  <!-- Add Disaster Category Modal -->
@stop

@section('js')

@stop