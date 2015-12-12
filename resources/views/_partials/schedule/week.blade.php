<li class="week">
	<h3>Vecka {{ date('W', strtotime($week->first()->start_time)) }}</h3>

	<ul class="list-days">
		<?php
			$days = $week->groupBy(function ($item) {
				return date('w', strtotime($item['start_time']));
			});
		?>

		@foreach ($days as $day)
			@include ('_partials.schedule.day', $day)
		@endforeach
	</ul>
</li>