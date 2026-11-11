<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('jadwal_pelayanans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_layanan');
            $table->string('hari');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->text('keterangan')->nullable();
            $table->boolean('status')->default(true);
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_pelayanans');
    }
};
