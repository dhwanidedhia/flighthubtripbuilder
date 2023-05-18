<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;
	
	protected $fillable = ['name'];
	
	/**
     * Get the flights associated with the trip.
    */
    public function flights()
    {
        return $this->hasMany(Flight::class);
    }
}
