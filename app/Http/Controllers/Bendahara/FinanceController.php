<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Finance;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class FinanceController extends Controller
{
    public function index()
    {
        $columns = [
            ['label' => 'Nama Penginput', 'key' => 'user_id'],
            ['label' => 'Judul', 'key' => 'judul'],
            ['label' => 'Deskripsi', 'key' => 'deskripsi'],
            ['label' => 'File PDF', 'key' => 'file'],
            ['label' => 'Kategori', 'key' => 'kategori'],
            ['label' => 'Tanggal Laporan', 'key' => 'tanggal_laporan'],
            ['label' => 'Dibuat', 'key' => 'created_at'],
        ];

        $rows = Finance::with('user')
            ->latest()
            ->get()
            ->map(function ($item) {
                return [
                    'id'              => $item->id,
                    'email'           => $item->id,
                    'user_id'         => $item->user?->name ?? '-',
                    'judul'           => $item->judul,
                    'deskripsi'       => Str::limit($item->deskripsi, 80),
                    'file'            => $item->file ? asset('storage/' . $item->file) : '-',
                    'kategori'        => ucfirst($item->kategori ?? '-'),
                    'tanggal_laporan' => $item->tanggal_laporan
                        ? \Carbon\Carbon::parse($item->tanggal_laporan)->format('d M Y')
                        : '-',
                    'created_at'      => $item->created_at?->format('d M Y') ?? '-',
                ];
            })
            ->toArray();

        return view('pages.bendahara.keuangan.index', compact('columns', 'rows'));
    }

    public function create()
    {
        return view('pages.bendahara.keuangan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'           => ['required', 'string', 'max:255'],
            'deskripsi'       => ['nullable', 'string'],
            'kategori'        => ['required', 'in:pemasukan,pengeluaran'],
            'tanggal_laporan' => ['required', 'date'],
            'file'            => ['required', 'file', 'mimes:pdf', 'max:5120'],
        ], [
            'judul.required'           => 'Judul laporan wajib diisi.',
            'kategori.required'        => 'Kategori wajib dipilih.',
            'kategori.in'              => 'Kategori tidak valid.',
            'tanggal_laporan.required' => 'Tanggal laporan wajib diisi.',
            'tanggal_laporan.date'     => 'Format tanggal tidak valid.',
            'file.required'            => 'File PDF wajib diunggah.',
            'file.mimes'               => 'File harus berformat PDF.',
            'file.max'                 => 'Ukuran file maksimal 5MB.',
        ]);

        $filePath = $request->file('file')->store('keuangan', 'public');

        Finance::create([
            'user_id'         => auth()->id(),
            'judul'           => $validated['judul'],
            'deskripsi'       => $validated['deskripsi'] ?? null,
            'kategori'        => $validated['kategori'],
            'tanggal_laporan' => $validated['tanggal_laporan'],
            'file'            => $filePath,
        ]);

        return redirect()
            ->route('bendahara.keuangan.index')
            ->with('success', 'Laporan keuangan berhasil disimpan.');
    }

    public function edit($id)
    {
        $finance = Finance::findOrFail($id);
        return view('pages.bendahara.keuangan.edit', compact('finance'));
    }

    public function update(Request $request, $id)
    {
        $finance = Finance::findOrFail($id);

        $validated = $request->validate([
            'judul'           => ['required', 'string', 'max:255'],
            'deskripsi'       => ['nullable', 'string'],
            'kategori'        => ['required', 'in:pemasukan,pengeluaran'],
            'tanggal_laporan' => ['required', 'date'],
            'file'            => ['nullable', 'file', 'mimes:pdf', 'max:5120'], // nullable saat edit
        ], [
            'judul.required'           => 'Judul laporan wajib diisi.',
            'kategori.required'        => 'Kategori wajib dipilih.',
            'kategori.in'              => 'Kategori tidak valid.',
            'tanggal_laporan.required' => 'Tanggal laporan wajib diisi.',
            'tanggal_laporan.date'     => 'Format tanggal tidak valid.',
            'file.mimes'               => 'File harus berformat PDF.',
            'file.max'                 => 'Ukuran file maksimal 5MB.',
        ]);

        $data = [
            'judul'           => $validated['judul'],
            'deskripsi'       => $validated['deskripsi'] ?? null,
            'kategori'        => $validated['kategori'],
            'tanggal_laporan' => $validated['tanggal_laporan'],
        ];

        if ($request->hasFile('file')) {
            if ($finance->file && Storage::disk('public')->exists($finance->file)) {
                Storage::disk('public')->delete($finance->file);
            }

            $data['file'] = $request->file('file')->store('keuangan', 'public');
        }

        $finance->update($data);

        return redirect()
            ->route('bendahara.keuangan.index')
            ->with('success', 'Laporan keuangan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $finance = Finance::findOrFail($id);

        if ($finance->file && Storage::disk('public')->exists($finance->file)) {
            Storage::disk('public')->delete($finance->file);
        }

        $finance->delete();

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Laporan keuangan berhasil dihapus.'
            ]);
        }

        return redirect()
            ->route('bendahara.keuangan.index')
            ->with('success', 'Laporan keuangan berhasil dihapus.');
    }
}
