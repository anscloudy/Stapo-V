@extends('layouts.panel')
@section('title', $laporan->kode)
@section('heading', $laporan->nama_barang)
@section('sub', $laporan->kode.' · '.$laporan->lokasi->nama)
@section('content')
<p><a class="lnk" href="{{ route('pelapor.laporan.index') }}">← Kembali ke riwayat</a></p>
<div class="detail">
  <div>
    <div class="box"><div class="box-h"><h2>Rincian laporan</h2><span class="badge s-{{ $laporan->status }}">{{ $laporan->status_label }}</span></div>
      <div class="box-b"><dl class="dl">
        <dt>Jenis</dt><dd>{{ ucfirst($laporan->jenis) }}</dd>
        <dt>Kategori</dt><dd>{{ $laporan->kategori }}</dd>
        <dt>Jumlah</dt><dd>{{ $laporan->jumlah }}</dd>
        <dt>Urgensi</dt><dd>{{ \App\Models\Laporan::TINGKAT[$laporan->tingkat] }}</dd>
        <dt>Dilaporkan</dt><dd>{{ $laporan->created_at->translatedFormat('d F Y, H:i') }}</dd>
        <dt>Deskripsi</dt><dd>{{ $laporan->deskripsi }}</dd>
      </dl>
      @if ($laporan->foto_urls)<h3 style="font-size:.9rem;margin:1.4rem 0 .6rem">Foto bukti</h3><div class="gallery">@foreach ($laporan->foto_urls as $u)<img src="{{ $u }}" alt="Foto bukti">@endforeach</div>@endif
      </div></div>

    @if ($laporan->catatan_petugas || $laporan->foto_selesai_url || $laporan->biaya)
    <div class="box"><div class="box-h"><h2>Tanggapan petugas</h2></div><div class="box-b">
      @if ($laporan->catatan_petugas)<p style="margin-top:0">{{ $laporan->catatan_petugas }}</p>@endif
      @if ($laporan->status === 'selesai' && $laporan->biaya)<p class="muted small">Biaya {{ $laporan->jenis_biaya ?? 'penanganan' }}: <b>Rp {{ number_format($laporan->biaya, 0, ',', '.') }}</b></p>@endif
      @if ($laporan->foto_selesai_url)<div class="gallery"><img src="{{ $laporan->foto_selesai_url }}" alt="Foto hasil"></div>@endif
    </div></div>
    @endif
  </div>
  <div class="box"><div class="box-h"><h2>Riwayat status</h2></div><div class="box-b">
    <ul class="timeline">@foreach ($laporan->logs as $log)
      <li><b>{{ \App\Models\Laporan::STATUS[$log->status] ?? ucfirst($log->status) }}</b> <span class="muted">oleh {{ $log->user->name ?? 'Sistem' }}</span>
        <small>{{ $log->created_at->translatedFormat('d M Y, H:i') }}</small>@if ($log->catatan)<div>{{ $log->catatan }}</div>@endif</li>
    @endforeach</ul></div></div>
</div>
@endsection
