@section( 'content' )

<h2>Redigera {{ $module->title }}</h2>

{{ Form::model( $module, [ 'route' => [ 'admin.modules.update', $module->id ], 'method' => 'PUT' ] ) }}
	<ul>
		<li>
			{{ Form::label( 'name', 'Namn' ) }}
			{{ Form::text( 'name' ) }}
		</li>
		
		<li>
			{{ Form::label( 'short_name', 'Kort namn' ) }}
			{{ Form::text( 'short_name' ) }}
		</li>
		
		<li>
			{{ Form::label( 'calendar', 'Adress till kalender' ) }}
			{{ Form::text( 'calendar' ) }}
		</li>
		
		<li>
			{{ Form::label( 'course_id', 'Del av kurs' ) }}
			
			<?php
				$select = [];
				
				foreach ( $courses as $course ) {
					$select[ $course->id ] = $course->name;
				}
			?>
			
			{{ Form::select( 'course_id', $select, $module->course_id ); }}
		</li>
		
		<li>
			{{ Form::submit( 'Uppdatera' ) }}
		</li>
	</ul>
{{ Form::close() }}

@stop