<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Mail\EventAccepted;
use App\Mail\EventRejected;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EventController extends Controller
{
    /**
     * Get all events with statistics and optional filtering
     */
    public function index(Request $request)
    {
        $query = Event::with(['category', 'creater']);

        // Filter by status if provided
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('event_status', $request->status);
        }

        // Filter by organizer if provided
        if ($request->has('organizer_id')) {
            $query->where('createdBy', $request->organizer_id);
        }

        // Search by title
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Get events
        $events = $query->orderBy('created_at', 'desc')->get();

        // Calculate statistics
        $statistics = [
            'total' => Event::count(),
            'pending' => Event::where('event_status', 'pending')->count(),
            'accepted' => Event::where('event_status', 'accepted')->count(),
            'refused' => Event::where('event_status', 'refused')->count(),
        ];

        return response()->json([
            'success' => true,
            'data' => [
                'events' => EventResource::collection($events),
                'statistics' => $statistics,
            ]
        ]);
    }

    /**
     * Get pending events for approval dashboard
     */
    public function pending()
    {
        $events = Event::with(['category', 'creater'])
            ->where('event_status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => EventResource::collection($events)
        ]);
    }

    /**
     * Get single event details
     */
    public function show($id)
    {
        $event = Event::with(['category', 'creater', 'reservations.user'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => new EventResource($event)
        ]);
    }

    /**
     * Update event status (accept/reject)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,accepted,refused',
            'rejection_reason' => 'required_if:status,refused|string|max:500',
        ]);

        $event = Event::with('creater')->findOrFail($id);
        $previousStatus = $event->event_status;

        // Update event status
        $event->event_status = $request->status;
        $event->save();

        // Send email notification to organizer
        if ($request->status === 'accepted' && $previousStatus !== 'accepted') {
            Mail::to($event->creater->email)->send(new EventAccepted($event));
        } elseif ($request->status === 'refused' && $previousStatus !== 'refused') {
            Mail::to($event->creater->email)->send(new EventRejected($event, $request->rejection_reason));
        }

        return response()->json([
            'success' => true,
            'message' => 'Event status updated successfully',
            'data' => new EventResource($event->fresh(['category', 'creater']))
        ]);
    }

    /**
     * Delete an event (admin only)
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        // Check if event has reservations
        if ($event->reservations()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete event with existing reservations'
            ], 400);
        }

        // Delete event media
        $event->clearMediaCollection('events');

        // Delete event
        $event->delete();

        return response()->json([
            'success' => true,
            'message' => 'Event deleted successfully'
        ]);
    }

    /**
     * Get events by specific organizer
     */
    public function byOrganizer($organizerId)
    {
        $events = Event::with(['category', 'creater'])
            ->where('createdBy', $organizerId)
            ->orderBy('created_at', 'desc')
            ->get();

        $statistics = [
            'total' => $events->count(),
            'pending' => $events->where('event_status', 'pending')->count(),
            'accepted' => $events->where('event_status', 'accepted')->count(),
            'refused' => $events->where('event_status', 'refused')->count(),
        ];

        return response()->json([
            'success' => true,
            'data' => [
                'events' => EventResource::collection($events),
                'statistics' => $statistics,
            ]
        ]);
    }
}
