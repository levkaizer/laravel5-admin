@extends('theme.strap.layouts.master')

@section('content')

	<p>Hi {{ $user->name }}</p>
	@foreach($links as $title => $l)
		<h3>{{{ $title }}}</h3>
		<ul>
		@foreach($l as $k => $v)
			<li><a href="{{ $v['link'] }}" {{ (isset($v['attributes']['class'])) ? 'class='.$v['attributes']['class'] : '' }} {{ (isset($v['attributes']['id'])) ? 'id='.$v['attributes']['id'] : '' }} >{{{ $k }}}</a></li>
		@endforeach
		</ul>
	@endforeach
@endsection