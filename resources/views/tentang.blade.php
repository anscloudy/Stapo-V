@extends('layouts.public')
@section('title', 'Tentang')
@section('content')
<section class="slide">
  <div class="wrap" style="max-width:920px">
    <div class="sec-head reveal"><small>TENTANG</small><h2>SARANA STAPOV</h2>
      <p>Sarana Status Laporan SMK Negeri 5 Surakarta — pencatatan digital laporan kerusakan dan kehilangan barang, lengkap dengan status perbaikan dan biayanya.</p></div>

    <div class="box reveal"><div class="box-h"><h2>Profil sekolah</h2></div><div class="box-b">
      <dl class="dl"><dt>Nama</dt><dd>{{ config('stapov.nama_sekolah') }}</dd><dt>Alamat</dt><dd>{{ config('stapov.alamat') }}</dd>
      <dt>Telepon</dt><dd>{{ config('stapov.telepon') }}</dd><dt>Email</dt><dd>{{ config('stapov.email') }}</dd>
      <dt>Website</dt><dd><a class="lnk" href="{{ config('stapov.website') }}" target="_blank" rel="noopener">{{ config('stapov.website') }}</a></dd></dl>
    </div></div>

    <div class="box reveal"><div class="box-h"><h2>Kompetensi keahlian</h2></div><div class="box-b">
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:.7rem">
        @foreach ($jurusan as $kode => $j)<div>{{ $j['ikon'] }} <b>{{ $kode }}</b> — {{ $j['nama'] }}</div>@endforeach
      </div>
    </div></div>

    @foreach ($lokasi as $tipe => $items)
    <div class="box reveal"><div class="box-h"><h2>{{ \App\Models\Lokasi::TIPE[$tipe] ?? ucfirst($tipe) }}</h2><span class="muted small">{{ $items->count() }} lokasi</span></div>
      <div class="box-b" style="columns:2 260px;column-gap:2rem">@foreach ($items as $l)<div style="padding:.2rem 0">• {{ $l->nama }}</div>@endforeach</div>
    </div>
    @endforeach
  </div>
</section>
@endsection
