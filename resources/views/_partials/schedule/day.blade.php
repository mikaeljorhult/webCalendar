<li class="day{{ (date('Y-m-d', strtotime($day->first()->start_time)) == date('Y-m-d') ? ' today' : '') }} {{ (date('Y-m-d', strtotime($day->first()->start_time)) < date('Y-m-d') ? 'past' : '') }}">
	<h4>{{ date('Y-m-d', strtotime($day->first()->start_time)) }}, {{ trans('weekdays.' . date('l', strtotime($day->first()->start_time))) }}</h4>

	<div class="list-events">
		<?php
			$times = $day->groupBy(function ($item) {
				return date('Hi', strtotime($item['start_time']));
			});
		?>

		@foreach ($times as $time)
			<div class="event-block">
				@foreach ($time as $lesson)
					@include ('_partials.schedule.lesson', $lesson)
				@endforeach
			</div>
		@endforeach
	</div>
</li>