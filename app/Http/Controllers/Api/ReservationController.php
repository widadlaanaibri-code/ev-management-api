<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;

class ReservationController extends Controller
{
    /**
     * Create a reservation (book seats), send ticket email, return reservation with download link.
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'quantity' => 'required|integer|min:1|max:20',
        ]);

        $user = Auth::user();
        $event = Event::where('event_status', 'accepted')->findOrFail($request->event_id);

        $available = $event->total_seats - $event->reserved_seats;
        if ($request->quantity > $available) {
            return response()->json([
                'success' => false,
                'message' => 'Not enough seats available. Only ' . $available . ' left.',
            ], 422);
        }

        $reservation = Reservation::create([
            'user_id' => $user->id,
            'event_id' => $event->id,
            'status' => $event->automatic_accept ? 'accepted' : 'pending',
            'quantity' => $request->quantity,
        ]);

        $event->increment('reserved_seats', $request->quantity);

        $quantity = (int) $request->quantity;
        $pdf = Pdf::loadView('pdf.ticket', [
            'user' => $user,
            'event' => $event,
            'quantity' => $quantity,
        ]);

        try {
            Mail::send('emails.ticket', [
                'eventTitle' => $event->title,
                'quantity' => $quantity,
                'userName' => $user->name,
            ], function ($message) use ($user, $event, $pdf, $quantity) {
                $message->to($user->email)
                    ->subject('Your ticket for: ' . $event->title);
                $message->attachData($pdf->output(), 'ticket-' . $event->id . '.pdf', [
                    'mime' => 'application/pdf',
                ]);
            });
        } catch (\Exception $e) {
            Log::error('Failed to send ticket email: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Reservation confirmed. Check your email for the ticket.',
            'data' => [
                'id' => $reservation->id,
                'event_id' => $event->id,
                'quantity' => $quantity,
                'status' => $reservation->status,
            ],
        ]);
    }

    /**
     * Download ticket PDF for a reservation (own reservations only).
     */
    public function downloadTicket($id)
    {
        $reservation = Reservation::with(['event', 'user'])->findOrFail($id);

        if ($reservation->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $pdf = Pdf::loadView('pdf.ticket', [
            'user' => $reservation->user,
            'event' => $reservation->event,
            'quantity' => $reservation->quantity ?? 1,
        ]);

        $filename = 'ticket-' . $reservation->event->title . '-' . $reservation->id . '.pdf';
        $filename = preg_replace('/[^a-zA-Z0-9\-_\.]/', '-', $filename);

        return $pdf->download($filename);
    }
}
