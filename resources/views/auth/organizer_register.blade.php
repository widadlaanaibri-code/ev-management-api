@extends('layouts.my_layout')

@section('hero_head')


<div class="container">
    <div class="row gx-lg-5 align-items-center mb-5">
        <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
            <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                Welcome To <span style="font-family: 'Protest Riot', sans-serif;color:brown">E v e n t o</span> <br />
                <span style="color: white">All on One Platform</span>
            </h1>
            <p class="opacity-70" style="color: white">
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

                    <form action="{{ route('organizer.post') }}" method="POST" id="form">
                        @csrf
                        <div class="form-outline mb-4">
                            <input type="text" id="fullname" class="form-control bg-light p-2 text-dark" placeholder="Full Name" name="name" />
                            <p id="fullname-error" class="form-error text-danger"></p>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="email" id="email" class="form-control bg-light p-2 text-dark" placeholder="Email" name="email" />
                            <p id="email-error" class="form-error text-danger"></p>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="password" id="password" class="form-control bg-light p-2 text-dark" placeholder="Password" name="password" />
                            <p id="password-error" class="form-error text-danger"></p>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="password" id="confirm_password" class="form-control bg-light p-2 text-dark" placeholder="Confirm Password" name="password_confirmation" />
                            <p id="confirm_password-error" class="form-error text-danger"></p>
                        </div>
                        <div class="form-outline mb-4">
                            <input type="text" id="establishment" class="form-control bg-light p-2 text-dark" placeholder="Establishment" name="establishment" />
                            <p id="establishment-error" class="form-error text-danger"></p>
                        </div>

                        <div class="form-outline mb-4">
                            <textarea type="text" id="desciption" class="form-control bg-light p-2 text-dark" placeholder="Description" name="description"></textarea>
                            <p id="desciption-error" class="form-error text-danger"></p>
                        </div>

                        <button type="submit" class="btn btn-dark btn-block mb-4 col-12">Register</button>
                        <a href="{{ route('login') }}" class="mb-4 col-12 register text-light">Already have an account? Login</a>

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
