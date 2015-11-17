@extends('theme.strap.layouts.master')

@section('content')

<h2>Create List</h2>
<form class="form-horizontal" method="POST" action="{{ route('admin::save-list') }}">
  {!! csrf_field() !!}
  <div class="form-group {{ ($errors->has('list_name')) ? 'has-error' : '' }}">
    <label for="list_name" class="col-sm-2 control-label">List name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="list_name" id="list_name" value="{{ old('list_name') }}" placeholder="List Name" {{ ($errors->has('list_name')) ? 'aria-describedby="list_nameHelpBlock"' : '' }}>
      @if($errors->has('list_name'))
      	<span id="list_nameHelpBlock" class="help-block">{{ $errors->first('list_name') }}</span>
      @endif	
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Create</button>
    </div>
  </div>
</form>
@endsection