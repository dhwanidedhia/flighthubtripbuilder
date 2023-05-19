@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Airline Details</div>
				<div class="card-body">
					<h5 class="card-title">Code Code: {{ $airline['code'] }}</h5>
					<p class="card-text">Name: {{ $airline['name'] }}</p>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
