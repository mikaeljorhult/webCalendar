@section( 'content' )

<h2>Användare</h2>
<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th>Användarnamn</th>
			<th>E-postadress</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		@if ( $users )
			@foreach ( $users as $user )
				<tr>
					<td>{{ HTML::link( URL::route( 'admin.user.show', $user->id ), $user->username ) }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ HTML::link( URL::route( 'admin.user.edit', $user->id ), 'Redigera' ) }}</td>
					<td>
						@if ( $user->id != Auth::user()->id )
							{{ Form::open( [ 'route' => [ 'admin.user.destroy', $user->id ], 'method' => 'DELETE' ] ) }}
							{{ Form::submit( 'Radera', [ 'class' => 'no-button' ] ) }}
							{{ Form::close() }}
						@else
							&nbsp;
						@endif
					</td>
				</tr>
			@endforeach
		@else
			<tr><td>Det finns inga användare i systemet.</td></tr>
		@endif
	</tbody>
</table>

<p>
	{{ HTML::link( URL::route( 'admin.user.create' ), 'Skapa ny användare', [ 'class' => 'button' ] ) }}
</p>

@stop