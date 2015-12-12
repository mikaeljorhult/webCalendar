<li class="week">
	<h3>{{ trans('messages.week') }} {{ $week->first()->start_time->format('W') }}</h3>

	<ul class="list-days">
		@foreach ($days as $day)
			@include ('_partials.schedule.day', $day)
		@endforeach
	</ul>
</li>