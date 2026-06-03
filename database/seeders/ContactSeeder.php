<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contact::create([
            'address' => 'Gedung Dakwah Muhammadiyah, Jl. Duren Sawit Raya No. 1, Jakarta Timur',
            'phone' => '+6285280136056',
            'email' => 'info@pcmdurensawit1.or.id',
            'operational_days_start' => 'Senin',
            'operational_days_end' => 'Jumat',
            'working_hours_start' => '08:00',
            'working_hours_end' => '18:00',
            'google_maps_url' => 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15864.890283559207!2d106.91659!3d-6.234365!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698cb58ca1ebcb%3A0x59543a4090f070b0!2sDuren%20Sawit%2C%20Kec.%20Duren%20Sawit%2C%20Kota%20Jakarta%20Timur%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1778816259461!5m2!1sid!2sid',
        ]);
    }
}
