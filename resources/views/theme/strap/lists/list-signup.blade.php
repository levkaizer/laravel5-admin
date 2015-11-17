<form class="form-horizontal" method="POST" action="{{ route('save-list-member') }}">
  {!! csrf_field() !!}
  <input type="hidden" value="{{ $list->id or \Configuration::get('default_list') }}" name="list">
  <div class="form-group {{ ($errors->has('first_name')) ? 'has-error' : '' }}">
    <label for="first_name" class="col-sm-2 control-label">First name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="first_name" id="first_name" value="{{ old('first_name') }}" placeholder="First name" {{ ($errors->has('first_name')) ? 'aria-describedby="first_nameHelpBlock"' : '' }}>
      @if($errors->has('first_name'))
      	<span id="first_nameHelpBlock" class="help-block">{{ $errors->first('first_name') }}</span>
      @endif	
    </div>
  </div>
  <div class="form-group {{ ($errors->has('last_name')) ? 'has-error' : '' }}">
    <label for="last_name" class="col-sm-2 control-label">Last name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="last_name" id="last_name" value="{{ old('last_name') }}" placeholder="Last name" {{ ($errors->has('last_name')) ? 'aria-describedby="last_nameHelpBlock"' : '' }}>
      @if($errors->has('last_name'))
      	<span id="last_nameHelpBlock" class="help-block">{{ $errors->first('last_name') }}</span>
      @endif	
    </div>
  </div>
  <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}">
    <label for="email" class="col-sm-2 control-label">E-mail address</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="you@example.com" {{ ($errors->has('email')) ? 'aria-describedby="emailHelpBlock"' : '' }}>
      @if($errors->has('email'))
      	<span id="emailHelpBlock" class="help-block">{{ $errors->first('email') }}</span>
      @endif	
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Sign up!</button>
    </div>
  </div>
</form>