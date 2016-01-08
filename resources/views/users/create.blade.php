@extends ('_layouts/default')

@section ('content')

	<div class="page-header">
		<h1>{{ trans('messages.create-user') }}</h1>
	</div>

	@include ('_partials.errors')

	{!! Form::model($user = new \WebCalendar\User, ['route' => 'admin.users.store']) !!}
		@include ('users._form', ['submitButtonText' => trans('messages.create-user')])
	{!! Form::close() !!}

@stop