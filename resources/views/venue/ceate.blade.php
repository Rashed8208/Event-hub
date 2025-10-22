@extends('layouts.backend')

@section('content')
<div class="container mt-4">
    <h2>Add New Venue</h2>

    <form action="{{ route('venue.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="4"></textarea>
        </div>

        <div class="mb-3">
            <label>Address</label>
            <input type="text" name="address" class="form-control">
        </div>

        <div class="mb-3">
            <label>City</label>
            <input type="text" name="city" class="form-control">
        </div>

        <div class="mb-3">
            <label>Capacity</label>
            <input type="number" name="capacity" class="form-control">
        </div>

        <div class="mb-3">
            <label>Price per Day</label>
            <input type="number" step="0.01" name="price_per_day" class="form-control">
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select">
                <option value="available">Available</option>
                <option value="booked">Booked</option>
                <option value="unavailable">Unavailable</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('venue.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
