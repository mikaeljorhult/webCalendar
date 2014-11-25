@section( 'content' )

<h2>Skapa användare</h2>

@include ( '_partials.errors' )

{{ Form::open( array( 'route' => 'admin.users.store', 'method' => 'POST' ) ) }}
	<ul>
		<li>
			{{ Form::label( 'username', 'Användarnamn' ) }}
			{{ Form::text( 'username', '', [ 'placeholder' => 'Användarnamn'] ) }}
		</li>
		
		<li>
			{{ Form::label( 'password', 'Lösenord' ) }}
			{{ Form::password( 'password', '', [ 'placeholder' => 'Lösenord' ] ) }}
		</li>
		
		<li>
			{{ Form::label( 'email', 'E-postadress' ) }}
			{{ Form::text( 'email', '', [ 'placeholder' => 'E-postadress' ] ) }}
		</li>
		
		<li>
			{{ Form::submit( 'Skapa användare' ) }}
		</li>
	</ul>
{{ Form::close() }}

@stop