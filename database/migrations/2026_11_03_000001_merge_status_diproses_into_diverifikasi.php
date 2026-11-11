<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/*
 | Status "diproses" dihapus dari pilihan admin. Admin hanya memilih
 | Diverifikasi / Selesai / Ditolak, dan "Diverifikasi" tampil sebagai "Diproses".
 | Data lama berstatus "diproses" digabung ke "diverifikasi".
 */
return new class extends Migration {
    public function up(): void
    {
        DB::table('laporans')->where('status', 'diproses')->update(['status' => 'diverifikasi']);
        DB::table('laporan_logs')->where('status', 'diproses')->update(['status' => 'diverifikasi']);
    }

    public function down(): void
    {
        // Tidak dapat dibedakan lagi mana yang dulu "diproses"; dibiarkan.
    }
};
