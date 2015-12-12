@extends ('_layouts/default')

@section ('content')

	<h2>{{ trans('messages.create-user') }}</h2>

	@include ('_partials.errors')

	{!! Form::model($user = new \WebCalendar\User, ['route' => 'admin.users.store']) !!}
		@include ('users._form', ['submitButtonText' => trans('messages.create-user')])
	{!! Form::close() !!}

@stop