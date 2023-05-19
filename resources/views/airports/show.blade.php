@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Airport Details</div>
				<div class="card-body">
					<h5 class="card-title">Airport Code: {{ $airport['code'] }}</h5>
					<p class="card-text">City Code: {{ $airport['city_code'] }}</p>
					<p class="card-text">Name: {{ $airport['name'] }}</p>
					<p class="card-text">City: {{ $airport['city'] }}</p>
					<p class="card-text">Country Code: {{ $airport['country_code'] }}</p>
					<p class="card-text">Latitude: {{ $airport['latitude'] }}</p>
					<p class="card-text">Longitude: {{ $airport['longitude'] }}</p>
					<p class="card-text">Timezone: {{ $airport['timezone'] }}</p>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
