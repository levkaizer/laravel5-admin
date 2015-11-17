@extends('theme.strap.layouts.master')

@section('content')

<h2>Set default list</h2>
<p>Choose a list to appear on homepage.</p>


<form class="form-horizontal" method="POST" action="{{ route('admin::save-default') }}">
  {!! csrf_field() !!}
  <div class="form-group {{ ($errors->has('homepage_list')) ? 'has-error' : '' }}">
    <label for="homepage_list" class="col-sm-2 control-label">Homepage list:</label>
    <div class="col-sm-10">
      <select id="homepage_list" class="form-control" name="homepage_list" id="homepage_list" {{ ($errors->has('list_name')) ? 'aria-describedby="list_nameHelpBlock"' : '' }}>
		@forelse($lists as $k => $l)
			<option value="{{ $k }}" {{ (\Configuration::get('default_list') == $k) ? 'selected' : ''}}>{{ $l }}</option>
		@empty
		<option>No lists</option>
		@endforelse
		</select>
      @if($errors->has('homepage_list'))
      	<span id="list_nameHelpBlock" class="help-block">{{ $errors->first('homepage_list') }}</span>
      @endif	
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Set</button>
    </div>
  </div>
</form>

@endsection