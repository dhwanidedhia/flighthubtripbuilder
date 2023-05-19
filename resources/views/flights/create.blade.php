@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Create Flight</h1>
	@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
    <form action="{{ route('flights.store') }}" method="POST">
        @csrf
        <!-- Flight form fields -->
        <div class="form-group">
            <label for="airline">Airline</label>
            <input type="text" name="airline" id="airline" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="number">Flight Number</label>
            <input type="text" name="number" id="number" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="departure_airport">Departure Airport</label>
            <input type="text" name="departure_airport" id="departure_airport" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="departure_time">Departure Time</label>
            <input type="text" name="departure_time" id="departure_time" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="arrival_airport">Arrival Airport</label>
            <input type="text" name="arrival_airport" id="arrival_airport" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="duration">Duration</label>
            <input type="text" name="duration" id="duration" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" id="price" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Flight</button>
    </form>
</div>
@endsection
