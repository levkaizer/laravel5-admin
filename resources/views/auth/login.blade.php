@extends('layouts.master')

@section('content')
<!-- 
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
-->
<!-- resources/views/auth/login.blade.php -->
<h2>Please login</h2>
<form class="form-horizontal" method="POST" action="/login">
  {!! csrf_field() !!}
  <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}">
    <label for="email" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="Email" {{ ($errors->has('email')) ? 'aria-describedby="emailHelpBlock"' : '' }}>
      @if($errors->has('email'))
      	<span id="emailHelpBlock" class="help-block">{{ $errors->first('email') }}</span>
      @endif	
    </div>
  </div>
  <div class="form-group {{ ($errors->has('password')) ? 'has-error' : '' }}">
    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="password" name="password" placeholder="Password" {{ ($errors->has('password')) ? 'aria-describedby="passwordHelpBlock"' : '' }}>
      @if($errors->has('password'))
      	<span id="passwordHelpBlock" class="help-block">{{ $errors->first('password') }}</span>
      @endif
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="remember"> Remember me
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Login</button> <a class="btn btn-default" href="password/email" role="button">Forgot password</a>
    </div>
  </div>
</form>
@endsection