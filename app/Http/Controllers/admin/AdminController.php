<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Reservation;
use App\Models\User;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->take(4)->get();
        $userCount = User::count();
        $reservationCount = Reservation::count();
        $eventCount = Event::count();
        return view('admin.dashboard', compact('users', 'userCount', 'reservationCount', 'eventCount'));
    }

    public function booking()
    {
        $reservations = Reservation::all();
        return view('admin.booking', compact('reservations'));
    }
}
