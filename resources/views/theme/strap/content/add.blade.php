@extends('theme.strap.layouts.master')

@section('content')

<h2>Add content</h2>
<form class="form-horizontal" method="POST" action="{{ route('admin::save-content') }}">
  {!! csrf_field() !!}
  <div class="form-group {{ ($errors->has('title')) ? 'has-error' : '' }}">
    <label for="title" class="col-sm-2 control-label">Title</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="title" id="title" value="{{  (old('title')) ? old('title') : '' }}" placeholder="Title" {{ ($errors->has('title')) ? 'aria-describedby="titleHelpBlock"' : '' }}>
      @if($errors->has('title'))
      	<span id="titleHelpBlock" class="help-block">{{ $errors->first('title') }}</span>
      @endif	
    </div>
  </div>
  
  <div class="form-group {{ ($errors->has('content')) ? 'has-error' : '' }}">
    <label for="content" class="col-sm-2 control-label">Content</label>
    <div class="col-sm-10">
      <textarea class="form-control" name="content" id="content" {{ ($errors->has('content')) ? 'aria-describedby="contentHelpBlock"' : '' }}>{{  (old('content')) ? old('content') : '' }}</textarea>
      @if($errors->has('content'))
      	<span id="contentHelpBlock" class="help-block">{{ $errors->first('content') }}</span>
      @endif	
    </div>
  </div>
  
  <div class="form-group {{ ($errors->has('alias')) ? 'has-error' : '' }}">
    <label for="alias" class="col-sm-2 control-label">Title</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="alias" id="alias" value="{{  (old('alias')) ? old('alias') : '' }}" placeholder="URL" {{ ($errors->has('alias')) ? 'aria-describedby="aliasHelpBlock"' : '' }}>
      @if($errors->has('alias'))
      	<span id="aliasHelpBlock" class="help-block">{{ $errors->first('alias') }}</span>
      @endif	
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="radio">
        <label>
          <input type="radio" name="status" id="statusOn" value="1" checked> Published
        </label>
      </div>
    </div>
    <div class="col-sm-offset-2 col-sm-10">
      <div class="radio">
        <label>
          <input type="radio" name="status" id="statusOff" value="0"> Unpublished
        </label>
      </div>
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
  </div>
</form>
@include('theme.strap.includes.editor')
@endsection