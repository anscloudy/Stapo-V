@extends('layouts.panel')
@section('title', 'Laporan Masuk')
@section('heading', 'Laporan Masuk')
@section('sub', 'Periksa foto, ubah status, dan catat biaya')
@section('content')
<div class="box">
  <div class="box-h"><form class="filters" method="GET">
    <input name="q" value="{{ request('q') }}" placeholder="Cari kode, barang, pelapor…">
    <select name="status"><option value="">Semua status</option>@foreach (\App\Models\Laporan::STATUS as $k => $v)<option value="{{ $k }}" @selected(request('status')===$k)>{{ $v }}</option>@endforeach</select>
    <select name="jenis"><option value="">Semua jenis</option><option value="kerusakan" @selected(request('jenis')==='kerusakan')>Kerusakan</option><option value="kehilangan" @selected(request('jenis')==='kehilangan')>Kehilangan</option></select>
    <button class="btn btn-line btn-sm">Filter</button>
  </form></div>
  <div class="tbl-wrap"><table>
    <thead><tr><th>Kode</th><th>Barang</th><th>Lokasi</th><th>Pelapor</th><th>Tanggal</th><th>Status</th><th></th></tr></thead>
    <tbody>
    @forelse ($laporans as $l)
      <tr><td><b>{{ $l->kode }}</b></td><td>{{ $l->nama_barang }} <span class="muted small">×{{ $l->jumlah }}</span><br><span class="muted small">{{ ucfirst($l->jenis) }}@if($l->fotos) · 📷 {{ count($l->fotos) }}@endif</span></td>
        <td>{{ $l->lokasi->nama }}</td><td>{{ $l->pelapor->name }}<br><span class="muted small">{{ $l->pelapor->kelas }}</span></td>
        <td>{{ $l->created_at->format('d/m/Y') }}</td><td><span class="badge s-{{ $l->status }}">{{ $l->status_label }}</span></td>
        <td><a class="btn btn-line btn-sm" href="{{ route('kelola.laporan.show', $l) }}">Periksa</a></td></tr>
    @empty<tr><td colspan="7" class="empty">Tidak ada laporan yang cocok.</td></tr>@endforelse
    </tbody></table></div>
  <div class="pager">{{ $laporans->links() }}</div>
</div>
@endsection
