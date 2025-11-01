<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{

    public function index()
    {
        $data = Event::all();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'price' => 'nullable|numeric|min:0',
            'available_tickets' => 'nullable|integer|min:0'
        ]);

        $requestData = $validatedData;


        if ($request->hasFile('image')) {
            $fileName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/events'), $fileName);
            $requestData['image'] = 'uploads/events/'.$fileName;
        }

        $event=Event::create($requestData);
        return response()->json(['message' => 'Event Created ', 'data' => $event], 200);
    }


    public function show( $id)
    {
        $event=Event::with('schedules')->find($id);
        return response()->json($event);
    }


    public function update(Request $request, Event $event)
    {
        $validatedData = $request->validate([
            'title' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'price' => 'nullable|numeric|min:0',
            'available_tickets' => 'nullable|integer|min:0'
        ]);

        $requestData = $validatedData;


        if ($request->hasFile('image')) {
            $fileName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/events'), $fileName);
            $requestData['image'] = 'uploads/events/'.$fileName;
        }

        $event->update($requestData);
        return response()->json(['message' => 'Event updated ', 'data' => $event], 200);
    }


    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json(['message' => 'Event updated '], 200);
    }
}
