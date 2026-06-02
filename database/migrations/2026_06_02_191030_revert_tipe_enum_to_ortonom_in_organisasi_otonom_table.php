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
        // 1. Tambahkan opsi 'ortonom' ke dalam ENUM sementara kita mempertahankan 'otonom'
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE organisasi_otonom MODIFY COLUMN tipe ENUM('ortonom', 'otonom', 'lembaga', 'majelis')");

        // 2. Perbarui baris data yang menggunakan 'otonom' menjadi 'ortonom'
        \Illuminate\Support\Facades\DB::statement("UPDATE organisasi_otonom SET tipe = 'ortonom' WHERE tipe = 'otonom'");

        // 3. Hapus 'otonom' dari definisi ENUM secara permanen
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE organisasi_otonom MODIFY COLUMN tipe ENUM('ortonom', 'lembaga', 'majelis')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 1. Tambahkan opsi 'otonom' ke dalam ENUM sementara kita mempertahankan 'ortonom'
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE organisasi_otonom MODIFY COLUMN tipe ENUM('ortonom', 'otonom', 'lembaga', 'majelis')");

        // 2. Perbarui baris data yang menggunakan 'ortonom' menjadi 'otonom'
        \Illuminate\Support\Facades\DB::statement("UPDATE organisasi_otonom SET tipe = 'otonom' WHERE tipe = 'ortonom'");

        // 3. Hapus 'ortonom' dari definisi ENUM secara permanen
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE organisasi_otonom MODIFY COLUMN tipe ENUM('otonom', 'lembaga', 'majelis')");
    }
};
