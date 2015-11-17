@extends('theme.strap.layouts.master')

@section('content')
<h1>Welcome to the Laravel 5 Admin system.</h1>
<div class="test">
	this should be black.
</div>
@if($showList)
<div class="panel panel-default">
  <div class="panel-heading"><h3 class="panel-title">Sign up to our mailing list</h3></div>
  <div class="panel-body">
  	@include('theme.strap.lists.list-signup')
  </div>
</div>
@else
	@if($thankyou)
	<p>Thank you for subscribing to our list.</p>
	@endif
@endif
@endsection