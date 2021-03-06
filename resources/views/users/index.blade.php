@extends ('_layouts/default')

@section('content')

	<div class="page-header">
		<h1>
			{{ trans('messages.users') }}
			{!! link_to_route('admin.users.create', '+', [], ['class' => 'btn btn-secondary-outline btn-sm']) !!}
		</h1>
	</div>

	<table cellpadding="0" cellspacing="0" class="table table-hover">
		<thead>
		<tr>
			<th>{{ trans('messages.username') }}</th>
			<th>{{ trans('messages.email') }}</th>
			<th class="icon-column">&nbsp;</th>
			<th class="icon-column">&nbsp;</th>
		</tr>
		</thead>
		<tbody>
			@forelse ($users as $user)
				<tr>
					<td>{!! link_to_route('admin.users.edit', $user->username, $user->id) !!}</td>
					<td>{{ $user->email }}</td>
					<td>{!! link_to_route('admin.users.edit', trans('messages.edit'), $user->id, ['class' => 'icon-button icon-edit']) !!}</td>
					<td>
						@if (Auth::check() && $user->id != Auth::user()->id)
							{!! Form::open(['route' => ['admin.users.destroy', $user->id], 'method' => 'DELETE']) !!}
							{!! Form::submit(trans('messages.delete'), ['class' => 'no-button icon-button icon-delete']) !!}
							{!! Form::close() !!}
						@else
							&nbsp;
						@endif
					</td>
				</tr>
			@empty
				<tr>
					<td>{{ trans('messages.no-users') }}</td>
				</tr>
			@endforelse
		</tbody>
	</table>

	<p>
		{!! link_to_route('admin.users.create', trans('messages.create-new-user'), [], ['class' => 'btn btn-primary']) !!}
	</p>

	@include ('_partials.modal.confirm-delete')

@stop