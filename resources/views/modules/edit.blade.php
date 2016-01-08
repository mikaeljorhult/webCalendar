@extends ('_layouts/default')

@section ('content')

	<div class="page-header">
		<h1>{{ trans('messages.edit') }} {{ $module->title }}</h1>
	</div>

	@include ('_partials.errors')

	{!! Form::model($module, ['route' => ['admin.modules.update', $module->id], 'method' => 'PUT', 'files' => true]) !!}
		@include ('modules._form', ['submitButtonText' => trans('messages.update')])
	{!! Form::close() !!}

@stop