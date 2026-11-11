@extends('layouts.panel')
@section('title', 'Profil Saya')
@section('heading', 'Profil Saya')
@section('content')
<div class="box" style="max-width:640px"><div class="box-h"><h2>Data akun</h2><span class="badge r-{{ $user->role }}">{{ $user->peran_label }}</span></div>
<div class="box-b">
<form method="POST" action="{{ route('profil.update') }}">@csrf @method('PUT')
  <div class="field"><label>Nama lengkap</label><input name="name" value="{{ old('name', $user->name) }}" required></div>
  <div class="grid2">
    <div class="field"><label>Email</label><input type="email" name="email" value="{{ old('email', $user->email) }}" required></div>
    <div class="field"><label>No. HP</label><input name="phone" value="{{ old('phone', $user->phone) }}"></div>
  </div>
  <div class="grid2">
    <div class="field"><label>NIS / NIP</label><input value="{{ $user->nis_nip }}" disabled></div>
    @if ($user->isPelapor())
    <div class="field"><label>Kelas / Unit</label>
      <select name="kelas"><option value="Guru / Staf" @selected($user->kelas==='Guru / Staf')>Guru / Staf</option>
        @foreach ($kelas as $k)<option @selected(old('kelas', $user->kelas)===$k)>{{ $k }}</option>@endforeach</select></div>
    @endif
  </div>
  <h3 style="font-size:.95rem;margin:1rem 0">Ganti kata sandi <span class="muted small">(kosongkan jika tidak diubah)</span></h3>
  <div class="grid2">
    <div class="field"><input type="password" name="password" placeholder="Kata sandi baru" minlength="8"></div>
    <div class="field"><input type="password" name="password_confirmation" placeholder="Ulangi kata sandi"></div>
  </div>
  <button class="btn btn-primary">Simpan perubahan</button>
</form></div></div>
@endsection
