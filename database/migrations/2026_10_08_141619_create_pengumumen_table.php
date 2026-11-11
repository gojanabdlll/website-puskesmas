<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pengumuman', function (Blueprint $table) {

            $table->id();

            $table->string('judul');

            $table->text('ringkasan')->nullable();

            $table->text('isi');

            $table->date('tanggal');

            $table->string('penulis')->nullable();

            $table->string('foto')->nullable();

            $table->boolean('status')->default(true);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengumuman');
    }
};