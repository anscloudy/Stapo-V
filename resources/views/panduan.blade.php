@extends('layouts.public')
@section('title', 'Panduan')
@section('content')
<section class="slide">
  <div class="wrap" style="max-width:820px">
    <div class="sec-head reveal"><small>PANDUAN</small><h2>Cara Menggunakan SARANA STAPOV</h2><p>Untuk siswa, guru, dan staf {{ config('stapov.nama_sekolah') }}.</p></div>
    @foreach ([
      ['1. Daftar atau masuk', 'Buat akun dengan NIS/NIP dan email sekolah, lalu masuk. Halaman utama tetap bisa dilihat tanpa login.'],
      ['2. Isi form pengaduan', 'Pilih lokasi (kelas, bengkel, laboratorium, atau fasilitas umum), jenis laporan, nama barang, dan jelaskan masalahnya. Laporan kerusakan wajib menyertakan 1–3 foto (maks. 4 MB per foto).'],
      ['3. Simpan kode laporan', 'Setiap laporan mendapat kode unik. Kode ini bisa dipakai untuk cek status lewat tombol “Cek Status Laporan” tanpa login.'],
      ['4. Pantau prosesnya', 'Status berubah: Diajukan → Diproses → Selesai. Laporan yang tidak dapat ditindaklanjuti ditandai Ditolak beserta alasannya.'],
      ['5. Petugas &amp; admin', 'Petugas memeriksa foto, memperbarui status, mencatat biaya perbaikan/penggantian, dan mengunggah foto hasil. Admin juga mengelola pengguna, lokasi, dan rekap.'],
    ] as $i => [$t, $d])
      <div class="box reveal"><div class="box-b"><h3 style="font-size:1.02rem">{!! $t !!}</h3><p class="muted" style="margin:.4rem 0 0">{!! $d !!}</p></div></div>
    @endforeach
  </div>
</section>
@endsection
