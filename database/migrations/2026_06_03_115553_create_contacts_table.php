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
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        Schema::create('contacts', function (Blueprint $table) use ($days) {
            $table->id();
            $table->text('address');
            $table->string('phone');
            $table->string('email');
            $table->enum('operational_days_start', $days);
            $table->enum('operational_days_end', $days);
            $table->time('working_hours_start');
            $table->time('working_hours_end');
            $table->text('google_maps_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
