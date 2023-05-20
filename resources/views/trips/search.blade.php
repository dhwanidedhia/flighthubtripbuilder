@extends('layouts.app')

@section('content')

<div class="container">
	<h1>Trip Search</h1>
	<form id="search-form">
		<div class="form-group">
			<label for="origin">Origin:</label>
			<input type="text" value="YUL" class="form-control" name="origin" id="origin" >
		</div>
		<div class="form-group">
			<label for="destination">Destination:</label>
			<input type="text" value="YVR" class="form-control" name="destination" id="destination" >
		</div>
		<div class="form-group">
			<label for="trip-type">Trip Type:</label>
			<select class="form-control" name="trip_type" id="trip-type">
				<option value="oneway">One Way</option>
				<option value="roundtrip">Round Trip</option>
			</select>
		</div>
		<button type="submit" class="btn btn-primary">Search</button>
	</form>
	
	<div id="sort-filter-results" class="row mt-4" style="display:none">
		
		<div class="col-md-4">
			<label>Sort by:</label>
			<div class="form-group">
				<select name="sort_by" class="form-control"  id="sort_by" onchange="applyFilters()">
					<option value="">Select</option>
					<option value="cost" selected>Cost</option>
					<option value="duration">Duration</option>
				</select>
			</div>
		</div>
		
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						
						<label>Filter by Airline:</label>
						<select name="filter_airline" class="form-control" id="filter_airline" onchange="applyFilters()">
							<option value="">Select Airline</option>
							@foreach($airlines as $airline)
							<option value="{{$airline['code']}}">{{$airline['code']}} - {{$airline['name']}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Filter by Duration:</label>
						<select name="filter_duration" class="form-control" id="filter_duration" onchange="applyFilters()">
							<option value="">Select Duration</option>
							@for ($i = 200; $i <= 1200; $i += 200)
							<option value="{{ $i }}">less than {{ $i }}</option>
							@endfor
							
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Filter by Cost:</label>
						<select name="filter_cost" class="form-control" id="filter_cost" onchange="applyFilters()">
							<option value="">Select Cost</option>
							@for ($j = 200; $j <= 1200; $j += 200)
							<option value="{{ $j }}">less than {{ $j }}</option>
							@endfor
							
							
						</select>
					</div>
				</div>
			</div>
		</div>
		</div>
		<div id="search-results" class="row">
			
			<!-- Displaying search results here -->
		</div>
		
		<div id="total-distance" class="row"></div>
		
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="{{ asset('js/search.js') }}"></script>
@endsection
