@section( 'content' )

<h2>Delkurser</h2>
<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th>Namn</th>
			<th>Kortnamn</th>
			<th>Kalender</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		@if ( $modules )
			@foreach ( $modules as $module )
				<tr>
					<td>{{ HTML::link( URL::route( 'admin.module.show', $module->id ), $module->name ) }}</td>
					<td>{{ $module->short_name }}</td>
					<td>{{ HTML::link( $module->calendar, 'Länk' ) }}</td>
					<td>{{ HTML::link( URL::route( 'admin.module.edit', $module->id ), 'Redigera' ) }}</td>
					<td>
						{{ Form::open( [ 'route' => [ 'admin.module.destroy', $module->id ], 'method' => 'DELETE' ] ) }}
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
	{{ HTML::link( URL::route( 'admin.module.create' ), 'Skapa ny delkurs', [ 'class' => 'button' ] ) }}
</p>

@stop