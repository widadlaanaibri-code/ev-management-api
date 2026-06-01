@extends('layouts.my_layout')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="container">
    <div class="row gx-lg-5 align-items-center mb-5">
        <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
            <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                Welcome To <span style="font-family: 'Protest Riot', sans-serif;color:brown">E v e n t o</span> <br />
                <span style="color: white">All on One Platform</span>
            </h1>
            <p class="mb-4 opacity-70" style="color: white">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                Temporibus, expedita iusto veniam atque, magni tempora mollitia
                dolorum consequatur nulla, neque debitis eos reprehenderit quasi
                ab ipsum nisi dolorem modi. Quos?
            </p>
        </div>

        <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
            <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
            <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

            <div class="card1 bg-glass">
                <div class="card-body px-4 py-5 px-md-5">

                    <form action="{{ route('password.email') }}" enctype="multipart/form-data" method="POST" id="form">
                        @csrf

                        {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif --}}
                        <div class="form-outline mb-4">
                            <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus/>
                            @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>



                        <button type="submit" class="btn btn-dark btn-block mb-4 col-12 p-2">{{ __('Send Password Reset Link') }}</button>
                        <a href="{{ route('register') }}" class="mb-4 col-12 register text-light">Dont have an account? <span class="text-primary">Register</span></a>

                        <!-- Register buttons -->
                        <div class="text-center">
                            <button type="button" class="btn btn-link btn-floating mx-1"><i class='bx bxl-meta'></i></button>
                            <button type="button" class="btn btn-link btn-floating mx-1"><i class='bx bxl-google'></i></button>
                            <button type="button" class="btn btn-link btn-floating mx-1"><i class='bx bxl-linkedin'></i></button>
                            <button type="button" class="btn btn-link btn-floating mx-1"><i class='bx bxl-github'></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
