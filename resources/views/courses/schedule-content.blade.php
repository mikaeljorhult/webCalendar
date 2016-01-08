<div class="page-header">
	<h1>{{ $course->name }}</h1>
</div>

@include ('_partials.schedule.filters')

<ul class="list-weeks">
	@foreach ($weeks as $week)
		@include ('_partials.schedule.week', $week)
	@endforeach
</ul>