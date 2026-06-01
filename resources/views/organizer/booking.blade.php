@extends('layouts.org-dashboard')


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
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Actions</th>


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

                                                <a href="#" class="status-badge" data-bs-toggle="modal"
                                                    data-bs-target="#statusModal"
                                                    data-reservation-id="{{ $reservation->id }}"
                                                    data-status="{{ $reservation->status }}">

                                                    <span
                                                        class="badge badge-sm bg-gradient-warning text-center">{{ $reservation->status }}</span>

                                                </a>

                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{ $reservation->created_at }}
                                                </span>
                                            </td>
                                            </td>

                                            <td class="align-middle text-center">
                                                <form action="{{ route('event.destroy', $reservation->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="text-danger text-xs me-3" type="submit"
                                                        style="background-color: transparent;border:none">Delete</button>

                                                </form>
                                            </td>


                                        </tr>
                                    @endforeach
                                    <div class="modal fade" id="statusModal" tabindex="-1"
                                        aria-labelledby="editProfileModalLabel" aria-hidden="true" style="z-index: 100001">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editProfileModalLabel">Experience</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="editProfileForm"
                                                        action="{{ route('updateStatus', $reservation->id) }}"
                                                        method="POST">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="mb-3">
                                                            <select name="status" id="status" class="form-control">
                                                                <option selected>Select a Status</option>
                                                                <option value="pending">Pending</option>
                                                                <option value="accepted">Accepted</option>
                                                                <option value="refused">Refused</option>
                                                            </select>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary" name="submit">Save
                                                            Changes</button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
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


    <script>
        $('#statusModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var status = button.data('status');
            var modal = $(this);
            modal.find('#status').val(status);
        });
    </script>
@endsection
