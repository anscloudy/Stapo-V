@extends('layouts.public')
@section('title', 'Cek Status Laporan')
@section('content')
<section class="slide" style="min-height:70vh">
  <div class="wrap" style="max-width:720px">
    <div class="sec-head"><small>CEK STATUS</small><h2>Lacak Laporan Anda</h2><p>Masukkan kode laporan (contoh: STP-261020-AB12). Tidak perlu login.</p></div>
    <form method="GET" class="box"><div class="box-b" style="display:flex;gap:.7rem">
      <input name="kode" value="{{ $kode }}" placeholder="STP-YYMMDD-XXXX" required>
      <button class="btn btn-primary">Cari</button>
    </div></form>

    @if ($kode && ! $laporan)
      <div class="flash bad">Laporan dengan kode <b>{{ $kode }}</b> tidak ditemukan. Periksa kembali kodenya.</div>
    @endif

    @if ($laporan)
    <div class="box"><div class="box-h"><h2>{{ $laporan->nama_barang }}</h2><span class="badge s-{{ $laporan->status }}">{{ $laporan->status_label }}</span></div>
      <div class="box-b">
        <dl class="dl">
          <dt>Kode</dt><dd>{{ $laporan->kode }}</dd>
          <dt>Lokasi</dt><dd>{{ $laporan->lokasi->nama }}</dd>
          <dt>Jenis</dt><dd>{{ ucfirst($laporan->jenis) }}</dd>
          <dt>Dilaporkan</dt><dd>{{ $laporan->created_at->translatedFormat('d F Y') }}</dd>
          @if ($laporan->tanggal_selesai)<dt>Selesai</dt><dd>{{ $laporan->tanggal_selesai->translatedFormat('d F Y') }}</dd>@endif
        </dl>
        <h3 style="font-size:.95rem;margin:1.4rem 0 .8rem">Riwayat status</h3>
        <ul class="timeline">
          @foreach ($laporan->logs as $log)
            <li><b>{{ \App\Models\Laporan::STATUS[$log->status] ?? $log->status }}</b><small>{{ $log->created_at->translatedFormat('d M Y, H:i') }}</small></li>
          @endforeach
        </ul>
      </div>
    </div>
    @endif
  </div>
</section>
@endsection
