@section( 'content' )

<h2>Redigera {{ $lesson->title }}</h2>

{{ Form::model( $lesson, [ 'route' => [ 'lessons.update', $lesson->id ], 'method' => 'PUT' ] ) }}
	<ul>
		<li>
			{{ Form::label( 'title', 'Titel' ) }}
			{{ Form::text( 'title' ) }}
		</li>
		
		<li>
			{{ Form::label( 'location', 'Plats' ) }}
			{{ Form::text( 'location' ) }}
		</li>
		
		<li>
			{{ Form::label( 'description', 'Beskrivning' ) }}
			{{ Form::textarea( 'description' ) }}
		</li>
		
		<li>
			{{ Form::label( 'start_time', 'Starttid' ) }}
			{{ Form::text( 'start_time' ) }}
		</li>
		
		<li>
			{{ Form::label( 'end_time', 'Sluttid' ) }}
			{{ Form::text( 'end_time' ) }}
		</li>
		
		<li>
			{{ Form::label( 'module_id', 'Del av delkurs' ) }}
			
			<?php
				$select = [];
				
				foreach ( $modules as $module ) {
					$select[ $module->id ] = $module->name;
				}
			?>
			
			{{ Form::select( 'module_id', $select, $lesson->module_id ); }}
		</li>
		
		<li>
			{{ Form::submit( 'Uppdatera' ) }}
		</li>
	</ul>
{{ Form::close() }}

@stop