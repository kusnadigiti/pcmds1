<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('amal_usaha', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organisasi_otonom_id')
                ->constrained('organisasi_otonom')
                ->cascadeOnDelete();
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->enum('tipe', ['bidang_sosial', 'bidang_kesehatan', 'bidang_pendidikan'])->default('bidang_sosial');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amal_usaha');
    }
};
