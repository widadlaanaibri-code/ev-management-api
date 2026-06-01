@extends('layouts.my_layout')


@section('nav')
    <nav id="navbar" class="navbar">
        <ul>
            <li><a href="index.html" class="active">Home</a></li>
            @auth
                <li><a href="events">Events</a></li>
                <li class="dropdown">
                    <a href="#"><span>My Tickets</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                        @if ($reservations->isNotEmpty())
                            @foreach ($reservations as $reservation)
                                <li class="d-flex justify-content-between" style="width:300px">
                                    <a href="{{ route('home.show', base64_encode($reservation->id)) }}"><img
                                            src="{{ $reservation->getFirstMediaUrl('media/events') }}"
                                            style="width: 40px;height:40px;" class="rounded-circle me-2">
                                        {{ $reservation->title }}</a>
                                    <a href="{{ route('ticket', $reservation->id) }}"><i class="bi bi-arrow-down-circle"
                                            style="font-size: 22px;color:rgb(129, 0, 0)"></i></a>
                                </li>
                            @endforeach
                        @else
                            <li><a>No tickets available!!.</a></li>
                        @endif
                    </ul>
                </li>
            @endauth
            <li><a href="about.html">About</a></li>

            <li><a href="contact.html">Contact</a></li>
        </ul>
    </nav>
@endsection

@section('hero_head')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <h2><span>Evento</span> Where Creativity Meets Collaboration</h2>
                <p>Dynamic online platform dedicated to fostering collaboration and innovation within the artistic
                    community. </p>
                <a href="contact.html" class="btn-get-started">Available for hire</a>
                <h2 class="mt-5"><span>Our Partners</span></h2>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <section id="services" class="services">
        <div class="container">

            <div class="row gy-4">

                <div class="col-xl-3 col-md-6 d-flex">
                    <div class="service-item position-relative item1">
                        <i class="bi bi-activity"></i>
                        <h4><a href="" class="stretched-link">Lorem Ipsum</a></h4>
                        <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-xl-3 col-md-6 d-flex">
                    <div class="service-item position-relative item2">
                        <i class="bi bi-bounding-box-circles"></i>
                        <h4><a href="" class="stretched-link">Sed ut perspici</a></h4>
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-xl-3 col-md-6 d-flex">
                    <div class="service-item position-relative item3">
                        <i class="bi bi-calendar4-week"></i>
                        <h4><a href="" class="stretched-link">Magni Dolores</a></h4>
                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-xl-3 col-md-6 d-flex">
                    <div class="service-item position-relative item4">
                        <i class="bi bi-broadcast"></i>
                        <h4><a href="" class="stretched-link">Nemo Enim</a></h4>
                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
                    </div>
                </div><!-- End Service Item -->

            </div>

        </div>
    </section><!-- End Services Section -->

    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing">
        <div class="container">

            <div class="section-header">
                <h2>Prices</h2>
                <p>Check Our adorable pricing</p>
            </div>

            <div class="row gy-4 gx-lg-5">

                <div class="col-lg-6">
                    <div class="pricing-item d-flex justify-content-between">
                        <h3>Portrait Photography</h3>
                        <h4>$20.00</h4>
                    </div>
                </div><!-- End Pricing Item -->

                <div class="col-lg-6">
                    <div class="pricing-item d-flex justify-content-between">
                        <h3>Fashion Photography</h3>
                        <h4>$30.00</h4>
                    </div>
                </div><!-- End Pricing Item -->

                <div class="col-lg-6">
                    <div class="pricing-item d-flex justify-content-between">
                        <h3>Sports Photography</h3>
                        <h4>$20.00</h4>
                    </div>
                </div><!-- End Pricing Item -->

                <div class="col-lg-6">
                    <div class="pricing-item d-flex justify-content-between">
                        <h3>Still Life Photography</h3>
                        <h4>$12.00</h4>
                    </div>
                </div><!-- End Pricing Item -->

                <div class="col-lg-6">
                    <div class="pricing-item d-flex justify-content-between">
                        <h3>Wedding Photography</h3>
                        <h4>$05.00</h4>
                    </div>
                </div><!-- End Pricing Item -->

                <div class="col-lg-6">
                    <div class="pricing-item d-flex justify-content-between">
                        <h3>Photojournalism</h3>
                        <h4>$22.00</h4>
                    </div>
                </div><!-- End Pricing Item -->

            </div>
    </section><!-- End Pricing Section -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <h2 class="mt-5"><span>Recent Events</span></h2>
            </div>
        </div>
    </div>
    <section id="gallery" class="gallery">

        <div class="container-fluid">

            <div class="row gy-4 justify-content-center">

                @foreach ($events as $event)
                    <div class="col-xl-3 col-lg-4 col-md-6">

                        <div class="gallery-item h-100">
                            <img src="{{ $event->getFirstMediaUrl('media/events') }}" class="img-fluid" alt=""
                                style="width: 500px;height:350px;object-fit:cover;">
                            <div class="gallery-links d-flex align-items-center justify-content-center">
                                <a href="{{ route('home.show', base64_encode($event->id)) }}" class="details-link"><i
                                        class="bi bi-eye"></i></a>
                            </div>
                        </div>
                    </div><!-- End Gallery Item -->
                @endforeach


            </div>

        </div>
    </section>
    <section id="testimonials" class="testimonials">
        <div class="container">

            <div class="section-header">
                <h2>Testimonials</h2>
                <p>What they are saying</p>
            </div>

            <div class="slides-3 swiper">
                <div class="swiper-wrapper"><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum
                                eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim
                                culpa.
                            </p>
                            <div class="profile mt-auto">
                                <img src="{{ asset('assets/img/843-1697011936.jpg') }}" class="testimonial-img"
                                    alt="">
                                <h3>Sara Wilsson</h3>
                                <h4>Designer</h4>
                            </div>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis
                                minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
                            </p>
                            <div class="profile mt-auto">
                                <img src="{{ asset('assets/img/873-1697012932.jpg') }}" class="testimonial-img"
                                    alt="">
                                <h3>Jena Karlis</h3>
                                <h4>Store Owner</h4>
                            </div>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim
                                velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum
                                veniam.
                            </p>
                            <div class="profile mt-auto">
                                <img src="{{ asset('assets/img/859-1697012922.jpg') }}" class="testimonial-img"
                                    alt="">
                                <h3>Matt Brandon</h3>
                                <h4>Freelancer</h4>
                            </div>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam
                                enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore
                                nisi cillum quid.
                            </p>
                            <div class="profile mt-auto">
                                <img src="{{ asset('assets/img/38-1684487575.jfif') }}" class="testimonial-img"
                                    alt="">
                                <h3>John Larson</h3>
                                <h4>Entrepreneur</h4>
                            </div>
                        </div>
                    </div><!-- End testimonial item -->

                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </section>
@endsection

@section('footer')
    <footer id="footer" class="footer">
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>PhotoFolio</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/photofolio-bootstrap-photography-website-template/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
    </footer>
@endsection
