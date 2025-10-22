<?php

namespace App\Http\Controllers;

use App\Models\ticket_booking;
use Illuminate\Http\Request;

class TicketBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $data=ticket_booking::get();
        return view('ticket_booking.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('ticket_booking.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Ticket_booking::create($request->all());
      return redirect()->route('ticket_booking.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ticket_booking $ticket_booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ticket_booking $ticket_booking)
    {
        return view('ticket_booking.edit',compact('ticket_booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ticket_booking $ticket_booking)
    {
        $ticket_booking->update($request->all());
      return redirect()->route('ticket_booking.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ticket_booking $ticket_booking)
    {
         $ticket_booking->delete();
      return redirect()->route('ticket_booking.index');
    }
}
