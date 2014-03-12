@section( 'content' )

<h2>Redigera {{ $module->title }}</h2>

{{ Form::model( $module, [ 'route' => [ 'admin.modules.update', $module->id ], 'method' => 'PUT' ] ) }}
	<ul>
		<li>
			{{ Form::label( 'name', 'Namn' ) }}
			{{ Form::text( 'name' ) }}
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
			{{ Form::label( 'calendar', 'Adress till kalender' ) }}
			{{ Form::text( 'calendar' ) }}
		</li>
		
		<li>
			{{ Form::label( 'courses', 'Kurser' ) }}
			{{ Form::courseCheckbox( 'courses', $module->courses->lists( 'id' ) ) }}
		</li>
		
		<li>
			{{ Form::submit( 'Uppdatera' ) }}
		</li>
	</ul>
{{ Form::close() }}

@stop