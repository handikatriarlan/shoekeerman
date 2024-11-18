<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>

    <!--===== HEADER =====-->
    <header class="header" id="header">
        <nav class="nav grid">
            <div class="nav__toggle" id="nav-toggle">
                <i class='bx bxs-grid'></i>
            </div>

            <a href="#" class="nav__logo">Shoekeerman</a>

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item"><a href="{{ route('home') }}#home" class="nav__link active">Home</a></li>
                    <li class="nav__item"><a href="{{ route('home') }}#featured" class="nav__link">Featured</a></li>
                    <li class="nav__item"><a href="{{ route('home') }}#women" class="nav__link">Women</a></li>
                    <li class="nav__item"><a href="{{ route('home') }}#new" class="nav__link">New</a></li>
                    <li class="nav__item"><a href="{{ route('shop') }}" class="nav__link">Shop</a></li>
                    <li class="nav__item"><a href="{{ route('shop') }}" class="nav__link">Cart</a></li>
                </ul>
            </div>

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item"><a href="{{ route('login') }}" class="nav__link">Login</a></li>
                    <li class="nav__item"><a href="{{ route('register') }}" class="nav__link">Register</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="main">
        @yield('content')
    </main>

    <!--===== FOOTER =====-->
    <footer class="footer section">
        <div class="footer__container grid">
            <div class="footer__box">
                <h3 class="footer__title">Shoekeerman</h3>
                <p class="footer__description">New collection of shoes 2020.</p>
            </div>

            <div class="footer__box">
                <h3 class="footer__title">EXPLORE</h3>
                <ul>
                    <li><a href="#home" class="footer__link">Home</a></li>
                    <li><a href="#featured" class="footer__link">Featured</a></li>
                    <li><a href="#women" class="footer__link">Women</a></li>
                    <li><a href="#new" class="footer__link">New</a></li>
                </ul>
            </div>

            <div class="footer__box">
                <h3 class="footer__title">SUPPORT</h3>
                <ul>
                    <li><a href="#" class="footer__link">Product Help</a></li>
                    <li><a href="#" class="footer__link">Customer Care</a></li>
                    <li><a href="#" class="footer__link">Athorized service</a></li>
                </ul>
            </div>

            <div class="footer__box">
                <a href="#" class="footer__social"><i class='bx bxl-facebook'></i></a>
                <a href="#" class="footer__social"><i class='bx bxl-instagram'></i></a>
                <a href="#" class="footer__social"><i class='bx bxl-twitter'></i></a>
                <a href="#" class="footer__social"><i class='bx bxl-google'></i></a>
            </div>
        </div>
        <p class="footer__copy">&#169; 2020 Bedimcode. All right reserved</p>
    </footer>

    <!--===== MAIN JS =====-->
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
