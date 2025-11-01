<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EventSchedule;
use Illuminate\Http\JsonResponse;

class EventScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $schedules = EventSchedule::with('event')
            ->when($request->query('event_id'), function ($query) use ($request) {
                $query->where('event_id', $request->query('event_id'));
            })
            ->paginate(15);

        return response()->json($schedules);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'event_id' => 'required|exists:events,id',
            'time' => 'required|date',
            'duration' => 'required|integer|min:1',
            'title' => 'required|string|max:255',
            'details' => 'nullable|string',
        ]);

        $schedule = EventSchedule::create($data);

        return response()->json(['message'=>"Data saved"], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $schedule = EventSchedule::with('event')->findOrFail($id);
        return response()->json($schedule);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $schedule = EventSchedule::findOrFail($id);
        $schedule->update($request->all());

        return response()->json($schedule);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $schedule = EventSchedule::findOrFail($id);
        $schedule->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
