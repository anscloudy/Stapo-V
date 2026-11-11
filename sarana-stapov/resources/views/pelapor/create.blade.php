@extends('layouts.panel')
@section('title', 'Form Pengaduan')
@section('heading', 'Form Pengaduan')
@section('sub', 'Laporkan kerusakan atau kehilangan fasilitas sekolah')
@section('content')
<form method="POST" action="{{ route('pelapor.laporan.store') }}" enctype="multipart/form-data" class="box" style="max-width:780px">
  @csrf
  <div class="box-h"><h2>Detail laporan</h2></div>
  <div class="box-b">
    <div class="field"><label>Jenis laporan</label>
      <div class="seg">
        <label><input type="radio" name="jenis" value="kerusakan" @checked(old('jenis','kerusakan')==='kerusakan')><span>🔧 Kerusakan</span></label>
        <label><input type="radio" name="jenis" value="kehilangan" @checked(old('jenis')==='kehilangan')><span>🔎 Kehilangan</span></label>
      </div>
      @error('jenis')<div class="err">{{ $message }}</div>@enderror</div>

    <div class="grid2">
      <div class="field"><label>Lokasi / ruang</label>
        <select name="lokasi_id" required><option value="">Pilih lokasi…</option>
          @foreach ($lokasis as $tipe => $items)
            <optgroup label="{{ \App\Models\Lokasi::TIPE[$tipe] ?? $tipe }}">
              @foreach ($items as $l)<option value="{{ $l->id }}" @selected(old('lokasi_id')==$l->id)>{{ $l->nama }}</option>@endforeach
            </optgroup>
          @endforeach
        </select>@error('lokasi_id')<div class="err">{{ $message }}</div>@enderror</div>
      <div class="field"><label>Kategori barang</label>
        <select name="kategori" required>@foreach ($kategori as $k)<option @selected(old('kategori')===$k)>{{ $k }}</option>@endforeach</select>
        @error('kategori')<div class="err">{{ $message }}</div>@enderror</div>
    </div>

    <div class="grid2">
      <div class="field"><label>Nama barang</label><input name="nama_barang" value="{{ old('nama_barang') }}" placeholder="Contoh: Proyektor, Kursi, Mesin Bubut" required>
        @error('nama_barang')<div class="err">{{ $message }}</div>@enderror</div>
      <div class="field"><label>Jumlah</label><input type="number" name="jumlah" min="1" value="{{ old('jumlah', 1) }}" required>@error('jumlah')<div class="err">{{ $message }}</div>@enderror</div>
    </div>

    <div class="field"><label>Tingkat urgensi</label>
      <select name="tingkat">@foreach (\App\Models\Laporan::TINGKAT as $k => $v)<option value="{{ $k }}" @selected(old('tingkat','sedang')===$k)>{{ $v }}</option>@endforeach</select></div>

    <div class="field"><label>Deskripsi masalah</label>
      <textarea name="deskripsi" required placeholder="Jelaskan kondisi barang, kapan terjadi, dan dampaknya.">{{ old('deskripsi') }}</textarea>
      @error('deskripsi')<div class="err">{{ $message }}</div>@enderror</div>

    <div class="field"><label>Foto bukti <span class="muted">(1–3 foto, wajib untuk kerusakan)</span></label>
      <label class="drop" for="fotos" style="font-weight:500">📷 Klik untuk memilih foto<br><span class="hint">JPG, PNG, atau WEBP · maks. 4 MB per foto</span></label>
      <input id="fotos" type="file" name="fotos[]" accept="image/*" multiple data-preview="#pv" style="display:none">
      <div class="previews" id="pv"></div>
      @error('fotos')<div class="err">{{ $message }}</div>@enderror
      @error('fotos.*')<div class="err">{{ $message }}</div>@enderror</div>

    <button class="btn btn-primary">Kirim laporan</button>
    <a class="btn btn-line" href="{{ route('pelapor.dashboard') }}">Batal</a>
  </div>
</form>
@endsection
