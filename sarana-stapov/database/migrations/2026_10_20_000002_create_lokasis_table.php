<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('lokasis', function (Blueprint $t) {
            $t->id();
            $t->string('nama');
            $t->string('tipe')->default('umum');   // kelas | bengkel | laboratorium | umum
            $t->string('jurusan')->nullable();     // kode jurusan, mis. PPLG
            $t->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('lokasis'); }
};
