@extends ('_layouts/default')

@section ( 'content' )

	<h2>Våra kurser</h2>

	<ul>
		@forelse ($courses as $course)
			<li>{!! link_to( '/schedule/' . $course->code, $course->name . ' (' . $course->code . ')' ) !!}</li>
		@empty
			<li>Det finns inga aktiva kurser.</li>
		@endforelse
	</ul>

@stop