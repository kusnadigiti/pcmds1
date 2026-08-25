<?php

use Illuminate\Support\Carbon;

if (! function_exists('cm_tanggal_id')) {
    /**
     * Format tanggal dalam bahasa Indonesia (tanggal 17 Maret 2026).
     */
    function cm_tanggal_id(mixed $date): string
    {
        $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $d = $date instanceof Carbon ? $date : Carbon::parse($date);

        return $d->format('j').' '.($bulan[(int) $d->format('n')] ?? '').' '.$d->format('Y');
    }
}

if (! function_exists('cm_bulan_pendek_id')) {
    /**
     * Nama bulan pendek bahasa Indonesia berdasarkan nomor bulan (1-12).
     */
    function cm_bulan_pendek_id(int $bulanKe): string
    {
        return [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'][$bulanKe] ?? '';
    }
}

if (! function_exists('cm_kategori_label')) {
    /**
     * Label kategori berita yang rapi.
     */
    function cm_kategori_label(?string $kategori): string
    {
        return match ($kategori) {
            'dakwah' => 'Dakwah',
            'pendidikan' => 'Pendidikan',
            'sosial' => 'Sosial',
            'organisasi' => 'Organisasi',
            'kesehatan' => 'Kesehatan',
            'ekonomi' => 'Ekonomi',
            default => ucfirst($kategori ?? 'Umum'),
        };
    }
}
