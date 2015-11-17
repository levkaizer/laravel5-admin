@extends('theme.strap.layouts.master')

@section('content')

<h2>Edit List</h2>
<form class="form-horizontal" method="POST" action="{{ route('admin::edit-list-save', ['id' => $list->id]) }}">
  {!! csrf_field() !!}
  <div class="form-group {{ ($errors->has('list_name')) ? 'has-error' : '' }}">
    <label for="list_name" class="col-sm-2 control-label">List name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="list_name" id="list_name" value="{{  (old('list_name')) ? old('list_name') : $list->list_name }}" placeholder="List Name" {{ ($errors->has('list_name')) ? 'aria-describedby="list_nameHelpBlock"' : '' }}>
      @if($errors->has('list_name'))
      	<span id="list_nameHelpBlock" class="help-block">{{ $errors->first('list_name') }}</span>
      @endif	
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="active" value="1" {{ ($list->active) ? ' checked ' : '' }}> Active
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
@endsection