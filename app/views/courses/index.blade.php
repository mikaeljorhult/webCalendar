@section( 'content' )

<h2>Kurser</h2>
<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th>Namn</th>
			<th>Kurskod</th>
			<th>Startdatum</th>
			<th>Slutdatum</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		@if ( $courses )
			@foreach ( $courses as $course )
				<tr>
					<td>{{ HTML::link( URL::route( 'admin.courseS.show', $course->id ), $course->name ) }}</td>
					<td>{{ $course->code }}</td>
					<td>{{ $course->start_date }}</td>
					<td>{{ $course->end_date }}</td>
					<td>{{ HTML::link( URL::route( 'admin.courseS.edit', $course->id ), 'Redigera' ) }}</td>
					<td>
						{{ Form::open( [ 'route' => [ 'admin.courseS.destroy', $course->id ], 'method' => 'DELETE' ] ) }}
						{{ Form::submit( 'Radera', [ 'class' => 'no-button' ] ) }}
						{{ Form::close() }}
					</td>
				</tr>
			@endforeach
		@else
			<tr><td>Det finns inga kurser i systemet.</td></tr>
		@endif
	</tbody>
</table>

<p>
	{{ HTML::link( URL::route( 'admin.courses.create' ), 'Skapa ny kurs', [ 'class' => 'button' ] ) }}
</p>

@stop