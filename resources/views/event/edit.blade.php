@extends('layouts.backend')

@section('content')
<div class="container">
    <h2>Edit Event</h2>

    <form action="{{ route('event.update', $d->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $event->title) }}">
        </div>

        <div class="mb-3">
            <label>Location</label>
            <input type="text" name="location" class="form-control" value="{{ old('location', $event->location) }}">
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Date</label>
                <input type="date" name="date" class="form-control" value="{{ old('date', $event->date) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label>Start Time</label>
                <input type="time" name="start_time" class="form-control" value="{{ old('start_time', $event->start_time) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label>End Time</label>
                <input type="time" name="end_time" class="form-control" value="{{ old('end_time', $event->end_time) }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Price</label>
                <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $event->price) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label>Available Tickets</label>
                <input type="number" name="available_tickets" class="form-control" value="{{ old('available_tickets', $event->available_tickets) }}">
            </div>
        </div>

        <div class="mb-3">
            <label>Event Image</label>
            <input type="file" name="image" class="form-control">
            @if ($event->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/'.$event->image) }}" width="120" alt="event image">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('event.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
