<li class="day{{ $day->first()->start_time->isToday() ? ' today' : '' }} {{ $day->first()->start_time->isPast() ? 'past' : '' }}">
	<h4>{{ $day->first()->start_time->format('Y-m-d') }}, {{ trans('weekdays.' . $day->first()->start_time->format('l')) }}</h4>

	<div class="list-events">
		@foreach ($times as $time)
			<div class="event-block">
				@foreach ($time as $lesson)
					<div class="event module-{{ $sort_order[$lesson->module->id] }}">
						<span class="event-date">
							{{ $lesson->start_time->format('H:i') }} - {{ $lesson->end_time->format('H:i') }}
						</span>:

						<span class="event-title">{{ $lesson->title }}</span>

						@if (!empty($lesson->location))
							<div class="event-location">{{ $lesson->location }}</div>
						@endif

						@if (!empty($lesson->description))
							<div class="event-location">{{ $lesson->description }}</div>
						@endif
					</div>
				@endforeach
			</div>
		@endforeach
	</div>
</li>