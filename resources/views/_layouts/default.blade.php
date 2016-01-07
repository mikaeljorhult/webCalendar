<!DOCTYPE html>
<html lang="{{ App::getLocale() }}" class="no-js">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<title>webCalendar</title>

	<link rel="shortcut icon" href="{{ asset('public/build/img/icons/favicon.ico') }}" />
	<link rel="apple-touch-icon" href="{{ asset('public/build/img/icons/apple-touch-icon.png') }}" />
	<link rel="apple-touch-icon-precomposed" href="{{ asset('public/build/img/icons/apple-touch-icon-precomposed.png') }}" />
	<link rel="apple-touch-icon" href="{{ asset('public/build/img/icons/apple-touch-icon-57x57.png') }}" />
	<link rel="apple-touch-icon" href="{{ asset('public/build/img/icons/apple-touch-icon-72x72.png') }}" />
	<link rel="apple-touch-icon" href="{{ asset('public/build/img/icons/apple-touch-icon-114x114.png') }}" />
	<link rel="apple-touch-icon" href="{{ asset('public/build/img/icons/apple-touch-icon-144x144.png') }}" />

	<link rel="stylesheet" href="{{ elixir('css/app.css') }}">
	<script src="{{ elixir('js/modernizr.js') }}"></script>
</head>

<body>
	<header class="navbar navbar-full navbar-dark bg-inverse">
		<div class="container">
			<a class="navbar-brand" href="{{ route('home') }}">webCalendar</a>

			<ul class="nav navbar-nav pull-xs-right">
				@if (Auth::check())
					<li class="nav-item">{!! link_to_route('admin.courses.index', trans('messages.courses'), [], ['class' => 'nav-link']) !!}</li>
					<li class="nav-item">{!! link_to_route('admin.modules.index', trans('messages.modules'), [], ['class' => 'nav-link']) !!}</li>
					<li class="nav-item">{!! link_to_route('admin.users.index', trans('messages.users'), [], ['class' => 'nav-link']) !!}</li>
					<li class="nav-item">{!! link_to_route('logout', trans('messages.logout'), [], ['class' => 'nav-link']) !!}</li>
				@endif
			</ul>
		</div>
	</header>

	<section class="container main-content">
		@yield ('content')
	</section>

	<footer class="container">
		&nbsp;
	</footer>

	<script src="{{ elixir('js/vendor.js') }}"></script>
	@if (Request::is('admin/*'))
		<script src="{{ elixir('js/admin.js') }}"></script>
	@endif
	<script src="{{ elixir('js/app.js') }}"></script>
</body>

</html>