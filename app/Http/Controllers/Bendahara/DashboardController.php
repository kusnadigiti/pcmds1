<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use App\Models\Finance;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $laporan        = Finance::where('user_id', auth()->id())
            ->latest()->take(10)->get();
        $recentLaporan  = $laporan->take(5);
        $totalPemasukan = Finance::where('user_id', auth()->id())
            ->where('kategori', 'pemasukan')->count();
        $totalPengeluaran = Finance::where('user_id', auth()->id())
            ->where('kategori', 'pengeluaran')->count();
        $totalLaporan   = Finance::where('user_id', auth()->id())->count();

        return view('pages.bendahara.dashboard', compact(
            'laporan',
            'recentLaporan',
            'totalPemasukan',
            'totalPengeluaran',
            'totalLaporan'
        ));
    }
}
