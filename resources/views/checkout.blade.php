@extends('layouts.my_layout')
@section('nav')
    <nav id="navbar" class="navbar">
        <ul>
            <li><a href="index.html" class="active">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li class="dropdown"><a href="#"><span>Gallery</span> <i
                        class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                    <li><a href="gallery.html">Nature</a></li>
                    <li><a href="gallery.html">People</a></li>
                    <li><a href="gallery.html">Architecture</a></li>
                    <li><a href="gallery.html">Animals</a></li>
                    <li><a href="gallery.html">Sports</a></li>
                    <li><a href="gallery.html">Travel</a></li>
                    <li class="dropdown"><a href="#"><span>Sub Menu</span> <i
                                class="bi bi-chevron-down dropdown-indicator"></i></a>
                        <ul>
                            <li><a href="#">Sub Menu 1</a></li>
                            <li><a href="#">Sub Menu 2</a></li>
                            <li><a href="#">Sub Menu 3</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="services.html">Services</a></li>
            <li><a href="contact.html">Contact</a></li>
        </ul>
    </nav>
@endsection
@section('hero_head')
    <div class="page-header d-flex align-items-center">
        <div class="container position-relative">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6 text-center">
                    <h2><span>Event Detail</span></h2>
                    <p>Odio et unde deleniti. Deserunt numquam exercitationem. Officiis quo odio sint voluptas
                        consequatur ut a odio voluptatem. Sit dolorum debitis veritatis natus dolores. Quasi ratione
                        sint. Sit quaerat ipsum dolorem.</p>

                    <a class="cta-btn" href="contact.html">Available for hire</a>

                </div>
            </div>
        </div>
    </div><!-- End Page Header -->

    <!-- ======= Gallery Single Section ======= -->
    <section id="gallery-single" class="gallery-single">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('reservation.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-fluid mb-4" style="background-color:transparent;width:100%">
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                    <input type="hidden" name="event_id" value="{{ $event->id }}">
                                    <div class="form-outline mb-3">
                                        <p>FullName</p>
                                        <input type="text" id="fullname" class="form-control text-dark bg-light"
                                            placeholder="FullName" name="title" style="width: 500px" />
                                        @error('title')
                                            <p class="fname-error text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-outline mb-3">
                                        <p>Card Number</p>
                                        <input type="text" id="fullname" class="form-control text-dark bg-light"
                                            placeholder="**************425" name="title" style="width: 500px" />
                                        @error('title')
                                            <p class="fname-error text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="row mb-4">
                                        <div class="form-outline mb-4 col-6">
                                            <p>CVV</p>
                                            <input type="text" id="fullname" class="form-control text-dark bg-light"
                                                placeholder="ex : 113" style="width:237px" />

                                        </div>
                                        <div class="form-outline mb-4 col-6">
                                            <p>Expire date</p>
                                            <input type="text" id="fullname" class="form-control text-dark bg-light"
                                                placeholder="ex : 01/24" style="width:237px" />
                                        </div>

                                    </div>

                                    <button class="btn btn-primary p-2" type="submit" style="width: 500px">Book
                                        Now</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
            <footer class="footer pt-3  ">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-6 mb-lg-0 mb-4">
                            <div class="copyright text-center text-sm text-muted text-lg-start">
                                ©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script>,
                                made with <i class="fa fa-heart"></i> by
                                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative
                                    Tim</a>
                                for a better web.
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com" class="nav-link text-muted"
                                        target="_blank">Creative Tim</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted"
                                        target="_blank">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/blog" class="nav-link text-muted"
                                        target="_blank">Blog</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted"
                                        target="_blank">License</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </section>

    <script src="https://js.stripe.com/v3/"></script>



@endsection
