@extends('layouts.dashboard')


@section('Booking-active', 'active')


@section('recent-tables')
<div class="row">
    <div class="col-12">
        <div class="card mb-4" style="background-color:#161718;">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center"
                style="background-color:#161718;">
                <h6>Your Events </h6>

            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Event</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Users</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Available Seats</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Status</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Reserved_at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($reservations->isNotEmpty())
                                @foreach ($reservations as $reservation)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>

                                                    <img src="{{ $reservation->event->getFirstMediaUrl('media/events') }}"
                                                        class="avatar avatar-sm me-3" alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm text-light">
                                                        {{ $reservation->event->title }}
                                                    </h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ $reservation->event->category->name }}</p>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle text-center">
                                            @if ($reservation->user->hasMedia('media/users'))
                                                <img src="{{ $reservation->user->getFirstMediaUrl('media/users') }}"
                                                    class="avatar avatar-sm rounded-circle" alt="user1"
                                                    style="border:2px solid rgb(51, 51, 51)">
                                            @else
                                                <img src="{{ asset('images/avatar.jfif') }}"
                                                    class="avatar avatar-sm rounded-circle" alt="user1">
                                            @endif

                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 text-secondary text-center">
                                                {{ $reservation->event->total_seats - $reservation->event->reserved_seats }}
                                            </p>
                                        </td>

                                        <td class="text-center align-middle">

                                            <a href="#" class="status-badge">

                                                @if ( $reservation->status === 'pending')

                                                <span class="badge badge-sm bg-gradient-warning text-center">{{ $reservation->status }}</span>
                                                @elseif ($reservation->status === 'accepted')
                                                <span class="badge badge-sm bg-gradient-success text-center">{{ $reservation->status }}</span>
                                                @endif

                                            </a>

                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                {{ $reservation->created_at }}
                                            </span>
                                        </td>
                                        </td>


                                    </tr>
                                @endforeach
                            @else
                                        <p class="text-xs font-weight-bold mb-0 text-danger text-center ">
                                            There is No Reservations!! </p>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
