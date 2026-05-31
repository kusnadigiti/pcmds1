<x-app-layout>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,400&display=swap');

    :root {
        --ink:      #0f1117;
        --surface:  #f5f4f0;
        --card:     #ffffff;
        --gold:     #c9a84c;
        --gold-lt:  #f0e4c0;
        --teal:     #1a6b5e;
        --teal-lt:  #d4ede9;
        --red:      #c0392b;
        --red-lt:   #fce8e6;
        --muted:    #7a7d8a;
        --border:   #e5e3dc;
        --shadow:   0 2px 16px rgba(15,17,23,.07);
        --radius:   16px;
    }

    .bnd { font-family:'DM Sans',sans-serif; background:var(--surface); min-height:100vh; padding:32px 28px 64px; color:var(--ink); }

    /* topline */
    .bnd-topline { height:4px; background:linear-gradient(90deg,var(--teal) 0%,var(--gold) 50%,var(--red) 100%); border-radius:99px; margin-bottom:32px; }

    /* header */
    .bnd-header { display:flex; align-items:flex-end; justify-content:space-between; flex-wrap:wrap; gap:16px; margin-bottom:36px; }
    .bnd-header h1 { font-family:'Playfair Display',serif; font-size:clamp(1.6rem,3vw,2.2rem); font-weight:700; letter-spacing:-.5px; margin:0 0 4px; }
    .bnd-header p  { font-size:.875rem; color:var(--muted); margin:0; }
    .bnd-badge { background:var(--gold-lt); color:#7a5c1a; font-size:.72rem; font-weight:600; letter-spacing:.08em; text-transform:uppercase; padding:5px 14px; border-radius:99px; border:1px solid var(--gold); }

    .bnd-actions { display:flex; gap:10px; flex-wrap:wrap; }
    .btn-primary { display:inline-flex; align-items:center; gap:7px; background:var(--ink); color:#fff; font-family:'DM Sans',sans-serif; font-weight:600; font-size:.84rem; padding:10px 20px; border-radius:10px; text-decoration:none; transition:background .2s,transform .15s; border:none; cursor:pointer; }
    .btn-primary:hover { background:#2c2f3a; transform:translateY(-1px); }
    .btn-outline { display:inline-flex; align-items:center; gap:7px; background:var(--card); color:var(--ink); font-family:'DM Sans',sans-serif; font-weight:600; font-size:.84rem; padding:10px 20px; border-radius:10px; border:1px solid var(--border); text-decoration:none; transition:background .2s,transform .15s; }
    .btn-outline:hover { background:var(--surface); transform:translateY(-1px); }

    /* flash */
    .flash { margin-bottom:20px; padding:12px 18px; border-radius:10px; font-size:.875rem; font-weight:500; display:flex; align-items:center; gap:10px; }
    .flash.success { background:var(--teal-lt); color:var(--teal); border:1px solid #a8d5ce; }
    .flash.error   { background:var(--red-lt);  color:var(--red);  border:1px solid #f0b9b4; }

    /* stat cards */
    .stat-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:16px; margin-bottom:28px; }
    .stat { background:var(--card); border:1px solid var(--border); border-radius:var(--radius); padding:24px 22px; box-shadow:var(--shadow); position:relative; overflow:hidden; transition:transform .2s,box-shadow .2s; }
    .stat:hover { transform:translateY(-3px); box-shadow:0 8px 28px rgba(15,17,23,.11); }
    .stat::after { content:''; position:absolute; bottom:0; left:0; right:0; height:3px; }
    .stat.s-inc::after  { background:var(--teal); }
    .stat.s-exp::after  { background:var(--red); }
    .stat.s-net::after  { background:var(--gold); }
    .stat.s-doc::after  { background:#4b6bfb; }
    .stat-icon { width:40px; height:40px; border-radius:10px; display:flex; align-items:center; justify-content:center; margin-bottom:16px; font-size:1rem; }
    .s-inc .stat-icon { background:var(--teal-lt); color:var(--teal); }
    .s-exp .stat-icon { background:var(--red-lt);  color:var(--red); }
    .s-net .stat-icon { background:var(--gold-lt); color:#7a5c1a; }
    .s-doc .stat-icon { background:#eef0fe; color:#4b6bfb; }
    .stat-lbl { font-size:.72rem; font-weight:700; letter-spacing:.07em; text-transform:uppercase; color:var(--muted); margin-bottom:6px; }
    .stat-val { font-family:'Playfair Display',serif; font-size:1.55rem; font-weight:700; line-height:1.1; margin-bottom:5px; }
    .stat-sub { font-size:.75rem; color:var(--muted); }
    .stat-sub .up   { color:var(--teal); font-weight:600; }
    .stat-sub .dn   { color:var(--red);  font-weight:600; }
    .stat-sub .nt   { color:#7a5c1a;    font-weight:600; }

    /* main grid */
    .main-grid { display:grid; grid-template-columns:1fr 340px; gap:20px; }
    @media(max-width:900px){ .main-grid { grid-template-columns:1fr; } }

    /* panel */
    .panel { background:var(--card); border:1px solid var(--border); border-radius:var(--radius); box-shadow:var(--shadow); overflow:hidden; }
    .panel-head { display:flex; align-items:center; justify-content:space-between; padding:18px 22px 16px; border-bottom:1px solid var(--border); }
    .panel-title { font-family:'Playfair Display',serif; font-size:1.05rem; font-weight:700; margin:0; }
    .panel-link  { font-size:.78rem; font-weight:600; color:var(--teal); text-decoration:none; }
    .panel-link:hover { text-decoration:underline; }

    /* table */
    .tbl-wrap { overflow-x:auto; }
    table { width:100%; border-collapse:collapse; font-size:.855rem; }
    thead th { padding:10px 16px; text-align:left; font-size:.7rem; font-weight:700; letter-spacing:.07em; text-transform:uppercase; color:var(--muted); background:var(--surface); border-bottom:1px solid var(--border); }
    tbody tr { border-bottom:1px solid var(--border); transition:background .15s; }
    tbody tr:last-child { border-bottom:none; }
    tbody tr:hover { background:#fafaf8; }
    tbody td { padding:13px 16px; vertical-align:middle; }
    .td-main { font-weight:500; }
    .td-sub  { color:var(--muted); font-size:.78rem; margin-top:2px; }

    .kat { display:inline-flex; align-items:center; gap:5px; padding:3px 10px; border-radius:99px; font-size:.72rem; font-weight:600; }
    .kat.p { background:var(--teal-lt); color:var(--teal); }
    .kat.e { background:var(--red-lt);  color:var(--red); }
    .kat .dot { width:6px; height:6px; border-radius:50%; background:currentColor; }

    .btn-ic { width:30px; height:30px; border-radius:8px; border:1px solid var(--border); background:var(--surface); cursor:pointer; display:inline-flex; align-items:center; justify-content:center; font-size:.85rem; color:var(--muted); text-decoration:none; transition:background .15s,color .15s; }
    .btn-ic:hover { background:var(--gold-lt); color:#7a5c1a; border-color:var(--gold); }
    .btn-ic.del:hover { background:var(--red-lt); color:var(--red); border-color:var(--red); }

    /* empty */
    .empty { text-align:center; padding:48px 20px; color:var(--muted); }
    .empty .ei { font-size:2.5rem; margin-bottom:10px; }
    .empty p { margin:0; font-size:.875rem; }
    .empty a { color:var(--teal); font-weight:600; text-decoration:none; }
    .empty a:hover { text-decoration:underline; }

    /* sidebar */
    .sidebar { display:flex; flex-direction:column; gap:20px; }

    /* bar chart */
    .chart-body { padding:16px 22px 22px; }
    .chart-legend { display:flex; gap:16px; margin-bottom:14px; }
    .leg { display:flex; align-items:center; gap:6px; font-size:.75rem; font-weight:600; color:var(--muted); }
    .leg-dot { width:8px; height:8px; border-radius:2px; }
    .leg-dot.i { background:var(--teal); }
    .leg-dot.e { background:var(--red); }
    .bar-chart { display:flex; align-items:flex-end; gap:6px; height:100px; }
    .bar-group { flex:1; display:flex; align-items:flex-end; gap:2px; }
    .bar { flex:1; border-radius:4px 4px 0 0; transition:opacity .2s; cursor:pointer; }
    .bar:hover { opacity:.7; }
    .bar.i { background:var(--teal); }
    .bar.e { background:var(--red); }
    .bar-lbls { display:flex; gap:6px; margin-top:6px; }
    .bar-lbl { flex:1; text-align:center; font-size:.67rem; color:var(--muted); font-weight:600; }

    /* activity */
    .act-list { padding:4px 0 8px; }
    .act-item { display:flex; align-items:flex-start; gap:12px; padding:11px 22px; transition:background .15s; }
    .act-item:hover { background:var(--surface); }
    .act-ic { width:34px; height:34px; border-radius:10px; flex-shrink:0; display:flex; align-items:center; justify-content:center; font-size:.9rem; }
    .act-ic.i { background:var(--teal-lt); color:var(--teal); }
    .act-ic.o { background:var(--red-lt);  color:var(--red); }
    .act-body { flex:1; min-width:0; }
    .act-name { font-weight:500; font-size:.84rem; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
    .act-date { font-size:.73rem; color:var(--muted); margin-top:2px; }
    .act-pdf  { font-size:.7rem; font-weight:600; color:#4b6bfb; background:#eef0fe; padding:2px 8px; border-radius:6px; white-space:nowrap; text-decoration:none; }
    .act-pdf:hover { background:#dde1fd; }

    /* saldo banner */
    .saldo-banner { background:var(--ink); color:#fff; border-radius:var(--radius); padding:20px 22px; display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap; }
    .saldo-banner .lbl { font-size:.72rem; font-weight:600; letter-spacing:.07em; text-transform:uppercase; opacity:.5; margin-bottom:4px; }
    .saldo-banner .val { font-family:'Playfair Display',serif; font-size:1.4rem; font-weight:700; }
    .saldo-banner .sub { font-size:.75rem; opacity:.5; margin-top:4px; }
    .saldo-banner .ratio-bar { flex:1; min-width:160px; }
    .ratio-track { height:6px; background:rgba(255,255,255,.15); border-radius:99px; margin-top:6px; overflow:hidden; }
    .ratio-fill  { height:100%; background:var(--gold); border-radius:99px; transition:width .8s ease; }

    /* tips */
    .tips { background:var(--gold-lt); border:1px solid var(--gold); }
    .tips .panel-head { border-bottom-color:var(--gold); }
    .tips .panel-title { color:#7a5c1a; }
    .tips ul { padding:14px 22px 18px; margin:0; list-style:none; display:flex; flex-direction:column; gap:10px; }
    .tips li { font-size:.82rem; color:#5a4010; display:flex; gap:8px; line-height:1.45; }
</style>

<div class="bnd">
    <div class="bnd-topline"></div>

    @if(session('success'))
        <div class="flash success">✓ {{ session('success') }}</div>
    @endif
    @if(session('error') || $errors->any())
        <div class="flash error">✕ {{ session('error') ?? $errors->first() }}</div>
    @endif

    {{-- Header --}}
    <div class="bnd-header">
        <div>
            <h1>Dasbor Keuangan</h1>
            <p>{{ now()->translatedFormat('l, d F Y') }}</p>
        </div>
        <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;">
            <span class="bnd-badge">📋 Bendahara</span>
            <div class="bnd-actions">
                <a href="{{ route('bendahara.keuangan.create') }}" class="btn-primary">
                    ＋ Upload PDF
                </a>
                <a href="{{ route('bendahara.keuangan.index') }}" class="btn-outline">
                    📋 Semua Laporan
                </a>
            </div>
        </div>
    </div>

    {{-- Saldo Banner --}}


    {{-- Main Grid --}}
    <div class="main-grid">

        {{-- LEFT: Tabel --}}
        <div>
            <div class="panel">
                <div class="panel-head">
                    <h2 class="panel-title">Laporan Terbaru</h2>
                    <a href="{{ route('bendahara.keuangan.index') }}" class="panel-link">Lihat semua →</a>
                </div>

                @if(isset($laporan) && $laporan->count())
                    <div class="tbl-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nama Penginput</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Tanggal Laporan</th>
                                    <th>File</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($laporan as $row)
                                <tr>
                                    <td>
                                        <div class="td-main">{{ $row->user->name }}</div>
                                        @if($row->created_at)
                                           <div class="td-sub">
                                                {{ $row->created_at->format('d M Y') }}
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="td-main">{{ $row->judul }}</div>
                                        @if($row->deskripsi)
                                            <div class="td-sub">{{ Str::limit($row->deskripsi, 52) }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="kat {{ $row->kategori === 'pemasukan' ? 'p' : 'e' }}">
                                            <span class="dot"></span>
                                            {{ ucfirst($row->kategori) }}
                                        </span>
                                    </td>
                                    <td style="white-space:nowrap;color:var(--muted);font-size:.82rem;">
                                        {{ \Carbon\Carbon::parse($row->tanggal_laporan)->format('d M Y') }}
                                    </td>
                                    <td>
                                        <a href="{{ Storage::url($row->file) }}" target="_blank" class="btn-ic" title="Buka PDF">📄</a>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('bendahara.keuangan.destroy', $row->id) }}"
                                              onsubmit="return confirm('Hapus laporan ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-ic del" title="Hapus">🗑</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty">
                        <div class="ei">📭</div>
                        <p>Belum ada laporan keuangan.<br>
                           <a href="{{ route('bendahara.keuangan.create') }}">Upload PDF pertama Anda →</a>
                        </p>
                    </div>
                @endif
            </div>
        </div>

        {{-- RIGHT: Sidebar --}}
        <div class="sidebar">
            {{-- Aktivitas Terkini --}}
            <div class="panel">
                <div class="panel-head">
                    <h2 class="panel-title">Aktivitas Terkini</h2>
                    <a href="{{ route('bendahara.keuangan.index') }}" class="panel-link">Semua →</a>
                </div>
                <div class="act-list">
                    @forelse(isset($recentLaporan) ? $recentLaporan : [] as $item)
                        <div class="act-item">
                            <div class="act-ic {{ $item->kategori === 'pemasukan' ? 'i' : 'o' }}">
                                {{ $item->kategori === 'pemasukan' ? '↑' : '↓' }}
                            </div>
                            <div class="act-body">
                                <div class="act-name">{{ $item->judul }}</div>
                                <div class="act-date">{{ \Carbon\Carbon::parse($item->tanggal_laporan)->diffForHumans() }}</div>
                            </div>
                            <a href="{{ Storage::url($item->file) }}" target="_blank" class="act-pdf">PDF</a>
                        </div>
                    @empty
                        <div class="empty" style="padding:28px 20px;">
                            <p>Belum ada aktivitas.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    @php
        $defaultChart = [
            ['label'=>'Jan','pemasukan'=>40,'pengeluaran'=>25],
            ['label'=>'Feb','pemasukan'=>55,'pengeluaran'=>30],
            ['label'=>'Mar','pemasukan'=>35,'pengeluaran'=>45],
            ['label'=>'Apr','pemasukan'=>70,'pengeluaran'=>20],
            ['label'=>'Mei','pemasukan'=>50,'pengeluaran'=>38],
            ['label'=>'Jun','pemasukan'=>60,'pengeluaran'=>42],
        ];
    @endphp
    const chartData = @json($chartData ?? $defaultChart);

    const maxVal = Math.max(...chartData.flatMap(d => [d.pemasukan, d.pengeluaran]), 1);
    const bc = document.getElementById('barChart');
    const bl = document.getElementById('barLabels');

    chartData.forEach(d => {
        const h1 = Math.round((d.pemasukan   / maxVal) * 90);
        const h2 = Math.round((d.pengeluaran  / maxVal) * 90);
        bc.innerHTML += `<div class="bar-group">
            <div class="bar i" style="height:${h1}px" title="Pemasukan: ${d.pemasukan}"></div>
            <div class="bar e" style="height:${h2}px" title="Pengeluaran: ${d.pengeluaran}"></div>
        </div>`;
        bl.innerHTML += `<div class="bar-lbl">${d.label}</div>`;
    });
</script>
</x-app-layout>
