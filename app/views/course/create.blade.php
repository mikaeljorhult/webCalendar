@section( 'content' )

<h2>Skapa kurs</h2>

{{ Form::open( [ 'route' => 'admin.course.store', 'method' => 'POST' ] ) }}
	<ul>
		<li>
			{{ Form::label( 'name', 'Namn' ) }}
			{{ Form::text( 'name', '', [ 'placeholder' => 'Namn' ] ) }}
		</li>
		
		<li>
			{{ Form::label( 'code', 'Kurskod' ) }}
			{{ Form::text( 'code', '', [ 'placeholder' => 'Kurskod' ] ) }}
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
			{{ Form::submit( 'Skapa kurs' ) }}
		</li>
	</ul>
{{ Form::close() }}

@stop