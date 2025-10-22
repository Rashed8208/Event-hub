@extends('layouts.backend')

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
            @forelse($data as $d)
            <tr>
                <td>{{ $d->id }}</td>
                <td>{{ $d->user_id }}</td>
                <td>{{ $d->event_id }}</td>
                <td>{{ $d->quantity }}</td>
                <td>${{ number_format($d->total_amount, 2) }}</td>
                <td>
                    <span class="badge 
                        @if($booking->status == 'paid') bg-success 
                        @elseif($booking->status == 'cancelled') bg-danger 
                        @else bg-warning text-dark @endif">
                        {{ ucfirst($d->status) }}
                    </span>
                </td>
                <td>{{ $d->booking_date }}</td>
                <td>
                    <a href="{{ route('ticket_booking.edit', $d->id) }}" class="btn btn-sm btn-info">Edit</a>
                    <form action="{{ route('ticket_booking.destroy', $d->id) }}" method="POST" class="d-inline">
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
