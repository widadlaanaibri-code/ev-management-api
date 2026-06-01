@extends('layouts.my_layout')
@section('nav')
    <nav id="navbar" class="navbar">
        <ul>
            <li><a href="index.html" class="active">Home</a></li>
            @auth
                <li><a href="../events">Events</a></li>
                <li class="dropdown">
                    <a href="#"><span>My Tickets</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                        @if ($reservations->isNotEmpty())
                            @foreach ($reservations as $reservation)
                            <li class="d-flex justify-content-between" style="width:300px">
                                <a href="{{ route('home.show', base64_encode($reservation->id)) }}"><img
                                        src="{{ $reservation->getFirstMediaUrl('media/events') }}"
                                        style="width: 40px;height:40px;" class="rounded-circle me-2">
                                    {{ $reservation->title }}</a>
                                <a href="{{ route('ticket', $reservation->id) }}"><i class="bi bi-arrow-down-circle"
                                        style="font-size: 22px;color:rgb(129, 0, 0)"></i></a>
                            </li>
                            @endforeach
                        @else
                            <li><a>No tickets available!!.</a></li>
                        @endif
                    </ul>
                </li>
            @endauth
            <li><a href="about.html">About</a></li>

            <li><a href="contact.html">Contact</a></li>
        </ul>
    </nav>
@endsection
@section('hero_head')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <h2><span>Evento</span> Where Creativity Meets Collaboration</h2>
                <p>Dynamic online platform dedicated to fostering collaboration and innovation within the artistic
                    community. </p>
                <a href="contact.html" class="btn-get-started">Available for hire</a>
                <h2 class="mt-5 mb-5"><span>Event Details</span></h2>
            </div>
        </div>
    </div><!-- End Page Header -->

    <!-- ======= Gallery Single Section ======= -->
    <section id="gallery-single" class="gallery-single">
        <div class="container">
            <div>
                <img src="{{ $event->getFirstMediaUrl('media/events') }}" alt=""
                    style="width:100%;height:500px;object-fit:cover;" class="rounded">
            </div>

            <div class="row justify-content-between gy-4 mt-4">

                <div class="col-lg-8">
                    <div class="portfolio-description">
                        <h2>{{ $event->title }}</h2>
                        <p>
                            {{ $event->description }}
                        </p>



                        <div class="testimonial-item">
                            <h2 class="text-danger">Creator</h2>
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid
                                cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet
                                legam anim culpa.
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                            <div class="d-flex gap-3 align-items-center">
                                @if ($event->creater->hasMedia('media/users'))
                                    <img src="{{ $event->creater->getFirstMediaUrl('media/users') }}"
                                        class="testimonial-img" alt=""
                                        style="width: 70px;height:70px;object-fit:cover">
                                @else
                                    <img src="{{ asset('images/avatar.jfif') }}" class="testimonial-img" alt=""
                                        style="width: 70px;height:70px;object-fit:cover">
                                @endif
                                <div class="mb-4">
                                    <h3>{{ $event->creater->name }}</h3>
                                    <h4>{{ $event->created_at }}</h4>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="portfolio-info">
                        <h3>Event information</h3>
                        <ul>
                            <li><strong>Category</strong> <span>{{ $event->category->name }}</span></li>
                            <li><strong>Event date</strong> <span>{{ $event->date }}</span></li>
                            <li><strong>Available Seats</strong>
                                <span>{{ $event->total_seats - $event->reserved_seats }}</span>
                            </li>
                            <li><strong>Ticket Price</strong> <span><span
                                        class="text-warning">$</span>{{ $event->price }}.00</span></li>
                            <li><strong>Event Location</strong> <a href="#">{{ $event->location }}</a></li>
                            <li>
                                @if ($event->date < now())
                                    <a class="text-danger">This event has already passed.</a>
                                @elseif(auth()->user()->hasPendingReservation($event))
                                    <a class="text-danger">You already have a pending reservation for this event.</a>
                                @elseif(auth()->user()->status === 'banned')
                                    <a class="text-danger">The Evento team has banned you from any action in the website</a>
                                @elseif($event->reserved_seats === $event->total_seats)
                                    <button class="btn-visit align-self-start bg-dark" style="border:none;" type="button"
                                        disabled>
                                        Sold Out!!!
                                    </button>
                                @elseif(!$event->isReservedByUser(auth()->user()))
                                    <form action="/session" method="POST">
                                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button class="btn-visit align-self-start" type="submit" style="border:none;">Get
                                            Your Ticket</button>
                                    </form>
                                @else
                                    <button class="btn-visit align-self-start bg-dark" style="border:none;" type="button"
                                        disabled>
                                        Ticket Reserved
                                    </button>
                                @endif
                            </li>

                        </ul>
                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
