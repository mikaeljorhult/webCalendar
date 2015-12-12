<div class="event module-{{ $sort_order[$lesson->module->id] }}">
	<span class="event-date">
		{{ date('H:i', strtotime($lesson->start_time)) }} - {{ date('H:i', strtotime($lesson->end_time)) }}
	</span>:

	<span class="event-title">{{ $lesson->title }}</span>

	@if (!empty($lesson->location))
		<div class="event-location">{{ $lesson->location }}</div>
	@endif


	@if (!empty($lesson->description))
		<div class="event-location">{{ $lesson->description }}</div>
	@endif
</div>