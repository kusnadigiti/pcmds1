<?php

namespace App\Providers;

use Carbon\Carbon;
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
             \App\Models\Berita::class,
             \App\Models\Article::class,
             \App\Models\Pengurus::class,
             \App\Models\Organisasi::class,
             \App\Models\Jadwal::class,
         ];

         foreach ($models as $model) {
             if (class_exists($model)) {
                 $model::saved(fn () => \Illuminate\Support\Facades\Cache::forget('admin_dashboard_data'));
                 $model::deleted(fn () => \Illuminate\Support\Facades\Cache::forget('admin_dashboard_data'));
             }
         }
    }
}
