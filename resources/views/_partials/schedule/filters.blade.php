<aside class="filters if-js">
	@if ($modules->count() > 0)
		<ul id="modules" class="modules">
			@foreach ($modules as $module)
				<li>
					<input type="checkbox" name="{{ $course->code }}_module-{{ $module->pivot->sort_order }}"
						   id="{{ $course->code }}_module-{{ $module->pivot->sort_order }}"
						   class="module-{{ $module->pivot->sort_order }}" checked="checked" />
					<label
						for="{{ $course->code }}_module-{{ $module->pivot->sort_order }}">{{ $module->name }}</label>
				</li>
			@endforeach
		</ul>
	@endif

	<input type="checkbox" name="hide-past" id="hide-past" />
	<label for="hide-past">Dölj passerade datum</label>
</aside>