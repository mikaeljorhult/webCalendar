<!DOCTYPE html>
<html lang="{{ App::getLocale() }}" class="no-js">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<title>webCalendar</title>

	<link rel="shortcut icon" href="{{ asset( 'assets/img/icons/favicon.ico' ) }}" />
	<link rel="apple-touch-icon" href="{{ asset( 'assets/img/icons/apple-touch-icon.png' ) }}" />
	<link rel="apple-touch-icon-precomposed" href="{{ asset( 'assets/img/icons/apple-touch-icon-precomposed.png' ) }}" />
	<link rel="apple-touch-icon" href="{{ asset( 'assets/img/icons/apple-touch-icon-57x57.png' ) }}" />
	<link rel="apple-touch-icon" href="{{ asset( 'assets/img/icons/apple-touch-icon-72x72.png' ) }}" />
	<link rel="apple-touch-icon" href="{{ asset( 'assets/img/icons/apple-touch-icon-114x114.png' ) }}" />
	<link rel="apple-touch-icon" href="{{ asset( 'assets/img/icons/apple-touch-icon-144x144.png' ) }}" />

	<link rel="stylesheet" href="{{ elixir('css/app.css') }}">
	<script src="{{ elixir('js/modernizr.js') }}"></script>
</head>

<body>
	<header class="main-header clearfix">
		<h1 class="gamma"><a href="{{ route( 'home' ) }}" class="logo">webCalendar</a></h1>

		<ul class="nav">
			@if ( Auth::check() )
				<li>{!! link_to_route( 'admin.courses.index', 'Kurser' ) !!}</li>
				<li>{!! link_to_route( 'admin.modules.index', 'Delkurser' ) !!}</li>
				<li>{!! link_to_route( 'admin.users.index', 'Användare' ) !!}</li>
				<li>{!! link_to_route( 'logout', 'Logga ut' ) !!}</li>
			@endif
		</ul>
	</header>

	<section class="wrapper main-content">
		@yield( 'content' )
	</section>

	<footer class="wrapper main-footer clearfix">
		&nbsp;
	</footer>

	<script src="{{ elixir('js/vendor.js') }}"></script>
	<script src="{{ elixir('js/app.js') }}"></script>
</body>

</html>