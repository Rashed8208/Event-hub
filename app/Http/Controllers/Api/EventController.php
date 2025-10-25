<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    
    public function index()
    {
        $data = Event::all();
        return view('event.index', compact('data'));
    }

   
    public function create()
    {
        return view('event.create');
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
            'available_tickets' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $requestData = $validatedData;

        
        if ($request->hasFile('image')) {
            $fileName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/events'), $fileName);
            $requestData['image'] = $fileName;
        }

        Event::create($requestData);

        return redirect()->route('event.index')->with('success', 'Event created successfully!');
    }

    
    public function show(Event $event)
    {
        return view('event.show', compact('event'));
    }

   
    public function edit(Event $event)
    {
        return view('event.edit', compact('event'));
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
            'available_tickets' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $requestData = $validatedData;

        
        if ($request->hasFile('image')) {
            $fileName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/events'), $fileName);
            $requestData['image'] = $fileName;
        }

        $event->update($requestData);

        return redirect()->route('event.index')->with('success', 'Event updated successfully!');
    }

    
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('event.index')->with('success', 'Event deleted successfully!');
    }
}
