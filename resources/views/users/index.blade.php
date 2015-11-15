@extends('theme.strap.layouts.master')

@section('content')

<h2>View users</h2>

<div class="table-responsive">
	<table class="table table-border table-bordered">
		<thead>
			<tr>
				<th>User name</th>
				<th>Email</th>
				<th>Operations</th>
			</tr>
		</thead>
		<tbody>
		@foreach($users as $u)
			<tr>
				<td>{{{ $u->name }}}</td>
				<td>{{{ $u->email }}}</td>
				<td width="31%" class="text-center">
					<a class="btn btn-primary btn-edit" data-id="{{ $u->id }}" href="/admin/user/edit/{{ $u->id }}">Edit</a>
					<a class="btn btn-info btn-chgpwd" data-id="{{ $u->id }}" data-toggle="modal" data-target="#modal" href="#">Change password</a>
					<a class="btn btn-danger btn-delete" data-id="{{ $u->id }}" href="/admin/user/delete/{{ $u->id }}">Delete</a>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div>

<script>
var chngPwdId = 0;
$(function(){
	$('a.btn-delete').on('click', function(){
		return confirm('Are you sure you want to delete this user?');
	});
	
	$('a.btn-chgpwd').on('click', function(){
		//return false;
		chngPwdId = $(this).data('id');
		alert(chngPwdId);
	});
	
	$('#modal').on('show.bs.modal', function (e) {
		// do something...
		var modal = $(this);
		modal.find('.modal-title').text('Change password');
		
		var modalBody = modal.find('.modal-body');
		
		modalBody.html('');
		
		modalBody.append('<form id="form-passwd" class="form-horizontal" method="post" action="/admin/user-password">');
		
		var modalForm = modalBody.find('#form-passwd');
		modalForm.append('<div class="form-group" id="group-1">');
		var group1 = modalForm.find('#group-1');
		group1.append('<label for="passwd-change" class="col-sm-2 control-label">Password:</label>');
		group1.append('<div class="col-sm-10" id="group-1-wrap">');
		var group1Wrap = group1.find('#group-1-wrap');
		group1Wrap.append('<input type="text" class="form-control" id="passwd-change" placeholder="New password">');
		
		modalForm.append('<div class="form-group" id="group-2">');
		var group2 = modalForm.find('#group-2');
		group2.append('<label for="passwd-change-confirm" class="col-sm-2 control-label">Confirm:</label>');
		group2.append('<div class="col-sm-10" id="group-2-wrap">');
		var group2Wrap = group2.find('#group-2-wrap');
		group2Wrap.append('<input type="text" class="form-control" id="passwd-change-confirm" placeholder="New password">');
		
		modalForm.append('<div class="form-group" id="group-3">');
		var group3 = modalForm.find('#group-3');
		group3.append('<div class="col-sm-offset-2 col-sm-10" id="group-3-wrap">');
		var group3Wrap = group3.find('#group-3-wrap');
		group3Wrap.append('<button type="submit" id="pwd-form-submit" class="btn btn-default" data-loading-text="Loading...">Change Password</button>');
		
		modalForm.append('{!! csrf_field() !!}');
		
	});
	
	$('body').on('click', '#pwd-form-submit', function(){
		var $btn = $(this).button('loading');
		$('.modal-footer .uil-ring-css').fadeIn('fast', function(){
			$(this).removeClass('hidden');
		});
		var postData = {
			id: chngPwdId,
			password: $('#passwd-change').val(),
			_token: '{!! csrf_token() !!}'
		};
		$.post('/admin/users/update-password', postData).done(function(data){
			var modalForm = $('#modal').find('#form-passwd');
			modalForm.prepend('<div class="alert alert-success"><p>Password changed.</p></div>');
		}).always(function(){
			$btn.button('reset');
			$('.modal-footer .uil-ring-css').fadeOut('fast', function(){
				$(this).addClass('hidden');
			});
		});
		return false;
	});
});
</script>
@endsection