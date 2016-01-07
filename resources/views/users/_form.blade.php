<fieldset class="form-group">
	{!! Form::label('username', trans('messages.username')) !!}
	{!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => trans('messages.username')]) !!}
</fieldset>

<fieldset class="form-group">
	{!! Form::label('password', trans('messages.password')) !!}
	{!! Form::password('password', ['class' => 'form-control', 'placeholder' => trans('messages.password')]) !!}
</fieldset>

<fieldset class="form-group">
	{!! Form::label('email', trans('messages.email')) !!}
	{!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => trans('messages.email')]) !!}
</fieldset>

<fieldset class="form-group">
	{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
</fieldset>