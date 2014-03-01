@section( 'content' )

<h2>Skapa lektion</h2>

{{ Form::open( array( 'route' => 'lessons.store', 'method' => 'POST' ) ) }}
	<ul>
		<li>
			{{ Form::label( 'title', 'Titel' ) }}
			{{ Form::text( 'title', '', array( 'placeholder' => 'Titel' ) ) }}
		</li>
		
		<li>
			{{ Form::label( 'location', 'Plats' ) }}
			{{ Form::text( 'location', '', array( 'placeholder' => 'Plats' ) ) }}
		</li>
		
		<li>
			{{ Form::label( 'description', 'Beskrivning' ) }}
			{{ Form::textarea( 'description', '', array( 'placeholder' => 'Beskrivning' ) ) }}
		</li>
		
		<li>
			{{ Form::label( 'start_time', 'Starttid' ) }}
			{{ Form::text( 'start_time', '', array( 'placeholder' => 'Starttid' ) ) }}
		</li>
		
		<li>
			{{ Form::label( 'end_time', 'Sluttid' ) }}
			{{ Form::text( 'end_time', '', array( 'placeholder' => 'Sluttid' ) ) }}
		</li>
		
		<li>
			{{ Form::label( 'module_id', 'Del av delkurs' ) }}
			
			<?php
				$select = [];
				
				foreach ( $modules as $module ) {
					$select[ $module->id ] = $module->name;
				}
			?>
			
			{{ Form::select( 'module_id', $select ); }}
		</li>
		
		<li>
			{{ Form::submit( 'Skapa lektion' ) }}
		</li>
	</ul>
{{ Form::close() }}

@stop