@extends('layouts.panel')
@section('title', 'Dashboard')
@section('content')
<div class="cards3">
  @include('partials.kpi', ['tag' => 'Aktif', 'tone' => 'blue', 'n' => $aktif, 'title' => 'Laporan Aktif', 'meta' => 'Belum selesai'])
  @include('partials.kpi', ['tag' => 'Diproses', 'tone' => 'violet', 'n' => $diverifikasi, 'title' => 'Laporan Diproses', 'meta' => 'Sedang ditangani petugas'])
  @include('partials.kpi', ['tag' => 'Selesai', 'tone' => 'ok', 'n' => $selesai, 'title' => 'Laporan Selesai', 'meta' => 'Terselesaikan'])
</div>
<div class="box">
  <div class="box-h"><h2>Riwayat Laporan Saya</h2><a class="btn btn-primary btn-sm" href="{{ route('pelapor.laporan.create') }}">@include('partials.icon', ['n' => 'plus']) Buat Laporan</a></div>
  @forelse ($laporans as $l)
    @include('partials.laporan-row', ['l' => $l, 'href' => route('pelapor.laporan.show', $l)])
  @empty
    <div class="empty">Belum ada laporan. Mulai dengan menekan <b>Buat Laporan</b>.</div>
  @endforelse
  @if ($laporans->count() >= 6)<div class="pager"><a href="{{ route('pelapor.laporan.index') }}">Lihat semua laporan</a></div>@endif
</div>
@endsection
