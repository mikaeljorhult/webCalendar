@extends ('_layouts/default')

@section ('content')

	<h2>{{ trans('messages.edit') }} {{ $user->username }}</h2>

	@include ('_partials.errors')

	{!! Form::model($user, ['route' => ['admin.users.update', $user->id], 'method' => 'PUT']) !!}
		@include ('users._form', ['submitButtonText' => trans('messages.update')])
	{!! Form::close() !!}

@stop