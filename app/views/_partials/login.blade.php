<div id="login-form" class="login-form">
	{{ Form::open( [ 'route' => 'sessions.store' ] ) }}
		{{ Form::token() }}
	
		<ul>
			<li>
				{{ Form::label( 'username', 'Användarnamn', [ 'class' => 'placeholder' ] ) }}
				{{ Form::text( 'username', '',  [ 'autocorrect' => 'off', 'autocapitalize' => 'off', 'placeholder' => 'Användarnamn' ] ) }}
			</li>
			
			<li>
				{{ Form::label( 'password', 'Lösenord', [ 'class' => 'placeholder' ] ) }}
				{{ Form::password( 'password', '',  [ 'autocorrect' => 'off', 'autocapitalize' => 'off', 'placeholder' => 'Lösenord' ] ) }}
			</li>
			
			<li>
				{{ Form::submit( 'Logga in' ) }}
			</li>
		</ul>
	{{ Form::close() }}
</div>