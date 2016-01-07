<fieldset class="form-group">
	{!! Form::label('name', trans('messages.name')) !!}
	{!! Form::text('name', null, ['class' => 'form-control']) !!}
</fieldset>

<fieldset class="form-group">
	{!! Form::label('start_date', trans('messages.start-date')) !!}
	{!! Form::date('start_date', $module->start_date, ['class' => 'form-control']) !!}
</fieldset>

<fieldset class="form-group">
	{!! Form::label('end_date', trans('messages.end-date')) !!}
	{!! Form::date('end_date', $module->end_date, ['class' => 'form-control']) !!}
</fieldset>

<fieldset class="form-group calendar-type">
	{!! Form::label('type', trans('messages.calendar')) !!}
	{!! Form::select('type', ['google' => 'Google Calendar', 'ical' => 'iCal', 'ical-file' => 'iCal (fil)', 'webcal' => 'WebCal'], [], ['class' => 'form-control']) !!}

	<br />

	{!! Form::text('calendar', null, ['class' => 'form-control']) !!}

	<br />

	{!! Form::file('file', ['class' => 'form-control-file']) !!}
</fieldset>

<fieldset class="form-group">
	{!! Form::label('courses', trans('messages.courses')) !!}
	{!! Form::courseCheckbox('courses', $module->courses->pluck('id')->all()) !!}
</fieldset>

<fieldset class="form-group">
	{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
</fieldset>