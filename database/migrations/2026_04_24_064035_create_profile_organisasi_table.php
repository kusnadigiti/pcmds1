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
        Schema::create('profile_organisasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('visi');
            $table->text('misi');
            $table->string('image');
            $table->string('tagline');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_organisasi');
    }
};
