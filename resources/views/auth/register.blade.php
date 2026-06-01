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

                    <form action="{{ route('register.post') }}" enctype="multipart/form-data" method="POST" id="form">
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

<script>
    document.getElementById('form').addEventListener('submit', function(event) {
        var fullname = document.getElementById('fullname');
        var email = document.getElementById('email');
        var password = document.getElementById('password');
        var confirm_password = document.getElementById('confirm_password');

        var fullname_error = document.getElementById('fullname-error');
        var email_error = document.getElementById('email-error');
        var password_error = document.getElementById('password-error');
        var confirm_password_error = document.getElementById('confirm_password-error');

        var isValid = true;

        // Reset error messages
        fullname_error.textContent = '';
        email_error.textContent = '';
        password_error.textContent = '';
        confirm_password_error.textContent = '';

        // Full Name validation
        if (fullname.value.trim() === '') {
            fullname_error.textContent = 'Full Name is required';
            isValid = false;
        }

        // Email validation
        if (email.value.trim() === '') {
            email_error.textContent = 'Email is required';
            isValid = false;
        }

        // Password validation
        if (password.value.trim() === '') {
            password_error.textContent = 'Password is required';
            isValid = false;
        }

        // Confirm Password validation
        if (confirm_password.value.trim() === '') {
            confirm_password_error.textContent = 'Confirm Password is required';
            isValid = false;
        } else if (confirm_password.value.trim() !== password.value.trim()) {
            confirm_password_error.textContent = 'Passwords do not match';
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
        }
    });
</script>

@endsection
