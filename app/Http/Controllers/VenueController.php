<?php

namespace App\Http\Controllers;

use App\Models\venue;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=venue::get();
        return view('venue.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('venue.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Venue::create($request->all());
        return redirect()->route('venue.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(venue $venue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(venue $venue)
    {
         return view('venue.edit',compact('venue'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, venue $venue)
    {
         $venue->update($request->all());
      return redirect()->route('venue.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(venue $venue)
    {
         $venue->delete();
      return redirect()->route('venue.index');
    }
}
