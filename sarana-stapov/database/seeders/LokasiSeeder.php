<?php

namespace Database\Seeders;

use App\Models\Lokasi;
use Illuminate\Database\Seeder;

class LokasiSeeder extends Seeder
{
    public function run(): void
    {
        // Ruang kelas: X / XI / XII untuk tiap kompetensi keahlian (rombel 1-2, ubah sesuai kondisi nyata)
        foreach (array_keys(config('stapov.jurusan')) as $kode) {
            foreach (['X', 'XI', 'XII'] as $tingkat) {
                foreach ([1, 2] as $rombel) {
                    Lokasi::firstOrCreate(
                        ['nama' => "Kelas $tingkat $kode $rombel"],
                        ['tipe' => 'kelas', 'jurusan' => $kode]
                    );
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
