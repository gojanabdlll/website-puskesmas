<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('laporan_pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nip', 30);
            $table->string('unit_kerja');
            $table->unsignedTinyInteger('bulan');
            $table->unsignedSmallInteger('tahun');
            $table->string('nama_file_asli');
            $table->string('file_path');
            $table->string('jenis_file', 10);
            $table->string('status')->default('Menunggu Pemeriksaan');
            $table->timestamps();

            $table->index(['tahun', 'bulan']);
            $table->index('nip');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_pegawais');
    }
};
