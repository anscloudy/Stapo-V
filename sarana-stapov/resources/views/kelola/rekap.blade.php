@extends('layouts.panel')
@section('title', 'Rekap & Biaya')
@section('heading', 'Rekap Barang & Biaya')
@section('sub', 'Barang yang sudah diperbaiki dan yang masih tertunda')
@section('content')
<div class="cards3">
  <div class="kpi"><b>Selesai diperbaiki</b><div class="n">{{ $selesai }}</div></div>
  <div class="kpi"><b>Masih tertunda</b><div class="n" style="color:var(--warn)">{{ $tertunda }}</div></div>
  <div class="kpi"><b>Total biaya (selesai)</b><div class="n" style="font-size:1.4rem">Rp {{ number_format($totalBiaya, 0, ',', '.') }}</div></div>
</div>
<div class="box">
  <div class="box-h no-print"><form class="filters" method="GET">
    <label style="margin:0">Dari</label><input type="date" name="dari" value="{{ request('dari') }}">
    <label style="margin:0">Sampai</label><input type="date" name="sampai" value="{{ request('sampai') }}">
    <select name="status"><option value="">Semua</option><option value="pending" @selected(request('status')==='pending')>Tertunda</option>
      @foreach (\App\Models\Laporan::STATUS as $k => $v)<option value="{{ $k }}" @selected(request('status')===$k)>{{ $v }}</option>@endforeach</select>
    <button class="btn btn-line btn-sm">Terapkan</button></form>
    <div style="display:flex;gap:.5rem"><a class="btn btn-line btn-sm" href="{{ route('kelola.rekap.csv', request()->query()) }}">⬇ CSV</a><button class="btn btn-primary btn-sm" onclick="window.print()">🖨 Cetak</button></div></div>
  <div class="tbl-wrap"><table>
    <thead><tr><th>Tgl</th><th>Kode</th><th>Barang</th><th>Lokasi</th><th>Status</th><th>Jenis biaya</th><th style="text-align:right">Biaya</th></tr></thead>
    <tbody>
    @forelse ($items as $l)
      <tr><td>{{ $l->created_at->format('d/m/Y') }}</td><td>{{ $l->kode }}</td><td>{{ $l->nama_barang }}</td><td>{{ $l->lokasi->nama }}</td>
        <td><span class="badge s-{{ $l->status }}">{{ $l->status_label }}</span></td><td>{{ ucfirst($l->jenis_biaya ?? '-') }}</td>
        <td style="text-align:right">{{ $l->biaya ? 'Rp '.number_format($l->biaya, 0, ',', '.') : '-' }}</td></tr>
    @empty<tr><td colspan="7" class="empty">Tidak ada data pada filter ini.</td></tr>@endforelse
    </tbody>
    @if ($items->count())<tfoot><tr><td colspan="6" style="text-align:right;font-weight:700;padding:.9rem 1rem">Total biaya (laporan selesai)</td><td style="text-align:right;font-weight:800">Rp {{ number_format($totalBiaya, 0, ',', '.') }}</td></tr></tfoot>@endif
  </table></div>
</div>
@endsection
