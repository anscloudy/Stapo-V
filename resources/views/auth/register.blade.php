<!DOCTYPE html>
<html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Daftar · SARANA STAPOV</title>
<link rel="icon" href="{{ route('gambar', 'logo_smk.png') }}">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/app.css') }}"></head>
<body>
<div class="auth">
  <div class="auth-side">
    <img src="{{ route('gambar', 'home_background.jpg') }}" alt="">
    <div><h2>Daftar sekali, lapor kapan saja.</h2><p style="color:#d4e2ec">Akun pelapor untuk siswa, guru, dan staf {{ config('stapov.nama_sekolah') }}. Akun petugas dan admin dibuat oleh admin.</p></div>
  </div>
  <div class="auth-form"><div class="auth-box">
    <a href="{{ route('home') }}" class="brand">@include('partials.brand-ico')<span><b>SARANA STAPOV</b><small>SMKN 5 Surakarta</small></span></a>
    <h1>Buat akun</h1><p class="muted" style="margin:0 0 1.2rem">Data ini muncul di laporan yang Anda kirim.</p>
    @include('partials.flash')
    <form method="POST" action="{{ route('register.store') }}">@csrf
      <div class="field"><label>Nama lengkap</label><input name="name" value="{{ old('name') }}" required></div>
      <div class="grid2">
        <div class="field"><label>NIS / NIP</label><input name="nis_nip" value="{{ old('nis_nip') }}" required></div>
        <div class="field"><label>No. HP (opsional)</label><input name="phone" value="{{ old('phone') }}"></div>
      </div>
      <div class="field"><label>Email</label><input type="email" name="email" value="{{ old('email') }}" required></div>
      <div class="field"><label>Kelas / Unit</label>
        <select name="kelas" required><option value="">Pilih…</option>
          <option value="Guru / Staf" @selected(old('kelas')==='Guru / Staf')>Guru / Staf</option>
          @foreach ($kelas as $k)<option @selected(old('kelas')===$k)>{{ $k }}</option>@endforeach
        </select></div>
      <div class="grid2">
        <div class="field"><label>Kata sandi</label><input type="password" name="password" minlength="8" required></div>
        <div class="field"><label>Ulangi kata sandi</label><input type="password" name="password_confirmation" required></div>
      </div>
      <button class="btn btn-primary" style="width:100%;justify-content:center">Daftar &amp; masuk</button>
    </form>
    <p class="small muted" style="margin-top:1.2rem">Sudah punya akun? <a class="lnk" href="{{ route('login') }}">Masuk</a></p>
  </div></div>
</div></body></html>
