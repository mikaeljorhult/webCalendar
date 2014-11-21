@section( 'content' )

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
		@if ( $modules )
			@foreach ( $modules as $module )
				<tr>
					<td>{{ HTML::link( URL::route( 'admin.modules.show', $module->id ), $module->name ) }}</td>
					<td>{{ $module->start_date }}</td>
					<td>{{ $module->end_date }}</td>
					<td>{{ HTML::link( $module->url, 'Länk' ) }}</td>
					<td>{{ HTML::link( URL::route( 'admin.modules.edit', $module->id ), 'Redigera' ) }}</td>
					<td>
						{{ Form::open( [ 'route' => [ 'admin.modules.destroy', $module->id ], 'method' => 'DELETE' ] ) }}
						{{ Form::submit( 'Radera', [ 'class' => 'no-button' ] ) }}
						{{ Form::close() }}
					</td>
				</tr>
			@endforeach
		@else
			<tr><td>Det finns inga delkurser i systemet.</td></tr>
		@endif
	</tbody>
</table>

<p>
	{{ HTML::link( URL::route( 'admin.modules.create' ), 'Skapa ny delkurs', [ 'class' => 'button' ] ) }}
</p>

@stop