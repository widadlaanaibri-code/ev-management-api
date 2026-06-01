@extends('layouts.my_layout')



@section('content')
    <section id="gallery" class="gallery">
        <div class="container-fluid">

            <div class="row gy-4 justify-content-center">

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="gallery-item h-100 bg-glass" style="display: flex; flex-direction: column; align-items: center; justify-content:center ;padding: 50px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        <h4 class="text-light mb-3">Register as a Spectator</h4>
                        <p class="text-light text-center mb-3">Establishments play a crucial role in our community. Register now to showcase your talent and connect with others.</p>
                        <a href="{{route('register')}}" class="btn btn-lg text-light" style="background-color:rgb(0, 0, 0);font-size:16px;padding:15px 30px">Register Now</a>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="gallery-item h-100 bg-glass" style="display: flex; flex-direction: column; align-items: center; justify-content:center ;padding: 50px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        <h4 class="text-light mb-3">Register as an Organizer</h4>
                        <p class="text-light text-center mb-3">Establishments play a crucial role in our community. Register now to showcase your talent and connect with others.</p>
                        <a href="{{route('organizer_auth')}}" class="btn btn-lg text-light" style="background-color:rgb(0, 0, 0);font-size:16px;padding:15px 30px">Register Now</a>
                    </div>
                </div>
                <!-- End Gallery Item -->


            </div>

        </div>
    </section>
@endsection
