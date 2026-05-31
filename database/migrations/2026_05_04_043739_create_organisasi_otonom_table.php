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
        Schema::create('organisasi_otonom', function (Blueprint $table) {
            $table->id();
            $table->string('nama');                         // Nama lengkap org
            $table->string('singkatan', 10);               // IPM, IMM, AIS, dst
            $table->string('slug')->unique();               // URL-friendly
            $table->enum('tipe', ['ortonom', 'lembaga', 'majelis']); // Kategori
            $table->text('deskripsi')->nullable();
            $table->string('logo')->nullable();             // Path logo
            $table->year('periode_mulai');
            $table->year('periode_selesai');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('pengurus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organisasi_otonom_id')
                ->constrained('organisasi_otonom')
                ->cascadeOnDelete();
            $table->string('nama');
            $table->string('jabatan');                      // Ketua, Sekretaris, dst.
            $table->enum('level', ['inti', 'majelis', 'lembaga'])->default('inti');
            $table->string('bidang')->nullable();           // e.g. "Pendidikan", "Sosial"
            $table->string('foto')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->year('periode_mulai');
            $table->year('periode_selesai');
            $table->integer('urutan')->default(0);          // Untuk sorting tampilan
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organisasi_otonom');
        Schema::dropIfExists('pengurus');
    }
};
