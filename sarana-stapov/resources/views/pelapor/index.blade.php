@extends('layouts.panel')
@section('title', 'Riwayat Laporan')
@section('heading', 'Riwayat Laporan')
@section('content')
<div class="box">
  <div class="box-h"><form class="filters" method="GET">
    <select name="status" onchange="this.form.submit()"><option value="">Semua status</option>
      @foreach (\App\Models\Laporan::STATUS as $k => $v)<option value="{{ $k }}" @selected(request('status')===$k)>{{ $v }}</option>@endforeach</select>
  </form><a class="btn btn-primary btn-sm" href="{{ route('pelapor.laporan.create') }}">＋ Buat Laporan</a></div>
  @forelse ($laporans as $l)
    @include('partials.laporan-row', ['l' => $l, 'href' => route('pelapor.laporan.show', $l)])
  @empty<div class="empty">Tidak ada laporan.</div>@endforelse
  <div class="pager">{{ $laporans->links() }}</div>
</div>
@endsection
