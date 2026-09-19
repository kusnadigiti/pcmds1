<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class AmalUsahaPageTest extends TestCase
{
    public function test_parent_page_route_and_school_choices_are_defined(): void
    {
        $route = Route::getRoutes()->getByName('amal-usaha.index');
        $view = file_get_contents(resource_path('views/pages/amal-usaha/landing.blade.php'));

        $this->assertNotNull($route);
        $this->assertSame('amal-usaha', $route->uri());
        $this->assertStringContainsString('Pilih Sekolah Muhammadiyah', $view);
        $this->assertStringContainsString("'jenjang' => 'SD'", $view);
        $this->assertStringContainsString("'jenjang' => 'SMP'", $view);
        $this->assertStringContainsString("'jenjang' => 'SMA'", $view);
        $this->assertStringContainsString('rel="noopener noreferrer"', $view);
    }
}
