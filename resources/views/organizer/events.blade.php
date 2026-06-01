@extends('layouts.org-dashboard')


@section('Events-active', 'active')


@section('recent-tables')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4" style="background-color:#161718;">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center"
                    style="background-color:#161718;">
                    <h6>Your Events </h6>
                    <a href="{{route('event.create')}}" class="btn btn-primary">Create Event</a>

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
                                        Date</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Location</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Total Seats</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Reserved Seats</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Price</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Automatic</th>
                                        <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Craeted_at</th>
                                        <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status</th>
                                        <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Actions</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $event)

                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>

                                                <img src="{{ $event->getFirstMediaUrl('media/events') }}" class="avatar avatar-sm me-3"
                                                    alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm text-light"> {{$event->title}}
                                                </h6>
                                                <p class="text-xs text-secondary mb-0">
                                                    {{$event->category->name}}</p>
                                                </div>
                                            </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0 text-secondary text-center">
                                            {{$event->date}} </p>
                                    </td>

                                    <td>
                                        <p class="text-xs font-weight-bold mb-0 text-secondary text-center">
                                            {{$event->location}} </p>
                                    </td>

                                    <td>
                                        <p class="text-xs font-weight-bold mb-0 text-secondary text-center">
                                            {{$event->total_seats}} </p>
                                        </td>

                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 text-secondary text-center">
                                                {{$event->reserved_seats}} </p>
                                            </td>

                                            <td>
                                                <p class="text-xs font-weight-bold mb-0 text-secondary text-center">
                                            <span class="text-success">$</span> {{$event->price}} </p>
                                    </td>

                                    <td class="text-center align-middle">

                                        <a href="#" class="status-badge">
                                            @if ($event->automatic_accept === 0)
                                            <span class="badge badge-sm bg-gradient-danger text-center">
                                                NO
                                            </span>
                                            @else
                                            <span class="badge badge-sm bg-gradient-success text-center">
                                                YES
                                            </span>
                                            @endif
                                        </a>

                                    </td>

                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold"> {{$event->created_at}} </span>
                                    </td>
                                    <td class="text-center align-middle">

                                        <a href="#" class="status-badge">
                                            @if ($event->event_status === 'pending')
                                            <span class="badge badge-sm bg-gradient-warning text-center">
                                                Pending
                                            </span>
                                            @elseif ($event->event_status === 'accepted')
                                            <span class="badge badge-sm bg-gradient-success text-center">
                                                Accepted
                                            </span>
                                            @else
                                            <span class="badge badge-sm bg-gradient-danger text-center">
                                                Refused
                                            </span>
                                            @endif
                                        </a>

                                    </td>

                                    <td class="align-middle text-center">
                                        <form action="{{route('event.destroy' , $event->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-danger text-xs me-3" type="submit" style="background-color: transparent;border:none">Delete</button>
                                            <a href="{{route('event.edit' , $event->id)}}" class="text-primary text-xs">Edit</a>
                                        </form>
                                    </td>


                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
