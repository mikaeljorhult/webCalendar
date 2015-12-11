@extends ('_layouts/default')

@section ('content')

	<h2>Redigera {{ $user->username }}</h2>

	@include ('_partials.errors')

	{!! Form::model($user, ['route' => ['admin.users.update', $user->id], 'method' => 'PUT']) !!}
		@include ('users._form', ['submitButtonText' => 'Uppdatera'])
	{!! Form::close() !!}

@stop