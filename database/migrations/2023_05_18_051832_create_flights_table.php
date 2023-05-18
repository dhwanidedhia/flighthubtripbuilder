<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->increments('id');
			$table->string('airline', 2);
            $table->string('number');
            $table->string('departure_airport', 3);
            $table->time('departure_time');
            $table->string('arrival_airport', 3);
            $table->unsignedInteger('duration');
            $table->decimal('price', 8, 2);
			$table->unsignedInteger('trip_id')->nullable();
            $table->timestamps();
			
            $table->foreign('airline')->references('code')->on('airlines');
            $table->foreign('departure_airport')->references('code')->on('airports');
            $table->foreign('arrival_airport')->references('code')->on('airports');
			$table->foreign('trip_id')->references('id')->on('trips')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flights');
    }
}
