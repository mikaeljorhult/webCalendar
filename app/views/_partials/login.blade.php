<div id="login-form" class="login-form">
	@if ( Auth::check() )
		<h2>Inloggad som {{ Auth::user()->username }}</h2>
		<p>{{ HTML::link( 'logout', 'Logga ut' ) }}</p>
	@else
		{{ Form::open( [ 'url' => 'login', 'method' => 'post' ] ) }}
			{{ Form::token() }}
		
			<ul>
				<li>
					{{ Form::label( 'username', 'Användarnamn' ) }}
					{{ Form::text( 'username', '',  [ 'autocorrect' => 'off', 'autocapitalize' => 'off', 'placeholder' => 'Användarnamn' ] ) }}
				</li>
				
				<li>
					{{ Form::label( 'password', 'Lösenord', array( 'class' => 'placeholder' ) ) }}
					{{ Form::password( 'password', '',  [ 'autocorrect' => 'off', 'autocapitalize' => 'off', 'placeholder' => 'Lösenord' ] ) }}
				</li>
				
				<li>
					{{ Form::submit( 'Logga in' ) }}
				</li>
			</ul>
		{{ Form::close() }}
	@endif
</div>