@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Airport</h1>
		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
        <form method="POST" action="{{ route('airports.store') }}">
            @csrf

            <div class="form-group">
                <label for="code">Code:</label>
                <input type="text" id="code" name="code" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="city_code">City Code:</label>
                <input type="text" id="city_code" name="city_code" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="country_code">Country Code:</label>
                <input type="text" id="country_code" name="country_code" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="latitude">Latitude:</label>
                <input type="number" id="latitude" name="latitude" class="form-control" step="0.000001" required>
            </div>

            <div class="form-group">
                <label for="longitude">Longitude:</label>
                <input type="number" id="longitude" name="longitude" class="form-control" step="0.000001" required>
            </div>

            <div class="form-group">
                <label for="timezone">Timezone:</label>
                <input type="text" id="timezone" name="timezone" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
