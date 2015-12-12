@extends('theme.strap.layouts.master')

@section('content')

<h2>Members of <em>{{ $list->list_name }}</em> list</h2>
<!-- <p><a href="{{ route('admin::add-list') }}" class="btn btn-success">Add list</a></p> -->
<div class="table-responsive">
	<table class="table table-border table-bordered">
		<thead>
			<tr>
				<th>First name</th>
				<th>Last name</th>
				<th>DOB</th>
				<th>Subscribed?</th>
				<th>Operations</th>
			</tr>
		</thead>
		<tbody>
		@forelse($members as $m)
			<tr id="list-{{ $m->id }}" {{ (!$m->subscribed) ? ' class=bg-warning ' : '' }}>
				<td>{{{ $m->first_name }}}</td>
				<td>{{{ $m->last_name }}}</td>
				<td>-</td>
				<td><span class="status">{{{ ($m->subscribed) ? 'Yes' : 'No' }}}</span></td>
				<td width="31%" class="text-center">
					<!-- <a class="btn btn-primary btn-edit" data-id="{{ $m->id }}" href="/admin/lists/edit/{{ $m->id }}">Edit</a> -->
					<a class="btn btn-danger btn-delete" data-id="{{ $m->id }}" href="/admin/members/delete/{{ $m->id }}">Delete</a>
				</td>
			</tr>
		@empty
			<tr id="list-empty">
				<td colspan="5">No members to display</td>
			</tr>
		@endforelse
		</tbody>
	</table>
</div>

<script>
$(function(){
	$('a.btn-delete').on('click', function(){
		if(confirm('Are you sure you want to delete this list?')) {
			var uid = $(this).data('id');
			var postData = {
				id: uid,
				_token: '{!! csrf_token() !!}'
			};
			$.post('/admin/lists/delete/'+uid, postData).done(function(data){
				$('tr#list-'+data.id).fadeOut('fast', function(){
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
		$.post('/admin/lists/status/'+uid, postData).done(function(data){
			var idString = 'tr#list-'+data.id;
			var $row = $(idString);
			// change the status
			var status = $row.find('.status').text();
			var statusNew = '';
			var statusActive = '';
			if(status == 'Yes') {
				statusNew = 'No';
				statusActive = 'Activate';
			}
			else {
				statusNew = 'Yes';
				statusActive = 'Deactivate';
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