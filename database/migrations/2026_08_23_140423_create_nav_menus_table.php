<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nav_menus', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('url')->nullable();          // null jika parent dropdown
            $table->unsignedBigInteger('parent_id')->nullable(); // null = top-level
            $table->integer('order')->default(0);
            $table->boolean('is_visible')->default(true);
            $table->boolean('open_new_tab')->default(false);
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('nav_menus')->onDelete('cascade');
            $table->index(['parent_id', 'order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nav_menus');
    }
};
