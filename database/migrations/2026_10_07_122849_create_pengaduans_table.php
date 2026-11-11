<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pengaduans', function (Blueprint $table) {

            $table->id();

            $table->string('nomor_tiket')->unique();

            $table->string('nama');

            $table->string('kontak')->nullable();

            $table->string('kategori');

            $table->string('subjek');

            $table->text('isi_pengaduan');

            $table->boolean('anonim')->default(false);

            $table->enum('status', [
                'Menunggu',
                'Diproses',
                'Selesai',
                'Ditolak'
            ])->default('Menunggu');

            $table->text('tanggapan')->nullable();

            $table->timestamp('tanggal_ditanggapi')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};