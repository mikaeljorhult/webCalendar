@section( 'content' )

<h2>Redigera {{ $course->title }}</h2>

{{ Form::model( $course, [ 'route' => [ 'admin.course.update', $course->id ], 'method' => 'PUT' ] ) }}
	<ul>
		<li>
			{{ Form::label( 'name', 'Namn' ) }}
			{{ Form::text( 'name' ) }}
		</li>
		
		<li>
			{{ Form::label( 'code', 'Kurskod' ) }}
			{{ Form::text( 'code' ) }}
		</li>
		
		<li>
			{{ Form::label( 'start_date', 'Startdatum' ) }}
			{{ Form::text( 'start_date' ) }}
		</li>
		
		<li>
			{{ Form::label( 'end_date', 'Slutdatum' ) }}
			{{ Form::text( 'end_date' ) }}
		</li>
		
		<li>
			{{ Form::submit( 'Uppdatera' ) }}
		</li>
	</ul>
{{ Form::close() }}

@stop