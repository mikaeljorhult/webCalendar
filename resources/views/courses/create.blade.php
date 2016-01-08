@extends ('_layouts/default')

@section ('content')

	<div class="page-header">
		<h1>{{ trans('messages.create-course') }}</h1>
	</div>

	@include ('_partials.errors')

	{!! Form::model($course = new \WebCalendar\Course, ['route' => 'admin.courses.store']) !!}
		@include ('courses._form', ['submitButtonText' => trans('messages.create-course')])
	{!! Form::close() !!}

@stop