@extends('layouts.master')

@section('content')

{{ Form::select('theme', $themes) }}

@endsection