<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title', 'Dashboard') · SARANA STAPOV</title>
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
@php $u = auth()->user(); @endphp
<div class="panel">
  <aside class="side">
    <a href="{{ route('home') }}" class="brand">
      <span class="brand-ico">🏫</span>
      <span><b>SARANA STAPOV</b><small>{{ $u->isPelapor() ? 'Portal Siswa/Guru' : ($u->isAdmin() ? 'Panel Admin' : 'Panel Petugas') }}</small></span>
    </a>
    <nav>
      @if ($u->isPelapor())
        <a href="{{ route('pelapor.dashboard') }}" class="{{ request()->routeIs('pelapor.dashboard') ? 'on' : '' }}">🏠 Dashboard</a>
        <a href="{{ route('pelapor.laporan.create') }}" class="{{ request()->routeIs('pelapor.laporan.create') ? 'on' : '' }}">➕ Form Pengaduan</a>
        <a href="{{ route('pelapor.laporan.index') }}" class="{{ request()->routeIs('pelapor.laporan.index','pelapor.laporan.show') ? 'on' : '' }}">📋 Riwayat Laporan</a>
      @else
        <a href="{{ route('kelola.dashboard') }}" class="{{ request()->routeIs('kelola.dashboard') ? 'on' : '' }}">🏠 Dashboard</a>
        <a href="{{ route('kelola.laporan.index') }}" class="{{ request()->routeIs('kelola.laporan.*') ? 'on' : '' }}">📥 Laporan Masuk</a>
        <a href="{{ route('kelola.rekap') }}" class="{{ request()->routeIs('kelola.rekap') ? 'on' : '' }}">🧾 Rekap &amp; Biaya</a>
        @if ($u->isAdmin())
          <h6>Data Master</h6>
          <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'on' : '' }}">👥 Pengguna</a>
          <a href="{{ route('admin.lokasi.index') }}" class="{{ request()->routeIs('admin.lokasi.*') ? 'on' : '' }}">📍 Lokasi &amp; Ruang</a>
        @endif
      @endif
      <a href="{{ route('profil') }}" class="{{ request()->routeIs('profil') ? 'on' : '' }}">👤 Profil Saya</a>
      <a href="{{ route('home') }}">🌐 Halaman Utama</a>
    </nav>
    <form class="out" method="POST" action="{{ route('logout') }}">@csrf<button type="submit">↩ Keluar</button></form>
  </aside>
  <div>
    <div class="top">
      <div>
        <h1>@yield('heading', 'Halo, <em>'.e($u->name).'</em> 👋')</h1>
        <div class="muted small">@yield('sub', ucfirst($u->role).($u->kelas ? ' · '.$u->kelas : '').($u->nis_nip ? ' · '.$u->nis_nip : ''))</div>
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
