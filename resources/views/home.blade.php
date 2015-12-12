@extends ('_layouts/default')

@section ( 'content' )

	<h2>{{ trans('messages.our-courses') }}</h2>

	<ul>
		@forelse ($courses as $course)
			<li>{!! link_to( '/schedule/' . $course->code, $course->name . ' (' . $course->code . ')' ) !!}</li>
		@empty
			<li>{{ trans('messages.no-active-courses') }}</li>
		@endforelse
	</ul>

@stop