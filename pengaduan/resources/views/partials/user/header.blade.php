<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/beranda.css') }}">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="https://www.its.ac.id/wp-content/uploads/2021/10/logo-kominfo-transparent.png"
                        alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                    Peminjaman
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('pengajuan') }}">Form Pengajuan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('userprofil') }}">Profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('userubahpassword') }}">Ubah Password</a>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <a href="{{ route('login') }}" type="button" class="btn btn-outline-danger">Log Out</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
