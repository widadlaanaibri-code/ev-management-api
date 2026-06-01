<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <link href="#" rel="icon">
    <link href="#" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Protest+Riot&display=swap" rel="stylesheet">
    {{-- <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Cardo:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet"> --}}

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/styles.css') }}">
    <script src="https://js.stripe.com/v3/"></script>
</head>
<style>
    .bg-glass {
        background-color: hsla(0, 94%, 26%, 0.267) !important;
        backdrop-filter: saturate(200%) blur(25px);
    }

    .bg-glass2 {
        background-color: hsla(0, 0%, 0%, 0.555) !important;
        backdrop-filter: saturate(200%) blur(25px);
    }

    .custom-popup-class {
        background-color: rgb(24, 24, 24);
    }



    .error input {
        border: 3px solid red;
    }

    .success input {
        border: 3px solid green;
    }

    form span.error-msg {
        color: red;
        width: 100%;
        display: flex;
        margin-left: 30%;
        margin-bottom: 20px;
    }

    form {
        padding: 20px;
        font-family: 'Poppins', sans-serif;
    }

    form a {
        margin-left: 25%;
        text-decoration: none;
    }

    body {
        height: 100vh;
        background-image: url('images/eventobg.jpg');
        width: 100%;
        background-position: center;
        background-size: cover;
        object-fit: cover;


    }

    .cards {
        width: 100%;
        border: none;
        background-color: transparent;
        border: none;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column
    }

    .cards img {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        object-fit: cover;
    }

    .cards label {
        margin-top: 30px;
        text-align: center;
        height: 40px;
        cursor: pointer;
        font-weight: bold;
        font-size: 20px;
        margin-bottom: 10px;

    }

    .cards input {
        display: none;
    }

    .table-responsive {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .form-outline input {
        background-color: rgb(37, 37, 37);
        border: none;
        width: 100%;
        padding: 15px;
        margin-top: 30px;
        color: rgb(187, 187, 187);

    }

    .form-outline select {
        background-color: rgb(37, 37, 37);
        border: none;
        width: 100%;
        padding: 15px;
        margin-top: 30px;
        color: rgb(187, 187, 187);

    }

    .pagination {
                display: flex;
                justify-content: center;
                list-style: none;
                padding: 0;
            }

            .pagination li {
                margin: 0 5px;
            }

            .pagination li a {
                display: inline-block;
                background-color: transparent;
                color: brown;
                border: none;
                text-decoration: none;
            }

            .pagination li .active a {
                background-color: brown;
                color: #6d0000;
            }
</style>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center fixed-top" style="background-color: transparent">
        <div class="container-fluid d-flex align-items-center justify-content-between">

            <a href="/" class="logo d-flex align-items-center  me-auto me-lg-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <div class="logo">E v e n t o</div>
            </a>

            @yield('nav')<!-- .navbar -->

            <div class="header-social-links d-flex gap-3">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('authentication') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a href="{{ route('admin.profile') }}">
                            @if (Auth::user()->hasMedia('media/users'))
                                <img src="{{ Auth::user()->getFirstMediaUrl('media/users') }}" alt=""
                                    srcset="" style="width: 40px;height:40px;border-radius:50%;margin-right:5px;">
                            @elseif (Auth::user()->provider == 'google')
                                <img src="{{ Auth::user()->avatar }}" alt=""
                                    srcset="" style="width: 40px;height:40px;border-radius:50%;margin-right:5px;">
                            @else
                                <img src="{{ asset('images/avatar.jfif') }}" alt="" srcset=""
                                    style="width: 40px;height:40px;border-radius:50%;margin-right:5px;">
                            @endif
                        </a>

                        <a id="navbarDropdown" class="nav-link" href="#" role="button">
                            {{ Auth::user()->name }}
                        </a>

                        <a class="nav-link" role="button" style="color:brown;" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endguest
            </div>

            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero d-flex flex-column justify-content-center align-items-center" data-aos="fade"
        data-aos-delay="1500" style="background-color: transparent">
        @yield('hero_head')
    </section><!-- End Hero Section -->

    <main id="main" data-aos="fade" data-aos-delay="1500">

        @yield('content')


    </main>

    <!-- ======= Footer ======= -->
    @yield('footer')<!-- End Footer -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <div id="preloader">
        <div class="line"></div>
    </div>


    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('js/form.js') }}"></script>
    <script src="{{ asset('js/login.js') }}"></script>
    <script src="{{ asset('js/search.js') }}"></script>


    @if (session('status'))
        <script>
            setTimeout(function() {
                Swal.fire({
                    title: 'Success',
                    text: '{{ session('status') }}',
                    icon: 'success',
                    confirmButtonClass: 'btn btn-success',
                    confirmButtonText: 'Cancel',
                    confirmButtonColor: 'rgb(102, 102, 245)',
                    background: 'rgb(24, 24, 24)',
                    customClass: {
                        popup: 'custom-popup-class'
                    }
                });
            }, {{ session('delay', 0) }});
        </script>
    @endif


</body>

</html>
