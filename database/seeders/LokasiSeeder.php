<?php

namespace Database\Seeders;

use App\Models\Lokasi;
use App\Models\User;
use Illuminate\Database\Seeder;

class LokasiSeeder extends Seeder
{
    public function run(): void
    {
        // Ruang kelas: tiap kompetensi keahlian punya rombel A, B, C untuk kelas X / XI / XII.
        // PPLG hanya dipakai di kelas X; saat naik ke XI & XII namanya menjadi RPL.
        // Nama lama (mis. "Kelas X DPIB 1") diganti di tempat, jadi laporan lama tidak putus.
        $rombel = [1 => 'A', 2 => 'B', 3 => 'C'];

        foreach (array_keys(config('stapov.jurusan')) as $kode) {
            foreach (['X', 'XI', 'XII'] as $tingkat) {
                $prodi = ($kode === 'PPLG' && $tingkat !== 'X') ? 'RPL' : $kode;

                foreach ($rombel as $no => $huruf) {
                    $baru = "Kelas $tingkat $prodi $huruf";
                    $lama = "Kelas $tingkat $kode $no";

                    $lokasi = Lokasi::where('nama', $baru)->first()
                        ?? Lokasi::where('nama', $lama)->first()
                        ?? new Lokasi();

                    $lokasi->fill(['nama' => $baru, 'tipe' => 'kelas', 'jurusan' => $kode])->save();

                    // Samakan juga kelas yang tersimpan di akun pengguna.
                    if ($lama !== $baru) {
                        User::where('kelas', $lama)->update(['kelas' => $baru]);
                    }
                }
            }
        }

        // Bengkel & laboratorium.
        // Bagian TP & TKRO/TBSM berdasarkan halaman resmi smkn5solo.sch.id; sisanya umum untuk SMK, silakan koreksi.
        $praktik = [
            ['Bengkel Kerja Bangku', 'bengkel', 'TP'],
            ['Bengkel Kerja Mesin', 'bengkel', 'TP'],
            ['Bengkel Kerja Mesin CNC', 'bengkel', 'TP'],
            ['Ruang Gambar CAD (Pemesinan)', 'laboratorium', 'TP'],
            ['Bengkel Chassis', 'bengkel', 'TKRO'],
            ['Bengkel Motor (Engine)', 'bengkel', 'TKRO'],
            ['Bengkel Kelistrikan Otomotif', 'bengkel', 'TKRO'],
            ['Bengkel Teknologi Dasar Otomotif', 'bengkel', 'TKRO'],
            ['Bengkel Sepeda Motor', 'bengkel', 'TBSM'],
            ['Laboratorium Komputer 1 (PPLG)', 'laboratorium', 'PPLG'],
            ['Laboratorium Komputer 2 (PPLG)', 'laboratorium', 'PPLG'],
            ['Laboratorium Elektronika', 'laboratorium', 'TEI'],
            ['Bengkel Instalasi Tenaga Listrik', 'bengkel', 'TITL'],
            ['Laboratorium Otomasi Industri', 'laboratorium', 'TOI'],
            ['Ruang Gambar DPIB', 'laboratorium', 'DPIB'],
            ['Bengkel Konstruksi Bangunan', 'bengkel', 'TKP'],
        ];
        foreach ($praktik as [$nama, $tipe, $jur]) {
            Lokasi::firstOrCreate(['nama' => $nama], ['tipe' => $tipe, 'jurusan' => $jur]);
        }

        foreach ([
            'Perpustakaan', 'Ruang Guru', 'Ruang Kepala Sekolah', 'Ruang Tata Usaha', 'Ruang BK',
            'UKS', 'Masjid / Musala', 'Aula', 'Lapangan Upacara', 'Lapangan Olahraga', 'Kantin',
            'Toilet Siswa', 'Toilet Guru', 'Area Parkir', 'Pos Satpam & Gerbang',
        ] as $nama) {
            Lokasi::firstOrCreate(['nama' => $nama], ['tipe' => 'umum']);
        }
    }
}
