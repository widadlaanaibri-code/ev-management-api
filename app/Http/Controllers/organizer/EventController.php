<?php

namespace App\Http\Controllers\organizer;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Get all events for the authenticated organizer
     */
    public function index()
    {
        $user = Auth::user();

        $events = Event::where('createdBy', $user->id)
            ->with(['category', 'tags'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Add image URL to each event
        $events->each(function ($event) {
            $event->image = $event->getFirstMediaUrl('event-images');
        });

        $stats = [
            'total' => $events->count(),
            'pending' => $events->where('event_status', 'pending')->count(),
            'accepted' => $events->where('event_status', 'accepted')->count(),
            'refused' => $events->where('event_status', 'refused')->count(),
        ];

        return response()->json([
            'success' => true,
            'data' => $events,
            'stats' => $stats,
        ]);
    }

    /**
     * Store a new event
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date|after:now',
            'location' => 'required|string|max:255',
            'total_seats' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'automatic_accept' => 'boolean',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120', // Max 5MB
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

        $user = Auth::user();

        $event = Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'location' => $request->location,
            'total_seats' => $request->total_seats,
            'reserved_seats' => 0,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'createdBy' => $user->id,
            'event_status' => 'pending',
            'automatic_accept' => $request->automatic_accept ?? false,
        ]);

        // Handle image upload using Spatie Media Library
        if ($request->hasFile('image')) {
            $event->addMediaFromRequest('image')
                ->toMediaCollection('event-images');
        }

        // Attach tags if provided
        if ($request->has('tags') && is_array($request->tags)) {
            $event->tags()->attach($request->tags);
        }

        // Load relationships
        $event->load(['category', 'tags']);
        $event->image = $event->getFirstMediaUrl('event-images');

        return response()->json([
            'success' => true,
            'message' => 'Event created successfully! It is pending admin approval.',
            'data' => $event,
        ], 201);
    }

    /**
     * Display the specified event
     */
    public function show($id)
    {
        $user = Auth::user();

        $event = Event::where('createdBy', $user->id)
            ->with(['category', 'tags'])
            ->findOrFail($id);

        // Add image URL
        $event->image = $event->getFirstMediaUrl('event-images');

        return response()->json([
            'success' => true,
            'data' => $event,
        ]);
    }

    /**
     * Update the specified event
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        $event = Event::where('createdBy', $user->id)->findOrFail($id);

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'date' => 'sometimes|required|date|after:now',
            'location' => 'sometimes|required|string|max:255',
            'total_seats' => 'sometimes|required|integer|min:1',
            'price' => 'sometimes|required|numeric|min:0',
            'category_id' => 'sometimes|required|exists:categories,id',
            'automatic_accept' => 'boolean',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,webp|max:5120', // Max 5MB
        ]);

        $event->update($request->only([
            'title',
            'description',
            'date',
            'location',
            'total_seats',
            'price',
            'category_id',
            'automatic_accept',
        ]));

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            // Delete old image
            $event->clearMediaCollection('event-images');

            // Add new image
            $event->addMediaFromRequest('image')
                ->toMediaCollection('event-images');
        }

        $event->load('category');

        return response()->json([
            'success' => true,
            'message' => 'Event updated successfully',
            'data' => $event,
        ]);
    }

    /**
     * Remove the specified event
     */
    public function destroy($id)
    {
        $user = Auth::user();

        $event = Event::where('createdBy', $user->id)->findOrFail($id);

        // Check if event has reservations
        if ($event->reserved_seats > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete event with existing reservations',
            ], 400);
        }

        $event->delete();

        return response()->json([
            'success' => true,
            'message' => 'Event deleted successfully',
        ]);
    }
}
