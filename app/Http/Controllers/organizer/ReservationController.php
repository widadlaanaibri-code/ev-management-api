<?php

namespace App\Http\Controllers\organizer;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Get all reservations for the authenticated organizer's events
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = Reservation::with(['event', 'user'])
            ->whereHas('event', function ($q) use ($user) {
                $q->where('createdBy', $user->id);
            })
            ->orderBy('created_at', 'desc');

        if ($request->has('status') && in_array($request->status, ['pending', 'accepted', 'refused'])) {
            $query->where('status', $request->status);
        }

        $reservations = $query->get();

        $allReservations = Reservation::whereHas('event', function ($q) use ($user) {
            $q->where('createdBy', $user->id);
        })->get();

        $stats = [
            'total' => $allReservations->count(),
            'pending' => $allReservations->where('status', 'pending')->count(),
            'accepted' => $allReservations->where('status', 'accepted')->count(),
            'refused' => $allReservations->where('status', 'refused')->count(),
        ];

        $data = $reservations->map(function ($r) {
            return [
                'id' => $r->id,
                'event_id' => $r->event_id,
                'event_title' => $r->event?->title,
                'event_date' => $r->event?->date,
                'user_id' => $r->user_id,
                'guest_name' => $r->user?->name,
                'guest_email' => $r->user?->email,
                'quantity' => (int) ($r->quantity ?? 1),
                'status' => $r->status,
                'created_at' => $r->created_at->format('Y-m-d H:i:s'),
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data,
            'stats' => $stats,
        ]);
    }
}
