@extends ('_layouts/default')

@section ('content')

	<div class="page-header">
		<h1>{{ trans('messages.modules') }}</h1>
	</div>

	<table cellpadding="0" cellspacing="0" class="table table-hover">
		<thead>
		<tr>
			<th>{{ trans('messages.name') }}</th>
			<th>{{ trans('messages.start-date') }}</th>
			<th>{{ trans('messages.end-date') }}</th>
			<th>{{ trans('messages.calendar') }}</th>
			<th class="icon-column">&nbsp;</th>
			<th class="icon-column">&nbsp;</th>
		</tr>
		</thead>
		<tbody>
			@forelse ($modules as $module)
				<tr>
					<td>{!! link_to_route('admin.modules.edit', $module->name, $module->id) !!}</td>
					<td>{{ $module->start_date->format('Y-m-d') }}</td>
					<td>{{ $module->end_date->format('Y-m-d') }}</td>
					<td>{!! link_to('#', '', ['class' => 'calendar-link icon-button icon-calendar', 'title' => $module->calendar]) !!}</td>
					<td>{!! link_to_route('admin.modules.edit', trans('messages.edit'), $module->id, ['class' => 'icon-button icon-edit'])  !!}</td>
					<td>
						{!! Form::open(['route' => ['admin.modules.destroy', $module->id], 'method' => 'DELETE']) !!}
						{!! Form::submit(trans('messages.delete'), ['class' => 'no-button icon-button icon-delete']) !!}
						{!! Form::close() !!}
					</td>
				</tr>
			@empty
				<tr>
					<td>{{ trans('messages.no-modules') }}</td>
				</tr>
			@endforelse
		</tbody>
	</table>

	<p>
		{!! link_to_route('admin.modules.create', trans('messages.create-new-module'), [], ['class' => 'button']) !!}
	</p>

	@include ('_partials.modal.confirm-delete')

@stop