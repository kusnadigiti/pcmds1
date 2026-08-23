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
        // 1. Tambahkan opsi 'otonom' ke dalam ENUM sementara kita mempertahankan 'ortonom'
        DB::statement("ALTER TABLE organisasi_otonom MODIFY COLUMN tipe ENUM('ortonom', 'otonom', 'lembaga', 'majelis')");

        // 2. Perbarui baris data lama yang masih menggunakan 'ortonom' menjadi 'otonom'
        DB::statement("UPDATE organisasi_otonom SET tipe = 'otonom' WHERE tipe = 'ortonom'");

        // 3. Hapus 'ortonom' dari definisi ENUM secara permanen
        DB::statement("ALTER TABLE organisasi_otonom MODIFY COLUMN tipe ENUM('otonom', 'lembaga', 'majelis')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE organisasi_otonom MODIFY COLUMN tipe ENUM('ortonom', 'otonom', 'lembaga', 'majelis')");
        DB::statement("UPDATE organisasi_otonom SET tipe = 'ortonom' WHERE tipe = 'otonom'");
        DB::statement("ALTER TABLE organisasi_otonom MODIFY COLUMN tipe ENUM('ortonom', 'lembaga', 'majelis')");
    }
};
