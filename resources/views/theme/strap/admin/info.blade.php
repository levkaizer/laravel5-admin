@extends('theme.strap.layouts.master')

@section('content')

<form class="form-horizontal" name="info-form" id="info-form" method="post" action="{{ route('admin::edit-info') }}">
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
  
  <div class="form-group {{ ($errors->has('name')) ? 'has-error' : '' }}">
    <label for="name" class="col-sm-2 control-label">Debug:</label>
    <div class="col-sm-10">
      <input type="checkbox" class="form-control" name="debug" id="debug" value="{{ (!is_null(old('debug'))) ? old('debug') : 1 }}" {{ (\Configuration::get('debug')) ? ' checked ' : '' }} placeholder="Name" {{ ($errors->has('debug')) ? 'aria-describedby="debugHelpBlock"' : '' }}>
      @if($errors->has('debug'))
      	<span id="debugHelpBlock" class="help-block">{{ $errors->first('debug') }}</span>
      @endif
      @if(\Configuration::debug())
      	<span id="debugShowBlock" class="help-block"><a href="{{ route('admin::flush') }}">Flush admin cache</a></span>
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