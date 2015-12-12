@extends ('_layouts/default')

@section ('content')

	<h2>{{ trans('messages.edit') }} {{ $course->title }}</h2>

	@include ('_partials.errors')

	{!! Form::model($course, ['route' => ['admin.courses.update', $course->id], 'method' => 'PUT']) !!}
		@include ('courses._form', ['submitButtonText' => trans('messages.update')])
	{!! Form::close() !!}

@stop