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
        Schema::create('wilayah_kerjas', function (Blueprint $table) {

            $table->id();

            $table->string('kecamatan');

            $table->string('desa_kelurahan');

            $table->unsignedBigInteger('jumlah_penduduk')->nullable();

            $table->string('luas_wilayah')->nullable();

            $table->text('keterangan')->nullable();

            $table->integer('urutan')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wilayah_kerjas');
    }
};