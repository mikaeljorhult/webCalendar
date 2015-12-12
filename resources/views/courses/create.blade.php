@extends ('_layouts/default')

@section ('content')

	<h2>{{ trans('messages.create-course') }}</h2>

	@include ('_partials.errors')

	{!! Form::model($course = new \WebCalendar\Course, ['route' => 'admin.courses.store']) !!}
		@include ('courses._form', ['submitButtonText' => trans('messages.create-course')])
	{!! Form::close() !!}

@stop