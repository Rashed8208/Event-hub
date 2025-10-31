<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
   
    public function index(Request $request)
    {
        $userId = $request->query('user_id');

        if ($userId) {
            $wishlists = Wishlist::where('user_id', $userId)->with(['user', 'event'])->get();
        } else {
            $wishlists = Wishlist::with(['user', 'event'])->get();
        }

        return response()->json([
            'status' => true,
            'data' => $wishlists
        ], 200);
    }

   
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'event_id' => 'required|exists:events,id',
        ]);

        // Prevent duplicate wishlist entries
        $exists = Wishlist::where('user_id', $validated['user_id'])
            ->where('event_id', $validated['event_id'])
            ->first();

        if ($exists) {
            return response()->json([
                'status' => false,
                'message' => 'This event is already in your wishlist.'
            ], 400);
        }

        $wishlist = Wishlist::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Event added to wishlist successfully.',
            'data' => $wishlist
        ], 201);
    }

   
    public function show($id)
    {
        $wishlist = Wishlist::with(['user', 'event'])->find($id);

        if (!$wishlist) {
            return response()->json([
                'status' => false,
                'message' => 'Wishlist item not found.'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $wishlist
        ], 200);
    }

    
    public function update(Request $request, $id)
    {
        $wishlist = Wishlist::find($id);

        if (!$wishlist) {
            return response()->json([
                'status' => false,
                'message' => 'Wishlist item not found.'
            ], 404);
        }

        $validated = $request->validate([
            'event_id' => 'sometimes|exists:events,id',
        ]);

        $wishlist->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Wishlist item updated successfully.',
            'data' => $wishlist
        ], 200);
    }

   
    public function destroy($id)
    {
        $wishlist = Wishlist::find($id);

        if (!$wishlist) {
            return response()->json([
                'status' => false,
                'message' => 'Wishlist item not found.'
            ], 404);
        }

        $wishlist->delete();

        return response()->json([
            'status' => true,
            'message' => 'Wishlist item removed successfully.'
        ], 200);
    }
}
