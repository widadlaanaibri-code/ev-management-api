@extends('layouts.my_layout')

@section('content')


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

                    <form action="{{ route('password.reset') }}" enctype="multipart/form-data" method="POST" id="form">
                        @csrf
                        <div class="form-outline mb-4">
                            <input type="email" id="email" class="form-control p-2 bg-light text-dark" placeholder="Email" name="email" />
                            <p id="email-log-error" class="form-error text-danger"></p>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="password" id="password" class="form-control p-2 bg-light text-dark" placeholder="Password" name="password" />
                            <p id="password-log-error" class="form-error text-danger"></p>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="password" id="password" class="form-control p-2 bg-light text-dark" placeholder="Confirm Password" name="password_confirmation" />
                            <p id="password-log-error" class="form-error text-danger"></p>
                        </div>

                        <button type="submit" class="btn btn-dark btn-block mb-4 col-12 p-2">Reset Password</button>

                        <!-- Register buttons -->
                        <div class="text-center mb-4">
                            <a href="" class="btn btn-link btn-floating mx-1"><i class='bx bxl-meta' style="font-size: 20px"></i></a>
                            <a href="{{ url('login/google') }}" class="btn btn-link btn-floating mx-1"><i class='bx bxl-google' style="font-size: 20px"></i></a>

                        </div>
                        <a href="{{ route('register') }}" class="col-12 register text-light">Dont have an account? <span class="text-primary">Register</span></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection



