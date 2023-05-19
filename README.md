## Installation

To install and run the FlightHubTripBuilder project, follow these steps:

1. Clone the repository by running the following command in your terminal:
git clone https://github.com/dhwanidedhia/flighthubtripbuilder

2. Navigate to the project directory:
cd flighthubtripbuilder

3.Install the project dependencies using Composer:
composer install

4. Edit the /app/config/database.php file to add the necessary database connection information.

5. Run the database migrations to create the required tables:
php artisan migrate

6. Seed the database with sample data:
php artisan db:seed

7. Start the development server:
php artisan serve
You can now access the flighthubtripbuilder application at http://127.0.0.1:8000


