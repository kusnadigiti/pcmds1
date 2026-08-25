# Design System — Tema "ColorMag" (Magazine/News Style)

> Dokumen ini merangkum pattern desain dari tema WordPress **ColorMag** (dipakai di situs muhammadiyahcileungsi.org) berdasarkan `style.css` dan markup HTML aktualnya. Tujuannya supaya AI agent bisa mereplika tampilan & struktur ini di stack apapun (HTML/CSS murni, React, Tailwind, dll) tanpa perlu dependency ke WordPress.

---

## 1. Ringkasan Konsep

Ini adalah layout **portal berita/majalah** klasik: header dengan logo + navigasi gelap, hero slider besar di atas, grid artikel dua kolom (konten utama + sidebar), lalu footer gelap dengan widget area dan copyright bar. Nuansa keseluruhan: bersih, kotak-kotak (card-based), aksen warna hijau segar sebagai identitas brand, tipografi sans-serif tebal untuk judul.

---

## 2. Design Tokens

### 2.1 Warna

| Token | Hex | Pemakaian |
|---|---|---|
| **Primary (aksen)** | `#2e9e5b` (hijau) | link hover, border aktif, badge kategori, tombol, garis bawah judul widget, border-top navbar |
| Primary light | `#9bc8da` | variasi tambahan |
| Dark navy (nav bg) | `#232323` | background navbar & dropdown menu |
| Footer dark | `#303440` / `#2c2e34` (card di footer) / `#252730` (socket bar classic) | background footer |
| Text utama | `#333333` | heading |
| Text body | `#444444` | paragraf |
| Text sekunder/meta | `#777777`, `#888888`, `#555555` | tanggal, author, meta info |
| Background halaman | `#eaeaea` | body background (area di luar container) |
| Card/section bg | `#ffffff` | konten utama, card |
| Border/divider tipis | `#eaeaea` | garis antar elemen |
| Breaking news bar bg | `#EBEBEC` / `#f8f8f8` | strip info di atas header |
| Link putih di area gelap | `#ffffff` → hover `#2e9e5b` | nav & footer links |

**CSS variables asli yang dipakai:**
```css
body {
  --color--light--primary: #9bc8da;
  --color--primary: #2e9e5b;
  --color--text--main: #333333;
  --color-gray--six: #888888;
}
```

### 2.2 Tipografi

- **Font utama:** `"Open Sans", sans-serif` (self-hosted via `@font-face`, weight 300–800 + italic)
- **Font monospace:** `"Courier 10 Pitch", Courier, monospace` (untuk `<code>`, `<pre>`)
- **Icon font:** FontAwesome (versi lama, ikon via `content: "\fXXX"` di pseudo-element `::before`)

**Heading scale** (semua heading: `font-weight: normal`, warna `#333333`, `padding-bottom: 18px`):

| Tag | Size |
|---|---|
| h1 | 36px |
| h2 | 32px |
| h3 | 28px |
| h4 | 24px |
| h5 | 22px |
| h6 | 18px |

- Body text: `16px`, `line-height: 1.6`, warna `#444444`
- Judul artikel di card (`.entry-title`): `22px` (card besar) / `18px` (card kecil) / `14px` (card sidebar-mini)
- Meta text (tanggal, author, komentar): `12px`, warna `#888888`

### 2.3 Spacing & Radius

- Container max-width: **1140px** (`.inner-wrap`), page wrapper max-width **1200px** (`#page`)
- Badge kategori: `border-radius: 3px`
- Card widget di footer (dark variant): `border-radius: 5px`
- Box shadow standar untuk card artikel: `0 1px 3px 0 rgba(0,0,0,0.1)`

---

## 3. Grid & Layout Global

```
body (bg #eaeaea, padding-top/bottom 10px)
 └─ #page (max-width: 1200px, margin: 0 auto)
     ├─ header#masthead
     ├─ #main (bg #fff, padding: 30px 0 20px)
     │   └─ .inner-wrap (max-width: 1140px)
     │       ├─ .front-page-top-section  → slider + highlighted widget (khusus homepage)
     │       └─ .main-content-section
     │           ├─ #primary   (float left, width: 70.17%)  ← konten utama
     │           └─ #secondary (float right, width: 27.19%) ← sidebar
     └─ footer#colophon
```

- Layout 2-kolom klasik pakai `float`, bukan flex/grid (gunakan CSS Grid/Flexbox modern saat replika, ratio-nya tetap **±70/30**).
- Body punya modifier class: `right-sidebar` (default), atau varian `left-sidebar`, `no-sidebar`, `no-sidebar-full-width`, dan `wide` (menghilangkan padding atas #page, container jadi full width).
- Utility 2-kolom generik: `.tg-one-half` (width 48.68%, margin-right 2.63%) + `.tg-one-half-last` (float right).

---

## 4. Header

### 4.1 Struktur (top → bawah)
1. **News bar / breaking news strip** (opsional) — bg `#f8f8f8`, font 14px, berisi tanggal & breaking news ticker.
2. **Header utama** (`#header-text-nav-container`, bg putih):
   - `#header-left-section`: logo image (`#header-logo-image`) + site title/tagline (`#site-title` font 46px warna primary, `#site-description` 16px abu).
   - `#header-right-section`: widget area kanan (biasanya iklan/banner), text-align right.
   - Bisa juga full-width **header image/banner** custom (seperti di situs contoh: banner PNG lebar penuh menggantikan logo teks).
3. **Navigasi utama** (`nav#site-navigation`, bg `#232323`, `border-top: 4px solid #2e9e5b`):
   - Menu horizontal, item `<li>` float left, link `a` uppercase, `font-size: 14px`, `font-weight: 600`, padding `10px 12px`, warna putih.
   - Hover/active: `background-color: #2e9e5b`.
   - Dropdown submenu: bg `#232323`, width `200px`, slide dari `left: -99999px` ke `left: 100%` saat hover (teknik lama, ganti dengan `opacity`/`transform` di implementasi modern).
   - Ikon panah untuk item dengan children (FontAwesome `\f107` / `\f105`).
   - Search icon di kanan navbar (`.fa.search-top`), toggle form search overlay saat diklik.
   - Mobile: `.menu-toggle` (hamburger icon `\f0c9`) muncul, menu berubah jadi `.main-small-navigation` full-width vertikal dengan bg putih per item, hover bg primary.

### 4.2 Contoh markup referensi
```html
<header id="masthead" class="site-header clearfix">
  <div id="header-text-nav-container">
    <div class="inner-wrap">
      <div id="header-text-nav-wrap">
        <div id="header-left-section">
          <div id="header-text">
            <h1 id="site-title"><a href="/">Nama Situs</a></h1>
            <p id="site-description">Tagline situs</p>
          </div>
        </div>
        <div id="header-right-section"><!-- widget kanan --></div>
      </div>
    </div>
    <nav id="site-navigation" class="main-navigation clearfix">
      <div class="inner-wrap">
        <p class="menu-toggle"></p>
        <div class="menu-primary-container">
          <ul class="menu">
            <li class="menu-item current-menu-item"><a href="#">Home</a></li>
            <li class="menu-item menu-item-has-children">
              <a href="#">Tentang</a>
              <ul class="sub-menu">
                <li><a href="#">Sejarah</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</header>
```

---

## 5. Komponen Kartu Artikel (dipakai berulang di banyak tempat)

Ini adalah **komponen paling penting** — dipakai di grid berita utama, sidebar, footer, dan slider dengan variasi ukuran.

### 5.1 Anatomi standar (`article` / `.single-article`)
```
article.post
 ├─ .featured-image (gambar thumbnail, ratio umum 800x445 / ~16:9)
 └─ .article-content
     ├─ .above-entry-meta
     │    └─ .cat-links → badge kategori (bg primary, warna putih, radius 3px, font 12px, padding 3px 10px)
     ├─ header.entry-header
     │    └─ h2/h3.entry-title (link ke post, warna gelap → hover primary)
     ├─ .below-entry-meta
     │    ├─ .posted-on (icon kalender + tanggal)
     │    ├─ .byline (icon user + nama author)
     │    ├─ .comments (icon komentar + jumlah)
     │    └─ .tag-links (icon tag + daftar tag)
     └─ .entry-content
          ├─ <p> (excerpt/ringkasan)
          └─ a.more-link "Read more →"
```

### 5.2 Style kunci
- Card shadow: `box-shadow: 0 1px 3px 0 rgba(0,0,0,0.1)` (dipakai di widget featured posts).
- Badge kategori: bg `#2e9e5b`, text putih, `border-radius: 3px`, `font-size: 12px`, `padding: 3px 10px`, `display: inline-block`.
- Judul (`entry-title`): warna `#232323`, hover → `#2e9e5b`, `text-shadow: none`.
- Meta icons (kalender/user/komentar/tag) pakai FontAwesome, warna abu `#888888`, size 10–11px, hover → primary.
- Semua transisi warna: `transition: background-color 0.3s linear 0s` (atau instant untuk color).

### 5.3 Contoh markup referensi (dari post asli)
```html
<article class="post has-post-thumbnail hentry category-berita">
  <div class="featured-image">
    <a href="/post-url/"><img src="thumb.jpg" width="800" height="445" alt=""/></a>
  </div>
  <div class="article-content clearfix">
    <div class="above-entry-meta">
      <span class="cat-links"><a href="/kategori/">Kategori</a></span>
    </div>
    <header class="entry-header">
      <h2 class="entry-title"><a href="/post-url/">Judul Artikel</a></h2>
    </header>
    <div class="below-entry-meta">
      <span class="posted-on"><i class="fa fa-calendar-o"></i>
        <time datetime="2026-03-17">17 Maret 2026</time></span>
      <span class="byline"><i class="fa fa-user"></i> Nama Author</span>
      <span class="comments"><i class="fa fa-comment"></i> 0 Comments</span>
      <span class="tag-links"><i class="fa fa-tags"></i> tag1, tag2</span>
    </div>
    <div class="entry-content">
      <p>Ringkasan singkat artikel...</p>
      <a class="more-link" href="/post-url/"><span>Read more</span></a>
    </div>
  </div>
</article>
```

---

## 6. Widget "Featured Posts" (grid unggulan di homepage)

Layout khas 2-kolom di dalam widget:
- `.first-post`: float left, width **48.7%** — post besar dengan gambar full + judul 22px.
- `.following-post` (bisa beberapa): float right, width **48.7%** — post kecil, gambar float left 
  di samping teks (mirip list horizontal mini), judul 18px, meta lebih ringkas, `.above-entry-meta` disembunyikan.
- Judul widget (`.widget-title`): border-bottom 2px solid primary, `span` di dalamnya diberi bg primary + padding `6px 12px` (efek "label kotak hijau").

```css
.widget-title { border-bottom: 2px solid #2e9e5b; font-size: 18px; margin-bottom: 15px; }
.widget-title span { background-color: #2e9e5b; color: #fff; padding: 6px 12px; display: inline-block; }
```
→ Pattern **judul section** ini konsisten dipakai di sidebar, footer, dan semua widget: teks judul dibungkus badge hijau dengan garis bawah tipis.

---

## 7. Slider / Hero (Featured Slider Widget)

- Full-width image slider (pakai library semacam bxSlider di versi asli — ganti dengan Swiper/Embla di implementasi modern).
- `.slide-content` diposisikan **absolute di bawah gambar**, dengan gradient overlay gelap dari transparan ke `rgba(0,0,0,0.3)` agar teks putih tetap terbaca.
- Isi overlay: badge kategori → judul (22px, putih, `text-shadow: 1px 1px 2px rgba(0,0,0,0.2)`) → meta (tanggal/author/komentar, semua putih).
- Tombol next/prev disembunyikan saat cuma 1 slide.

---

## 8. Sidebar (`#secondary`)

- Setiap widget: `margin-bottom: 35px`, font-size 14px.
- Widget umum yang muncul: **Search box**, **Media/banner image** (iklan/pengumuman statis), **Featured posts slider mini**, **Random posts**, **Text widget**.
- Search box: input + tombol icon kaca pembesar (FontAwesome `\f002`) menyatu jadi satu bar.
- List `<ul><li>` di widget: `padding: 5px 0`, tanpa bullet, separator garis (khusus versi footer).
- Judul widget sidebar pakai pattern badge hijau yang sama seperti section 6.

---

## 9. Footer (`#colophon`)

### 9.1 Struktur
```
footer#colophon
 ├─ .footer-widgets-wrapper (bg #303440, border-top tipis)
 │    └─ .inner-wrap
 │        └─ .footer-widgets-area (padding-top 45px)
 │            ├─ .tg-footer-main-widget   (width ~39.5%, float left)  → widget kolom besar pertama
 │            └─ .tg-footer-other-widgets (width ~57.9%, float right) → berisi 2-3 kolom kecil:
 │                 ├─ .tg-second-footer-widget (30.3%)
 │                 ├─ .tg-third-footer-widget  (30.3%)
 │                 └─ .tg-fourth-footer-widget (30.3%)
 └─ .footer-socket-wrapper (bg lebih gelap, mis. #252730, padding 20px 0)
      └─ .footer-socket-area
          ├─ .footer-socket-left-section  → copyright text (abu terang #b1b6b6, link underline)
          └─ .footer-socket-right-section → menu footer / social icons (opsional)
```

- Semua teks di footer widget berwarna terang: paragraf `#aaaaaa`, link `#ffffff` → hover `#2e9e5b`.
- Varian "classic": judul widget tanpa background badge, cuma garis aksen pendek (`width:25px; height:2px; background:#2e9e5b`) di bawah teks judul — lebih minimalis dibanding versi utama.
- Copyright text format umum: `Copyright © {tahun} {Nama Situs}. All rights reserved.`

---

## 10. Elemen UI Lain

| Elemen | Style |
|---|---|
| **Pagination** | angka aktif: bg primary, teks putih; angka non-aktif: bg putih, teks abu, hover → border & teks primary |
| **Scroll-to-top button** | fixed bottom-right, icon chevron-up warna primary, opacity 0.5 → hover 1 |
| **Link umum (dalam artikel)** | warna default → hover `#2e9e5b` |
| **Blockquote/quote box** | tanpa quote-mark bawaan browser (`content:""`) |
| **Table** | border tipis `#eaeaea`, padding `6px 10px` |
| **404 page** | search box besar (width 50%), text-align center |

---

## 11. Responsive Breakpoints

- **≥ 992px** — desktop penuh: nav horizontal, header 2 section kiri/kanan sejajar.
- **768–991px** — tablet: beberapa elemen header mulai stack, breaking news masih 1 baris.
- **≤ 768px** — mobile: navigasi berubah ke `.main-small-navigation` (vertikal, hamburger toggle), search icon & random-post icon menyesuaikan.
- **≤ 480px** — extra small: tanggal di header disembunyikan, padding breaking news dikecilkan.

Rekomendasi mapping modern: `sm: 480px`, `md: 768px`, `lg: 992px`, `xl: 1200px` (container).

---

## 12. Iconography

Tema asli pakai **FontAwesome 4.x** (ikon via unicode content di `::before`, bukan `<i>` SVG). Ikon yang dipakai:
- Kalender (`fa-calendar-o`) — tanggal post
- User (`fa-user`) — author
- Comment (`fa-comment`) — jumlah komentar
- Tags (`fa-tags`) — tag
- Search (`fa-search` / custom glyph `\f002`)
- Chevron/caret (`\f107`, `\f105`) — dropdown menu indicator
- Hamburger (`\f0c9`) — mobile menu toggle
- Random (`fa-random`) — random post shuffle icon
- Chevron-up (`fa-chevron-up`) — scroll to top

→ Saat replika modern, ganti dengan icon set apapun (Lucide, Heroicons, FontAwesome 6) selama mapping makna & posisinya sama.

---

## 13. Checklist Implementasi Cepat untuk AI Agent

1. Set warna primary `#2e9e5b`, font `Open Sans`, body bg `#eaeaea`, card/container bg `#ffffff`.
2. Buat container 2 lapis: outer `max-width: 1200px` (page), inner `max-width: 1140px` (content wrap).
3. Header: logo/title kiri, widget kanan, di bawahnya navbar gelap (`#232323`) dengan border-top 4px primary dan dropdown.
4. Section title pattern: teks dalam badge hijau + garis bawah tipis — pakai ini di SETIAP judul widget/section (sidebar, footer, featured posts).
5. Kartu artikel: gambar di atas, badge kategori, judul, meta (tanggal/author/komentar/tag) dengan icon abu, excerpt, tombol "Read more".
6. Layout homepage: hero slider (opsional) → grid 2 kolom 70/30 (konten/sidebar) → featured widget dengan 1 post besar + beberapa post kecil di sampingnya.
7. Footer gelap 2 tingkat: widget area (kolom lebar 40/60 lalu dibagi lagi jadi 3) + socket bar copyright.
8. Semua hover state: warna → `#2e9e5b`, transisi halus 0.3s.
9. Mobile: navbar collapse ke hamburger + list vertikal full width.
