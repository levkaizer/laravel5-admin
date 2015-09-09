@extends('theme.strap.layouts.master')

@section('content')

<!-- resources/views/auth/password.blade.php -->
<h2>Reset password</h2>
<form class="form-horizontal" method="POST" action="/password/email">
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
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
    </div>
  </div>
</form>
@endsection