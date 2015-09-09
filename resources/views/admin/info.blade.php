@extends('theme.strap.layouts.master')

@section('content')

<p>Site name: {{{ \Configuration::get('app_name') }}}</p>

@endsection