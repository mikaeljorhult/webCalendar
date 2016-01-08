@extends ('_layouts/default')

@section ('content')

	<div class="page-header">
		<h1>{{ trans('messages.edit') }} {{ $user->username }}</h1>
	</div>

	@include ('_partials.errors')

	{!! Form::model($user, ['route' => ['admin.users.update', $user->id], 'method' => 'PUT']) !!}
		@include ('users._form', ['submitButtonText' => trans('messages.update')])
	{!! Form::close() !!}

@stop