<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanLog extends Model
{
    protected $fillable = ['laporan_id', 'user_id', 'status', 'catatan'];

    public function user() { return $this->belongsTo(User::class); }
}
