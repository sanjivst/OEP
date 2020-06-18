@extends('layouts.my_frame')
@section('content')

	<div class="container-fluid">
		<div class="container">
			<div class="container">
				<h1>{{$feedback->title}}</h1>
				<p>
					{!!$feedback->description!!}
				</p>

			</div>
		</div>
	</div>

<script>
	$(function () {
		$(".feedback").addClass('active');
	});
</script>
@endsection
