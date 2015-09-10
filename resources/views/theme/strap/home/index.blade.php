@extends('theme.strap.layouts.master')

@section('content')
	<p>Hi {{ $user->name }}</p>
	
	@include('theme.strap.home.admin_menu')
	
@endsection