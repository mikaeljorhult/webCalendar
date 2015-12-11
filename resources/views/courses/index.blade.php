@extends ('_layouts/default')

@section('content')

	<h2>Kurser</h2>
	<table cellpadding="0" cellspacing="0">
		<thead>
		<tr>
			<th>Namn</th>
			<th>Kurskod</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		</thead>
		<tbody>
		@if ($courses)
			@foreach ($courses as $course)
				<tr>
					<td>{!! link_to_route('admin.courses.edit', $course->name, $course->id) !!}</td>
					<td>{{ $course->code }}</td>
					<td>{!! link_to_route('admin.courses.edit', 'Redigera', $course->id) !!}</td>
					<td>
						{!! Form::open(['route' => ['admin.courses.destroy', $course->id], 'method' => 'DELETE']) !!}
						{!! Form::submit('Radera', ['class' => 'no-button']) !!}
						{!! Form::close() !!}
					</td>
				</tr>
			@endforeach
		@else
			<tr>
				<td>Det finns inga kurser i systemet.</td>
			</tr>
		@endif
		</tbody>
	</table>

	<p>
		{!! link_to_route('admin.courses.create', 'Skapa ny kurs', [], ['class' => 'button']) !!}
	</p>

@stop