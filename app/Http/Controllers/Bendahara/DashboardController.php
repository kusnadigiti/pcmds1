<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use App\Models\Finance;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch 10 latest laporan
        $laporan = Finance::with('user')
            ->where('user_id', auth()->id())
            ->latest()
            ->take(10)
            ->get();

        // Reuse the already fetched collection in memory to get the 5 latest
        $recentLaporan = $laporan->take(5);

        // Fetch counts using a single raw select aggregate query instead of 3 separate queries
        $financeStats = Finance::where('user_id', auth()->id())
            ->selectRaw("
                count(*) as total,
                sum(case when kategori = 'pemasukan' then 1 else 0 end) as pemasukan,
                sum(case when kategori = 'pengeluaran' then 1 else 0 end) as pengeluaran
            ")
            ->first();

        $totalLaporan = $financeStats->total ?? 0;
        $totalPemasukan = $financeStats->pemasukan ?? 0;
        $totalPengeluaran = $financeStats->pengeluaran ?? 0;

        return view('pages.bendahara.dashboard', compact(
            'laporan',
            'recentLaporan',
            'totalPemasukan',
            'totalPengeluaran',
            'totalLaporan'
        ));
    }
}
