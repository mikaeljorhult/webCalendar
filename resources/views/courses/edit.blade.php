@extends ('_layouts/default')

@section ('content')

	<div class="page-header">
		<h1>{{ trans('messages.edit') }} {{ $course->title }}</h1>
	</div>

	@include ('_partials.errors')

	{!! Form::model($course, ['route' => ['admin.courses.update', $course->id], 'method' => 'PUT']) !!}
		@include ('courses._form', ['submitButtonText' => trans('messages.update')])
	{!! Form::close() !!}

@stop