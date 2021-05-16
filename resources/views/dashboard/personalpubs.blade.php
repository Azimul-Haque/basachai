@extends('adminlte::page')

@section('title', 'Your Publications')

@section('css')

@stop

@section('content_header')
    <h1>
      Your Publications [Publications submitted by you]
      <div class="pull-right">
        <a href="{{ route('dashboard.personal.pubs.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Publication</a>
      </div>
    </h1>
@stop

@section('content')
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>Status</th>
          <th width="20%">Title</th>
          <th width="">Code</th>
          <th width="">Associates</th>
          <th width="">Published</th>
          <th width="25%">Body</th>
          <th width="">Image</th>
          <th width="">File</th>
        </tr>
      </thead>
      <tbody>
        @php $addmodalflag = 0; $editmodalflag = 0; @endphp
        @foreach($publications as $publication)
        <tr>
          <td>
            @if($publication->status == 0)
              <i class="fa fa-hourglass-half"></i> Unpublished
            @else
              <i class="fa fa-check"></i> Published
            @endif
          </td>
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
            <img src="{{ asset('images/publications/'.$publication->image)}}" style="height: 120px; width: auto;" />
            @else
            <img src="{{ asset('images/abc.png')}}" style="height: 120px; width: auto;" />
            @endif
          </td>
          <td>
            @if($publication->file != null)
              <a href="{{ asset('files/'.$publication->file)}}">Attachement</a>
            @endif
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