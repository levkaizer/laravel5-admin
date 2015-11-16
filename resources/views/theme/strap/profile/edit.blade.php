@extends('theme.strap.layouts.master')

<!-- resources/views/auth/register.blade.php -->

@section('content')
<h2>{{ $user->name }}</h2>
<form class="form-horizontal" method="POST" action="{{ '/profile/edit' }}">
  {!! csrf_field() !!}
  <div class="form-group {{ ($errors->has('name')) ? 'has-error' : '' }}">
    <label for="name" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="name" id="name" value="{{ (!is_null(old('name'))) ? old('name') : $user->name }}" placeholder="Name" {{ ($errors->has('name')) ? 'aria-describedby="nameHelpBlock"' : '' }}>
      @if($errors->has('name'))
      	<span id="nameHelpBlock" class="help-block">{{ $errors->first('name') }}</span>
      @endif	
    </div>
  </div>
  <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}">
    <label for="email" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="email" id="email" value="{{ (!is_null(old('email'))) ? old('email') : $user->email }}" placeholder="Email" {{ ($errors->has('email')) ? 'aria-describedby="emailHelpBlock"' : '' }}>
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
  <div class="form-group {{ ($errors->has('password_confirmation')) ? 'has-error' : '' }}">
    <label for="password_confirmation" class="col-sm-2 control-label">Confirm password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" {{ ($errors->has('password_confirmation')) ? 'aria-describedby="confirmPasswordHelpBlock"' : '' }}>
      @if($errors->has('password_confirmation'))
      	<span id="confirmPasswordHelpBlock" class="help-block">{{ $errors->first('password_confirmation') }}</span>
      @endif
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Update</button>
    </div>
  </div>
</form>

@endsection