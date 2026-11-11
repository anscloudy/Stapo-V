@extends('layouts.public')
@section('title', 'Sistem Pengaduan Sarana')
@section('content')
@php $urlLapor = auth()->check() && auth()->user()->isPelapor() ? route('pelapor.laporan.create') : route('login'); @endphp

{{-- ============ HERO (parallax berlapis) ============ --}}
<section class="hero" id="hero">
  <div class="hero-bgwrap" data-parallax="bg">
    <img class="hero-bg" src="{{ route('gambar', 'home_background.jpg') }}" alt="Gedung SMK Negeri 5 Surakarta">
  </div>
  <span class="orb o1" data-depth="0.5"><i></i></span>
  <span class="orb o2" data-depth="1.1"><i></i></span>
  <span class="orb o3" data-depth="0.8"><i></i></span>

  <div class="wrap">
    <div class="hero-in" data-parallax="content">
      <span class="pill"><i></i> Sistem Aktif — SMKN 5 Surakarta</span>
      <h1>Sistem Pengaduan &amp; <em>Pelaporan Sarana</em> Sekolah SMKN 5</h1>
      <p>Laporkan kerusakan dan kehilangan fasilitas sekolah dengan mudah. Tim sarpras kami siap memproses setiap laporan secara cepat dan transparan.</p>
      <div class="hero-cta">
        <a class="btn btn-primary" href="{{ $urlLapor }}">@include('partials.icon', ['n' => 'plus']) Laporkan Kerusakan/Kehilangan</a>
        <a class="btn btn-ghost" href="{{ route('cek-status') }}">@include('partials.icon', ['n' => 'search']) Cek Status Laporan</a>
      </div>
    </div>
  </div>

  <div class="hero-cards" aria-hidden="true">
    <div class="hc hc1" data-depth="0.7"><span class="hc-ic">@include('partials.icon', ['n' => 'edit'])</span><div><b>Laporan dikirim</b><small>Foto bukti &amp; detail masalah</small></div></div>
    <div class="hc hc2" data-depth="1.3"><span class="hc-ic">@include('partials.icon', ['n' => 'shield'])</span><div><b>Diverifikasi &amp; diproses</b><small>Ditinjau tim sarpras</small></div></div>
    <div class="hc hc3" data-depth="0.9"><span class="hc-ic ok">@include('partials.icon', ['n' => 'check'])</span><div><b>Selesai diperbaiki</b><small>Status terpantau real-time</small></div></div>
  </div>

  <a href="#statistik" class="scroll-cue" aria-label="Gulir ke bawah">
    @include('partials.chevrons') @include('partials.chevrons')
  </a>
  @include('partials.wave', ['cls' => 'wave-white'])
</section>

{{-- ============ STATISTIK ============ --}}
<section class="stats" id="statistik">
  <div class="wrap">
    <div class="stat reveal"><div class="ic">@include('partials.icon', ['n' => 'clipboard'])</div><div><b data-count="{{ $total }}">{{ number_format($total, 0, ',', '.') }}</b><span>Total Laporan</span></div></div>
    <div class="stat reveal d1"><div class="ic">@include('partials.icon', ['n' => 'check'])</div><div><b data-count="{{ $selesai }}">{{ number_format($selesai, 0, ',', '.') }}</b><span>Laporan Selesai</span></div></div>
    <div class="stat reveal d2"><div class="ic">@include('partials.icon', ['n' => 'wrench'])</div><div><b data-count="{{ $diproses }}">{{ number_format($diproses, 0, ',', '.') }}</b><span>Barang Diproses</span></div></div>
  </div>
</section>

{{-- ============ CARA KERJA ============ --}}
<section class="slide min" id="cara-kerja">
  <div class="wrap">
    <div class="sec-head reveal">
      <small>CARA KERJA</small>
      <h2>Mudah dalam 3 Langkah</h2>
      <p>Proses pelaporan yang sederhana, transparan, dan bisa dipantau secara real-time.</p>
    </div>
    <div class="steps">
      <div class="step reveal reveal-left" data-tilt><span class="no">01</span><div class="ico">@include('partials.icon', ['n' => 'edit'])</div><h3>Submit Laporan</h3><p>Isi formulir pengaduan dengan detail kerusakan atau kehilangan barang beserta foto bukti.</p></div>
      <div class="step reveal d1" data-tilt><span class="no">02</span><div class="ico">@include('partials.icon', ['n' => 'shield'])</div><h3>Verifikasi Admin</h3><p>Tim sarpras memverifikasi laporan, meninjau bukti foto, dan menetapkan prioritas penanganan.</p></div>
      <div class="step reveal reveal-right d2" data-tilt><span class="no">03</span><div class="ico">@include('partials.icon', ['n' => 'wrench'])</div><h3>Perbaikan &amp; Selesai</h3><p>Perbaikan dilakukan dan status laporan diperbarui. Pelapor dapat memantau penyelesaiannya.</p></div>
    </div>
    <div class="next-arrow"><a href="#fasilitas" aria-label="Lanjut">@include('partials.chevrons')</a></div>
  </div>
</section>

{{-- ============ JURUSAN & FASILITAS (slider) ============ --}}
<section class="slide wavy" id="fasilitas">
  @include('partials.wave', ['cls' => 'wave-top'])
  <div class="wrap">
    <div class="sec-head reveal">
      <small>LINGKUP LAPORAN</small>
      <h2>Fasilitas di Setiap Kompetensi Keahlian</h2>
      <p>{{ count($jurusan) }} kompetensi keahlian dan {{ $lokasiCount }} ruang/lokasi terdaftar di sistem, dari kelas hingga bengkel.</p>
    </div>
    <div class="slider-wrap reveal reveal-zoom">
      <button class="s-btn s-prev" type="button" aria-label="Sebelumnya">‹</button>
      <div class="slider">
        @foreach ($jurusan as $kode => $j)
        <article class="slide-card" data-tilt>
          <div class="ph">{{ $j['ikon'] }}
            <img src="{{ asset('images/jurusan/'.strtolower($kode).'.jpg') }}" alt="" loading="lazy" onerror="this.remove()">
          </div>
          <div class="tx"><h3>{{ $kode }}</h3><p>{{ $j['nama'] }}</p></div>
        </article>
        @endforeach
      </div>
      <button class="s-btn s-next" type="button" aria-label="Berikutnya">›</button>
    </div>
    <div class="next-arrow"><a href="#lapor" aria-label="Lanjut">@include('partials.chevrons')</a></div>
  </div>
</section>

{{-- ============ CTA ============ --}}
<section class="slide" id="lapor">
  <div class="wrap wide">
    <div class="cta reveal reveal-zoom">
      <img src="{{ route('gambar', 'home_background.jpg') }}" alt="" loading="lazy">
      <span class="orb o4" data-depth="0.6"><i></i></span>
      <div class="cta-in">
        <div><h2>Ada fasilitas yang rusak atau hilang?</h2><p>Jangan biarkan masalah berlarut. Laporkan sekarang dan kami tangani segera.</p></div>
        <a class="btn btn-primary" href="{{ $urlLapor }}">Buat Laporan Sekarang @include('partials.icon', ['n' => 'arrow'])</a>
      </div>
    </div>
  </div>
</section>
@endsection
