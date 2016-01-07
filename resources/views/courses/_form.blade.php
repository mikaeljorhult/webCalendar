<fieldset class="form-group">
	{!! Form::label('name', trans('messages.name')) !!}
	{!! Form::text('name', null, ['class' => 'form-control']) !!}
</fieldset>

<fieldset class="form-group">
	{!! Form::label('code', trans('messages.course-code')) !!}
	{!! Form::text('code', null, ['class' => 'form-control']) !!}
</fieldset>

@if (count($course->modules) > 0)
	<fieldset class="form-group">
		{!! Form::label('modules', trans('messages.modules')) !!}

		<ul id="modules-list" class="sortable">
			@foreach ($course->modules as $module)
				<li>
					<input type="hidden" name="modules[]" value="{{ $module->id }}" />
					{{ $module->name }}
				</li>
			@endforeach
		</ul>
	</fieldset>
@endif

<fieldset class="form-group">
	{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
</fieldset>