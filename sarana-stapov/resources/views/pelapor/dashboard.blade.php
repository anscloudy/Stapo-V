@extends('layouts.panel')
@section('title', 'Dashboard')
@section('content')
<div class="cards3">
  <div class="kpi"><div class="row"><div class="ic">📋</div><div class="n">{{ $aktif }}</div></div><b>Laporan Aktif</b><span>Sedang diproses</span></div>
  <div class="kpi"><div class="row"><div class="ic">✅</div><div class="n" style="color:#8DB4F0">{{ $diverifikasi }}</div></div><b>Laporan Diverifikasi</b><span>Menunggu tindak lanjut</span></div>
  <div class="kpi"><div class="row"><div class="ic">🎉</div><div class="n" style="color:var(--ok)">{{ $selesai }}</div></div><b>Laporan Selesai</b><span>Terselesaikan</span></div>
</div>
<div class="box">
  <div class="box-h"><h2>Riwayat Laporan Saya</h2><a class="btn btn-primary btn-sm" href="{{ route('pelapor.laporan.create') }}">＋ Buat Laporan</a></div>
  @forelse ($laporans as $l)
    @include('partials.laporan-row', ['l' => $l, 'href' => route('pelapor.laporan.show', $l)])
  @empty
    <div class="empty">Belum ada laporan. Mulai dengan menekan <b>Buat Laporan</b>.</div>
  @endforelse
  @if ($laporans->count() >= 6)<div class="pager"><a href="{{ route('pelapor.laporan.index') }}">Lihat semua laporan</a></div>@endif
</div>
@endsection
