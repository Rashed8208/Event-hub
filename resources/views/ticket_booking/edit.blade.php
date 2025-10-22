@extends('layouts.backend')

@section('content')
<div class="container mt-4">
    <h2>Edit Ticket Booking</h2>

    <form action="{{ route('ticket_booking.update', $d->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>User ID</label>
            <input type="number" name="user_id" class="form-control" value="{{ $ticket_booking->user_id }}" required>
        </div>

        <div class="mb-3">
            <label>Event ID</label>
            <input type="number" name="event_id" class="form-control" value="{{ $ticket_booking->event_id }}" required>
        </div>

        <div class="mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control" value="{{ $ticket_booking->quantity }}" min="1" required>
        </div>

        <div class="mb-3">
            <label>Total Amount</label>
            <input type="number" step="0.01" name="total_amount" class="form-control" value="{{ $ticket_booking->total_amount }}" required>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select">
                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="paid" {{ $booking->status == 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Booking Date</label>
            <input type="datetime-local" name="booking_date" class="form-control" 
                   value="{{ $ticket_booking->booking_date ? \Carbon\Carbon::parse($ticket_booking->booking_date)->format('Y-m-d\TH:i') : '' }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('ticket_booking.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
