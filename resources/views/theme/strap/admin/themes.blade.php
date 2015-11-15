@extends('theme.strap.layouts.master')

@section('content')

<p>Themes</p>

<form name="themes-form" id="themes-form" method="post" action="{{ route('admin::edit-themes') }}">
	{!! csrf_field() !!}
	<select name="theme" id="theme">
		<option value="0">Original</option>
		@foreach($themes as $k => $v)
		<option value="{{{ $v }}}" {{ ($v == $selected) ? 'selected' : '' }}>{{{ $v }}}</option>
		@endforeach
	</select>
	<input type="submit" value="Save"/>
</form>

@endsection