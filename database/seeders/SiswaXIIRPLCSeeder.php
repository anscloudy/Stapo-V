<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

/*
 | Akun pelapor untuk siswa kelas XII RPL C.
 | Login: NISN (kolom NIS/NIP) + kata sandi = NISN masing-masing.
 | Aman dijalankan berulang (updateOrCreate berdasarkan NISN).
 */
class SiswaXIIRPLCSeeder extends Seeder
{
    public function run(): void
    {
        $siswa = [
            ['ABDUL AZIZ NURRAHMAN', '0085192025'],
            ['Adiputra Arya Sena', '0099677881'],
            ['Alvin Yourry Putra Mentari', '0085189232'],
            ['AMADEO BRIAN RANASTYA PUTRA', '0082552856'],
            ['Andreas Kelvin Anasta Putra', '0091140341'],
            ['Anjeli Afifah Darajati', '0081528255'],
            ['AZRIEL AIDA NUROCHIM', '0094655031'],
            ['BINTANG FAHRI HASCARYA', '0089632086'],
            ['CARISHA AMIRA INSANI', '0082793500'],
            ['CHELSEA MUHAMMAD ADLI', '0096404873'],
            ['CHRISTIAN WARDANA', '0085226056'],
            ['Cleodora Bertha Fortuna', '0099325275'],
            ['Cristiano Vieli Kaligis', '0099196067'],
            ['Daffa Farih Irfanudin', '0093922303'],
            ['DESTA TIAR REDRIANA', '0087475927'],
            ['FARREL BRILLIANT NUGROHO', '0091553307'],
            ['FIDA QUROTTU AINI', '0086726378'],
            ['GHOZI MUMTAZA HANIF', '0098225927'],
            ['IRFAN AJI WARDANA', '0083318812'],
            ['MANESTIKO BANYUBIRU', '0098813285'],
            ['Michael Aditya', '0082434559'],
            ['Moses Adi Saputra', '0099030536'],
            ['MUHAMMAD ANSHORI', '0097488229'],
            ['MUHAMMAD FAHRI RAHMAN ARRAFI', '3096322062'],
            ['MUHAMMAD ROSYID MURYANTO', '0098352062'],
            ['NICHOLAS GUSTI SAPUTRA', '3098883861'],
            ['PRANAJA ABI PRAYA WIDYATAMAKA', '0099821145'],
            ['RAMADITYA SURYA PUTRA', '0097645030'],
            ['Sabian Apta Arira', '0082793082'],
            ['SATRIA RAHMANSYAH', '0098491439'],
            ['THEODORICK BAKUH PANGGALIH', '0094722484'],
            ['X-Ian Adi Nugroho', '0082122132'],
        ];

        foreach ($siswa as [$nama, $nisn]) {
            User::updateOrCreate(['nis_nip' => $nisn], [
                'name'     => mb_convert_case($nama, MB_CASE_TITLE, 'UTF-8'),
                'email'    => $nisn.'@siswa.smkn5solo.sch.id',
                'role'     => 'pelapor',
                'kelas'    => 'Kelas XII RPL C',
                'password' => $nisn,
            ]);
        }
    }
}
