<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Airport;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;

class TripController extends Controller
{
  
	/**
     * Search for matching trips based on the provided criteria.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
	public function search(Request $request)
    {
		//echo "<pre>";print_r($request->all());die;
		// Validate the search criteria
		$validator = \Validator::make($request->all(), [
			'origin' => 'required|string|exists:airports,code',
			'destination' => 'required|string|exists:airports,code|different:origin',
			'trip_type' => 'nullable|string|in:oneway,roundtrip',
		]);

		// Return validation errors if the criteria are invalid
		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()], 400);
		}
		
		// Get the search criteria from the request
		$origin = $request->input('origin');
		$destination = $request->input('destination');
		$tripType = $request->input('trip_type', 'oneway'); // Default to oneway if not provided
		$sortBy = $request->input('sort_by'); // Sorting criteria
		$filterAirline = $request->input('filter_airline'); // Airline filter
		$filterDuration = $request->input('filter_duration'); // Duration filter
		$filterCost = $request->input('filter_cost'); // Cost filter
		
		
		// Define a cache key based on the search criteria
		$cacheKey = "search:{$origin}:{$destination}:{$tripType}";

		// Check if the search results are cached
		if (Cache::has($cacheKey)) {
			// Retrieve the cached results
			$trips = Cache::get($cacheKey);
		} else {
			// Perform the search logic based on the criteria and trip type
			if ($tripType === 'roundtrip') {
				$trips = $this->searchTrips($origin, $destination, true);
			} else {
				$trips = $this->searchTrips($origin, $destination, false);
			}
			// Cache the search results for future use (cache for 1 hour)
			Cache::put($cacheKey, $trips, 60);
		}
		
		$trips = collect($trips);
		
		// Apply filtering
		//Filter by Airlines
		if ($filterAirline) {
			$trips = $trips->filter(function ($trip) use ($filterAirline) {
				$outboundFlight = $trip['outbound'];
				$inboundFlight = isset($trip['inbound']) ? $trip['inbound'] : null;

				// Check if either the outbound or inbound flight matches the filter airline
				$outboundMatch = $outboundFlight->airline === $filterAirline;
				$inboundMatch = $inboundFlight && $inboundFlight->airline === $filterAirline;

				return $outboundMatch || $inboundMatch;
			});
		}
		
		//Filter by Duration
		$trips = $trips->values()->all();
		if ($filterDuration) {
			$trips = array_filter($trips, function ($trip) use ($filterDuration) {
				$outboundDuration = $trip['outbound']['duration'];
				$inboundDuration = isset($trip['inbound']) ? $trip['inbound']['duration'] : 0;
				$totalDuration = $outboundDuration + $inboundDuration;
				return $totalDuration <= $filterDuration;
			});
		}
		
		//Filter by Cost
		if ($filterCost) {
			$trips = array_filter($trips, function ($trip) use ($filterCost) {
				$outboundPrice = $trip['outbound']['price'];
				$inboundPrice = isset($trip['inbound']) ? $trip['inbound']['price'] : 0;
				$totalCost = $outboundPrice + $inboundPrice;
				return $totalCost <= $filterCost;
			});
		}
		
		
		$trips = collect($trips);
		
		//Apply Sorting 
		if ($sortBy === 'cost') {
			//Sort by cost
			$trips = $trips->sortBy(function ($trip) {
				return $trip['outbound']->price + (isset($trip['inbound']) ? $trip['inbound']->price : 0);
			});
		} elseif ($sortBy === 'duration') {
			//Sort by duration
			$trips = $trips->sortBy(function ($trip) {
				return $trip['outbound']->duration + (isset($trip['inbound']) ? $trip['inbound']->duration : 0);
			});
		}
		
		$trips = $trips->values()->all();

		//Pagination
		$trips = collect($trips);
		// Paginate the trip results
		$perPage = $request->input('per_page', 20); // Number of trips per page (default: 10)
		$currentPage = $request->input('page', 1); // Current page (default: 1)
		$paginatedTrips = new LengthAwarePaginator(
			$trips->forPage($currentPage, $perPage),
			$trips->count(),
			$perPage,
			$currentPage,
			['path' => $request->url(), 'query' => $request->query()]
		);

		$trips = $paginatedTrips;
		
		$trips = $trips->values()->all();
		
		//Calculate distance
		if ($tripType === 'roundtrip') {
			$total_distance = $this->calculateTotalDistance($origin, $destination, true);
		}else{
			$total_distance = $this->calculateTotalDistance($origin, $destination, false);
		}
		
		// Return the matching trips as a JSON response
		return response()->json(['trips' => $trips,'total_distance'=>$total_distance], 201);

    }
	
	/**
	 * Perform the search for trips based on the origin, destination, and trip type.
	 *
	 * @param  string  $origin
	 * @param  string  $destination
	 * @param  bool  $roundtrip
	 * @return array
	 */
	private function searchTrips($origin, $destination, $roundtrip = false)
	{
		// Get the airports based on the origin and destination codes
		$originAirport = Airport::where('code', $origin)->first();
		$destinationAirport = Airport::where('code', $destination)->first();
		
		
		// Query the flights data to find the matching trips
		if($roundtrip == true) {
			// Search for roundtrip flights
			$outboundFlights = $originAirport->departures()
				->where('arrival_airport', $destination)
				->get();
			
			
			$inboundFlights = $destinationAirport->departures()
				->where('arrival_airport', $origin)
				->get();
			
			// Combine outbound and inbound flights to create roundtrip trips
			$trips = [];
			foreach ($outboundFlights as $outboundFlight) {
				foreach ($inboundFlights as $inboundFlight) {
					$trip = [
						'outbound' => $outboundFlight,
						'inbound' => $inboundFlight
					];
					
					$trips[] = $trip;
				}
			}
			
		}
		else {
			// Search for oneway flights
			$flights = $originAirport->departures()
				->where('arrival_airport', $destination)
				->get();
			
			// Create one-way trips from the found flights
			$trips = $flights->map(function ($flight) {
				return [
					'outbound' => $flight
				];
			});
		} 
		
		// Return the matching trips as an array or a collection
		return $trips;
	}
	
	/**
	 * Calculate the total distance traveled in the trips.
	 *
	 * @param  array  $trips
	 * @return int
	 */
	private function calculateTotalDistance($origin, $destination, $roundtrip = false)
	{
		// Get the airports based on the origin and destination codes
		$originAirport = Airport::where('code', $origin)->first();
		$destinationAirport = Airport::where('code', $destination)->first();
		
		$totalDistance = 0;

		$inboundDistance = 0;
		
		$outboundDistance = $this->calculateDistance($originAirport->latitude, $originAirport->longitude, $destinationAirport->latitude, $destinationAirport->longitude);
		
		//check for round trip
		if($roundtrip == true) {
			
			$inboundDistance = $this->calculateDistance($destinationAirport->latitude, $destinationAirport->longitude,$originAirport->latitude, $originAirport->longitude);
		}
		
		
		$totalDistance = $outboundDistance + $inboundDistance;
		
		return number_format($totalDistance,2);
	}
	
	/**
	 * Calculate the distance between two points on Earth using the Haversine formula.
	 *
	 * @param float $lat1 Latitude of the first point.
	 * @param float $lon1 Longitude of the first point.
	 * @param float $lat2 Latitude of the second point.
	 * @param float $lon2 Longitude of the second point.
	 * @return float The distance between the two points in kilometers.
	*/
	private function calculateDistance($lat1, $lon1, $lat2, $lon2)
	{
		// Earth radius in kilometers
		$earthRadius = 6371;

		// Convert latitude and longitude from degrees to radians
		$dLat = deg2rad($lat2 - $lat1);
		$dLon = deg2rad($lon2 - $lon1);

		// Apply Haversine formula
		$a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
		$c = 2 * atan2(sqrt($a), sqrt(1 - $a));

		// Calculate the distance
		$distance = $earthRadius * $c;

		return $distance;
	}
}
