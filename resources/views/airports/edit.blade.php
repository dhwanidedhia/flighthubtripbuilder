@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Airport</h1>
		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
        <form method="POST" action="{{ route('airports.update', $airport['id']) }}">
            @csrf
            @method('PUT')

            <!-- Add your form fields here for editing an existing airport -->
            <div class="form-group">
                <label for="code">Code:</label>
                <input type="text" id="code" name="code" class="form-control" value="{{ $airport['code'] }}" required>
            </div>

            <div class="form-group">
                <label for="city_code">City Code:</label>
                <input type="text" id="city_code" name="city_code" class="form-control" value="{{ $airport['city_code'] }}" required>
            </div>

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $airport['name'] }}" required>
            </div>

            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" class="form-control" value="{{ $airport['city'] }}" required>
            </div>

            <div class="form-group">
                <label for="country_code">Country Code:</label>
                <input type="text" id="country_code" name="country_code" class="form-control" value="{{ $airport['country_code'] }}" required>
            </div>

            <div class="form-group">
                <label for="latitude">Latitude:</label>
                <input type="number" id="latitude" name="latitude" class="form-control" value="{{ $airport['latitude'] }}" step="0.000001" required>
            </div>

            <div class="form-group">
                <label for="longitude">Longitude:</label>
                <input type="number" id="longitude" name="longitude" class="form-control" value="{{ $airport['longitude'] }}" step="0.000001" required>
            </div>

            <div class="form-group">
                <label for="timezone">Timezone:</label>
                <input type="text" id="timezone" name="timezone" class="form-control" value="{{ $airport['timezone'] }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
