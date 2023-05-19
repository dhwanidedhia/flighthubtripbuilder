## FlightHub Trip Builder
This is a PHP-based web service that allows users to search for and retrieve information about flights and trips. The API provides functionalities to search for one-way and round trips, retrieve airline and airport information, and perform CRUD operations on flight and trip data.

## Installation

To install and run the FlightHubTripBuilder project, follow these steps:

1. Clone the repository by running the following command in your terminal:
git clone https://github.com/dhwanidedhia/flighthubtripbuilder

2. Navigate to the project directory:
cd flighthubtripbuilder

3. Install the project dependencies using Composer:
composer install

4. Edit the /app/config/database.php file to add the necessary database connection information.

5. Run the database migrations to create the required tables:
php artisan migrate

6. Seed the database with sample data:
php artisan db:seed

7. Start the development server:
php artisan serve
You can now access the flighthubtripbuilder application at http://127.0.0.1:8000

## Usage
Once the API is up and running, you can make requests to the available endpoints to interact with the system. You can use tools like cURL or Postman to test the API. The API supports various operations such as searching for trips, retrieving flight details, and managing trip data.

## API Endpoints
The FlightHub Trip Builder API provides the following endpoints:

### GET /api/search: Search for trips based on the specified criteria.

Sample Requests and Responses
Search for Trips

Request:
### GET /api/search?origin=YUL&destination=YVR&trip_type=oneway
Response:
{
	"trips": [{
		"outbound": {
			"id": 3,
			"airline": "F8",
			"number": "103",
			"departure_airport": "YUL",
			"departure_time": "22:00:00",
			"arrival_airport": "YVR",
			"duration": 330,
			"price": "239.01",
			"trip_id": null,
			"created_at": "2023-05-19T07:24:53.000000Z",
			"updated_at": "2023-05-19T07:24:53.000000Z"
		}
	}]
}


Request:
### GET /api/search?origin=YUL&destination=YVR&trip_type=roundtrip
Response:
{
	"trips": [{
		"outbound": {
			"id": 3,
			"airline": "F8",
			"number": "103",
			"departure_airport": "YUL",
			"departure_time": "22:00:00",
			"arrival_airport": "YVR",
			"duration": 330,
			"price": "239.01",
			"trip_id": null,
			"created_at": "2023-05-19T07:24:53.000000Z",
			"updated_at": "2023-05-19T07:24:53.000000Z"
		},
		"inbound": {
			"id": 2,
			"airline": "AC",
			"number": "304",
			"departure_airport": "YVR",
			"departure_time": "08:55:00",
			"arrival_airport": "YUL",
			"duration": 277,
			"price": "499.93",
			"trip_id": null,
			"created_at": "2023-05-19T07:24:53.000000Z",
			"updated_at": "2023-05-19T07:24:53.000000Z"
		}
	}]
}


