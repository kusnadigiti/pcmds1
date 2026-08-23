# AGENTS.md

## Project

Laravel 12 mosque/organization management CMS. PHP 8.2+, MySQL, Vite + Tailwind CSS + Alpine.js.

## Quick Commands

```bash
composer dev          # Runs artisan serve + queue:listen + pail + npm run dev (concurrently)
php artisan serve     # Dev server only
npm run dev           # Vite dev server only
npm run build         # Vite production build
php artisan migrate   # Run migrations
php artisan test      # PHPUnit (suites: Unit, Feature)
./vendor/bin/pint     # Laravel Pint (code formatter - no config file, uses Laravel defaults)
```

## Code Style

- Laravel Pint with default config (no `pint.json`). Run `./vendor/bin/pint` before committing.
- `.editorconfig`: 4 spaces, LF line endings, UTF-8.
- Views use Blade templates in `resources/views/`.

## Architecture

### Roles & Middleware

Three custom middleware registered in `bootstrap/app.php`:
- `role` → `App\Http\Middleware\RoleMiddleware` — checks `auth()->user()->role` against allowed list
- `bendahara.2fa` → `App\Http\Middleware\EnsureBendahara2FA` — enforces Google 2FA for bendahara

Role values: `admin`, `superadmin`, `penulis`, `bendahara`.

### Route Groups (`routes/web.php`)

| Prefix | Roles | Notes |
|--------|-------|-------|
| `/admin` | admin, superadmin | Main CMS dashboard, CRUD for all content |
| `/admin` (nested) | superadmin only | User management (`manage-user`) |
| `/penulis` | penulis | Article & news CRUD only |
| `/bendahara` | bendahara, superadmin | Finance, requires 2FA verification |

Public routes: landing page, articles, news, organizations, amal-usaha, sitemap.xml.

### Key Models

All in `app/Models/`. 14 models total. Notable:
- `User` — has `role` field (string), `google2fa_secret`, `google2fa_enabled`
- `Organisasi` — table `organisasi_otonom`, scopes: `aktif()`, `otonom()`, `lembaga()`, `majelis()`
- `Pengurus` — belongs to `Organisasi` via `organisasi_otonom_id`
- `AmalUsaha` — belongs to `Organisasi`, grouped by `tipe` (bidang_pendidikan, bidang_kesehatan, bidang_sosial)

### Enums (`app/Enum/`)

- `StatusEnum` — draft, published (used by Article, Berita)
- `KategoriEnum` — Dakwah, Pendidikan, Sosial, Organisasi (used by Berita)

### Frontend

- Tailwind with custom theme: `primary` (#0d5c3a green), `secondary` (#D4A017 gold), `accent` (#0f1923), `cream` (#f8f5ee)
- Font: Plus Jakarta Sans
- Icons: Lucide (npm dependency)
- Alpine.js for interactivity
- Blade components: `AppLayout`, `GuestLayout` in `app/View/Components/`

### Caching

`AppServiceProvider` registers model observers on Berita, Article, Pengurus, Organisasi, Jadwal that auto-clear `admin_dashboard_data` cache on save/delete.

### 2FA Flow

Bendahara users must set up Google 2FA before accessing finance routes. Session key: `2fa_passed`. Setup at `/bendahara/2fa/setup`, verify at `/bendahara/2fa/verify`.

## Testing

- PHPUnit 11 with `tests/Unit` and `tests/Feature` suites.
- `phpunit.xml` uses array drivers for mail/session/cache/queue in testing.
- SQLite in-memory is commented out in `phpunit.xml` — tests hit the MySQL database defined in `.env`.
- Minimal test coverage: only `ExampleTest` and `ProfileTest` exist.

## Environment

- `.env` ships with APP_KEY and MySQL config (database: `web-masjid-2`).
- Session, cache, queue all use `database` driver.
- No Docker/Sail config present despite `laravel/sail` being a dev dependency.

## Gotchas

- `KategoriEnum.php` has `<?` instead of `<?php` opening tag (line 1) — works but non-standard.
- Some migration filenames contain typos (`fix_tipe_enum`, `revert_tipe_enum_to_ortonom`) — these are intentional schema fixes, not errors.
- The `/cek-db` route exposes DB config — likely a debug route left in production.
- No CI workflows configured (no `.github/` directory).
