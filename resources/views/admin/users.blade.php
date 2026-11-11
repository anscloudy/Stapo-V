@extends('layouts.panel')
@section('title', 'Pengguna')
@section('heading', 'Kelola Pengguna')
@section('sub', 'Admin, petugas, dan pelapor')
@section('content')
<div class="detail w340">
  <div class="box">
    <div class="box-h"><form class="filters" method="GET"><input name="q" value="{{ request('q') }}" placeholder="Cari nama, email, NIS…">
      <select name="role" onchange="this.form.submit()"><option value="">Semua peran</option>@foreach (['admin','petugas','pelapor'] as $r)<option @selected(request('role')===$r)>{{ $r }}</option>@endforeach</select></form></div>
    <div class="tbl-wrap"><table><thead><tr><th>Nama</th><th>NIS/NIP</th><th>Peran</th><th></th></tr></thead><tbody>
      @foreach ($users as $u)
        <tr><td><b>{{ $u->name }}</b><br><span class="muted small">{{ $u->email }}</span></td><td>{{ $u->nis_nip }}</td><td><span class="badge r-{{ $u->role }}">{{ $u->peran_label }}</span></td>
          <td style="white-space:nowrap"><a class="btn btn-line btn-sm" href="{{ route('admin.users.index', ['edit' => $u->id]) }}">Ubah</a>
            @if ($u->id !== auth()->id())<form method="POST" action="{{ route('admin.users.destroy', $u) }}" style="display:inline" onsubmit="return confirm('Hapus pengguna ini? Laporannya ikut terhapus.')">@csrf @method('DELETE')<button class="btn btn-danger btn-sm">Hapus</button></form>@endif</td></tr>
      @endforeach</tbody></table></div>
    <div class="pager">{{ $users->links() }}</div>
  </div>

  <form class="box" method="POST" action="{{ $edit ? route('admin.users.update', $edit) : route('admin.users.store') }}" style="align-self:start">
    @csrf @if ($edit) @method('PUT') @endif
    <div class="box-h"><h2>{{ $edit ? 'Ubah pengguna' : 'Tambah pengguna' }}</h2>@if ($edit)<a class="lnk" href="{{ route('admin.users.index') }}">Batal</a>@endif</div>
    <div class="box-b">
      <div class="field"><label>Nama</label><input name="name" value="{{ old('name', $edit->name ?? '') }}" required>@error('name')<div class="err">{{ $message }}</div>@enderror</div>
      <div class="field"><label>Email</label><input type="email" name="email" value="{{ old('email', $edit->email ?? '') }}" required>@error('email')<div class="err">{{ $message }}</div>@enderror</div>
      <div class="field"><label>NIS / NIP</label><input name="nis_nip" value="{{ old('nis_nip', $edit->nis_nip ?? '') }}">@error('nis_nip')<div class="err">{{ $message }}</div>@enderror</div>
      <div class="field"><label>Peran</label><select name="role">@foreach (['pelapor','petugas','admin'] as $r)<option value="{{ $r }}" @selected(old('role', $edit->role ?? 'petugas')===$r)>{{ ucfirst($r) }}</option>@endforeach</select>@error('role')<div class="err">{{ $message }}</div>@enderror</div>
      <div class="field"><label>Kelas / unit</label><input name="kelas" value="{{ old('kelas', $edit->kelas ?? '') }}"></div>
      <div class="field"><label>No. HP</label><input name="phone" value="{{ old('phone', $edit->phone ?? '') }}"></div>
      <div class="field"><label>Kata sandi @if ($edit)<span class="muted">(kosongkan jika tetap)</span>@endif</label><input type="password" name="password" minlength="8" @required(!$edit)>@error('password')<div class="err">{{ $message }}</div>@enderror</div>
      @error('hapus')<div class="err">{{ $message }}</div>@enderror
      <button class="btn btn-primary" style="width:100%;justify-content:center">{{ $edit ? 'Simpan' : 'Tambah' }}</button>
    </div>
  </form>
</div>
@endsection
