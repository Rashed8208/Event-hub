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


    public function show($id)
{
    $booking = TicketBooking::with(['event'])->findOrFail($id);
    return response()->json($booking);
}

    
    // public function update(Request $request, TicketBooking $ticketBooking)
    // {
    //     $validatedData = $request->validate([
    //         'quantity' => 'nullable|integer|min:1',
    //         'total_amount' => 'nullable|numeric|min:0',
    //         'status' => 'nullable|integer',
    //         'booking_date' => 'nullable|date',
    //     ]);

       
    //     if (isset($validatedData['quantity'])) {
    //         $event = $ticketBooking->event;
    //         $difference = $validatedData['quantity'] - $ticketBooking->quantity;

    //         if ($difference > 0 && $event->available_tickets < $difference) {
    //             return response()->json(['message' => 'Not enough tickets available to increase quantity.'], 400);
    //         }

           
    //         $event->decrement('available_tickets', max(0, $difference));
    //         $event->increment('available_tickets', max(0, -$difference));
    //     }

    //     $ticketBooking->update($validatedData);

    //     return response()->json(['message' => 'Booking updated successfully', 'data' => $ticketBooking], 200);
    // }
    public function update(Request $request, $id)
{
    $ticketBooking = TicketBooking::findOrFail($id);
    
    $validatedData = $request->validate([
        'user_id' => 'nullable|exists:users,id',
        'event_id' => 'nullable|exists:events,id',
        'quantity' => 'nullable|integer|min:1',
        'total_amount' => 'nullable|numeric|min:0',
        'status' => 'nullable|integer',
        'booking_date' => 'nullable|date',
    ]);

    // Handle event_id change
    if (isset($validatedData['event_id']) && $validatedData['event_id'] != $ticketBooking->event_id) {
        // Restore tickets to old event
        $oldEvent = $ticketBooking->event;
        $oldEvent->increment('available_tickets', $ticketBooking->quantity);
        
        // Deduct from new event
        $newEvent = Event::findOrFail($validatedData['event_id']);
        if ($newEvent->available_tickets < $ticketBooking->quantity) {
            return response()->json(['message' => 'Not enough tickets available in the new event.'], 400);
        }
        $newEvent->decrement('available_tickets', $ticketBooking->quantity);
    }

    // Handle quantity change (only if event_id stays the same)
    if (isset($validatedData['quantity']) && 
        (!isset($validatedData['event_id']) || $validatedData['event_id'] == $ticketBooking->event_id)) {
        $event = $ticketBooking->event;
        $difference = $validatedData['quantity'] - $ticketBooking->quantity;

        if ($difference > 0 && $event->available_tickets < $difference) {
            return response()->json(['message' => 'Not enough tickets available to increase quantity.'], 400);
        }

        if ($difference > 0) {
            $event->decrement('available_tickets', $difference);
        } else if ($difference < 0) {
            $event->increment('available_tickets', abs($difference));
        }
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
