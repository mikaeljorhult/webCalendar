<ul>
	<li>
		{!! Form::label('name', trans('messages.name')) !!}
		{!! Form::text('name') !!}
	</li>

	<li>
		{!! Form::label('start_date', trans('messages.start-date')) !!}
		{!! Form::date('start_date', $module->start_date) !!}
	</li>

	<li>
		{!! Form::label('end_date', trans('messages.end-date')) !!}
		{!! Form::date('end_date', $module->end_date) !!}
	</li>

	<li>
		{!! Form::label('calendar', trans('messages.calendar-id')) !!}
		{!! Form::text('calendar') !!}
	</li>

	<li>
		{!! Form::label('courses', trans('messages.courses')) !!}
		{!! Form::courseCheckbox('courses', $module->courses->pluck('id')->all()) !!}
	</li>

	<li>
		{!! Form::submit($submitButtonText) !!}
	</li>
</ul>