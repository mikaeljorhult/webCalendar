@extends ('_layouts/default')

@section ('content')

	<h2>Logga in</h2>

	<form method="POST" action="/auth/login">
		{!! csrf_field() !!}

		<div>
			E-post
			<input type="email" name="email" value="{{ old('email') }}">
		</div>

		<div>
			Lösenord
			<input type="password" name="password" id="password">
		</div>

		<div>
			<input type="checkbox" name="remember"> Kom ihåg
		</div>

		<div>
			<button type="submit">Logga in</button>
		</div>
	</form>

@stop