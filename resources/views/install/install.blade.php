@extends('layouts.master')

@section('content')

<h2>Welcome to the Admin installer!</h2>
<p>Please enter some details below to begin.</p>

<form class="form-horizontal" name="install-form" id="info-form" method="post" action="{{ route('install-save') }}">
	{!! csrf_field() !!}
	
	<div class="form-group {{ ($errors->has('name')) ? 'has-error' : '' }}">
    <label for="name" class="col-sm-2 control-label">Site name:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="name" id="name" value="{{ (!is_null(old('name'))) ? old('name') : \Configuration::get('app_name') }}" placeholder="Name" {{ ($errors->has('name')) ? 'aria-describedby="nameHelpBlock"' : '' }}>
      @if($errors->has('name'))
      	<span id="nameHelpBlock" class="help-block">{{ $errors->first('name') }}</span>
      @endif	
    </div>
  </div>
  
  <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}">
    <label for="email" class="col-sm-2 control-label">Admin Email:</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="email" id="email" value="{{ (!is_null(old('email'))) ? old('email') : '' }}" placeholder="email@email.com" {{ ($errors->has('email')) ? 'aria-describedby="usernameHelpBlock"' : '' }}>
      @if($errors->has('email'))
      	<span id="usernameHelpBlock" class="help-block">{{ $errors->first('email') }}</span>
      @endif	
    </div>
  </div>
  
  <div class="form-group {{ ($errors->has('admin_name')) ? 'has-error' : '' }}">
    <label for="admin_name" class="col-sm-2 control-label">Admin name:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="admin_name" id="admin_name" value="{{ (!is_null(old('admin_name'))) ? old('admin_name') : '' }}" placeholder="Your name" {{ ($errors->has('admin_name')) ? 'aria-describedby="adminnameHelpBlock"' : '' }}>
      @if($errors->has('admin_name'))
      	<span id="adminnameHelpBlock" class="help-block">{{ $errors->first('admin_name') }}</span>
      @endif	
    </div>
  </div>
  
  <div class="form-group {{ ($errors->has('password')) ? 'has-error' : '' }}">
    <label for="password" class="col-sm-2 control-label">Password:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="password" id="password" value="{{ (!is_null(old('password'))) ? old('password') : '' }}" {{ ($errors->has('password')) ? 'aria-describedby="passwordHelpBlock"' : '' }}>
      @if($errors->has('password'))
      	<span id="passwordHelpBlock" class="help-block">{{ $errors->first('password') }}</span>
      @endif	
    </div>
  </div>
  
  <div class="form-group {{ ($errors->has('password_confirm')) ? 'has-error' : '' }}">
    <label for="password_confirm" class="col-sm-2 control-label">Confirm password:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="password_confirm" id="password_confirm" value="{{ (!is_null(old('password_confirm'))) ? old('password_confirm') : '' }}" {{ ($errors->has('password_confirm')) ? 'aria-describedby="password_confirmHelpBlock"' : '' }}>
      @if($errors->has('password_confirm'))
      	<span id="password_confirmHelpBlock" class="help-block">{{ $errors->first('password_confirm') }}</span>
      @endif	
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
  </div>
</form>

@endsection