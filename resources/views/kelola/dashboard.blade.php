@extends('layouts.panel')
@section('title', 'Dashboard')
@section('content')
<div class="cards3">
  @include('partials.kpi', ['tag' => 'Semua', 'tone' => 'blue', 'n' => $total, 'title' => 'Total Laporan', 'meta' => 'Semua status'])
  @include('partials.kpi', ['tag' => 'Baru', 'tone' => 'warn', 'n' => $perStatus['diajukan'] ?? 0, 'title' => 'Menunggu Verifikasi', 'meta' => 'Perlu ditinjau'])
  @include('partials.kpi', ['tag' => 'Diproses', 'tone' => 'violet', 'n' => $perStatus['diverifikasi'] ?? 0, 'title' => 'Laporan Diproses', 'meta' => 'Belum selesai'])
  @include('partials.kpi', ['tag' => 'Selesai', 'tone' => 'ok', 'n' => $perStatus['selesai'] ?? 0, 'title' => 'Laporan Selesai', 'meta' => 'Total biaya Rp '.number_format($biaya, 0, ',', '.')])
</div>
<div class="detail">
  <div class="box"><div class="box-h"><h2>Laporan terbaru</h2><a class="lnk" href="{{ route('kelola.laporan.index') }}">Lihat semua</a></div>
    @forelse ($baru as $l)
      @include('partials.laporan-row', ['l' => $l, 'href' => route('kelola.laporan.show', $l)])
    @empty<div class="empty">Belum ada laporan masuk.</div>@endforelse
  </div>
  <div>
    <div class="box"><div class="box-h"><h2>Komposisi status</h2></div><div class="box-b">
      @foreach (\App\Models\Laporan::STATUS as $k => $v)
        <div style="margin-bottom:.9rem"><div style="display:flex;justify-content:space-between;font-size:.85rem;gap:.5rem"><span>{{ $v }}</span><b>{{ $perStatus[$k] ?? 0 }}</b></div>
        <div class="bar"><i data-w="{{ $total ? round(($perStatus[$k] ?? 0) / $total * 100) : 0 }}" style="width:0"></i></div></div>
      @endforeach
    </div></div>
    <div class="box"><div class="box-h"><h2>Lokasi paling sering dilaporkan</h2></div><div class="box-b">
      @forelse ($lokasiTop as $l)<div style="display:flex;justify-content:space-between;gap:.8rem;padding:.35rem 0;font-size:.88rem"><span style="min-width:0;overflow-wrap:anywhere">{{ $l->nama }}</span><b>{{ $l->laporans_count }}</b></div>
      @empty<span class="muted small">Belum ada data.</span>@endforelse
    </div></div>
  </div>
</div>
@endsection
