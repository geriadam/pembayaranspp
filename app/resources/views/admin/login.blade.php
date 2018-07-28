@extends('layouts.login')
@section('content')
<div>
  <div>
    Tes
  </div><br>
    {{ Form::open(['route' => 'admin.loginPost']) }}
    @if(\Session::has('alert'))
      <div class="alert alert-danger">
        <div>{{ Session::get('alert') }}</div>
      </div>
    @endif
    <div class="form-group">
      {!! Form::email('email', null, ["class" => "form-control", "required" => "required"]) !!}
    </div>
    <div class="form-group">
      {!! Form::password('password', ["class" => "form-control", "required" => "required"]) !!}
    </div>
    <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
  {!! Form::close() !!}  
</div>
@endsection