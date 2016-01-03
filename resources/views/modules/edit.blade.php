@extends ('_layouts/default')

@section ('content')

	<h2>{{ trans('messages.edit') }} {{ $module->title }}</h2>

	@include ('_partials.errors')

	{!! Form::model($module, ['route' => ['admin.modules.update', $module->id], 'method' => 'PUT', 'files' => true]) !!}
		@include ('modules._form', ['submitButtonText' => trans('messages.update')])
	{!! Form::close() !!}

@stop