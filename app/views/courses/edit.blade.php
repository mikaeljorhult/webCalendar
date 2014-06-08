@section( 'content' )

<h2>Redigera {{ $course->title }}</h2>

{{ Form::model( $course, [ 'route' => [ 'admin.courses.update', $course->id ], 'method' => 'PUT' ] ) }}
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
			{{ Form::label( 'modules', 'Delkurser' ) }}
			@if ( count( $course->modules ) > 0 )
				<ul class="sortable">
				@foreach ( $course->modules as $module )
					<li>
						<input type="hidden" name="modules[]" value="{{ $module->id }}" />
						{{ $module->name }}
					</li>
				@endforeach
				</ul>
			@endif
		</li>
		
		<li>
			{{ Form::submit( 'Uppdatera' ) }}
		</li>
	</ul>
{{ Form::close() }}

@stop