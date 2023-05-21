<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;
	
	protected $fillable = ['airline', 'number', 'departure_airport', 'departure_time', 'arrival_airport', 'duration', 'price'];
	
	/**
     * Get the airline of the flight.
     */
    public function airline()
    {
        return $this->belongsTo(Airline::class, 'airline', 'code');
    }

    /**
     * Get the departure airport of the flight.
     */
    public function departureAirport()
    {
        return $this->belongsTo(Airport::class, 'departure_airport', 'code');
    }

    /**
     * Get the arrival airport of the flight.
     */
    public function arrivalAirport()
    {
        return $this->belongsTo(Airport::class, 'arrival_airport', 'code');
    }
}
