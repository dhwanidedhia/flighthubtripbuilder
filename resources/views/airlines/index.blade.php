@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Airlines</h2>
		@if(session()->has('success'))
			<div class="alert alert-success">
				{{ session()->get('success') }}
			</div>
		@endif
        <a href="{{ route('airlines.create') }}" class="btn btn-success mb-2">Create Airline</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($airlines as $airline)
                    <tr>
                        <td>{{ $airline->code }}</td>
                        <td>{{ $airline->name }}</td>
                        <td>
                            <a href="{{ route('airlines.show', $airline->id) }}" class="btn btn-primary btn-sm">View</a>
                            <a href="{{ route('airlines.edit', $airline->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('airlines.destroy', $airline->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this airline?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
