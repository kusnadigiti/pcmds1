<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NavMenu;

class AddOrtomNavMenuSeeder extends Seeder
{
    public function run()
    {
        $exists = NavMenu::where('label', 'like', '%otonom%')->exists();
        if (!$exists) {
            NavMenu::where('order', '>=', 4)->whereNull('parent_id')->increment('order');
            NavMenu::create([
                'label' => 'Organisasi Otonom',
                'url' => null,
                'parent_id' => null,
                'order' => 4,
                'is_visible' => true,
                'open_new_tab' => false,
            ]);
        }
    }
}
