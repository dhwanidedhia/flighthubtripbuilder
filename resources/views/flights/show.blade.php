@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Flight Details</div>

                    <div class="card-body">
                        <h5>Airline: {{ $flight->airline }}</h5>
                        <p>Flight Number: {{ $flight->number }}</p>
                        <p>Departure Airport: {{ $flight->departure_airport }}</p>
                        <p>Departure Time: {{ $flight->departure_time }}</p>
                        <p>Arrival Airport: {{ $flight->arrival_airport }}</p>
                        <p>Duration: {{ $flight->duration }} minutes</p>
                        <p>Price: {{ $flight->price }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection