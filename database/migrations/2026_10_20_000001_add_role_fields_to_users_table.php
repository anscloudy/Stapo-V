<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $t) {
            $t->string('role')->default('pelapor')->after('email');   // admin | petugas | pelapor
            $t->string('nis_nip')->nullable()->unique()->after('role');
            $t->string('kelas')->nullable()->after('nis_nip');
            $t->string('phone')->nullable()->after('kelas');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $t) {
            $t->dropUnique(['nis_nip']);
            $t->dropColumn(['role', 'nis_nip', 'kelas', 'phone']);
        });
    }
};
