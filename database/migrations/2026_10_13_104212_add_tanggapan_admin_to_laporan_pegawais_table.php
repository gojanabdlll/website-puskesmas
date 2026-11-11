<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('laporan_pegawais', function (Blueprint $table) {
            $table->text('tanggapan_admin')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('laporan_pegawais', function (Blueprint $table) {
            $table->dropColumn('tanggapan_admin');
        });
    }
};
