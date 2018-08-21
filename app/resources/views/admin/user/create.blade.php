@extends('layouts.default')
@section('content')
@if ($errors->any())
  <div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <em>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </em>
  </div>
@endif
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content">
                <a href="{{ route('admin.user.index') }}">
                    <button type="button" class="btn btn-info btn-raised"><span class="glyphicon glyphicon-triangle-left"></span> 
                      Back
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="row">
  <div class="col-lg-12">
    {{ Form::open(['route' => ['admin.user.store'], 'method' => "POST"]) }}
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <div class="ibox-tools">
          <a class="collapse-link">
            <i class="fa fa-chevron-up"></i>
          </a>
        </div>
      </div>
      <div class="ibox-content">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, ["class" => "form-control"]) !!}
        </div>
        <div class="form-group">
            <strong>Email:</strong>
            {!! Form::email('email', null, ["class" => "form-control"]) !!}
        </div>
        <div class="form-group">
            <strong>Password:</strong>
            {!! Form::password('password', ["class" => "form-control"]) !!}
        </div>
        <div class="form-group">
            <strong>Password Confirm:</strong>
            {!! Form::password('password_confirmation', ["class" => "form-control"]) !!}
        </div>
      </div>
      <div class="ibox-content">
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="reset" class="btn btn-danger btn-large">Reset</button>
      </div>
    </div>
    {!! Form::close() !!}  
  </div>
</div>
@endsection