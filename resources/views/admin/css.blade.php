@extends('theme.strap.layouts.master')

@section('content')

<h2>CSS Editor</h2>
<p>Front end CSS file: <strong>{{ $file['path'] }}</strong></p>

<form name="css-form" id="css-form" method="post" action="{{ route('admin::edit-css') }}">
	{!! csrf_field() !!}
	<textarea name="css" id="css">{{ $file['css'] }}</textarea>
	<input type="submit" value="Save" />
</form>

@endsection