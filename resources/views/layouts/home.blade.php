<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Portal Berita</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <!-- Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/0e035b9984.js" crossorigin="anonymous"></script>

    <!-- Custom CSS (opsional) -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
</head>
<body style="font-family: 'Poppins', sans-serif;">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-custom shadow-sm py-3 fixed-top bg-success">
    <div class="container">
        <a class="navbar-brand text-white" href="{{ url('/') }}"><b>{{ config('app.name') }}</b></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon text-dark pt-2"><i class="fas fa-bars"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <!-- If user is logged in -->
                @if (auth()->check())
                    <li class="nav-item">
                        <a class="nav-link active bg-warning text-black" href="{{ url('dashboard') }}">Dashboard</a>
                    </li>
                <!-- If user is not logged in -->
                @else
                    <li class="nav-item">
                        <a class="d-flex mx-3 nav-link btn btn-light text-success" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-warning text-success" href="{{ route('register') }}">Register</a>
                    </li>
                @endif
                <form class="d-flex mx-3 my-auto" action="{{ route('search') }}" method="GET">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                        <input class="form-control" type="search" name="keywords" placeholder="Cari berita..." aria-label="Search">
                    </div>
                </form>                                      
            </ul>
        </div>
    </div>
</nav>

    <!-- End Navbar -->

    <!-- Spacer biar isi nggak ketutup navbar -->
    <div style="padding-top: 90px;"></div>

    <!-- Content -->
    <div class="container">
        @yield('content')
    </div>

    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>
</html>
