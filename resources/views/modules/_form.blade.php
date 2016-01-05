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

	<li class="calendar-type">
		{!! Form::label('type', trans('messages.calendar')) !!}
		{!! Form::select('type', ['google' => 'Google Calendar', 'ical' => 'iCal', 'ical-file' => 'iCal (fil)', 'webcal' => 'WebCal']) !!}

		<br />

		{!! Form::text('calendar') !!}

		<br />

		{!! Form::file('file') !!}
	</li>

	<li>
		{!! Form::label('courses', trans('messages.courses')) !!}
		{!! Form::courseCheckbox('courses', $module->courses->pluck('id')->all()) !!}
	</li>

	<li>
		{!! Form::submit($submitButtonText) !!}
	</li>
</ul>