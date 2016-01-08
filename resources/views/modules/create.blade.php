@extends ('_layouts/default')

@section ('content')

	<div class="page-header">
		<h1>{{ trans('messages.create-module') }}</h1>
	</div>

	@include ('_partials.errors')

	{!! Form::model($module = new \WebCalendar\Module, ['route' => 'admin.modules.store', 'files' => true]) !!}
		@include ('modules._form', ['submitButtonText' => trans('messages.create-module')])
	{!! Form::close() !!}

@stop