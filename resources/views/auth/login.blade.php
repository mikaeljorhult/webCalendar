@extends ('_layouts/default')

@section ('content')

	<div class="page-header">
		<h1>{{ trans('messages.login') }}</h1>
	</div>

	<form method="POST" action="/auth/login">
		{!! csrf_field() !!}

		<fieldset class="form-group">
			{{ Form::label('email', trans('messages.email')) }}
			{{ Form::email('email', old('email'), ['class' => 'form-control']) }}
		</fieldset>

		<fieldset class="form-group">
			{{ Form::label('password', trans('messages.password')) }}</label>
			{{ Form::password('password', ['class' => 'form-control']) }}
		</fieldset>

		<div class="checkbox">
			<label>
				<input type="checkbox" name="remember">
				{{ trans('messages.remember') }}
			</label>
		</div>

		{{ Form::submit(trans('messages.login'), ['class' => 'btn btn-primary']) }}
	</form>

@stop