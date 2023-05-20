@extends('layouts.app')

@section('content')
<div class="container">
	<h1>Edit Flight</h1>
	@if ($errors->any())
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif
	
	
	<form action="{{ route('flights.update', $flight->id) }}" method="POST">
		@csrf
		@method('PUT')
		
		<div class="form-group">
			<label for="airline">Airline:</label>
			<select name="airline" class="form-control" id="airline" required>
				<option value="">Select Airline</option>
				@foreach($airlines as $airline)
				<option value="{{$airline['code']}}" @if($airline['code'] ==$flight->airline) selected @endif >{{$airline['code']}} - {{$airline['name']}}</option>
				@endforeach
			</select>
		</div>
		
		<div class="form-group">
			<label for="number">Flight Number:</label>
			<input type="text" name="number" id="number" class="form-control" value="{{ $flight->number }}">
		</div>
		
		<div class="form-group">
			<label for="departure_airport">Departure Airport:</label>
			<select name="departure_airport" class="form-control" id="departure_airport" required>
				<option value="">Select Airport</option>
				@foreach($airports as $airport)
				<option value="{{$airport['code']}}" @if($airport['code'] ==$flight->departure_airport) selected @endif >{{$airport['code']}} - {{$airport['name']}}</option>
				@endforeach
			</select>
		
		</div>
		
		<div class="form-group">
			<label for="departure_time">Departure Time:</label>
			<input type="text" name="departure_time" id="departure_time" class="form-control" value="{{ $flight->departure_time }}">
		</div>
		
		<div class="form-group">
			<label for="arrival_airport">Arrival Airport:</label>
			<select name="arrival_airport" class="form-control" id="arrival_airport" required>
				<option value="">Select Airport</option>
				@foreach($airports as $airport)
				<option value="{{$airport['code']}}" @if($airport['code'] ==$flight->arrival_airport) selected @endif >{{$airport['code']}} - {{$airport['name']}}</option>
				@endforeach
			</select>
		</div>
		
		<div class="form-group">
			<label for="duration">Duration:</label>
			<input type="text" name="duration" id="duration" class="form-control" value="{{ $flight->duration }}">
		</div>
		
		<div class="form-group">
			<label for="price">Price:</label>
			<input type="text" name="price" id="price" class="form-control" value="{{ $flight->price }}">
		</div>
		
		<button type="submit" class="btn btn-primary">Update</button>
	</form>
	
</div>
@endsection
