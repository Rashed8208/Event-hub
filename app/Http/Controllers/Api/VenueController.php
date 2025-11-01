<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Venue;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    /**
     * Display a listing of all venues.
     */
    public function index()
    {
        $data = Venue::all();

        return response()->json($data);
    }

    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'capacity' => 'nullable|integer|min:0',
            'price_per_day' => 'nullable|numeric|min:0',
            'status' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $requestData = $validatedData;

       
        if ($request->hasFile('image')) {
            $fileName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/venues'), $fileName);
            $requestData['image'] = 'uploads/venues/' . $fileName;
        }

        $venue = Venue::create($requestData);

        return response()->json([
            'message' => 'Venue created successfully.',
            'data' => $venue
        ], 201);
    }

   
    public function show(Venue $venue)
    {
        return response()->json($venue);
    }

   
    public function update(Request $request, Venue $venue)
    {
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'capacity' => 'nullable|integer|min:0',
            'price_per_day' => 'nullable|numeric|min:0',
            'status' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $requestData = $validatedData;

        
        if ($request->hasFile('image')) {
            $fileName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/venues'), $fileName);
            $requestData['image'] = 'uploads/venues/' . $fileName;
        }

        $venue->update($requestData);

        return response()->json([
            'message' => 'Venue updated successfully.',
            'data' => $venue
        ], 200);
    }

    public function destroy(Venue $venue)
    {
        $venue->delete();

        return response()->json([
            'message' => 'Venue deleted successfully.'
        ], 200);
    }
}
