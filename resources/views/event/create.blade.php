@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Event</h2>

    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
        </div>

        <div class="mb-3">
            <label>Location</label>
            <input type="text" name="location" class="form-control" value="{{ old('location') }}">
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Date</label>
                <input type="date" name="date" class="form-control" value="{{ old('date') }}">
            </div>
            <div class="col-md-4 mb-3">
                <label>Start Time</label>
                <input type="time" name="start_time" class="form-control" value="{{ old('start_time') }}">
            </div>
            <div class="col-md-4 mb-3">
                <label>End Time</label>
                <input type="time" name="end_time" class="form-control" value="{{ old('end_time') }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Price</label>
                <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label>Available Tickets</label>
                <input type="number" name="available_tickets" class="form-control" value="{{ old('available_tickets') }}">
            </div>
        </div>

        <div class="mb-3">
            <label>Event Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Save Event</button>
        <a href="{{ route('events.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
