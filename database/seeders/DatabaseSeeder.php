<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Airline;
use App\Models\Flight;
use App\Models\Airport;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
     
        // Airlines
        $airlines = [
            [
                'code' => 'AC',
                'name' => 'Air Canada',
            ],
			[
                'code' => 'F8',
                'name' => 'Flair Airlines',
            ],
        ];

        foreach ($airlines as $airline) {
            Airline::create($airline);
        }

        // Airports
        $airports = [
            [
                'code' => 'YUL',
                'city_code' => 'YMQ',
                'name' => 'Pierre Elliott Trudeau International',
                'city' => 'Montreal',
                'country_code' => 'CA',
                'latitude' => 45.457714,
                'longitude' => -73.749908,
                'timezone' => 'America/Montreal',
            ],
            [
                'code' => 'YVR',
                'city_code' => 'YVR',
                'name' => 'Vancouver International',
                'city' => 'Vancouver',
                'country_code' => 'CA',
                'latitude' => 49.194698,
                'longitude' => -123.179192,
                'timezone' => 'America/Vancouver',
            ]
			
        ];

        foreach ($airports as $airport) {
            Airport::create($airport);
        }

        // Flights
        $flights = [
            [
                'airline' => 'AC',
                'number' => '301',
                'departure_airport' => 'YUL',
                'departure_time' => '07:30',
                'arrival_airport' => 'YVR',
                'duration' => 330,
                'price' => '600.31',
            ],
            [
                'airline' => 'AC',
                'number' => '304',
                'departure_airport' => 'YVR',
                'departure_time' => '08:55',
                'arrival_airport' => 'YUL',
                'duration' => 277,
                'price' => '499.93',
            ],
			[
                'airline' => 'F8',
                'number' => '103',
                'departure_airport' => 'YUL',
                'departure_time' => '22:00',
                'arrival_airport' => 'YVR',
                'duration' => 330,
                'price' => '239.01',
            ],
            [
                'airline' => 'F8',
                'number' => '102',
                'departure_airport' => 'YVR',
                'departure_time' => '13:25',
                'arrival_airport' => 'YUL',
                'duration' => 270,
                'price' => '259.23',
            ],
        ];

        foreach ($flights as $flight) {
            Flight::create($flight);
        }
    }
}
