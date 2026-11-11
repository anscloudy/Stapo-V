<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('laporans', function (Blueprint $t) {
            $t->id();
            $t->string('kode')->unique();
            $t->foreignId('user_id')->constrained()->cascadeOnDelete();
            $t->foreignId('lokasi_id')->constrained('lokasis');
            $t->foreignId('petugas_id')->nullable()->constrained('users')->nullOnDelete();
            $t->string('jenis');                       // kerusakan | kehilangan
            $t->string('kategori');
            $t->string('nama_barang');
            $t->unsignedInteger('jumlah')->default(1);
            $t->text('deskripsi');
            $t->json('fotos')->nullable();             // foto bukti dari pelapor
            $t->string('tingkat')->default('sedang');  // rendah | sedang | tinggi
            $t->string('status')->default('diajukan'); // diajukan | diverifikasi | diproses | selesai | ditolak
            $t->text('catatan_petugas')->nullable();
            $t->unsignedBigInteger('biaya')->default(0);
            $t->string('jenis_biaya')->nullable();     // perbaikan | penggantian
            $t->string('foto_selesai')->nullable();    // foto hasil perbaikan
            $t->date('tanggal_selesai')->nullable();
            $t->timestamps();
            $t->index(['status', 'created_at']);
        });

        Schema::create('laporan_logs', function (Blueprint $t) {
            $t->id();
            $t->foreignId('laporan_id')->constrained('laporans')->cascadeOnDelete();
            $t->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $t->string('status');
            $t->text('catatan')->nullable();
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_logs');
        Schema::dropIfExists('laporans');
    }
};
