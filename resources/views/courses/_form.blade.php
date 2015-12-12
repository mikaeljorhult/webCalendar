<ul>
	<li>
		{!! Form::label('name', trans('messages.name')) !!}
		{!! Form::text('name') !!}
	</li>

	<li>
		{!! Form::label('code', trans('messages.course-code')) !!}
		{!! Form::text('code') !!}
	</li>

	<li>
		{!! Form::label('modules', trans('messages.modules')) !!}

		@if (count($course->modules) > 0)
			<ul id="modules-list" class="sortable">
				@foreach ($course->modules as $module)
					<li>
						<input type="hidden" name="modules[]" value="{{ $module->id }}" />
						{{ $module->name }}
					</li>
				@endforeach
			</ul>
		@endif
	</li>

	<li>
		{!! Form::submit($submitButtonText) !!}
	</li>
</ul>