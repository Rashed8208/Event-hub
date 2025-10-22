@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>All Events</h2>
        <a href="{{ route('event.create') }}" class="btn btn-primary">+ Add Event</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Location</th>
                <th>Date</th>
                <th>Time</th>
                <th>Price</th>
                <th>Tickets</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
                <tr>
                    <td>{{ $d->id }}</td>
                    <td>{{ $d->title }}</td>
                    <td>{{ $d->location }}</td>
                    <td>{{ $d->date }}</td>
                    <td>{{ $d->start_time }} - {{ $d->end_time }}</td>
                    <td>${{ number_format($d->price, 2) }}</td>
                    <td>{{ $d->available_tickets }}</td>
                    <td>
                        @if ($d->image)
                            <img src="{{ asset('storage/'.$event->image) }}" width="80" alt="event image">
                        @else
                            <span class="text-muted">No image</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('event.edit', $d->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('event.destroy', $d->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
