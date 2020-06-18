@extends('layouts.my_frame')
@section('content')

	<div class="container-fluid">
		<div class="container">
			<div class="container">
				<h1>{{$project->name}}</h1>
				<p>
					{!!$project->detail!!}
				</p>

			</div>
		</div>
	</div>

<script>
	$(function () {
		$(".project").addClass('active');
	});
</script>
@endsection
