@section( 'content' )

<h2>Redigera {{ $user->username }}</h2>

{{ Form::model( $user, [ 'route' => [ 'admin.user.update', $user->id ], 'method' => 'PUT' ] ) }}
	<ul>
		<li>
			{{ Form::label( 'username', 'Användarnamn' ) }}
			{{ Form::text( 'username' ) }}
		</li>
		
		<li>
			{{ Form::label( 'password', 'Lösenord' ) }}
			{{ Form::password( 'password' ) }}
		</li>
		
		<li>
			{{ Form::label( 'email', 'E-postadress' ) }}
			{{ Form::text( 'email' ) }}
		</li>
		
		<li>
			{{ Form::submit( 'Uppdatera' ) }}
		</li>
	</ul>
{{ Form::close() }}

@stop