@extends('layouts.my_layout')



@section('hero_head')
    <section id="hero" class="hero d-flex flex-column justify-content-center align-items-center" data-aos="fade"
        data-aos-delay="1500">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="cards">
                            @if (Auth::user()->hasMedia('media/users'))
                                <img src="{{ Auth::user()->getFirstMediaUrl('media/users') }}" id="image">
                            @else
                                <img src="{{ asset('images/avatar.jfif') }}" id="image">
                            @endif
                            <label for="input-file">Choose profile photo</label>
                            @error('profile')
                                <p class="fname-error text-danger">{{ $message }}</p>
                            @enderror
                            <input type="file" accept="image/jpg, image/png, image/jpeg" name="profile" style="background-color: transparent;" id="input-file">
                        </div>
                        <h2 class="mt-5"><span>Update Your Account</span></h2>

                        <div class="form-outline mb-4">
                            <input type="text" id="fullname" class="form-control" placeholder="Company Name" name="name" value="{{ Auth::user()->name }}" />
                            @error('name')
                                <p class="fname-error text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-outline mb-4">
                            <input type="text" id="email" class="form-control" placeholder="Email" name="email" value="{{ Auth::user()->email }}" />
                            @error('email')
                                <p class="fname-error text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <button class="btn mt-3 p-3 text-light" type="submit" style="background-color: brown">Save Changes</button>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
