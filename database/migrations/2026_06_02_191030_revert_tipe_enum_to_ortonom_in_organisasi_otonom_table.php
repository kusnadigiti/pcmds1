<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Tambahkan opsi 'ortonom' ke dalam ENUM sementara kita mempertahankan 'otonom'
        DB::statement("ALTER TABLE organisasi_otonom MODIFY COLUMN tipe ENUM('ortonom', 'otonom', 'lembaga', 'majelis')");

        // 2. Perbarui baris data yang menggunakan 'otonom' menjadi 'ortonom'
        DB::statement("UPDATE organisasi_otonom SET tipe = 'ortonom' WHERE tipe = 'otonom'");

        // 3. Hapus 'otonom' dari definisi ENUM secara permanen
        DB::statement("ALTER TABLE organisasi_otonom MODIFY COLUMN tipe ENUM('ortonom', 'lembaga', 'majelis')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 1. Tambahkan opsi 'otonom' ke dalam ENUM sementara kita mempertahankan 'ortonom'
        DB::statement("ALTER TABLE organisasi_otonom MODIFY COLUMN tipe ENUM('ortonom', 'otonom', 'lembaga', 'majelis')");

        // 2. Perbarui baris data yang menggunakan 'ortonom' menjadi 'otonom'
        DB::statement("UPDATE organisasi_otonom SET tipe = 'otonom' WHERE tipe = 'ortonom'");

        // 3. Hapus 'ortonom' dari definisi ENUM secara permanen
        DB::statement("ALTER TABLE organisasi_otonom MODIFY COLUMN tipe ENUM('otonom', 'lembaga', 'majelis')");
    }
};
