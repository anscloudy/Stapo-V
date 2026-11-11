<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $table = 'lokasis';
    protected $fillable = ['nama', 'tipe', 'jurusan'];

    const TIPE = ['kelas' => 'Ruang Kelas', 'bengkel' => 'Bengkel', 'laboratorium' => 'Laboratorium', 'umum' => 'Fasilitas Umum'];

    public function laporans() { return $this->hasMany(Laporan::class); }
}
