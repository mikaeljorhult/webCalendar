<!DOCTYPE html>
<!--[if lt IE 8]><html class="no-js lt-ie9 oldie"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9 ie8"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>webCalendar</title>
	<meta name="viewport" content="width=device-width">
	
	<link rel="shortcut icon" href="{{ URL::asset( 'assets/img/icons/favicon.ico' ); }}" />
	<link rel="apple-touch-icon" href="{{ URL::asset( 'assets/img/icons/apple-touch-icon.png' ); }}" />
	<link rel="apple-touch-icon-precomposed" href="{{ URL::asset( 'assets/img/icons/apple-touch-icon-precomposed.png' ); }}" />
	<link rel="apple-touch-icon" href="{{ URL::asset( 'assets/img/icons/apple-touch-icon-57x57.png' ); }}" />
	<link rel="apple-touch-icon" href="{{ URL::asset( 'assets/img/icons/apple-touch-icon-72x72.png' ); }}" />
	<link rel="apple-touch-icon" href="{{ URL::asset( 'assets/img/icons/apple-touch-icon-114x114.png' ); }}" />
	<link rel="apple-touch-icon" href="{{ URL::asset( 'assets/img/icons/apple-touch-icon-144x144.png' ); }}" />
	
	{{ HTML::style( 'assets/css/main.css' ); }}
	{{ HTML::script( 'assets/js/modernizr.js' ); }}
</head>

<body>
	<header class="main-header clearfix">
		<h1 class="gamma"><a href="{{ URL::route( 'home' ) }}" class="logo">webCalendar</a></h1>
		
		<ul class="nav">
			@if ( Auth::check() )
				<li>{{ HTML::link( URL::route( 'admin.course.index' ), 'Kurser' ) }}</li>
				<li>{{ HTML::link( URL::route( 'admin.module.index' ), 'Delkurser' ) }}</li>
				<li>{{ HTML::link( URL::route( 'admin.user.index' ), 'Användare' ) }}</li>
				<li>{{ HTML::link( 'logout', 'Logga ut' ) }}</li>
			@else
				<li>{{ HTML::link( URL::route( 'login' ), 'Logga in' ) }}</li>
			@endif
		</ul>
	</header>
	
	<section class="wrapper main-content">
		@yield( 'content' )
	</section>
	
	<footer class="wrapper main-footer clearfix">
		&nbsp;
	</footer>
	
	<script type="text/javascript">var baseurl = "<?php echo URL::route( 'home' ); ?>";</script>
	{{ HTML::script( 'assets/js/jquery.js' ); }}
	{{ HTML::script( 'assets/js/plugins.js' ); }}
	{{ HTML::script( 'assets/js/main.js' ); }}
</body>

</html>