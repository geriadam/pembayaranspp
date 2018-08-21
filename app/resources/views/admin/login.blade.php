@extends('layouts.login')
@section('content')
<div>
  <div>
    @if(!empty($profile->pesantren_profile_logo) 
        && file_exists(App\PesantrenProfile::IMAGE_PATH.$profile->pesantren_profile_logo))
        <img src="{{ url(App\PesantrenProfile::IMAGE_PATH.$profile->pesantren_profile_logo) }}" width="200" height="200">
    @else
        <h1 class="logo-name">{{ CodeHelper::createAcronym($profile->pesantren_profile_name) }}</h1>
    @endif
  </div>
  <h3>{{ $profile->pesantren_profile_name }}</h3>
  <p>{{ $profile->pesantren_profile_address }}</p>
    {{ Form::open(['route' => 'admin.loginPost']) }}
      @if(\Session::has('alert'))
        <div class="alert alert-danger">
          <div>{{ Session::get('alert') }}</div>
        </div>
      @endif
      <div class="form-group">
        {!! Form::email('email', null, ["class" => "form-control", "required" => "required", "placeholder" => "Email"]) !!}
      </div>
      <div class="form-group">
        {!! Form::password('password', ["class" => "form-control", "required" => "required", "placeholder" => "Password"]) !!}
      </div>
      <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
      {!! Form::close() !!}  
    <p class="m-t"> <small>Copyright &copy; All Right Reserved 2018 {{ date('Y') == '2018' ? "" : "- ".date('Y')."" }}</small> </p>
</div>
@endsection