@section( 'content' )

<h2>Skapa delkurs</h2>

{{ Form::open( [ 'route' => 'admin.modules.store', 'method' => 'POST' ] ) }}
	<ul>
		<li>
			{{ Form::label( 'name', 'Namn' ) }}
			{{ Form::text( 'name', '', [ 'placeholder' => 'Namn' ] ) }}
		</li>
		
		<li>
			{{ Form::label( 'calendar', 'Adress till kalender' ) }}
			{{ Form::text( 'calendar', '', [ 'placeholder' => 'Adress till kalender' ] ) }}
		</li>
		
		<li>
			{{ Form::label( 'courses', 'Kurser' ) }}
			{{ Form::courseCheckbox( 'courses' ) }}
		</li>
		
		<li>
			{{ Form::submit( 'Skapa delkurs' ) }}
		</li>
	</ul>
{{ Form::close() }}

@stop