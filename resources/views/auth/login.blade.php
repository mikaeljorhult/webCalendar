@extends ('_layouts/default')

@section ('content')

	<h2>{{ trans('messages.login') }}</h2>

	<form method="POST" action="/auth/login">
		{!! csrf_field() !!}

		<ul>
			<li>
				<label>{{ trans('messages.email') }}</label>
				<input type="email" name="email" value="{{ old('email') }}">
			</li>

			<li>
				<label>{{ trans('messages.password') }}</label>
				<input type="password" name="password" id="password">
			</li>

			<li>
				<input type="checkbox" name="remember"> {{ trans('messages.remember') }}
			</li>

			<li>
				<button type="submit">{{ trans('messages.login') }}</button>
			</li>
		</ul>
	</form>

@stop