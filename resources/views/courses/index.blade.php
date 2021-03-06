@extends ('_layouts/default')

@section ('content')

	<div class="page-header">
		<h1>
			{{ trans('messages.courses') }}
			{!! link_to_route('admin.courses.create', '+', [], ['class' => 'btn btn-secondary-outline btn-sm']) !!}
		</h1>
	</div>

	<table cellpadding="0" cellspacing="0" class="table table-hover">
		<thead>
			<tr>
				<th>{{ trans('messages.name') }}</th>
				<th>{{ trans('messages.course-code') }}</th>
				<th class="icon-column">&nbsp;</th>
				<th class="icon-column">&nbsp;</th>
			</tr>
		</thead>

		<tbody>
		@if ($courses)
			@foreach ($courses as $course)
				<tr>
					<td>{!! link_to_route('admin.courses.edit', $course->name, $course->id) !!}</td>
					<td>{{ $course->code }}</td>
					<td>{!! link_to_route('admin.courses.edit', trans('messages.edit'), $course->id, ['class' => 'icon-button icon-edit']) !!}</td>
					<td>
						{!! Form::open(['route' => ['admin.courses.destroy', $course->id], 'method' => 'DELETE']) !!}
						{!! Form::submit(trans('messages.delete'), ['class' => 'no-button icon-button icon-delete']) !!}
						{!! Form::close() !!}
					</td>
				</tr>
			@endforeach
		@else
			<tr>
				<td>{{ trans('messages.no-courses') }}</td>
			</tr>
		@endif
		</tbody>
	</table>

	<p>
		{!! link_to_route('admin.courses.create', trans('messages.create-new-course'), [], ['class' => 'btn btn-primary']) !!}
	</p>

	@include ('_partials.modal.confirm-delete')

@stop