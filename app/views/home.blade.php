@section( 'content' )

<h2>Våra kurser</h2>
<ul>
	@if ( $courses )
		@foreach ( $courses as $course )
			<li>{{ HTML::link( URL::to( '/schedule/' . $course->code ), $course->name . ' (' . $course->code . ')' ) }}</li>
		@endforeach
	@else
		<li>Det finns inga aktiva kurser.</li>
	@endif
</ul>

@stop