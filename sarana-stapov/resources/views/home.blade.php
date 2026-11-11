@extends('layouts.public')
@section('title', 'Sistem Pengaduan Sarana')
@section('content')

{{-- ============ SLIDE 1: HERO ============ --}}
<section class="hero" id="hero">
  <img class="hero-bg" src="{{ asset('images/hero.jpg') }}" alt="Ruang kelas SMKN 5 Surakarta"
       onerror="this.onerror=null;this.src='https://picsum.photos/seed/smkn5-classroom/1920/1080'">
  <div class="wrap">
    <div class="hero-in">
      <span class="pill reveal in"><i></i> Sistem Aktif — SMKN 5 Surakarta</span>
      <h1 class="reveal in d1">Sistem Pengaduan &amp; <em>Pelaporan Sarana</em> Sekolah SMKN 5</h1>
      <p class="reveal in d2">Laporkan kerusakan dan kehilangan fasilitas sekolah dengan mudah. Tim sarpras kami siap memproses setiap laporan secara cepat dan transparan.</p>
      <div class="hero-cta reveal in d3">
        <a class="btn btn-primary" href="{{ auth()->check() && auth()->user()->isPelapor() ? route('pelapor.laporan.create') : route('login') }}">＋ Laporkan Kerusakan/Kehilangan</a>
        <a class="btn btn-ghost" href="{{ route('cek-status') }}">📋 Cek Status Laporan</a>
      </div>
    </div>
  </div>
  <a href="#statistik" class="scroll-cue" aria-label="Gulir ke bawah">
    @include('partials.chevrons') @include('partials.chevrons')
  </a>
</section>

{{-- ============ SLIDE 2: STATISTIK ============ --}}
<section class="stats" id="statistik">
  <div class="wrap">
    <div class="stat reveal"><div class="ic">📋</div><div><b>{{ number_format($total, 0, ',', '.') }}</b><span>Total Laporan</span></div></div>
    <div class="stat reveal d1"><div class="ic">✅</div><div><b>{{ number_format($selesai, 0, ',', '.') }}</b><span>Laporan Selesai</span></div></div>
    <div class="stat reveal d2"><div class="ic">🔧</div><div><b>{{ number_format($diproses, 0, ',', '.') }}</b><span>Barang Diproses</span></div></div>
  </div>
</section>

{{-- ============ SLIDE 3: CARA KERJA ============ --}}
<section class="slide min" id="cara-kerja">
  <div class="wrap">
    <div class="sec-head reveal">
      <small>CARA KERJA</small>
      <h2>Mudah dalam 3 Langkah</h2>
      <p>Proses pelaporan yang sederhana, transparan, dan bisa dipantau secara real-time.</p>
    </div>
    <div class="steps">
      <div class="step reveal"><span class="no">01</span><div class="ico">📝</div><h3>Submit Laporan</h3><p>Isi formulir pengaduan dengan detail kerusakan atau kehilangan barang beserta foto bukti.</p></div>
      <div class="step reveal d1"><span class="no">02</span><div class="ico">🔍</div><h3>Verifikasi Admin</h3><p>Tim sarpras memverifikasi laporan, meninjau bukti foto, dan menetapkan prioritas penanganan.</p></div>
      <div class="step reveal d2"><span class="no">03</span><div class="ico">🛠️</div><h3>Perbaikan &amp; Selesai</h3><p>Perbaikan dilakukan dan status laporan diperbarui. Pelapor dapat memantau penyelesaiannya.</p></div>
    </div>
    <div class="next-arrow"><a href="#fasilitas" aria-label="Lanjut"> @include('partials.chevrons') </a></div>
  </div>
</section>

{{-- ============ SLIDE 4: JURUSAN & FASILITAS (slider) ============ --}}
<section class="slide" id="fasilitas" style="background:#fff;border-block:1px solid var(--line)">
  <div class="wrap">
    <div class="sec-head reveal">
      <small>LINGKUP LAPORAN</small>
      <h2>Fasilitas di Setiap Kompetensi Keahlian</h2>
      <p>{{ count($jurusan) }} kompetensi keahlian dan {{ $lokasiCount }} ruang/lokasi terdaftar di sistem, dari kelas hingga bengkel.</p>
    </div>
    <div class="slider-wrap reveal">
      <button class="s-btn s-prev" aria-label="Sebelumnya">‹</button>
      <div class="slider">
        @foreach ($jurusan as $kode => $j)
        <article class="slide-card">
          <div class="ph">{{ $j['ikon'] }}
            <img src="{{ asset('images/jurusan/'.strtolower($kode).'.jpg') }}" alt="" loading="lazy" onerror="this.remove()">
          </div>
          <div class="tx"><h3>{{ $kode }}</h3><p>{{ $j['nama'] }}</p></div>
        </article>
        @endforeach
      </div>
      <button class="s-btn s-next" aria-label="Berikutnya">›</button>
    </div>
    <div class="next-arrow"><a href="#lapor" aria-label="Lanjut">@include('partials.chevrons')</a></div>
  </div>
</section>

{{-- ============ SLIDE 5: CTA ============ --}}
<section class="slide" id="lapor">
  <div class="wrap" style="width:min(1830px,96%)">
    <div class="cta reveal">
      <img src="{{ asset('images/cta.jpg') }}" alt="" loading="lazy" onerror="this.onerror=null;this.src='https://picsum.photos/seed/smkn5-workshop/1600/500'">
      <div class="cta-in">
        <div><h2>Ada fasilitas yang rusak atau hilang?</h2><p>Jangan biarkan masalah berlarut. Laporkan sekarang dan kami tangani segera.</p></div>
        <a class="btn btn-primary" href="{{ auth()->check() && auth()->user()->isPelapor() ? route('pelapor.laporan.create') : route('login') }}">Buat Laporan Sekarang →</a>
      </div>
    </div>
  </div>
</section>
@endsection
