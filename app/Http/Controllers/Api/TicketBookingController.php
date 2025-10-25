<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TicketBooking;
use App\Models\Event;
use Illuminate\Http\Request;

class TicketBookingController extends Controller
{
    /**
     * Display a listing of all bookings.
     */
    public function index()
    {
        $bookings = TicketBooking::with(['event', 'user'])->get();
        return response()->json([
            'status' => true,
            'data' => $bookings
        ], 200);
    }

    /**
     * Store a newly created booking.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'event_id' => 'required|exists:events,id',
            'quantity' => 'required|integer|min:1',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'nullable|integer',
            'booking_date' => 'nullable|date',
        ]);

        // Check event ticket availability
        $event = Event::findOrFail($request->event_id);
        if ($event->available_tickets < $request->quantity) {
            return response()->json([
                'status' => false,
                'message' => 'Not enough tickets available.'
            ], 400);
        }

        // Create booking
        $booking = TicketBooking::create($validated);

        // Update available tickets
        $event->decrement('available_tickets', $request->quantity);

        return response()->json([
            'status' => true,
            'message' => 'Booking created successfully.',
            'data' => $booking
        ], 201);
    }

    /**
     * Display a single booking.
     */
    public function show($id)
    {
        $booking = TicketBooking::with(['event', 'user'])->find($id);

        if (!$booking) {
            return response()->json([
                'status' => false,
                'message' => 'Booking not found.'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $booking
        ], 200);
    }

    /**
     * Update an existing booking.
     */
    public function update(Request $request, $id)
    {
        $booking = TicketBooking::find($id);

        if (!$booking) {
            return response()->json([
                'status' => false,
                'message' => 'Booking not found.'
            ], 404);
        }

        $validated = $request->validate([
            'quantity' => 'sometimes|integer|min:1',
            'total_amount' => 'sometimes|numeric|min:0',
            'status' => 'sometimes|integer',
            'booking_date' => 'sometimes|date',
        ]);

        $booking->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Booking updated successfully.',
            'data' => $booking
        ], 200);
    }

    /**
     * Remove a booking.
     */
    public function destroy($id)
    {
        $booking = TicketBooking::find($id);

        if (!$booking) {
            return response()->json([
                'status' => false,
                'message' => 'Booking not found.'
            ], 404);
        }

        $booking->delete();

        return response()->json([
            'status' => true,
            'message' => 'Booking deleted successfully.'
        ], 200);
    }
}
