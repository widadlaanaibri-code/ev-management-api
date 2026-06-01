<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Mail\TicketEmail;
use Illuminate\Support\Facades\Mail;


class StripeController extends Controller
{
    public function session(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $event = Event::findOrFail($request->event_id);
        $totalPrice = $event->price;

        $unitAmount = max(50, $totalPrice);

        $session = \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency'     => 'usd',
                        'product_data' => [
                            'name' => 'Event Ticket',
                        ],
                        'unit_amount'  => $unitAmount,
                    ],
                    'quantity'   => 1,
                ],
            ],
            'mode'        => 'payment',
            'success_url' => route('success', ['event_id' => $request->event_id]), // Pass event ID in the success URL
        ]);

        return redirect()->to($session->url);
    }


    public function success(Request $request)
    {
        $event = Event::findOrFail($request->event_id);
        $reservation = Reservation::create([
            'user_id' => Auth::id(),
            'event_id' => $request->event_id,
            'status' => $event->automatic_accept ? 'accepted' : 'pending',
        ]);

        $event->increment('reserved_seats');
        $event->save();
        $user = Auth::user();
        $data['email'] = $user->email;
        $data['title'] = $event->title;
        if ($event->automatic_accept == 0) {
            Mail::send('emails.request', $data, function ($message) use ($data) {
                $message->to($data['email'])
                    ->subject($data['title']);
            });
        } else {
            $pdf = PDF::loadView('pdf.ticket', compact('user', 'event'));

            Mail::send('emails.ticket', $data, function ($message) use ($data, $pdf) {
                $message->to($data['email'])
                    ->subject($data['title'])
                    ->attachData($pdf->output(), "ticket.pdf");
            });
        }

        return redirect('user/home')->with('status', 'Booking Tickets Successfully!Check Your Email');
    }
}
