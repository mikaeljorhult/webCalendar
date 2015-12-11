@extends ('_layouts/default')

@section ('content')

	<h2>Skapa användare</h2>

	@include ('_partials.errors')

	{!! Form::model($user = new \WebCalendar\User, ['route' => 'admin.users.store']) !!}
		@include ('users._form', ['submitButtonText' => 'Skapa användare'])
	{!! Form::close() !!}

@stop