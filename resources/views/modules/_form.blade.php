<ul>
	<li>
		{!! Form::label('name', trans('messages.name')) !!}
		{!! Form::text('name') !!}
	</li>

	<li>
		{!! Form::label('start_date', trans('messages.start-date')) !!}
		{!! Form::input('date', 'start_date') !!}
	</li>

	<li>
		{!! Form::label('end_date', trans('messages.end-date')) !!}
		{!! Form::input('date', 'end_date') !!}
	</li>

	<li>
		{!! Form::label('calendar', trans('messages.calendar-id')) !!}
		{!! Form::text('calendar') !!}
	</li>

	<li>
		{!! Form::label('courses', trans('messages.courses')) !!}
		{!! Form::courseCheckbox('courses', $module->courses->lists('id')->all()) !!}
	</li>

	<li>
		{!! Form::submit($submitButtonText) !!}
	</li>
</ul>