<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/app.css" rel="stylesheet">
    @if(isset($styles))
    	@if(is_array($styles) || count($styles) > 1)
    		@foreach($styles as $style)
    <link href="{{{ $style }}}" rel="stylesheet">
    		@endforeach
    	@else
    <link href="{{{ $styles }}}" rel="stylesheet">
    	@endif
    @endif


    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/js/vendor.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @if(isset($scripts))
    	@foreach($scripts as $script)
    <script src="{{ $script }}"></script>
    	@endforeach
    @endif
    <script src="/js/app.js"></script>
  </head>

  <body>
  
  <nav class="navbar navbar-inverse navbar-fixed-top">
	  <div class="container">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="{{ Auth::check() ? '/admin' : '/' }}">{{{ \Configuration::get('app_name') }}}</a>
		</div>
		<div id="navbar" class="collapse navbar-collapse">
		  <ul class="nav navbar-nav">
			@include('theme.strap.layouts.nav') 
		  </ul>
		  <ul class="nav navbar-nav navbar-right">
		    @if(\Auth::check())
		  	<li class="active dropdown">
		  		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ \Auth::user()->name }} <span class="caret"></span></a>
		  		<ul class="dropdown-menu">
                  <li><a href="/profile">Profile</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="/logout">Logout</a></li>
		  		</ul>
		  	</li>
		  	@else
		  		<li><a href="/login">Login</a></li>
                <li><a href="/register">Register</a></li>
		  	@endif	
		  </ul>
		</div><!--/.nav-collapse -->
	  </div>
	</nav>
	
	@if(isset($message))
		<div class="alert alert-success" role="alert">{{ $message }}</div>
	@endif

    <div class="container">
    	@yield('content')
    </div><!-- /.container -->
    @include('theme.strap.dialogs.modal') 
  </body>
</html>
