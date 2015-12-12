<ul>
	<li>
		{!! Form::label('username', trans('messages.username')) !!}
		{!! Form::text('username', null, ['placeholder' => trans('messages.username')]) !!}
	</li>

	<li>
		{!! Form::label('password', trans('messages.password')) !!}
		{!! Form::password('password', ['placeholder' => trans('messages.password')]) !!}
	</li>

	<li>
		{!! Form::label('email', trans('messages.email')) !!}
		{!! Form::text('email', null, ['placeholder' => trans('messages.email')]) !!}
	</li>

	<li>
		{!! Form::submit($submitButtonText) !!}
	</li>
</ul>