<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Berita;
use App\Models\Jadwal;
use App\Models\Organisasi;
use App\Models\Pengurus;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale('id');

        // Clear admin dashboard cache on model changes
        $models = [
            Berita::class,
            Article::class,
            Pengurus::class,
            Organisasi::class,
            Jadwal::class,
        ];

        foreach ($models as $model) {
            if (class_exists($model)) {
                $model::saved(fn () => Cache::forget('admin_dashboard_data'));
                $model::deleted(fn () => Cache::forget('admin_dashboard_data'));
            }
        }
    }
}
