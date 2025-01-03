<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}" type="image/x-icon">
    @vite(['resources/js/app.js'])
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>

    <!--===== HEADER =====-->
    <header class="header" id="header">
        <nav class="nav grid">
            <div class="nav__toggle" id="nav-toggle">
                <i class='bx bxs-grid'></i>
            </div>

            <a href="{{ route('home') }}" class="nav__logo">Shoekeerman</a>

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="{{ route('home') }}"
                            class="nav__link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ route('shop') }}"
                            class="nav__link {{ request()->routeIs('shop') ? 'active' : '' }}">Shop</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ route('cart') }}"
                            class="nav__link {{ request()->routeIs('cart') ? 'active' : '' }}">Cart</a>
                    </li>

                    @guest
                        <li class="nav__item">
                            <a href="{{ route('login') }}"
                                class="nav__link {{ request()->routeIs('login') ? 'active' : '' }}">Login</a>
                        </li>
                        <li class="nav__item">
                            <a href="{{ route('register') }}"
                                class="nav__link {{ request()->routeIs('register') ? 'active' : '' }}">Register</a>
                        </li>
                    @endguest

                    @auth
                        @if (Auth::user()->role === 'admin')
                            <li class="nav__item">
                                <a href="{{ route('admin.dashboard') }}"
                                    class="nav__link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
                            </li>
                        @endif
                        <li class="nav__item">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a href="#" class="nav__link"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                        </li>
                    @endauth
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
                    <li><a href="{{ route('home') }}#home" class="footer__link">Home</a></li>
                    <li><a href="{{ route('home') }}#featured" class="footer__link">Featured</a></li>
                    <li><a href="{{ route('home') }}#women" class="footer__link">Women</a></li>
                    <li><a href="{{ route('home') }}#new" class="footer__link">New</a></li>
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
        <p class="footer__copy">&copy; {{ date('Y') }} Shoekeerman. All rights reserved.</p>
    </footer>

    <!--===== MAIN JS =====-->
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
