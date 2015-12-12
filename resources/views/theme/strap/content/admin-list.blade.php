@extends('theme.strap.layouts.master')

@section('content')

<h2>Site Content</h2>
<p><a href="{{ route('admin::add-content') }}" class="btn btn-success">Add Content</a></p>
<div class="table-responsive">
	<table class="table table-border table-bordered">
		<thead>
			<tr>
				<th>Title</th>
				<th>Status</th>
				<th>Operations</th>
			</tr>
		</thead>
		<tbody>
		@forelse($content as $c)
			<tr id="content-{{ $c->id }}" {{ (!$c->status) ? ' class=bg-warning ' : '' }}>
				<td>{{{ $c->title }}}</td>
				<td><span class="status">{{{ ($c->status) ? 'Published' : 'Unpublished' }}}</span></td>
				<td width="40%" class="text-center">
					<a class="btn btn-primary btn-edit" data-id="{{ $c->id }}" href="/admin/content/edit/{{ $c->id }}">Edit</a>
					<a class="btn btn-info btn-status" data-id="{{ $c->id }}" href="/admin/content/status/{{ $c->id }}"> {{ ($c->status) ? 'Unpublish' : 'Publish' }}</a>
					<a class="btn btn-danger btn-delete" data-id="{{ $c->id }}" href="/admin/lists/delete/{{ $c->id }}">Delete</a>
				</td>
			</tr>
		@empty
			<tr id="list-empty">
				<td colspan="3">No content to display</td>
			</tr>
		@endforelse
		</tbody>
	</table>
</div>

<script>
$(function(){
	$('a.btn-delete').on('click', function(){
		if(confirm('Are you sure you want to delete this content item?')) {
			var uid = $(this).data('id');
			var postData = {
				id: uid,
				_token: '{!! csrf_token() !!}'
			};
			$.post('/admin/content/delete/'+uid, postData).done(function(data){
				$('tr#content-'+data.id).fadeOut('fast', function(){
					$(this).remove();
				});
			});
		}
		return false;
	});
	
	$('a.btn-status').on('click', function(){
		var $this = $(this);
		var uid = $(this).data('id');
		var postData = {
			id: uid,
			_token: '{!! csrf_token() !!}'
		};
		$.post('/admin/content/status/'+uid, postData).done(function(data){
			var idString = 'tr#content-'+data.id;
			var $row = $(idString);
			// change the status
			var status = $row.find('.status').text();
			var statusNew = '';
			var statusActive = '';
			if(status == 'Published') {
				statusNew = 'Unpublished';
				statusActive = 'Publish';
			}
			else {
				statusNew = 'Published';
				statusActive = 'Unpublish';
			}
			$row.find('.status').text(statusNew);
			$this.text(statusActive);
			
			// now check for warning flags
			var status = data.status;
			if(status) {
				if($row.hasClass('bg-warning')) {
					$row.removeClass('bg-warning');
				}
			}
			else {
				$row.addClass('bg-warning');
			}
		});
		return false;
	});
	
});
</script>
@endsection