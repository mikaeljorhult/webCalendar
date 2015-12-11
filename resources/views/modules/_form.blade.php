<ul>
	<li>
		{!! Form::label('name', 'Namn') !!}
		{!! Form::text('name') !!}
	</li>

	<li>
		{!! Form::label('start_date', 'Startdatum') !!}
		{!! Form::text('start_date') !!}
	</li>

	<li>
		{!! Form::label('end_date', 'Slutdatum') !!}
		{!! Form::text('end_date') !!}
	</li>

	<li>
		{!! Form::label('calendar', 'Kalender-ID') !!}
		{!! Form::text('calendar') !!}
	</li>

	<li>
		{!! Form::label('courses', 'Kurser') !!}
		{!! Form::courseCheckbox('courses', $module->courses->lists('id')->all()) !!}
	</li>

	<li>
		{!! Form::submit($submitButtonText) !!}
	</li>
</ul>