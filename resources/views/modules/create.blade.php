@extends ('_layouts/default')

@section ('content')

	<h2>{{ trans('messages.create-module') }}</h2>

	@include ('_partials.errors')

	{!! Form::model($module = new \WebCalendar\Module, ['route' => 'admin.modules.store', 'files' => true]) !!}
		@include ('modules._form', ['submitButtonText' => trans('messages.create-module')])
	{!! Form::close() !!}

@stop