<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title', 'SARANA STAPOV') · {{ config('stapov.nama_sekolah') }}</title>
<link rel="icon" href="{{ route('gambar', 'logo_smk.png') }}">
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="progress" aria-hidden="true"><i></i></div>
<header class="nav">
  <div class="wrap">
    <a href="{{ route('home') }}" class="brand">
      @include('partials.brand-ico')
      <span><b>SARANA STAPOV</b><small>SMKN 5 Surakarta</small></span>
    </a>
    <nav class="nav-links">
      <a href="{{ auth()->check() && auth()->user()->isPelapor() ? route('pelapor.laporan.create') : route('login') }}">Buat Laporan</a>
      <a href="{{ auth()->check() && auth()->user()->isPelapor() ? route('pelapor.laporan.index') : route('login') }}">Riwayat Saya</a>
      <a href="{{ route('tentang') }}" class="{{ request()->routeIs('tentang') ? 'on' : '' }}">Tentang</a>
      <a href="{{ route('panduan') }}" class="{{ request()->routeIs('panduan') ? 'on' : '' }}">Panduan</a>
    </nav>
    <div class="nav-right">
      @auth
        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm">Dashboard</a>
      @else
        <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Masuk</a>
      @endauth
      <button class="burger" type="button" aria-label="Menu" aria-expanded="false">@include('partials.icon', ['n' => 'menu'])</button>
    </div>
  </div>
</header>
<main class="public">@yield('content')</main>
<footer class="foot">
  <div class="wrap">
    <a href="{{ route('home') }}" class="brand">@include('partials.brand-ico')<span><b>SARANA STAPOV</b><small>© {{ date('Y') }} {{ config('stapov.nama_sekolah') }}. All rights reserved.</small></span></a>
    <span>Sistem Pengaduan Sarana &amp; Prasarana Sekolah · {{ config('stapov.alamat') }}</span>
  </div>
</footer>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
