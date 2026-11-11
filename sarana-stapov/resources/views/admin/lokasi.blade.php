@extends('layouts.panel')
@section('title', 'Lokasi & Ruang')
@section('heading', 'Lokasi & Ruang')
@section('sub', 'Daftar kelas, bengkel, laboratorium, dan fasilitas umum SMKN 5 Surakarta')
@section('content')
@error('hapus')<div class="flash bad">{{ $message }}</div>@enderror
<div class="detail" style="grid-template-columns:1fr 340px">
  <div class="box">
    <div class="box-h"><form class="filters" method="GET"><input name="q" value="{{ request('q') }}" placeholder="Cari lokasi…">
      <select name="tipe" onchange="this.form.submit()"><option value="">Semua tipe</option>@foreach (\App\Models\Lokasi::TIPE as $k => $v)<option value="{{ $k }}" @selected(request('tipe')===$k)>{{ $v }}</option>@endforeach</select></form></div>
    <div class="tbl-wrap"><table><thead><tr><th>Nama</th><th>Tipe</th><th>Jurusan</th><th>Laporan</th><th></th></tr></thead><tbody>
      @foreach ($lokasis as $l)
        <tr><td><b>{{ $l->nama }}</b></td><td>{{ \App\Models\Lokasi::TIPE[$l->tipe] ?? $l->tipe }}</td><td>{{ $l->jurusan ?? '-' }}</td><td>{{ $l->laporans_count }}</td>
          <td style="white-space:nowrap"><a class="btn btn-line btn-sm" href="{{ route('admin.lokasi.index', ['edit' => $l->id]) }}">Ubah</a>
            <form method="POST" action="{{ route('admin.lokasi.destroy', $l) }}" style="display:inline" onsubmit="return confirm('Hapus lokasi ini?')">@csrf @method('DELETE')<button class="btn btn-danger btn-sm">Hapus</button></form></td></tr>
      @endforeach</tbody></table></div>
    <div class="pager">{{ $lokasis->links() }}</div>
  </div>

  <form class="box" method="POST" action="{{ $edit ? route('admin.lokasi.update', $edit) : route('admin.lokasi.store') }}" style="align-self:start">
    @csrf @if ($edit) @method('PUT') @endif
    <div class="box-h"><h2>{{ $edit ? 'Ubah lokasi' : 'Tambah lokasi' }}</h2>@if ($edit)<a class="lnk" href="{{ route('admin.lokasi.index') }}">Batal</a>@endif</div>
    <div class="box-b">
      <div class="field"><label>Nama ruang</label><input name="nama" value="{{ old('nama', $edit->nama ?? '') }}" required>@error('nama')<div class="err">{{ $message }}</div>@enderror</div>
      <div class="field"><label>Tipe</label><select name="tipe">@foreach (\App\Models\Lokasi::TIPE as $k => $v)<option value="{{ $k }}" @selected(old('tipe', $edit->tipe ?? 'kelas')===$k)>{{ $v }}</option>@endforeach</select></div>
      <div class="field"><label>Jurusan <span class="muted">(opsional)</span></label><select name="jurusan"><option value="">—</option>@foreach (config('stapov.jurusan') as $k => $j)<option value="{{ $k }}" @selected(old('jurusan', $edit->jurusan ?? '')===$k)>{{ $k }} — {{ $j['nama'] }}</option>@endforeach</select></div>
      <button class="btn btn-primary" style="width:100%;justify-content:center">{{ $edit ? 'Simpan' : 'Tambah' }}</button>
    </div>
  </form>
</div>
@endsection
