<?php

namespace Database\Seeders;

use App\Models\Laporan;
use App\Models\Lokasi;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(LokasiSeeder::class);

        // Akun utama
        User::updateOrCreate(['email' => 'admincuy@gmail.com'], [
            'name' => 'Admin', 'role' => 'admin', 'password' => 'ghe42f@#',
        ]);
        User::updateOrCreate(['email' => 'gurucuy@gmail.com'], [
            'name' => 'Guru', 'role' => 'pelapor', 'kelas' => 'Guru / Staf', 'password' => 'ghe42f@#',
        ]);

        // 32 siswa kelas XII RPL C (login pakai NISN)
        $this->call(SiswaXIIRPLCSeeder::class);

        User::updateOrCreate(['email' => 'admin@smkn5solo.sch.id'], [
            'name' => 'Admin Sarpras', 'role' => 'admin', 'nis_nip' => 'ADM001', 'password' => 'admin12345',
        ]);
        $petugas = User::updateOrCreate(['email' => 'petugas@smkn5solo.sch.id'], [
            'name' => 'Petugas Sarpras', 'role' => 'petugas', 'nis_nip' => 'PTG001', 'password' => 'petugas12345',
        ]);
        $budi = User::updateOrCreate(['email' => 'budi@siswa.smkn5solo.sch.id'], [
            'name' => 'Budi Santoso', 'role' => 'pelapor', 'nis_nip' => '0051234',
            'kelas' => 'Kelas XII RPL A', 'phone' => '081234567890', 'password' => 'siswa12345',
        ]);

        if (Laporan::count() > 0) return;

        $contoh = [
            ['Komputer PC Laboratorium', 'Laboratorium Komputer 1 (PPLG)', 'kerusakan', 'Komputer & Elektronik', 'diverifikasi', 0, 'Monitor mati total, sudah dicek kabel power.'],
            ['Proyektor Kelas XII RPL', 'Kelas XII RPL A', 'kerusakan', 'Papan Tulis & Proyektor', 'selesai', 450000, 'Lampu proyektor redup lalu padam.'],
            ['Kursi Belajar Patah', 'Kelas XI TP A', 'kerusakan', 'Meja & Kursi', 'diverifikasi', 0, 'Kaki kursi patah, berbahaya dipakai.'],
            ['AC Tidak Dingin', 'Ruang Guru', 'kerusakan', 'Kelistrikan & AC', 'ditolak', 0, 'AC hanya mengeluarkan angin.'],
            ['Papan Tulis Rusak', 'Kelas X DPIB A', 'kerusakan', 'Papan Tulis & Proyektor', 'diajukan', 0, 'Permukaan papan tulis mengelupas.'],
        ];
        foreach ($contoh as $i => [$barang, $lok, $jenis, $kat, $status, $biaya, $desk]) {
            $l = Laporan::create([
                'user_id' => $budi->id,
                'lokasi_id' => Lokasi::where('nama', $lok)->value('id'),
                'jenis' => $jenis, 'kategori' => $kat, 'nama_barang' => $barang, 'jumlah' => 1,
                'deskripsi' => $desk, 'tingkat' => 'sedang', 'status' => $status,
                'petugas_id' => $status === 'diajukan' ? null : $petugas->id,
                'biaya' => $biaya, 'jenis_biaya' => $biaya ? 'perbaikan' : null,
                'tanggal_selesai' => $status === 'selesai' ? now()->subDays(3) : null,
                'catatan_petugas' => $status === 'ditolak' ? 'Sudah ditangani vendor kontrak AC, tidak perlu laporan baru.' : null,
                'created_at' => now()->subDays(($i + 1) * 5),
            ]);
            $l->logs()->create(['user_id' => $budi->id, 'status' => 'diajukan', 'catatan' => 'Laporan dibuat.']);
            if ($status !== 'diajukan') {
                $l->logs()->create(['user_id' => $petugas->id, 'status' => $status, 'catatan' => $l->catatan_petugas]);
            }
        }
    }
}
