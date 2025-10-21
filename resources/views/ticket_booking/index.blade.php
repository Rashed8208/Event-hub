@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h2>Ticket Bookings</h2>
        <a href="{{ route('ticket_booking.create') }}" class="btn btn-primary">+ New Booking</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>User ID</th>
                <th>Event ID</th>
                <th>Quantity</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Booking Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $booking)
            <tr>
                <td>{{ $booking->id }}</td>
                <td>{{ $booking->user_id }}</td>
                <td>{{ $booking->event_id }}</td>
                <td>{{ $booking->quantity }}</td>
                <td>${{ number_format($booking->total_amount, 2) }}</td>
                <td>
                    <span class="badge 
                        @if($booking->status == 'paid') bg-success 
                        @elseif($booking->status == 'cancelled') bg-danger 
                        @else bg-warning text-dark @endif">
                        {{ ucfirst($booking->status) }}
                    </span>
                </td>
                <td>{{ $booking->booking_date }}</td>
                <td>
                    <a href="{{ route('ticket_booking.edit', $booking->id) }}" class="btn btn-sm btn-info">Edit</a>
                    <form action="{{ route('ticket_booking.destroy', $booking->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="8" class="text-center">No bookings found</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
