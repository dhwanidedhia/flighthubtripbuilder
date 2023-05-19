@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create Airline</h2>
		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		
        <form action="{{ route('airlines.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="code">Code:</label>
                <input type="text" name="code" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
