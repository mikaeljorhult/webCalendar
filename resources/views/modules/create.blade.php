@extends ('_layouts/default')

@section ('content')

	<h2>Skapa delkurs</h2>

	@include ('_partials.errors')

	{!! Form::model($module = new \WebCalendar\Module, ['route' => 'admin.modules.store']) !!}
		@include ('modules._form', ['submitButtonText' => 'Skapa delkurs'])
	{!! Form::close() !!}

@stop