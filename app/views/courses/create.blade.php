@section( 'content' )

<h2>Skapa kurs</h2>

{{ Form::open( [ 'route' => 'admin.courses.store', 'method' => 'POST' ] ) }}
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
			{{ Form::submit( 'Skapa kurs' ) }}
		</li>
	</ul>
{{ Form::close() }}

@stop