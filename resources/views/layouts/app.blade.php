<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Boostrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">
    <style>
        body {
            margin-top: 70px;
            font-family: 'Poppins', sans-serif;
        }

        .navbar-brand {
            color: #FF6B6B;
        }

        .navbar-brand i {
            color: #FFD166;
        }

        .nav-link {
            color: #FF6B6B;
        }

        .nav-link:hover {
            color: #FFD166;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #f0f0f0;
            padding: 10px 0;
            box-shadow: 0px -2px 4px rgba(0, 0, 0, 0.1);
        }

        .footer span {
            font-size: 14px;
            font-weight: bold;
        }

        .footer a {
            color: #FF6B6B;
            text-decoration: none;
        }

        .footer a:hover {
            color: #FFD166;
        }
    </style>

    {{-- @vite(['resources/js/app.js']) --}}

</head>

<body>
    <div class="loader-container">
        <div class="loader"></div>
    </div>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
            <div class="container">
                <a class="navbar-brand fw-bold" href="{{ route('index_menu') }}">
                    <i class="fas fa-utensils"></i> KateringKu
                </a>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto"></ul>

                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <i class="fas fa-sign-in-alt"></i> Login
                                    </a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">
                                        <i class="fas fa-user-plus"></i> Register
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('show_profile') }}">
                                        <i class="fa-solid fa-user-circle" style="color: #FF6B6B;"></i> Profil
                                    </a>
                                    @if (Auth::user()->is_admin)
                                        <a class="dropdown-item" href="{{ route('home') }}">
                                            <i class="fa-solid fa-cash-register" style="color: #FF6B6B;"></i> Transaksi
                                        </a>
                                        <a class="dropdown-item" href="{{ route('create_menu') }}">
                                            <i class="fa-solid fa-plus-circle" style="color: #FF6B6B;"></i> Buat Menu Baru
                                        </a>
                                    @else
                                        <a class="dropdown-item" href="{{ route('show_cart') }}">
                                            <i class="fa-solid fa-shopping-cart" style="color: #FF6B6B;"></i> Keranjang
                                        </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('index_menu') }}">
                                        <i class="fa-solid fa-utensils" style="color: #FF6B6B;"></i> Menu
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                            if (confirm('Apakah kamu yakin ingin logout?')) {
                                                document.getElementById('logout-form').submit();
                                            }">
                                        <i class="fa-solid fa-sign-out-alt" style="color: #FF6B6B;"></i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <main class="py-4">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container text-center">
            <span class="fw-bold">Made with <font color="red">💖</font> from <a
                    href="https://www.linkedin.com/in/okky-rafa-nuggraha-4a6857260/">okkism</a></span>
        </div>
    </footer>

    <script>
        window.addEventListener("load", function() {
            // Simulating a delay for demonstration purposes
            setTimeout(function() {
                document.querySelector(".loader-container").style.display = "none";
            }, 1000);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>
