<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('footer_settings', function (Blueprint $table) {
            $table->id();

            $table->string('nama_puskesmas')
                ->default('Puskesmas Singaparna');

            $table->text('alamat')->nullable();
            $table->string('telepon', 50)->nullable();
            $table->string('email')->nullable();
            $table->string('logo')->nullable();

            $table->json('pintasan')->nullable();
            $table->json('tautan_terkait')->nullable();

            $table->string('copyright')->nullable();
            $table->string('kredit')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('footer_settings');
    }
};
