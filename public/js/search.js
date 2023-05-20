$(document).ready(function() {
    $('#search-form').submit(function(e) {
        e.preventDefault();

        var origin = $('#origin').val();
        var destination = $('#destination').val();
        var tripType = $('#trip-type').val();

        $.ajax({
            url: 'api/trips',
            type: 'GET',
            data: {
                origin: origin,
                destination: destination,
                trip_type: tripType,
				filter_airline: $('#filter_airline').val(),
				filter_duration: $('#filter_duration').val(),
				filter_cost: $('#filter_cost').val(),
				sort_by: $('#sort_by').val()
            },
            success: function(response) {
				$('#sort-filter-results').show();
                // Handle the API response and display the search results
                var trips = response.trips;
				
				displayTrips(trips);
				
				var totalDistance = response.total_distance;
				
                // Display the search results on the page
				$('#total-distance').html("<b>Total Distance: </b>"+totalDistance+" KM");
               
            },
            error: function(xhr, status, error) {
                if (xhr.status === 400) {
                    var errors = xhr.responseJSON.errors;
                    // Display validation errors to the user
                    var errorContainer = $('#search-results');
                    errorContainer.empty();
                    
                    var alertDiv = $('<div>').addClass('alert alert-danger');
                    var alertHeading = $('<h4>').addClass('alert-heading').text('Please check below errors');
                    var errorList = $('<ul>').addClass('mb-0');
                    
                    Object.keys(errors).forEach(function(field) {
                        var errorItem = $('<li>').text(errors[field][0]);
                        errorList.append(errorItem);
                    });
                    
                    alertDiv.append(alertHeading);
                    alertDiv.append(errorList);
                    errorContainer.append(alertDiv);
                } else {
                    console.log('API request failed:', error);
                }
            }
        });
    });

});

	
	
function displayTrips(trips) {
	var resultsContainer = $('#search-results');
	resultsContainer.empty();

	if (trips.length > 0) {
		// Create the table and its header
		var tableElement = $('<table>').addClass('table table-bordered');
		
		if($('#trip-type').val() == 'oneway'){
			var tableHeader = $('<thead>').append(
				$('<tr>').append(
					$('<th>').text('Outbound Flight')
				)
			);
		}else{
			var tableHeader = $('<thead>').append(
				$('<tr>').append(
					$('<th>').text('Outbound Flight'),
					$('<th>').text('Inbound Flight')
				)
			);
		}
		
		tableElement.append(tableHeader);

		// Create the table body
		var tableBody = $('<tbody>');
		trips.forEach(function(trip) {
			var outboundFlight = trip.outbound;
			var inboundFlight = trip.inbound;

			// Create a row for each trip
			var rowElement = $('<tr>');

			// Add the outbound flight details
			var outboundCell = $('<td>').html('Airline: ' + outboundFlight.airline + '<br>Flight: ' + outboundFlight.number + '<br>Cost: ' + outboundFlight.price + '<br>Duration: ' + outboundFlight.duration+ '<br>Departure Time: ' + outboundFlight.departure_time);
			rowElement.append(outboundCell);

			// Add the inbound flight details if present
			if (inboundFlight) {
				var inboundCell = $('<td>').html('Airline: ' + inboundFlight.airline + '<br>Flight: ' + inboundFlight.number + '<br>Cost: ' + inboundFlight.price + '<br>Duration: ' + inboundFlight.duration+ '<br>Departure Time: ' + inboundFlight.departure_time);
				rowElement.append(inboundCell);
			}

			tableBody.append(rowElement);
		});

		tableElement.append(tableBody);

		// Append the table to the results container
		resultsContainer.append(tableElement);
	}
	else {
		var noResultsAlert = $('<div>').addClass('alert alert-warning').text('No trips found.');
		resultsContainer.append(noResultsAlert);
	}
}

function applyFilters() {
	// Retrieve the selected filter and sort criteria
	var filterAirline = $('select[name="filter_airline"]').val();
	var filterDuration = $('select[name="filter_duration"]').val();
	var filterCost = $('select[name="filter_cost"]').val();
	var sortBy = $('select[name="sort_by"]').val();

	$.ajax({
		url: 'api/trips', 
		type: 'GET',
		data: {
			origin: $('#origin').val(),
			destination: $('#destination').val(),
			trip_type: $('#trip-type').val(),
			filter_airline: filterAirline,
			filter_duration: filterDuration,
			filter_cost: filterCost,
			sort_by: sortBy
		},
		success: function(response) {
			// Handle the API response and display the search results
			var trips = response.trips;

			displayTrips(trips);
		},
		error: function(xhr, status, error) {
			// Handle the error case
			console.log('API request failed:', error);
		}
	});
}