<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of all tickets.
     */
    public function index()
    {
        $tickets = Ticket::all();

        return response()->json([
            'status' => true,
            'data' => $tickets
        ], 200);
    }

    /**
     * Store a newly created ticket.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'ticket_type' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'available_tickets' => 'nullable|integer|min:0',
            'status' => 'nullable|integer',
        ]);

        $ticket = Ticket::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Ticket created successfully.',
            'data' => $ticket
        ], 201);
    }

    /**
     * Display a single ticket.
     */
    public function show($id)
    {
        $ticket = Ticket::find($id);

        if (!$ticket) {
            return response()->json([
                'status' => false,
                'message' => 'Ticket not found.'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $ticket
        ], 200);
    }

    /**
     * Update an existing ticket.
     */
    public function update(Request $request, $id)
    {
        $ticket = Ticket::find($id);

        if (!$ticket) {
            return response()->json([
                'status' => false,
                'message' => 'Ticket not found.'
            ], 404);
        }

        $validated = $request->validate([
            'event_id' => 'sometimes|exists:events,id',
            'ticket_type' => 'sometimes|string|max:100',
            'price' => 'sometimes|numeric|min:0',
            'quantity' => 'sometimes|integer|min:1',
            'available_tickets' => 'sometimes|integer|min:0',
            'status' => 'sometimes|integer',
        ]);

        $ticket->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Ticket updated successfully.',
            'data' => $ticket
        ], 200);
    }

    /**
     * Remove a ticket.
     */
    public function destroy($id)
    {
        $ticket = Ticket::find($id);

        if (!$ticket) {
            return response()->json([
                'status' => false,
                'message' => 'Ticket not found.'
            ], 404);
        }

        $ticket->delete();

        return response()->json([
            'status' => true,
            'message' => 'Ticket deleted successfully.'
        ], 200);
    }
}
