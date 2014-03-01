@section( 'content' )

<h1>{{ $course->name }}</h1>

<aside class="filters if-js">
	@if ( $modules->count() > 0 )
		<ul id="modules" class="modules">
			@foreach ( $modules as $module )
				<li>
					<input type="checkbox" name="{{ $module->course->code }}_{{ $module->short_name }}" id="{{ $module->course->code }}_{{ $module->short_name }}" class="{{ $module->short_name }}" checked="checked" />
					<label for="{{ $module->course->code }}_{{ $module->short_name }}">{{ $module->name }}</label>
				</li>
			@endforeach
		</ul>
	@endif
	
	<input type="checkbox" name="hide-past" id="hide-past" />
	<label for="hide-past">Dölj passerade datum</label>
</aside>

@if ( $lessons->count() > 0 )
	<?php
		$week = 0;
		$day = 0;
	?>
	
	<ul class="list-weeks">
		@for ( $i = 0, $length = $lessons->count(); $i < $length; $i++ )
			<?php
				$lesson = $lessons[ $i ];
				$new_week = ( date( 'W', strtotime( $lesson->start_time ) ) != $week );
				$week = date( 'W', strtotime( $lesson->start_time ) );
				$new_day = ( $new_week || date( 'd', strtotime( $lesson->start_time ) ) != $day );
				$day = date( 'd', strtotime( $lesson->start_time ) );
			?>
			
			@if ( $new_week )
				<li class="week">
					<h3>Vecka {{ date( 'W', strtotime( $lesson->start_time ) ) }}</h3>
					<ul class="list-days">
			@endif
			
			@if ( $new_day )
				<li class="day{{ ( date( 'Y-m-d', strtotime( $lesson->start_time ) ) == date( 'Y-m-d' ) ? ' today' : '' ) }} {{ ( date( 'Y-m-d', strtotime( $lesson->start_time ) ) < date( 'Y-m-d' ) ? 'past' : '' ) }}">
					<h4>{{ date( 'Y-m-d', strtotime( $lesson->start_time ) ) }}, {{ date( 'l', strtotime( $lesson->start_time ) ) }}</h4>
					<div class="list-events">
			@endif
			
			@if ( ( $i + 1 != $length && $lesson->start_time == $lessons[ $i + 1 ]->start_time ) && ( $i > 0 && $lesson->start_time != $lessons[ $i - 1 ]->start_time ) )
				<div class="event-block">
			@endif
			
			<div class="event {{ $lesson->module->short_name }}">
				<span class="event-date">{{ date( 'H:i', strtotime( $lesson->start_time ) ) }} - {{ date( 'H:i', strtotime( $lesson->end_time ) ) }}</span>: 
				<span class="event-title">{{ $lesson->title }}</span>
				
				@if ( !empty( $lesson->location ) )
					<div class="event-location">{{ $lesson->location }}</div>
				@endif
				
				
				@if ( !empty( $lesson->description ) )
					<div class="event-location">{{ $lesson->description }}</div>
				@endif
			</div><!-- .event -->
			
			@if ( $i > 0 && $i + 1 != $length && $lesson->start_time == $lessons[ $i - 1 ]->start_time && $lesson->start_time != $lessons[ $i + 1 ]->start_time )
				</div><!-- .event-block -->
			@endif
			
			@if ( $i + 1 >= $length || $day != date( 'd', strtotime( $lessons[ $i + 1 ]->start_time ) ) )
				</div><!-- .list-events -->
				</li><!-- .day -->
			@endif
			
			@if ( $i + 1 >= $length || $week != date( 'W', strtotime( $lessons[ $i + 1 ]->start_time ) ) )
				</ul><!-- list-week -->
				</li><!-- .week -->
			@endif
		@endfor
	</ul>
@endif

@stop