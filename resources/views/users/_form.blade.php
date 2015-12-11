<ul>
	<li>
		{!! Form::label('username', 'Användarnamn') !!}
		{!! Form::text('username', null, ['placeholder' => 'Användarnamn']) !!}
	</li>

	<li>
		{!! Form::label('password', 'Lösenord') !!}
		{!! Form::password('password', ['placeholder' => 'Lösenord']) !!}
	</li>

	<li>
		{!! Form::label('email', 'E-postadress') !!}
		{!! Form::text('email', null, ['placeholder' => 'E-postadress']) !!}
	</li>

	<li>
		{!! Form::submit($submitButtonText) !!}
	</li>
</ul>