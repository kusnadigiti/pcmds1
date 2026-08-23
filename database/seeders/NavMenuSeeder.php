<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NavMenuSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('nav_menus')->delete();

        // Top-level menus
        $beranda = DB::table('nav_menus')->insertGetId([
            'label' => 'Beranda',
            'url' => '/',
            'parent_id' => null,
            'order' => 1,
            'is_visible' => true,
            'open_new_tab' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $tentang = DB::table('nav_menus')->insertGetId([
            'label' => 'Tentang PCM',
            'url' => null,
            'parent_id' => null,
            'order' => 2,
            'is_visible' => true,
            'open_new_tab' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $prm = DB::table('nav_menus')->insertGetId([
            'label' => 'PRM',
            'url' => null,
            'parent_id' => null,
            'order' => 3,
            'is_visible' => true,
            'open_new_tab' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $amalUsaha = DB::table('nav_menus')->insertGetId([
            'label' => 'Amal Usaha',
            'url' => null,
            'parent_id' => null,
            'order' => 4,
            'is_visible' => true,
            'open_new_tab' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $kontak = DB::table('nav_menus')->insertGetId([
            'label' => 'Hubungi Kami',
            'url' => '/#kontak',
            'parent_id' => null,
            'order' => 5,
            'is_visible' => true,
            'open_new_tab' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Sub-items: Tentang PCM
        DB::table('nav_menus')->insert([
            ['label' => 'Sejarah & Visi Misi', 'url' => '/#profil', 'parent_id' => $tentang, 'order' => 1, 'is_visible' => true, 'open_new_tab' => false, 'created_at' => now(), 'updated_at' => now()],
            ['label' => 'Struktur Organisasi', 'url' => '/struktur-organisasi', 'parent_id' => $tentang, 'order' => 2, 'is_visible' => true, 'open_new_tab' => false, 'created_at' => now(), 'updated_at' => now()],
            ['label' => 'Artikel Terbaru', 'url' => '/articles/all', 'parent_id' => $tentang, 'order' => 3, 'is_visible' => true, 'open_new_tab' => false, 'created_at' => now(), 'updated_at' => now()],
            ['label' => 'Berita & Kegiatan', 'url' => '/berita/show-all', 'parent_id' => $tentang, 'order' => 4, 'is_visible' => true, 'open_new_tab' => false, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Sub-items: PRM
        DB::table('nav_menus')->insert([
            ['label' => 'Kegiatan', 'url' => '/#kegiatan', 'parent_id' => $prm, 'order' => 1, 'is_visible' => true, 'open_new_tab' => false, 'created_at' => now(), 'updated_at' => now()],
            ['label' => 'Amal Usaha', 'url' => '/#amal-usaha', 'parent_id' => $prm, 'order' => 2, 'is_visible' => true, 'open_new_tab' => false, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Sub-items: Amal Usaha
        DB::table('nav_menus')->insert([
            ['label' => 'Bidang Pendidikan', 'url' => '/amal-usaha/bidang-pendidikan', 'parent_id' => $amalUsaha, 'order' => 1, 'is_visible' => true, 'open_new_tab' => false, 'created_at' => now(), 'updated_at' => now()],
            ['label' => 'Bidang Kesehatan', 'url' => '/amal-usaha/bidang-kesehatan', 'parent_id' => $amalUsaha, 'order' => 2, 'is_visible' => true, 'open_new_tab' => false, 'created_at' => now(), 'updated_at' => now()],
            ['label' => 'Bidang Kesejahteraan Sosial', 'url' => '/amal-usaha/bidang-kesejahteraan-sosial', 'parent_id' => $amalUsaha, 'order' => 3, 'is_visible' => true, 'open_new_tab' => false, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
