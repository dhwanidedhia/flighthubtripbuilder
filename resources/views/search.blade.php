<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Trip Search</title>
    <!-- Add your CSS stylesheets -->
	<link rel="stylesheet" href="{{ asset('css/search.css') }}">
	<!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
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

        <div id="search-results">
            <!-- Display search results here -->
        </div>
    </div>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="{{ asset('js/search.js') }}"></script>
</body>
</html>