@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Flights</h1>
    
    <a href="{{ route('flights.create') }}" class="btn btn-success mb-3">Create Flight</a>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Airline</th>
                <th>Number</th>
                <th>Departure Airport</th>
                <th>Departure Time</th>
                <th>Arrival Airport</th>
                <th>Duration</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($flights as $flight)
            <tr>
                <td>{{ $flight->airline }}</td>
                <td>{{ $flight->number }}</td>
                <td>{{ $flight->departure_airport }}</td>
                <td>{{ $flight->departure_time }}</td>
                <td>{{ $flight->arrival_airport }}</td>
                <td>{{ $flight->duration }}</td>
                <td>{{ $flight->price }}</td>
                <td>
                    <a href="{{ route('flights.show', $flight->id) }}" class="btn btn-primary btn-sm">View</a>
                    <a href="{{ route('flights.edit', $flight->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('flights.destroy', $flight->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this flight?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection