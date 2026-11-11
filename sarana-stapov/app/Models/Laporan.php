<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Laporan extends Model
{
    protected $table = 'laporans';

    protected $fillable = [
        'kode', 'user_id', 'lokasi_id', 'petugas_id', 'jenis', 'kategori', 'nama_barang', 'jumlah',
        'deskripsi', 'fotos', 'tingkat', 'status', 'catatan_petugas', 'biaya', 'jenis_biaya',
        'foto_selesai', 'tanggal_selesai',
    ];

    protected function casts(): array
    {
        return ['fotos' => 'array', 'tanggal_selesai' => 'date', 'biaya' => 'integer'];
    }

    const STATUS = [
        'diajukan'     => 'Diajukan',
        'diverifikasi' => 'Diverifikasi',
        'diproses'     => 'Diproses',
        'selesai'      => 'Selesai',
        'ditolak'      => 'Ditolak',
    ];

    const TINGKAT = ['rendah' => 'Rendah', 'sedang' => 'Sedang', 'tinggi' => 'Tinggi (mengganggu KBM)'];

    protected static function booted(): void
    {
        static::creating(function (Laporan $l) {
            $l->kode = $l->kode ?: 'STP-'.now()->format('ymd').'-'.strtoupper(Str::random(4));
        });
    }

    public function pelapor() { return $this->belongsTo(User::class, 'user_id'); }
    public function petugas() { return $this->belongsTo(User::class, 'petugas_id'); }
    public function lokasi()  { return $this->belongsTo(Lokasi::class); }
    public function logs()    { return $this->hasMany(LaporanLog::class)->latest(); }

    public function getStatusLabelAttribute(): string { return self::STATUS[$this->status] ?? $this->status; }

    public function getFotoUrlsAttribute(): array
    {
        return collect($this->fotos ?? [])->map(fn ($p) => Storage::url($p))->all();
    }

    public function getFotoSelesaiUrlAttribute(): ?string
    {
        return $this->foto_selesai ? Storage::url($this->foto_selesai) : null;
    }

    public function scopePending($q) { return $q->whereIn('status', ['diajukan', 'diverifikasi', 'diproses']); }
}
