<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role', 'nis_nip', 'kelas', 'phone'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return ['email_verified_at' => 'datetime', 'password' => 'hashed'];
    }

    public function laporans() { return $this->hasMany(Laporan::class); }

    public function isAdmin(): bool   { return $this->role === 'admin'; }
    public function isPetugas(): bool { return $this->role === 'petugas'; }
    public function isPelapor(): bool { return $this->role === 'pelapor'; }

    public function homeRoute(): string
    {
        return $this->isPelapor() ? 'pelapor.dashboard' : 'kelola.dashboard';
    }

    public function getPeranLabelAttribute(): string
    {
        return match (true) {
            $this->isAdmin()                 => 'Admin',
            $this->isPetugas()               => 'Petugas',
            $this->kelas === 'Guru / Staf'   => 'Guru',
            default                          => 'Pelapor',
        };
    }

    public function getInisialAttribute(): string
    {
        return collect(explode(' ', trim($this->name)))->take(2)
            ->map(fn ($w) => mb_strtoupper(mb_substr($w, 0, 1)))->implode('');
    }
}
