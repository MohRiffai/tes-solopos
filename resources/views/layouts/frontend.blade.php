<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/0e035b9984.js" crossorigin="anonymous"></script>
</head>

<body>
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
                    <li class="nav-item">
                        @if (isset(auth()->user()->name))
                            <a class="nav-link active bg-warning text-black" href="{{ url('dashboard') }}">Dashboard</a>
                        @else
                            {{-- <a class="nav-link active" href="{{ url('login') }}">Login</a> --}}
                        @endif
                    </li>
                    {{-- <form class="d-flex mx-3 my-auto">
                        <input class="form-control me-2" type="search" placeholder="Cari berita..." aria-label="Search">
                        <button class="btn btn-outline-light" type="submit"><i class="fas fa-search"></i></button>
                    </form> --}}
                    <form class="d-flex mx-3 my-auto" action="{{ route('search') }}" method="GET">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i> <!-- Ikon search dari Font Awesome -->
                            </span>
                            <input class="form-control" type="search" name="keywords" placeholder="Cari berita..." aria-label="Search">
                        </div>
                    </form>                                      
                </ul>
            </div>
        </div>
    </nav>
    <!-- end navbar-->
    <!-- Main -->
    <div class="clearfix  mt-5 pt-4"></div>
    <div class="main mt-4">
        @yield('content')
    </div>
    <!-- End Main -->
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
