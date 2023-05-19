@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Airline</h2>
		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
        <form action="{{ route('airlines.update', $airline->id) }}" method="POST">
            @csrf
            @method('PUT')
			
			<div class="form-group">
                <label for="code">Code:</label>
                <input type="text" name="code" class="form-control" value="{{ $airline->code }}" required>
            </div>
			
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" value="{{ $airline->name }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
