@extends ('_layouts/default')

@section ('content')

	<h2>Redigera {{ $course->title }}</h2>

	@include ('_partials.errors')

	{!! Form::model($course, ['route' => ['admin.courses.update', $course->id], 'method' => 'PUT']) !!}
		@include ('courses._form', ['submitButtonText' => 'Uppdatera'])
	{!! Form::close() !!}

@stop