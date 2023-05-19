$(document).ready(function() {
    $('#search-form').submit(function(e) {
        e.preventDefault();

        var origin = $('#origin').val();
        var destination = $('#destination').val();
        var tripType = $('#trip-type').val();

        // Make the API request through the proxy
        $.ajax({
            url: 'api/trips', // Proxy route defined in the Laravel API
            type: 'GET',
            data: {
                origin: origin,
                destination: destination,
                trip_type: tripType
            },
            success: function(response) {
                // Handle the API response and display the search results
                var trips = response.trips;
				
				var totalDistance = response.total_distance;
				
                // Display the search results on the page
                var resultsContainer = $('#search-results');
                resultsContainer.empty();
				if (trips.length > 0) {
					    // Create the table
					var tableElement = $('<table>').addClass('table table-bordered');

					// Create the table header
					if(tripType == 'oneway'){
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
						var outboundCell = $('<td>').text(outboundFlight.airline + ' Flight ' + outboundFlight.number);
						rowElement.append(outboundCell);

						// Add the inbound flight details if present
						if (inboundFlight) {
							var inboundCell = $('<td>').text(inboundFlight.airline + ' Flight ' + inboundFlight.number);
							rowElement.append(inboundCell);
						}
						
						
						tableBody.append(rowElement);
					});

					tableElement.append(tableBody);

					// Append the table to the results container
					resultsContainer.append(tableElement);
					// Display the total distance
                    var totalDistanceElement = $('<div>').addClass('total-distance').text('Total Distance for this Trip: ' + totalDistance + ' km');
                    resultsContainer.append(totalDistanceElement);
				}
				else {
                    var noResultsAlert = $('<div>').addClass('alert alert-warning').text('No trips found.');
                    resultsContainer.append(noResultsAlert);
                }
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