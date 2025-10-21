@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Add New Ticket Booking</h2>

    <form action="{{ route('ticket_booking.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>User ID</label>
            <input type="number" name="user_id" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Event ID</label>
            <input type="number" name="event_id" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control" min="1" required>
        </div>

        <div class="mb-3">
            <label>Total Amount</label>
            <input type="number" step="0.01" name="total_amount" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select">
                <option value="pending">Pending</option>
                <option value="paid">Paid</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Booking Date</label>
            <input type="datetime-local" name="booking_date" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('ticket_booking.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
