# FlightHub Trip Builder
This is a PHP-based web service that allows users to search for and retrieve information about flights and trips. The API provides functionalities to search for one-way and round trips, retrieve airline and airport information, and perform CRUD operations on airline, airport and flight data.

# Prerequisites
PHP 7.4 or higher <br>
Composer <br>
Laravel 8.x <br>

# Installation

To install and run the FlightHubTripBuilder project, follow these steps: <br>

1. Clone the repository by running the following command in your terminal: <br>
git clone https://github.com/dhwanidedhia/flighthubtripbuilder

2. Navigate to the project directory: <br>
cd flighthubtripbuilder

3. Install the project dependencies using Composer: <br>
composer install

4. Copy the example environment file: cp .env.example .env

5. Generate an application key: php artisan key:generate

6. Configure the database connection in the .env file.
 
7. Run the database migrations to create the required tables: <br>
php artisan migrate

8. Seed the database with sample data: <br>
php artisan db:seed

7. Start the development server: <br>
php artisan serve <br>
The application will be accessible at http://localhost:8000

# Usage

## Trip Search <br>
The trip search feature allows users to search for flights based on their origin, destination, and trip type. Users can specify the origin airport, destination airport, and select whether it's a one-way trip or a round trip. <br>
<br>
![image](https://github.com/dhwanidedhia/flighthubtripbuilder/assets/16332681/bfa1cec7-0ace-4a0b-9860-3bbdc80a5bff)

### Search Form <br>
The search form contains the following fields:
<br>
1. **Origin:** Text input field where users can enter the origin airport code.
2. **Destination:** Text input field where users can enter the destination airport code.
3. **Trip Type:** Dropdown menu where users can select either "One Way" or "Round Trip".

**Search Button:** Button to submit the search form.

### Sort and Filter Results
Once the search form is submitted, the search results will be displayed along with sorting and filtering options. The sorting options allow users to sort the search results by cost or duration. The filtering options allow users to filter the results by airline, duration, and cost.

**Sort by**
1. **Cost:** Sorts the search results by the cost of the flights, from lowest to highest.
2. **Duration:** Sorts the search results by the duration of the flights, from shortest to longest.

**Filter**
1. **Filter by Airline**
Users can filter the search results by selecting a specific airline from the dropdown menu. Only flights from the selected airline will be displayed.

2. **Filter by Duration**
Users can filter the search results by selecting a maximum duration from the dropdown menu. Only flights with a duration less than or equal to the selected value will be displayed.

3. **Filter by Cost**
Users can filter the search results by selecting a maximum cost from the dropdown menu. Only flights with a cost less than or equal to the selected value will be displayed.

### Displaying Search Results
Search results are cached. Each flight will be listed outbound/inbound based on trip type with the following details:
Airline, Flight number, Departure airport, Departure time, Arrival airport, Duration, Price
Also total distance from origin to destination will be displayed

#### One Way Trip
![image](https://github.com/dhwanidedhia/flighthubtripbuilder/assets/16332681/ff011cce-7eeb-4a04-ab10-48b1eabf2dbc)

#### Round Trip
![image](https://github.com/dhwanidedhia/flighthubtripbuilder/assets/16332681/96b06452-ff55-4d9a-b334-b2da74793f0c)

## CRUD Operation <br>

**Airline CRUD Operations**
1. **Create:** Create a new airline by providing the airline name and code.
2. **Read:** View the list of all airlines and click on an airline to see its details.
3. **Update:** Edit the details of an airline and save the changes.
4. **Delete:** Delete an airline by clicking the delete button and confirming the action.

![image](https://github.com/dhwanidedhia/flighthubtripbuilder/assets/16332681/619ec20c-42fc-432f-a110-75cef095e53d)

**Airport CRUD Operations**
1. **Create:** Create a new airport by entering the airport code, city code, name, city, country code, latitude, longitude, and timezone.
2. **Read:** View the list of all airports and click on an airport to see its details.
3. **Update:** Edit the details of an airport and save the changes.
4. **Delete:** Delete an airport by clicking the delete button and confirming the action.

![image](https://github.com/dhwanidedhia/flighthubtripbuilder/assets/16332681/6cedbb21-cd73-4596-a06a-6f77cc894ab1)

**Flight CRUD Operations** <br>
1. **Create:** To create a new flight, navigate to the flight creation page and fill in the required details such as airline, flight number, departure airport, departure time, arrival airport, duration, and price. <br>
2. **Read:** To view a list of all flights, visit the flight listing page. Clicking on a specific flight will display its details. <br>
3. **Update:** Edit the details of a flight by navigating to the flight edit page. Make the necessary changes and save them. <br>
4. **Delete:** To delete a flight, click the delete button on the flight details page and confirm the action.

![image](https://github.com/dhwanidedhia/flighthubtripbuilder/assets/16332681/b6e4f090-33ec-45a1-b0e0-35153043ab47)


# API Endpoints
The FlightHub Trip Builder RESTFUL API provides the following endpoints:

#### GET /api/trips: Search for trips based on the specified criteria.

Sample Requests and Responses
Search for Trips

### One Way Trip
**Request:**  <br> 
GET /api/trips?origin=YUL&destination=YVR&trip_type=oneway&filter_airline=&filter_duration=&filter_cost=&sort_by=cost&per_page=20&page=1 
<br>

**Response:**

```json

{
  "trips": [
    {
      "outbound": {
        "id": 1,
        "airline": "AC",
        "number": "301",
        "departure_airport": "YUL",
        "departure_time": "07:30:00",
        "arrival_airport": "YVR",
        "duration": 330,
        "price": "600.31"
      }
    }
  ],
  "total_distance": "3,681.74"
}
```

### Round Trip <br>
**Request:** <br>
GET /api/trips?origin=YUL&destination=YVR&trip_type=roundtrip&filter_airline=&filter_duration=&filter_cost=&sort_by=cost&per_page=20&page=1 
<br>

**Response:** <br>

```json

{
  "trips": [
    {
      "outbound": {
        "id": 1,
        "airline": "AC",
        "number": "301",
        "departure_airport": "YUL",
        "departure_time": "07:30:00",
        "arrival_airport": "YVR",
        "duration": 330,
        "price": "600.31"
      },
      "inbound": {
        "id": 2,
        "airline": "AC",
        "number": "304",
        "departure_airport": "YVR",
        "departure_time": "08:55:00",
        "arrival_airport": "YUL",
        "duration": 277,
        "price": "499.93"
      }
    }
  ],
  "total_distance": "7,363.47"
}
```

# Testing
Tried implementing automated software tests using PHPUnit


