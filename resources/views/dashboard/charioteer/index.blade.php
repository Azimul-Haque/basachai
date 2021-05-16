@extends('adminlte::page')

@section('title', 'Charioteer | Onesignal')

@section('css')

@stop

@section('content_header')
    <h1>
      Onesignal Push Notification Service
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
          <h3 class="box-title"><a href="{{ route('dashboard.onesignal') }}">All Questions</a></h3>
          <div class="box-tools pull-right">
            <div style="max-width: 300px !important; float: left; margin-right: 20px;">
              {!! Form::open(['route' => 'dashboard.onesignal.search', 'method' => 'GET', 'class' => 'form-default', 'data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}
                <div class="input-group">
                    <input type="text" class="form-control" name="q" placeholder="Search term...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                    </span>
                </div>
              {!! Form::close() !!}
            </div>
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addQuestionModel" data-backdrop="static" title="Add New Question" data-placement="top"><i class="fa fa-plus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th width="35%">Question</th>
                  <th width="">Answer</th>
                  <th width="">Options</th>
                  <th width="">Count</th>
                  <th width="">Status</th>
                  <th width="15%">Action</th>
                </tr>
              </thead>
              <tbody>
                @php $addmodalflag = 0; $editmodalflag = 0; @endphp
                @foreach($charioteers as $charioteer)
                <tr>
                  <td>
                    {{ $charioteer->question }}
                  </td>
                  <td>
                    {{ $charioteer->answer }}
                  </td>
                  <td>
                    {{ $charioteer->incanswer }}
                  </td>
                  <td>
                    {{ $charioteer->count }}
                  </td>
                  <td>
                    @if($charioteer->status == 0)
                      <span class="badge" style="background: red !important;">Pending</span>
                    @else
                      <span class="badge" style="background: green !important;">Approved</span>
                    @endif
                  </td>
                  
                  <td>
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editQuestionModel{{ $charioteer->id }}" data-backdrop="static" title="Edit Question" data-placement="top"><i class="fa fa-pencil"></i></button>
                    <!-- Edit Question Modal -->
                    <!-- Edit Question Modal -->
                    <div class="modal fade" id="editQuestionModel{{ $charioteer->id }}" role="dialog">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header modal-header-primary">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Edit Question</h4>
                          </div>
                          {!! Form::model($charioteer, ['route' => ['dashboard.onesignal.updateqa', $charioteer->id], 'method' => 'PUT', 'class' => 'form-default', 'enctype' => 'multipart/form-data']) !!}
                            <div class="modal-body">
                              <div class="form-group">
                                {!! Form::label('question', 'Question') !!}
                                {!! Form::text('question', null, array('class' => 'form-control', 'placeholder' => 'Write Question', 'required')) !!}
                              </div>
                              <div class="form-group">
                                {!! Form::label('answer', 'Answer') !!}
                                {!! Form::text('answer', null, array('class' => 'form-control', 'placeholder' => 'Write Answer', 'required')) !!}
                              </div>
                              <div class="row">
                                @php
                                  $options = explode(',', $charioteer->incanswer);
                                @endphp
                                <div class="col-md-4">
                                  <div class="form-group">
                                    {!! Form::label('option1', 'Option 1') !!}
                                    {!! Form::text('option1', $options[0], array('class' => 'form-control', 'placeholder' => 'Write Option 1', 'required')) !!}
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    {!! Form::label('option2', 'Option 2') !!}
                                    {!! Form::text('option2', $options[1], array('class' => 'form-control', 'placeholder' => 'Write Option 2', 'required')) !!}
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    {!! Form::label('option3', 'Option 3') !!}
                                    {!! Form::text('option3', $options[2], array('class' => 'form-control', 'placeholder' => 'Write Option 3', 'required')) !!}
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              {!! Form::submit('Submit', array('class' => 'btn btn-primary')) !!}
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          {!! Form::close() !!}
                        </div>
                      </div>
                    </div>
                    <!-- Edit Question Modal -->
                    <!-- Edit Question Modal -->

                    @if($charioteer->status == 0)
                      <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#approveQuestionModel{{ $charioteer->id }}" data-backdrop="static" title="Approve Question" data-placement="top"><i class="fa fa-check"></i></button>
                      <!-- Approve Question Modal -->
                      <!-- Approve Question Modal -->
                      <div class="modal fade" id="approveQuestionModel{{ $charioteer->id }}" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header modal-header-success">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Approve Question</h4>
                            </div>
                            {!! Form::model($charioteer, ['route' => ['dashboard.onesignal.approve', $charioteer->id], 'method' => 'PUT', 'class' => 'form-default', 'enctype' => 'multipart/form-data']) !!}
                              <div class="modal-body">
                                <div class="form-group">
                                  {!! Form::label('question', 'Question') !!}
                                  {!! Form::text('question', null, array('class' => 'form-control', 'placeholder' => 'Write Question', 'required')) !!}
                                </div>
                                <div class="form-group">
                                  {!! Form::label('answer', 'Answer') !!}
                                  {!! Form::text('answer', null, array('class' => 'form-control', 'placeholder' => 'Write Answer', 'required')) !!}
                                </div>
                              </div>
                              <div class="modal-footer">
                                {!! Form::submit('Approve', array('class' => 'btn btn-success')) !!}
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            {!! Form::close() !!}
                          </div>
                        </div>
                      </div>
                      <!-- Approve Question Modal -->
                      <!-- Approve Question Modal -->
                    @else
                      <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#unapproveQuestionModel{{ $charioteer->id }}" data-backdrop="static" title="Make Pending Question" data-placement="top"><i class="fa fa-ban"></i></button>
                      <!-- Approve Question Modal -->
                      <!-- Approve Question Modal -->
                      <div class="modal fade" id="unapproveQuestionModel{{ $charioteer->id }}" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header modal-header-info">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Make Pending</h4>
                            </div>
                            
                              <div class="modal-body">
                                Confirm make pending this question:<br/><b>{{ $charioteer->question }}</b>?
                              </div>
                              <div class="modal-footer">
                                {!! Form::model($charioteer, ['route' => ['dashboard.onesignal.unapprove', $charioteer->id], 'method' => 'PUT', 'class' => 'form-default', 'enctype' => 'multipart/form-data']) !!}
                                  {!! Form::submit('Submit', array('class' => 'btn btn-info')) !!}
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                {!! Form::close() !!}
                              </div>
                          </div>
                        </div>
                      </div>
                      <!-- Approve Question Modal -->
                      <!-- Approve Question Modal -->
                    @endif

                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteQuestionModal{{ $charioteer->id }}" data-backdrop="static" title="Delete"><i class="fa fa-trash-o"></i></button>
                    <!-- Delete Charioteer Modal -->
                    <!-- Delete Charioteer Modal -->
                    <div class="modal fade" id="deleteQuestionModal{{ $charioteer->id }}" role="dialog">
                      <div class="modal-dialog modal-md">
                        <div class="modal-content">
                          <div class="modal-header modal-header-danger">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Delete Question</h4>
                          </div>
                          <div class="modal-body">
                            Confirm delete this question:<br/><b>{{ $charioteer->question }}</b>?
                          </div>
                          <div class="modal-footer">
                            {!! Form::model($charioteer, ['route' => ['dashboard.onesignal.delqa', $charioteer->id], 'method' => 'DELETE', 'class' => 'form-default', 'enctype' => 'multipart/form-data']) !!}
                                {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            {!! Form::close() !!}
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Delete Charioteer Modal -->
                    <!-- Delete Charioteer Modal -->
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          {{ $charioteers->links() }}
        </div>
        <!-- /.box-body -->
      </div>

      <div class="box box-warning">
        <div class="box-header with-border text-yellow">
          <i class="fa fa-fw fa-flag"></i>
          <h3 class="box-title">Reports</h3>
          <div class="box-tools pull-right">
            {{-- <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#addQuestionModel" data-backdrop="static" title="Add New Disaster Category" data-placement="top"><i class="fa fa-plus"></i></button> --}}
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Question</th>
                  <th>Answer</th>
                  <th>Report</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($reports as $report)
                <tr>
                  <td>{{ $report->question }}</td>
                  <td>{{ $report->answer }}</td>
                  <td>{{ $report->report }}</td>
                  <td>
                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#resolveReport{{ $report->id }}" data-backdrop="static" title="Resolve"><i class="fa fa-trash-o"></i></button>
                    <!-- Delete Report Modal -->
                    <!-- Delete Report Modal -->
                    <div class="modal fade" id="resolveReport{{ $report->id }}" role="dialog">
                      <div class="modal-dialog modal-md">
                        <div class="modal-content">
                          <div class="modal-header modal-header-danger">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Resolve Question</h4>
                          </div>
                          <div class="modal-body">
                            Confirm resolve/ delete this question:<br/><b>{{ $report->question }}</b>?
                          </div>
                          <div class="modal-footer">
                            {!! Form::model($report, ['route' => ['dashboard.onesignal.delreport', $report->id], 'method' => 'DELETE', 'class' => 'form-default', 'enctype' => 'multipart/form-data']) !!}
                                {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            {!! Form::close() !!}
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Delete Report Modal -->
                    <!-- Delete Report Modal -->
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
          <i class="fa fa-fw fa-bell-o"></i>
          <h3 class="box-title">Send Question Notification</h3>
          <div class="box-tools pull-right">
            {{-- <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addQuestionModel" data-backdrop="static" title="Add New Disaster Category" data-placement="top"><i class="fa fa-plus"></i></button> --}}
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          {!! Form::open(['route' => 'dashboard.onesignal.sendpush', 'method' => 'GET', 'class' => 'form-default', 'data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}
            {!! Form::submit('Send a Random Push', array('class' => 'btn btn-success btn-block')) !!}
          {!! Form::close() !!}
        </div>
        <!-- /.box-body -->
      </div>
      <div class="box box-info">
        <div class="box-header with-border text-aqua">
          <i class="fa fa-fw fa-refresh"></i>
          <h3 class="box-title">Send Update Notification</h3>
          <div class="box-tools pull-right">
            {{-- <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#addQuestionModel" data-backdrop="static" title="Add New Disaster Category" data-placement="top"><i class="fa fa-plus"></i></button> --}}
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          {!! Form::open(['route' => 'dashboard.onesignal.sendupdate', 'method' => 'POST', 'class' => 'form-default', 'data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
              {!! Form::label('heading', 'Heading') !!}
              {!! Form::text('heading', 'BCS সংবিধানে নতুন প্রশ্ন যোগ হয়েছে!', array('class' => 'form-control', 'placeholder' => 'Write Heading', 'required')) !!}
            </div>
            <div class="form-group">
              {!! Form::label('subtitle', 'Subtitle') !!}
              {!! Form::text('subtitle', 'প্রশ্নগুলো পেতে ক্লিক করুন !', array('class' => 'form-control', 'placeholder' => 'Write Subtitle', 'required')) !!}
            </div>
            {!! Form::submit('Send Update Notification', array('class' => 'btn btn-info btn-block')) !!}
          {!! Form::close() !!}
        </div>
        <!-- /.box-body -->
      </div>
      <div class="box box-danger">
        <div class="box-header with-border text-red">
          <i class="fa fa-fw fa-envelope-o"></i>
          <h3 class="box-title">App Messages</h3>
          <div class="box-tools pull-right">
            {{-- <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#addQuestionModel" data-backdrop="static" title="Add New Disaster Category" data-placement="top"><i class="fa fa-plus"></i></button> --}}
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email, Datetime</th>
                  <th>Message</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($messages as $message)
                <tr>
                  <td>
                    {{ $message->name }}<br/>
                    <small class="text-green">{{ date('F d, Y h:i A', strtotime($message->created_at)) }}</small>
                  </td>
                  <td>{{ $message->email }}</td>
                  <td>{{ $message->message }}</td>
                  <td>
                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteMessage{{ $message->id }}" data-backdrop="static" title="Delete"><i class="fa fa-trash-o"></i></button>
                    <!-- Delete Message Modal -->
                    <!-- Delete Message Modal -->
                    <div class="modal fade" id="deleteMessage{{ $message->id }}" role="dialog">
                      <div class="modal-dialog modal-md">
                        <div class="modal-content">
                          <div class="modal-header modal-header-danger">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Delete Message</h4>
                          </div>
                          <div class="modal-body">
                            Confirm resolve/ delete this message?
                          </div>
                          <div class="modal-footer">
                            {!! Form::model($message, ['route' => ['dashboard.onesignal.delmessage', $message->id], 'method' => 'DELETE', 'class' => 'form-default', 'enctype' => 'multipart/form-data']) !!}
                                {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            {!! Form::close() !!}
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Delete Message Modal -->
                    <!-- Delete Message Modal -->
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

  <!-- Add Question Modal -->
  <!-- Add Question Modal -->
  <div class="modal fade" id="addQuestionModel" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header modal-header-primary">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Question</h4>
        </div>
        {!! Form::open(['route' => 'dashboard.onesignal.storeqa', 'method' => 'POST', 'class' => 'form-default', 'data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}
          <div class="modal-body">
            <div class="form-group">
              {!! Form::label('question', 'Question') !!}
              {!! Form::text('question', null, array('class' => 'form-control', 'placeholder' => 'Write Question', 'required')) !!}
            </div>
            <div class="form-group">
              {!! Form::label('answer', 'Answer') !!}
              {!! Form::text('answer', null, array('class' => 'form-control', 'placeholder' => 'Write Answer', 'required')) !!}
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('option1', 'Option 1') !!}
                  {!! Form::text('option1', null, array('class' => 'form-control', 'placeholder' => 'Write Option 1', 'required')) !!}
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('option2', 'Option 2') !!}
                  {!! Form::text('option2', null, array('class' => 'form-control', 'placeholder' => 'Write Option 2', 'required')) !!}
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('option3', 'Option 3') !!}
                  {!! Form::text('option3', null, array('class' => 'form-control', 'placeholder' => 'Write Option 3', 'required')) !!}
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            {!! Form::submit('Submit', array('class' => 'btn btn-primary')) !!}
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        {!! Form::close() !!}
        {{-- <form method="post" action="{{ route("dashboard.onesignal.postqstnapi") }}">
          <textarea class="form-control"></textarea>
          <button type="submit">Test</button>
        </form> --}}
      </div>
    </div>
  </div>
  <!-- Add Question Modal -->
  <!-- Add Question Modal -->
@stop

@section('js')

@stop