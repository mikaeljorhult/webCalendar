@extends ('_layouts/default')

@section ('content')

	<h2>Skapa kurs</h2>

	@include ('_partials.errors')

	{!! Form::model($course = new \WebCalendar\Course, ['route' => 'admin.courses.store']) !!}
		@include ('courses._form', ['submitButtonText' => 'Skapa kurs'])
	{!! Form::close() !!}

@stop