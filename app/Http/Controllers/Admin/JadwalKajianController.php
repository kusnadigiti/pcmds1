<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalKajianController extends Controller
{
    public function index()
    {
        $columns = [
            ['label' => 'Judul Kajian', 'key' => 'nama_kegiatan'],
            ['label' => 'Tanggal',      'key' => 'tanggal'],
            ['label' => 'Waktu',        'key' => 'waktu'],
            ['label' => 'Tempat',       'key' => 'lokasi'],
            ['label' => 'Deskripsi',    'key' => 'deskripsi'],
        ];

        $rows = Jadwal::all()
            ->map(function ($item) {
                $item->email = $item->id; // biar datatable aman
                return $item;
            });

        return view('pages.admin.program.kajian-index', compact('columns', 'rows'));
    }

    public function create()
    {
        return view('pages.admin.program.kajian-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal'       => 'required|date',
            'waktu'         => 'required',
            'lokasi'        => 'required|string|max:255',
            'deskripsi'     => 'nullable|string',
        ]);

        Jadwal::create($validated);

        return redirect()
            ->route('admin.program-kajian')
            ->with('success', 'Jadwal kajian berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);

        return view('pages.admin.program.kajian-edit', compact('jadwal'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal'       => 'required|date',
            'waktu'         => 'required',
            'lokasi'        => 'required|string|max:255',
            'deskripsi'     => 'nullable|string',
        ]);

        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update($validated);

        return redirect()
            ->route('admin.program-kajian')
            ->with('success', 'Jadwal kajian berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        // Kalau request dari fetch / AJAX
        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Jadwal kajian berhasil dihapus.'
            ]);
        }

        // Kalau request biasa (form submit)
        return redirect()
            ->route('admin.program-kajian')
            ->with('success', 'Jadwal kajian berhasil dihapus.');
    }
}
