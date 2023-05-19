<?php

namespace Tests\Feature;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchControllerTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;
    use WithoutMiddleware;
    use WithFaker;

    public function testSearch()
    {
        // Create a mock request object with the necessary input
        $request = \Illuminate\Http\Request::create('/search', 'POST', [
            'origin' => 'YUL',
            'destination' => 'YVR',
            'trip_type' => 'oneway',
            'sort_by' => 'cost',
            'filter_airline' => 'AC',
            'filter_duration' => 300,
            'filter_cost' => 500
        ]);

        // Make a request to the search endpoint
        $response = $this->app->call('App\Http\Controllers\TripController@search', ['request' => $request]);

        // Assert that the response is successful
        $response->assertStatus(200);

        // Assert that the response contains the expected JSON structure
        $response->assertJsonStructure([
            'trips',
            'total_distance'
        ]);

        // Assert that the response contains the expected data
        $responseData = $response->json();
        $this->assertArrayHasKey('trips', $responseData);
        $this->assertArrayHasKey('total_distance', $responseData);
    }
}
