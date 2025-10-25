<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Display all wishlist items for all users (or can be filtered by user_id).
     */
    public function index(Request $request)
    {
        $userId = $request->query('user_id');

        if ($userId) {
            $wishlists = Wishlist::where('user_id', $userId)->with('event')->get();
        } else {
            $wishlists = Wishlist::with(['user', 'event'])->get();
        }

        return response()->json([
            'status' => true,
            'data' => $wishlists
        ], 200);
    }

    /**
     * Store a newly created wishlist item.
     */
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
                'message' => 'This event is already in the wishlist.'
            ], 400);
        }

        $wishlist = Wishlist::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Event added to wishlist.',
            'data' => $wishlist
        ], 201);
    }

    /**
     * Show a specific wishlist item.
     */
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

    /**
     * Remove a wishlist item.
     */
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
            'message' => 'Wishlist item removed.'
        ], 200);
    }
}
