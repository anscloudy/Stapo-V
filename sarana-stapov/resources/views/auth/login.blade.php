<!DOCTYPE html>
<html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Masuk · SARANA STAPOV</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/app.css') }}"></head>
<body>
<div class="auth">
  <div class="auth-side">
    <img src="{{ asset('images/hero.jpg') }}" alt="" onerror="this.onerror=null;this.src='https://picsum.photos/seed/smkn5-classroom/1200/1600'">
    <div><h2>Satu pintu untuk semua laporan sarana sekolah.</h2><p style="color:#d4e2ec">Laporkan kapan saja tanpa harus bertemu petugas. Pantau statusnya sampai selesai.</p></div>
  </div>
  <div class="auth-form"><div class="auth-box">
    <a href="{{ route('home') }}" class="brand"><span class="brand-ico">🏫</span><span><b>SARANA STAPOV</b><small>SMKN 5 Surakarta</small></span></a>
    <h1>Masuk</h1><p class="muted" style="margin:0 0 1.5rem">Gunakan email atau NIS/NIP Anda.</p>
    @include('partials.flash')
    <form method="POST" action="{{ route('login.attempt') }}">@csrf
      <div class="field"><label>Email atau NIS/NIP</label><input name="identitas" value="{{ old('identitas') }}" required autofocus></div>
      <div class="field"><label>Kata sandi</label><input type="password" name="password" required></div>
      <label style="display:flex;gap:.5rem;font-weight:500;align-items:center"><input type="checkbox" name="ingat" style="width:auto"> Ingat saya</label>
      <button class="btn btn-primary" style="width:100%;justify-content:center;margin-top:1.2rem">Masuk</button>
    </form>
    <p class="small muted" style="margin-top:1.4rem">Belum punya akun? <a class="lnk" href="{{ route('register') }}">Daftar sebagai siswa/guru</a></p>
    <p class="small"><a class="lnk" href="{{ route('home') }}">← Kembali ke beranda</a></p>
  </div></div>
</div></body></html>
