@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Airports</h1>
		
		<a href="{{ route('airports.create') }}" class="btn btn-success mb-2">Create Airport</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>City Code</th>
                    <th>Name</th>
                    <th>City</th>
                    <th>Country Code</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Timezone</th>
                    <th WIDTH="250">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($airports as $airport)
                    <tr>
                        <td>{{ $airport['code'] }}</td>
                        <td>{{ $airport['city_code'] }}</td>
                        <td>{{ $airport['name'] }}</td>
                        <td>{{ $airport['city'] }}</td>
                        <td>{{ $airport['country_code'] }}</td>
                        <td>{{ $airport['latitude'] }}</td>
                        <td>{{ $airport['longitude'] }}</td>
                        <td>{{ $airport['timezone'] }}</td>
                        <td WIDTH="250">
                            <a href="{{ route('airports.show', $airport->id) }}" class="btn btn-primary btn-sm">View</a>
                            <a href="{{ route('airports.edit', $airport->id) }}" class="btn btn-warning btn-sm">Edit</a>
							
                            <form action="{{ route('airports.destroy', $airport->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this airport?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
