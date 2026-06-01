@extends('layouts.dashboard')


@section('Events-active', 'active')


@section('recent-tables')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4" style="background-color:#161718;">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center"
                    style="background-color:#161718;">
                    <h6>Evento Events </h6>
                    <a href="{{ route('event.create') }}" class="btn btn-primary">Create Event</a>

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
                                        CreatedBy</th>
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
                                        Craeted_at</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status</th>



                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>

                                                    <img src="{{ $event->getFirstMediaUrl('media/events') }}"
                                                        class="avatar avatar-sm me-3" alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm text-light"> {{ $event->title }}
                                                    </h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ $event->category->name }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">

                                                @if ($event->creater->hasMedia('media/users'))
                                                    <img src="{{ $event->creater->getFirstMediaUrl('media/users') }}"
                                                        class="avatar avatar-sm me-3" alt="user1">
                                                @else
                                                    <img src="{{ asset('images/avatar.jfif') }}"
                                                        class="avatar avatar-sm me-3" alt="user1">
                                                @endif

                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 text-secondary text-center">
                                                {{ $event->date }} </p>
                                        </td>

                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 text-secondary text-center">
                                                {{ $event->location }} </p>
                                        </td>

                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 text-secondary text-center">
                                                {{ $event->total_seats }} </p>
                                        </td>

                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 text-secondary text-center">
                                                {{ $event->reserved_seats }} </p>
                                        </td>

                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 text-secondary text-center">
                                                <span class="text-success">$</span> {{ $event->price }}
                                            </p>
                                        </td>


                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold"> {{ $event->created_at }}
                                            </span>
                                        </td>
                                        <td class="text-center align-middle">

                                            <a href="#" class="status-badge"  data-event_id="{{ $event->id }}"
                                                data-status="{{ $event->event_status}}" data-bs-toggle="modal"
                                                data-bs-target="#statusModal">
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



                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card mb-4" style="background-color:#161718;">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center"
                    style="background-color:#161718;">
                    <h6>Evento Categories </h6>
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#addCategory">Add Category</a>

                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        CategoryName</th>
                                        <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Craeted_at</th>
                                        <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Updated_at</th>
                                        <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Deleted_at</th>
                                        <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td class="p-3">
                                            <p class="text-xs font-weight-bold mb-0 text-secondary text-center">
                                                {{ $category->id }} </p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 text-secondary text-center">
                                                {{ $category->name }} </p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 text-secondary text-center">
                                                {{ $category->created_at }} </p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 text-secondary text-center">
                                                {{ $category->updated_at }} </p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 text-secondary text-center">
                                                {{ $category->deleted_at ? $category->deleted_at : '-----------' }} </p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <form action="{{route('categories.destroy' , $category->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-danger text-xs me-3" type="submit" style="background-color: transparent;border:none">Delete</button>
                                                <a href="" class="text-primary text-xs"<a href="#" class="text-primary text-xs" data-cat_name="{{ $category->name }}" data-cat_id="{{ $category->id }}" data-bs-toggle="modal" data-bs-target="#updateCategory">Edit</a>
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
    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true" style="z-index: 100001">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Update Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editProfileForm" enctype="multipart/form-data" action="{{ route('events.update-status',['id' => $event->id]) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="event_id" id="event_id">
                        <div class="mb-3">
                            <select name="status" id="status" class="form-control">
                                <option value="pending" {{ $event->event_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="accepted" {{ $event->event_status === 'accepted' ? 'selected' : '' }}>Accepted</option>
                                <option value="banned" {{ $event->event_status === 'refused' ? 'selected' : '' }}>Banned</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true" style="z-index: 100001">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editProfileForm" enctype="multipart/form-data" action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="event_id" id="event_id">
                        <div class="mb-3">
                            <input name="category" id="status" class="form-control" placeholder="Category Name">

                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="updateCategory" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true" style="z-index: 100001">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Update Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editProfileForm" enctype="multipart/form-data" action="{{ route('categories.update', ['category' => $category->id]) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" name="cat_id" id="cat_id">
                            <input name="category" id="cat" class="form-control" placeholder="Category Name">
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
