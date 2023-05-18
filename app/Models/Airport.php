<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;

	protected $fillable = ['code', 'city_code', 'name', 'city', 'country_code', 'latitude', 'longitude', 'timezone'];
	
	 /**
     * Get the departures of the airport.
     */
    public function departures()
    {
        return $this->hasMany(Flight::class, 'departure_airport', 'code');
    }

    /**
     * Get the arrivals of the airport.
     */
    public function arrivals()
    {
        return $this->hasMany(Flight::class, 'arrival_airport', 'code');
    }
}
