<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // ✅ Cek dulu apakah kolom sudah ada, supaya tidak error duplikat
            if (!Schema::hasColumn('users', 'status')) {
                $table->enum('status', ['pending', 'lolos', 'tidak_lolos'])->default('pending');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
