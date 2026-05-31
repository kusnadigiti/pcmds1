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
        Schema::create('struktur_organisasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();       // nullable karena slot bisa kosong dulu
            $table->string('peran');                  // jabatan: Ketua, Sekretaris, dll
            $table->unsignedTinyInteger('peran_level')->default(1); // 1=top, 2=mid, 3=bawah
            $table->unsignedTinyInteger('urutan')->default(1);      // urutan dalam satu level
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('struktur_organisasi');
    }
};
