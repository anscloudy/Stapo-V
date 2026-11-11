<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title', 'Dashboard') · SARANA STAPOV</title>
<link rel="icon" href="{{ route('gambar', 'logo_smk.png') }}">
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
@php
  $u = auth()->user();
  $subDefault = collect([$u->peran_label, $u->kelas !== 'Guru / Staf' ? $u->kelas : null, $u->nis_nip])->filter()->implode(' · ');
@endphp
<div class="panel">
  <div class="scrim" data-menu-close></div>
  <aside class="side" id="side">
    <div class="side-head">
      <a href="{{ route('home') }}" class="brand">
        @include('partials.brand-ico')
        <span><b>SARANA STAPOV</b><small>{{ $u->isPelapor() ? 'Portal Siswa/Guru' : ($u->isAdmin() ? 'Panel Admin' : 'Panel Petugas') }}</small></span>
      </a>
      <button class="menu-close" type="button" data-menu-close aria-label="Tutup menu">@include('partials.icon', ['n' => 'x'])</button>
    </div>
    <nav>
      @if ($u->isPelapor())
        <a href="{{ route('pelapor.dashboard') }}" class="{{ request()->routeIs('pelapor.dashboard') ? 'on' : '' }}">@include('partials.icon', ['n' => 'home'])<span>Dashboard</span></a>
        <a href="{{ route('pelapor.laporan.create') }}" class="{{ request()->routeIs('pelapor.laporan.create') ? 'on' : '' }}">@include('partials.icon', ['n' => 'plus'])<span>Form Pengaduan</span></a>
        <a href="{{ route('pelapor.laporan.index') }}" class="{{ request()->routeIs('pelapor.laporan.index','pelapor.laporan.show') ? 'on' : '' }}">@include('partials.icon', ['n' => 'clipboard'])<span>Riwayat Laporan</span></a>
      @else
        <a href="{{ route('kelola.dashboard') }}" class="{{ request()->routeIs('kelola.dashboard') ? 'on' : '' }}">@include('partials.icon', ['n' => 'home'])<span>Dashboard</span></a>
        <a href="{{ route('kelola.laporan.index') }}" class="{{ request()->routeIs('kelola.laporan.*') ? 'on' : '' }}">@include('partials.icon', ['n' => 'inbox'])<span>Laporan Masuk</span></a>
        <a href="{{ route('kelola.rekap') }}" class="{{ request()->routeIs('kelola.rekap') ? 'on' : '' }}">@include('partials.icon', ['n' => 'receipt'])<span>Rekap &amp; Biaya</span></a>
        @if ($u->isAdmin())
          <h6>Data Master</h6>
          <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'on' : '' }}">@include('partials.icon', ['n' => 'users'])<span>Pengguna</span></a>
          <a href="{{ route('admin.lokasi.index') }}" class="{{ request()->routeIs('admin.lokasi.*') ? 'on' : '' }}">@include('partials.icon', ['n' => 'pin'])<span>Lokasi &amp; Ruang</span></a>
        @endif
      @endif
      <h6>Akun</h6>
      <a href="{{ route('profil') }}" class="{{ request()->routeIs('profil') ? 'on' : '' }}">@include('partials.icon', ['n' => 'user'])<span>Profil Saya</span></a>
      <a href="{{ route('home') }}">@include('partials.icon', ['n' => 'globe'])<span>Halaman Utama</span></a>
    </nav>
    <form class="out" method="POST" action="{{ route('logout') }}">@csrf<button type="submit">@include('partials.icon', ['n' => 'logout'])<span>Keluar</span></button></form>
  </aside>
  <div class="main">
    <div class="top">
      <button class="menu-btn" type="button" data-menu-open aria-label="Buka menu" aria-controls="side">@include('partials.icon', ['n' => 'menu'])</button>
      <div class="top-t">
        <h1>@hasSection('heading')@yield('heading')@else Halo, <em>{{ $u->name }}</em> 👋 @endif</h1>
        <div class="muted small">@yield('sub', $subDefault)</div>
      </div>
      <a href="{{ route('profil') }}" class="avatar" title="Profil">{{ $u->inisial }}</a>
    </div>
    <div class="content">
      @include('partials.flash')
      @yield('content')
    </div>
  </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
