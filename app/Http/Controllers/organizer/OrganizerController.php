<?php

namespace App\Http\Controllers\organizer;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Mail\TicketEmail;
use Illuminate\Support\Facades\Mail;

class OrganizerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->whereHas('roles', function ($query) {
            $query->where('role_id', 3);
        })->take(4)->get();
        $userCount = User::count();
        $reservationCount = Reservation::count();
        $eventCount = Event::count();
        return view('organizer.dashboard', compact('users', 'userCount', 'reservationCount', 'eventCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function booking()
    {
        $reservations = Reservation::where('status', 'pending')->get();
        return view('organizer.booking', compact('reservations'));
    }
    public function updateStatus(Request $request, Reservation $reservation)
    {
        $request->validate([
            'status' => 'required|in:pending,accepted,refused',
        ]);

        Event::find($reservation->event_id);
        $reservation->update([
            'status' => $request->status,
        ]);

        $event = $reservation->event;
        $user = $reservation->user;
        $pdf = PDF::loadView('pdf.ticket', compact('user', 'event'));
        $data['email'] = $user->email;
        $data['title'] = $event->title;
        Mail::send('emails.ticket', $data, function ($message) use ($data, $pdf) {
            $message->to($data['email'])
                ->subject($data['title'])
                ->attachData($pdf->output(), "ticket.pdf");
        });

        return redirect()->back()->with('status', 'Status updated successfully.');
    }
}
