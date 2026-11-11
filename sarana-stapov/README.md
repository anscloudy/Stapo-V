# SARANA STAPOV — Sistem Pengaduan Sarana SMK Negeri 5 Surakarta (Laravel)

Paket ini adalah **overlay**: file-file khusus aplikasi yang ditimpa/ditambahkan ke proyek Laravel 11/12 baru.

## Instalasi (XAMPP / Laragon, PHP 8.2+, Composer)

```bash
composer create-project laravel/laravel sarana-stapov
cd sarana-stapov
# 1) salin SEMUA isi folder paket ini ke dalam folder sarana-stapov (timpa jika diminta)
# 2) edit .env sesuai ENV-CONTOH.txt, lalu buat database kosong "sarana_stapov" di phpMyAdmin
php artisan migrate --seed
php artisan storage:link
php artisan serve
```
Buka http://127.0.0.1:8000

## Akun demo (ganti segera setelah dipakai)
| Peran   | Login                              | Sandi          |
|---------|------------------------------------|----------------|
| Admin   | admin@smkn5solo.sch.id / ADM001    | admin12345     |
| Petugas | petugas@smkn5solo.sch.id / PTG001  | petugas12345   |
| Pelapor | budi@siswa.smkn5solo.sch.id / 0051234 | siswa12345  |

Pelapor baru mendaftar sendiri lewat /daftar. Akun petugas/admin dibuat admin di menu Pengguna.

## Alur
- **Publik (tanpa login):** beranda bergaya slide, statistik nyata dari database, Tentang, Panduan, Cek Status via kode laporan.
- **Pelapor:** dashboard, form pengaduan + upload 1–3 foto, riwayat, detail & timeline status.
- **Petugas:** laporan masuk (filter/cari), periksa foto, ubah status, prioritas, catatan, biaya perbaikan/penggantian, foto hasil, rekap + CSV + cetak.
- **Admin:** semua fitur petugas + kelola pengguna, lokasi/ruang, hapus laporan.

## Data sekolah
`config/stapov.php` (profil & 9 kompetensi keahlian) dan `database/seeders/LokasiSeeder.php` (kelas, bengkel, lab, fasilitas umum).
Nama bengkel TP, TKRO, TBSM diambil dari smkn5solo.sch.id; ruang lain dan jumlah rombel adalah perkiraan umum — **koreksi lewat menu Lokasi & Ruang** atau seeder.

## Gambar
Lihat `public/images/README.txt`. Tanpa foto asli, dipakai gambar sementara dari picsum.photos.

## Catatan
Kode belum dijalankan di lingkungan PHP saat dibuat (tidak tersedia). Jika ada error saat `migrate`/`serve`, kirim pesan errornya agar diperbaiki.
