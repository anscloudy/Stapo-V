@extends('layouts.panel')
@section('title', 'Dashboard')
@section('content')
<div class="cards3">
  <div class="kpi"><div class="row"><div class="ic">📥</div><div class="n">{{ $total }}</div></div><b>Total Laporan</b><span>Semua status</span></div>
  <div class="kpi"><div class="row"><div class="ic">🕒</div><div class="n" style="color:var(--warn)">{{ $perStatus['diajukan'] ?? 0 }}</div></div><b>Menunggu Verifikasi</b><span>Perlu ditinjau</span></div>
  <div class="kpi"><div class="row"><div class="ic">🔧</div><div class="n" style="color:#7c6bdc">{{ ($perStatus['diverifikasi'] ?? 0) + ($perStatus['diproses'] ?? 0) }}</div></div><b>Tertunda / Diproses</b><span>Belum selesai</span></div>
  <div class="kpi"><div class="row"><div class="ic">✅</div><div class="n" style="color:var(--ok)">{{ $perStatus['selesai'] ?? 0 }}</div></div><b>Selesai</b><span>Total biaya Rp {{ number_format($biaya, 0, ',', '.') }}</span></div>
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
        <div style="margin-bottom:.9rem"><div style="display:flex;justify-content:space-between;font-size:.85rem"><span>{{ $v }}</span><b>{{ $perStatus[$k] ?? 0 }}</b></div>
        <div class="bar"><i data-w="{{ $total ? round(($perStatus[$k] ?? 0) / $total * 100) : 0 }}" style="width:0"></i></div></div>
      @endforeach
    </div></div>
    <div class="box"><div class="box-h"><h2>Lokasi paling sering dilaporkan</h2></div><div class="box-b">
      @forelse ($lokasiTop as $l)<div style="display:flex;justify-content:space-between;padding:.3rem 0;font-size:.88rem"><span>{{ $l->nama }}</span><b>{{ $l->laporans_count }}</b></div>
      @empty<span class="muted small">Belum ada data.</span>@endforelse
    </div></div>
  </div>
</div>
@endsection
