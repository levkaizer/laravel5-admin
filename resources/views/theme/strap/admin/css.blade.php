@extends('theme.strap.layouts.master')

@section('content')

<style type="text/css" media="screen">
    #css-form { 
    	height:500px;
    	position:relative;
    }
    
    #css-editor{

    	height:400px;
    }
</style>

<h2>CSS Editor</h2>
<p>Front end CSS file: <strong>{{ $file['path'] }}</strong></p>

<form name="css-form" id="css-form" method="post" action="{{ route('admin::edit-css') }}">
	{!! csrf_field() !!}
	<pre name="css-editor" id="css-editor">{{ $file['css'] }}</pre>
	<input name="css" id="css" type="hidden" />
	<input type="submit" value="Save" />
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.2/ace.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.2/ext-beautify.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.2/ext-keybinding_menu.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.2/mode-css.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.2/snippets/css.js"></script>

<script>
    var editor = ace.edit("css-editor");
    editor.setTheme("ace/theme/kuroir");
    editor.getSession().setMode("ace/mode/css");
    editor.getSession().on('change', function(e) {
    // e.type, etc
    	$('#css').val(editor.getValue());
	});

</script>
@endsection