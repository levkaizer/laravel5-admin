/**
 * App.js
 */
var _token = null;
function getToken($) {
	$.ajax({
		type:'get',
		url:'/admin/token'
	}).done(function(data){
		_token = data.token;
		setToken($);
	});
}

function setToken($) {
	alert(_token);
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': _token
		}
	});
}