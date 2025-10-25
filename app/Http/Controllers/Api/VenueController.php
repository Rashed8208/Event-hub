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
        $venues = Venue::all();

        return response()->json([
            'status' => true,
            'data' => $venues
        ], 200);
    }

    /**
     * Store a newly created venue in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'capacity' => 'nullable|integer|min:0',
            'price_per_day' => 'nullable|numeric|min:0',
            'status' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/venues'), $imageName);
            $validated['image'] = $imageName;
        }

        $venue = Venue::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Venue created successfully.',
            'data' => $venue
        ], 201);
    }

    /**
     * Display the specified venue.
     */
    public function show($id)
    {
        $venue = Venue::find($id);

        if (!$venue) {
            return response()->json([
                'status' => false,
                'message' => 'Venue not found.'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $venue
        ], 200);
    }

    /**
     * Update the specified venue.
     */
    public function update(Request $request, $id)
    {
        $venue = Venue::find($id);

        if (!$venue) {
            return response()->json([
                'status' => false,
                'message' => 'Venue not found.'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'capacity' => 'nullable|integer|min:0',
            'price_per_day' => 'nullable|numeric|min:0',
            'status' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Handle image update
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/venues'), $imageName);
            $validated['image'] = $imageName;
        }

        $venue->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Venue updated successfully.',
            'data' => $venue
        ], 200);
    }

    /**
     * Remove the specified venue.
     */
    public function destroy($id)
    {
        $venue = Venue::find($id);

        if (!$venue) {
            return response()->json([
                'status' => false,
                'message' => 'Venue not found.'
            ], 404);
        }

        $venue->delete();

        return response()->json([
            'status' => true,
            'message' => 'Venue deleted successfully.'
        ], 200);
    }
}
