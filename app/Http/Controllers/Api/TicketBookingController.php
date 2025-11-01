<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TicketBooking;
use App\Models\Event;
use Illuminate\Http\Request;

class TicketBookingController extends Controller
{
   
    public function index()
    {
        $bookings = TicketBooking::with(['event'])->get();
        return response()->json($bookings);
    }

    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'event_id' => 'required|exists:events,id',
            'quantity' => 'required|integer|min:1',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'nullable|integer',
        ]);

        $event = Event::findOrFail($validatedData['event_id']);
        if ($event->available_tickets < $validatedData['quantity']) {
            return response()->json(['message' => 'Not enough tickets available.'], 400);
        }

        $booking = TicketBooking::create($request->all());


        $event->decrement('available_tickets', $validatedData['quantity']);

        return response()->json(['message' => 'Booking created successfully', 'data' => $booking], 200);
    }


    public function show(TicketBooking $ticketBooking)
    {
        return response()->json($ticketBooking->load(['event', 'user']));
    }

    
    public function update(Request $request, TicketBooking $ticketBooking)
    {
        $validatedData = $request->validate([
            'quantity' => 'nullable|integer|min:1',
            'total_amount' => 'nullable|numeric|min:0',
            'status' => 'nullable|integer',
            'booking_date' => 'nullable|date',
        ]);

       
        if (isset($validatedData['quantity'])) {
            $event = $ticketBooking->event;
            $difference = $validatedData['quantity'] - $ticketBooking->quantity;

            if ($difference > 0 && $event->available_tickets < $difference) {
                return response()->json(['message' => 'Not enough tickets available to increase quantity.'], 400);
            }

           
            $event->decrement('available_tickets', max(0, $difference));
            $event->increment('available_tickets', max(0, -$difference));
        }

        $ticketBooking->update($validatedData);

        return response()->json(['message' => 'Booking updated successfully', 'data' => $ticketBooking], 200);
    }

    
    public function destroy(TicketBooking $ticketBooking)
    {
        // Restore event tickets
        $event = $ticketBooking->event;
        $event->increment('available_tickets', $ticketBooking->quantity);

        $ticketBooking->delete();

        return response()->json(['message' => 'Booking deleted successfully'], 200);
    }
}
