@extends('layout.base')

@section('title', 'Home')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> <!-- Asumsi menggunakan Bootstrap -->
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">My Website</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto"> <!-- ms-auto untuk menempatkan di sebelah kanan -->
                  @if (Auth::check())
                  <!-- Tampilkan nama user jika sudah login -->
                  <li class="nav-item">
                      <span class="nav-link">Hello, {{ Auth::user()->name }}</span>
                  </li>
                  <!-- Tombol Logout -->
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('logout') }}"
                         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                          Logout
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  </li>
              @else
                  <!-- Tombol Login jika belum login -->
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('login') }}">Login</a>
                  </li>
              @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
      <img src="/assets/img/foto-alvin-1.jpg" alt="" data-aos="fade-in" class="img-fluid">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <h2>Ahmad Alvin Jauhari</h2>
        <p>
          <span class="typed" data-typed-items="Pemrograman Berbasis Kerangka Kerja B, 5025221180">
            Pemrograman Berbasis Kerangka Kerja B
          </span>
          <span class="typed-cursor typed-cursor--blink" aria-hidden="true"></span>
        </p>
      </div>
    </section><!-- /Hero Section -->

    <script src="{{ asset('js/app.js') }}"></script> <!-- Asumsi menggunakan Bootstrap JS -->
</body>
</html>
@endsection
