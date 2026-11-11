@extends('layouts.panel')
@section('title', $laporan->kode)
@section('heading', $laporan->nama_barang)
@section('sub', $laporan->kode.' · '.$laporan->lokasi->nama)
@section('content')
<p><a class="lnk" href="{{ route('kelola.laporan.index') }}">← Kembali ke daftar</a></p>
<div class="detail">
  <div>
    <div class="box"><div class="box-h"><h2>Data pelapor &amp; barang</h2><span class="badge s-{{ $laporan->status }}">{{ $laporan->status_label }}</span></div>
      <div class="box-b"><dl class="dl">
        <dt>Pelapor</dt><dd>{{ $laporan->pelapor->name }} ({{ $laporan->pelapor->nis_nip }})</dd>
        <dt>Kelas / unit</dt><dd>{{ $laporan->pelapor->kelas ?? '-' }}</dd>
        <dt>Kontak</dt><dd>{{ $laporan->pelapor->phone ?? $laporan->pelapor->email }}</dd>
        <dt>Jenis</dt><dd>{{ ucfirst($laporan->jenis) }} · {{ $laporan->kategori }}</dd>
        <dt>Jumlah</dt><dd>{{ $laporan->jumlah }}</dd>
        <dt>Dilaporkan</dt><dd>{{ $laporan->created_at->translatedFormat('d F Y, H:i') }}</dd>
        <dt>Deskripsi</dt><dd>{{ $laporan->deskripsi }}</dd>
      </dl>
      <h3 style="font-size:.9rem;margin:1.4rem 0 .6rem">Foto bukti dari pelapor</h3>
      @if ($laporan->foto_urls)<div class="gallery">@foreach ($laporan->foto_urls as $u)<img src="{{ $u }}" alt="Foto bukti">@endforeach</div>
      @else<span class="muted small">Pelapor tidak melampirkan foto.</span>@endif
      </div></div>

    <div class="box"><div class="box-h"><h2>Riwayat status</h2></div><div class="box-b">
      <ul class="timeline">@foreach ($laporan->logs as $log)
        <li><b>{{ \App\Models\Laporan::STATUS[$log->status] }}</b> <span class="muted">oleh {{ $log->user->name ?? 'Sistem' }}</span>
          <small>{{ $log->created_at->translatedFormat('d M Y, H:i') }}</small>@if ($log->catatan)<div>{{ $log->catatan }}</div>@endif</li>
      @endforeach</ul></div></div>
  </div>

  <div>
    <form method="POST" action="{{ route('kelola.laporan.update', $laporan) }}" enctype="multipart/form-data" class="box">
      @csrf @method('PUT')
      <div class="box-h"><h2>Tindak lanjut</h2></div>
      <div class="box-b">
        <div class="field"><label>Status</label>
          <select name="status" data-toggle>@foreach (\App\Models\Laporan::STATUS as $k => $v)<option value="{{ $k }}" @selected(old('status', $laporan->status)===$k)>{{ $v }}</option>@endforeach</select>
          @error('status')<div class="err">{{ $message }}</div>@enderror</div>
        <div class="field"><label>Prioritas</label>
          <select name="tingkat">@foreach (\App\Models\Laporan::TINGKAT as $k => $v)<option value="{{ $k }}" @selected(old('tingkat', $laporan->tingkat)===$k)>{{ $v }}</option>@endforeach</select></div>
        <div class="field"><label>Catatan petugas <span class="muted">(wajib jika ditolak)</span></label>
          <textarea name="catatan_petugas">{{ old('catatan_petugas', $laporan->catatan_petugas) }}</textarea>
          @error('catatan_petugas')<div class="err">{{ $message }}</div>@enderror</div>
        <div class="only-done">
          <div class="grid2">
            <div class="field"><label>Jenis biaya</label>
              <select name="jenis_biaya"><option value="">—</option>
                <option value="perbaikan" @selected(old('jenis_biaya', $laporan->jenis_biaya)==='perbaikan')>Perbaikan</option>
                <option value="penggantian" @selected(old('jenis_biaya', $laporan->jenis_biaya)==='penggantian')>Penggantian</option></select></div>
            <div class="field"><label>Biaya (Rp)</label><input type="number" min="0" name="biaya" value="{{ old('biaya', $laporan->biaya) }}">@error('biaya')<div class="err">{{ $message }}</div>@enderror</div>
          </div>
          <div class="field"><label>Foto hasil perbaikan</label><input type="file" name="foto_selesai" accept="image/*" data-preview="#pv2">
            <div class="previews" id="pv2">@if ($laporan->foto_selesai_url)<img src="{{ $laporan->foto_selesai_url }}" alt="">@endif</div>
            @error('foto_selesai')<div class="err">{{ $message }}</div>@enderror</div>
        </div>
        <button class="btn btn-primary" style="width:100%;justify-content:center">Simpan perubahan</button>
      </div>
    </form>
    @if (auth()->user()->isAdmin())
    <form method="POST" action="{{ route('admin.laporan.destroy', $laporan) }}" onsubmit="return confirm('Hapus laporan ini beserta fotonya?')">
      @csrf @method('DELETE')<button class="btn btn-danger btn-sm">Hapus laporan</button></form>
    @endif
  </div>
</div>
@endsection
