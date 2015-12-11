@extends ('_layouts/default')

@section ('content')

	<h2>Delkurser</h2>
	<table cellpadding="0" cellspacing="0">
		<thead>
		<tr>
			<th>Namn</th>
			<th>Startdatum</th>
			<th>Slutdatum</th>
			<th>Kalender</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		</thead>
		<tbody>
		@if ($modules)
			@foreach ($modules as $module)
				<tr>
					<td>{!! link_to_route('admin.modules.edit', $module->name, $module->id) !!}</td>
					<td>{{ $module->start_date }}</td>
					<td>{{ $module->end_date }}</td>
					<td>{{ $module->calendar }}</td>
					<td>{!! link_to_route('admin.modules.edit', 'Redigera', $module->id)  !!}</td>
					<td>
						{!! Form::open(['route' => ['admin.modules.destroy', $module->id], 'method' => 'DELETE']) !!}
						{!! Form::submit('Radera', ['class' => 'no-button']) !!}
						{!! Form::close() !!}
					</td>
				</tr>
			@endforeach
		@else
			<tr>
				<td>Det finns inga delkurser i systemet.</td>
			</tr>
		@endif
		</tbody>
	</table>

	<p>
		{!! link_to_route('admin.modules.create', 'Skapa ny delkurs', [], ['class' => 'button']) !!}
	</p>

@stop