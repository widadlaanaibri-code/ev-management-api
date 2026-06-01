@extends('layouts.dashboard')

@section('Users-active' , 'active')
@section('recent-tables')
<div class="row">
    <div class="col-6">
        <div class="card mb-4" style="background-color:#161718;">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center"
                style="background-color:#161718;">
                <h6>Evento Users </h6>

            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th
                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    User</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Role</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Status</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Craeted_at</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($spectators as $spectator)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                @if ($spectator->hasMedia('media/users'))
                                                <img src="{{ $spectator->getFirstMediaUrl('media/users') }}"
                                                class="avatar avatar-sm me-3" alt="user1">
                                                @else
                                                <img src="{{ asset('images/avatar.jfif') }}"
                                                class="avatar avatar-sm me-3" alt="user1">
                                                @endif
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm text-light"> {{ $spectator->name }}
                                                </h6>
                                                <p class="text-xs text-secondary mb-0">
                                                    {{ $spectator->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @foreach ($spectator->roles as $role)
                                            <p class="text-xs font-weight-bold mb-0 text-success">
                                                {{ $role->name }} </p>
                                        @endforeach
                                    </td>

                                    <td>

                                        <a href="#" class="status-badge"
                                            data-spectator-id="{{ $spectator->id }}"
                                            data-status="{{ $spectator->status }}" data-bs-toggle="modal"
                                            data-bs-target="#statusModal">
                                            @if ($spectator->status === 'pending')
                                                <span
                                                    class="badge badge-sm bg-gradient-warning">{{ $spectator->status }}</span>
                                            @elseif ($spectator->status === 'accepted')
                                                <span
                                                    class="badge badge-sm bg-gradient-success">{{ $spectator->status }}</span>
                                            @else
                                                <span
                                                    class="badge badge-sm bg-gradient-danger">{{ $spectator->status }}</span>
                                            @endif
                                        </a>

                                    </td>

                                    <td class="align-middle text-center">
                                        <span
                                            class="text-secondary text-xs font-weight-bold">{{ $spectator->created_at }}</span>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card mb-4" style="background-color:#161718;">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center"
                style="background-color:#161718;">
                <h6>Evento Organizers </h6>

            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th
                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Organizer</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Role</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Status</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Establishment</th>

                            </tr>
                        </thead>
                        <tbody>

                            @if ($organizers->isNotEmpty())

                                @foreach ($organizers as $organizer)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    @if ($organizer->hasMedia('media/users'))
                                                <img src="{{ $organizer->getFirstMediaUrl('media/users') }}"
                                                class="avatar avatar-sm me-3" alt="user1">
                                                @else
                                                <img src="{{ asset('images/avatar.jfif') }}"
                                                class="avatar avatar-sm me-3" alt="user1">
                                                @endif
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm text-light">
                                                        {{ $organizer->name }}
                                                    </h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ $organizer->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @foreach ($organizer->roles as $role)
                                                <p class="text-xs font-weight-bold mb-0 text-success">
                                                    {{ $role->name }} </p>
                                            @endforeach
                                        </td>

                                        <td>

                                            <a href="#" class="status-badge"
                                                data-organizer-id="{{ $organizer->id }}"
                                                data-status="{{ $organizer->status }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#statusOrganizerModal">
                                                @if ($organizer->status === 'pending')
                                                    <span
                                                        class="badge badge-sm bg-gradient-warning">{{ $organizer->status }}</span>
                                                @elseif ($organizer->status === 'accepted')
                                                    <span
                                                        class="badge badge-sm bg-gradient-success">{{ $organizer->status }}</span>
                                                @else
                                                    <span
                                                        class="badge badge-sm bg-gradient-danger">{{ $organizer->status }}</span>
                                                @endif
                                            </a>

                                        </td>

                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $organizer->establishment->name }}</span>
                                        </td>

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center">
                                        <h6 class="mb-0 text-sm text-light">No Organizers</h6>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true" style="z-index: 100001">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Update Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProfileForm" enctype="multipart/form-data" action="{{ route('users.update-status',['id' => $spectator->id]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="spectator_id" id="spectator_id">
                    <div class="mb-3">
                        <select name="status" id="status" class="form-control">
                            <option value="pending" {{ $spectator->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="accepted" {{ $spectator->status === 'accepted' ? 'selected' : '' }}>Accepted</option>
                            <option value="banned" {{ $spectator->status === 'banned' ? 'selected' : '' }}>Banned</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="statusOrganizerModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
    aria-hidden="true" style="z-index: 100001">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Update Organizer Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProfileForm" enctype="multipart/form-data" action="" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <select name="status" id="organizer_status" class="form-control">
                            <option value="pending"
                                {{ $spectator->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="accepted"
                                {{ $spectator->status === 'accepted' ? 'selected' : '' }}>Accepted</option>
                            <option value="banned"
                                {{ $spectator->status === 'banned' ? 'selected' : '' }}>Banned</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Save Changes</button>
                </form>


            </div>
        </div>
    </div>
</div>
@endsection
