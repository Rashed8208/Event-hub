<?php

namespace App\Http\Controllers;

use App\Models\event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=event::get();
        return view('event.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('event.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Event::create($request->all());
      return redirect()->route('event.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(event $event)
    {
        return view('event.edit',compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, event $event)
    {
        $event->update($request->all());
      return redirect()->route('event.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(event $event)
    {
         $event->delete();
      return redirect()->route('event.index');
    }
}
