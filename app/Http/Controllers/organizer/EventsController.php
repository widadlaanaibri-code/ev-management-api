<?php

namespace App\Http\Controllers\organizer;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventsController extends Controller
{

    public function index()
    {

        $userId = Auth::id();
        $events = Event::where('createdBy', $userId)->get();
        return view('organizer.events', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('organizer.create.events', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {

        $event = new Event([
            'title' => $request->title,
            'location' => $request->location,
            'description' => $request->description,
            'price' => $request->price,
            'total_seats' => $request->input('total-seats'),
            'date' => $request->date,
            'category_id' => $request->category,
            'automatic_accept' => $request->autostatus === 'automatic' ? 1 : 0,
            'createdBy' => Auth::id()
        ]);
        $event->addMediaFromRequest('cover')->toMediaCollection('media/events', 'media_events');
        $event->save();
        return redirect('evento-org/event')->with('status', 'Event created successfully.');
    }
    public function edit(string $id)
    {
        $event = Event::findOrFail($id);
        $categories = Category::all();
        return view('organizer.update.events', compact('event', 'categories'));
    }
    public function update(UpdateEventRequest $request, string $id)
    {



        $event = Event::findOrFail($id);
        $event->title = $request->title;
        $event->location = $request->location;
        $event->description = $request->description;
        $event->price = $request->price;
        $event->total_seats = $request->input('total-seats');
        $event->date = $request->date;
        $event->category_id = $request->category;
        $event->automatic_accept = $request->autostatus === 'automatic' ? 1 : 0;

        if ($request->hasFile('cover')) {
            if ($event->getFirstMedia('media_events')) {
                $event->clearMediaCollection('media_events');
            }
            $event->addMediaFromRequest('cover')->toMediaCollection('media/events', 'media_events');
        }
        $event->save();
        return redirect('evento-org/event')->with('status', 'Event updated successfully.');
    }
    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect('evento-org/event')->with('status', 'Event deleted successfully.');
    }
}
