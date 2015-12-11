@extends ('_layouts/default')

@section ('content')

	<h2>Redigera {{ $module->title }}</h2>

	@include ('_partials.errors')

	{!! Form::model($module, ['route' => ['admin.modules.update', $module->id], 'method' => 'PUT']) !!}
		@include ('modules._form', ['submitButtonText' => 'Uppdatera'])
	{!! Form::close() !!}

@stop