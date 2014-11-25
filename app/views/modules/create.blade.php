@section( 'content' )

<h2>Skapa delkurs</h2>

@include ( '_partials.errors' )

{{ Form::open( [ 'route' => 'admin.modules.store', 'method' => 'POST' ] ) }}
	<ul>
		<li>
			{{ Form::label( 'name', 'Namn' ) }}
			{{ Form::text( 'name', '', [ 'placeholder' => 'Namn' ] ) }}
		</li>
		
		<li>
			{{ Form::label( 'start_date', 'Startdatum' ) }}
			{{ Form::text( 'start_date', '', [ 'placeholder' => 'Startdatum' ] ) }}
		</li>
		
		<li>
			{{ Form::label( 'end_date', 'Slutdatum' ) }}
			{{ Form::text( 'end_date', '', [ 'placeholder' => 'Slutdatum' ] ) }}
		</li>
		
		<li>
			{{ Form::label( 'calendar', 'Kalender-ID' ) }}
			{{ Form::text( 'calendar', '', [ 'placeholder' => 'Kalender-ID' ] ) }}
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