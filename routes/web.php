<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\Admin\JadwalKajianController;
use App\Http\Controllers\Admin\KelolaOrganisasi;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ProfileOrganisasiController;
use App\Http\Controllers\Admin\StrukturOrganisasiController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Admin\OrganisasiController;
use App\Http\Controllers\Admin\PengurusController;
use App\Http\Controllers\Admin\AmalUsahaController;
use App\Http\Controllers\Admin\HeroSectionsController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Admin\TwoFactorController;
use App\Http\Controllers\Bendahara\FinanceController;
use App\Http\Controllers\Bendahara\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/articles/all', [LandingController::class, 'showAllArticles'])->name('articles.show-all');
Route::get('/articles/{slug}', [LandingController::class, 'showArticle'])->name('articles.show');
Route::get('/struktur-organisasi', [LandingController::class, 'showStrukturOrganisasi'])->name('struktur-organisasi');
Route::get('/berita/show-all', [LandingController::class, 'showAllBerita'])->name('berita.all');
Route::get('/berita/detail/{berita}', [LandingController::class, 'showBerita'])->name('berita.show');
Route::get('/organisasi-otonom/{slug}', [LandingController::class, 'showOrganisasiOtonom'])->name('organisasi-otonom.show');
Route::get('/anggota-organisasi/{slug}', [LandingController::class, 'showAnggotaOrganisasi'])->name('anggota-organisasi.show');


Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['auth', 'role:admin,superadmin'])->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('/banner', HeroSectionsController::class);

        Route::get('/profile-organisasi', [ProfileOrganisasiController::class, 'index'])->name('profile-organisasi');
        Route::get('/profile-organisasi/create', [ProfileOrganisasiController::class, 'create'])->name('profile-organisasi.create');
        Route::post('/profile-organisasi', [ProfileOrganisasiController::class, 'store'])->name('profile-organisasi.store');
        Route::delete('/profile-organisasi/{id}', [ProfileOrganisasiController::class, 'destroy'])->name('profile-organisasi.destroy');
        Route::get('/profile-organisasi/{id}/edit', [ProfileOrganisasiController::class, 'edit'])->name('profile-organisasi.edit');
        Route::put('/profile-organisasi/{id}', [ProfileOrganisasiController::class, 'update'])->name('profile-organisasi.update');

        Route::get('/organisasi-otonom', [OrganisasiController::class, 'index'])->name('organisasi-otonom');
        Route::get('/organisasi-otonom/create', [OrganisasiController::class, 'create'])->name('organisasi-otonom.create');
        Route::post('/organisasi-otonom', [OrganisasiController::class, 'store'])->name('organisasi-otonom.store');
        Route::get('/organisasi-otonom/{id}/edit', [OrganisasiController::class, 'edit'])->name('organisasi-otonom.edit');
        Route::put('/organisasi-otonom/{id}', [OrganisasiController::class, 'update'])->name('organisasi-otonom.update');
        Route::delete('/organisasi-otonom/{id}', [OrganisasiController::class, 'destroy'])->name('organisasi-otonom.destroy');

        Route::get('/struktur-organisasi', [StrukturOrganisasiController::class, 'index'])->name('struktur-organisasi');
        Route::get('/struktur-organisasi/{strukturOrganisasi}', [StrukturOrganisasiController::class, 'show'])->name('struktur-organisasi.show');
        Route::post('/struktur-organisasi', [StrukturOrganisasiController::class, 'store'])->name('struktur-organisasi.store');
        Route::put('/struktur-organisasi/{strukturOrganisasi}', [StrukturOrganisasiController::class, 'update'])->name('struktur-organisasi.update');
        Route::delete('/struktur-organisasi/{strukturOrganisasi}', [StrukturOrganisasiController::class, 'destroy'])->name('struktur-organisasi.destroy');

        Route::get('/pengurus', [PengurusController::class, 'index'])->name('pengurus.index');
        Route::get('/pengurus/create', [PengurusController::class, 'create'])->name('pengurus.create');
        Route::post('/pengurus', [PengurusController::class, 'store'])->name('pengurus.store');
        Route::get('/pengurus/{id}/edit', [PengurusController::class, 'edit'])->name('pengurus.edit');
        Route::put('/pengurus/{id}', [PengurusController::class, 'update'])->name('pengurus.update');
        Route::delete('/pengurus/{id}', [PengurusController::class, 'destroy'])->name('pengurus.destroy');

        Route::resource('berita', NewsController::class);

        Route::get('/articles', [ArtikelController::class, 'index'])->name('articles');
        Route::get('/articles/create', [ArtikelController::class, 'create'])->name('articles.create');
        Route::post('/articles', [ArtikelController::class, 'store'])->name('articles.store');
        Route::get('/articles/{id}/edit', [ArtikelController::class, 'edit'])->name('articles.edit');
        Route::put('/articles/{id}', [ArtikelController::class, 'update'])->name('articles.update');
        Route::delete('/articles/{id}', [ArtikelController::class, 'destroy'])->name('articles.destroy');

        Route::get('/program-kajian', [JadwalKajianController::class, 'index'])->name('program-kajian');
        Route::get('/program-kajian/create', [JadwalKajianController::class, 'create'])->name('jadwal-kajian.create');
        Route::post('/program-kajian', [JadwalKajianController::class, 'store'])->name('jadwal-kajian.store');
        Route::get('/program-kajian/{id}/edit', [JadwalKajianController::class, 'edit'])->name('jadwal-kajian.edit');
        Route::put('/program-kajian/{id}', [JadwalKajianController::class, 'update'])->name('jadwal-kajian.update');
        Route::delete('/program-kajian/{id}', [JadwalKajianController::class, 'destroy'])->name('jadwal-kajian.destroy');

        Route::get('/amal-usaha', [AmalUsahaController::class, 'index'])->name('amal-usaha.index');
        Route::get('/amal-usaha/create', [AmalUsahaController::class, 'create'])->name('amal-usaha.create');
        Route::post('/amal-usaha', [AmalUsahaController::class, 'store'])->name('amal-usaha.store');
        Route::get('/amal-usaha/{id}/edit', [AmalUsahaController::class, 'edit'])->name('amal-usaha.edit');
        Route::put('/amal-usaha/{id}', [AmalUsahaController::class, 'update'])->name('amal-usaha.update');
        Route::delete('/amal-usaha/{id}', [AmalUsahaController::class, 'destroy'])->name('amal-usaha.destroy');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::middleware(['auth', 'role:superadmin'])->group(function () {

            Route::get('/manage-user', [ManageUserController::class, 'index'])
                ->name('manage-user');

            Route::get('/manage-user/create', [ManageUserController::class, 'create'])
                ->name('manage-user.create');

            Route::post('/manage-user', [ManageUserController::class, 'store'])
                ->name('manage-user.store');

            Route::get('/manage-user/{id}/edit', [ManageUserController::class, 'edit'])
                ->name('manage-user.edit');

            Route::put('/manage-user/{id}', [ManageUserController::class, 'update'])
                ->name('manage-user.update');

            Route::delete('/manage-user/{id}', [ManageUserController::class, 'destroy'])
                ->name('manage-user.destroy');
        });
    });
});

Route::prefix('penulis')->name('penulis.')->group(function () {
    Route::middleware(['auth', 'role:penulis'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::get('/articles', [ArtikelController::class, 'index'])->name('articles');
        Route::get('/articles/create', [ArtikelController::class, 'create'])->name('articles.create');
        Route::post('/articles', [ArtikelController::class, 'store'])->name('articles.store');
        Route::get('/articles/{id}/edit', [ArtikelController::class, 'edit'])->name('articles.edit');
        Route::put('/articles/{id}', [ArtikelController::class, 'update'])->name('articles.update');
        Route::delete('/articles/{id}', [ArtikelController::class, 'destroy'])->name('articles.destroy');

        Route::resource('/berita', NewsController::class);
    });
});

Route::prefix('bendahara')->name('bendahara.')->group(function () {

    Route::middleware(['auth', 'role:bendahara,superadmin'])->group(function () {

        Route::get('/2fa/setup', [TwoFactorController::class, 'setup'])
            ->name('2fa.setup');
        Route::post('/2fa/setup', [TwoFactorController::class, 'activate'])
            ->name('2fa.activate');

        Route::get('/2fa/verify', [TwoFactorController::class, 'index'])
            ->name('2fa.verify');
        Route::post('/2fa/verify', [TwoFactorController::class, 'verify'])
            ->name('2fa.check');
    });

    Route::middleware(['auth', 'role:bendahara,superadmin', 'bendahara.2fa'])->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('/keuangan', FinanceController::class);
    });
});



Route::get('/cek-db', function () {
    return [
        'env' => env('DB_CONNECTION'),
        'config' => config('database.default'),
    ];
});

require __DIR__ . '/auth.php';
