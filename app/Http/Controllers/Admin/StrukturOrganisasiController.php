<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StrukturOrganisasiController extends Controller
{
    /**
     * Tampilkan halaman bagan organisasi.
     */
    public function index()
    {
        // Seed default slots jika belum ada
        $this->seedDefaultSlots();

        $strukturs = StrukturOrganisasi::orderBy('peran_level')->orderBy('urutan')->get();

        return view('pages.admin.profile-org.kelola-organisasi', compact('strukturs'));
    }

    /**
     * Return JSON data satu anggota (untuk modal edit via AJAX).
     */
    public function show(StrukturOrganisasi $strukturOrganisasi)
    {
        return response()->json($strukturOrganisasi);
    }

    /**
     * Simpan anggota baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'        => 'required|string|max:100',
            'peran'       => 'required|string|max:100',
            'peran_level' => 'required|integer',
            'image'       => 'nullable|image|max:2048',
        ]);

        $data = [
            'nama'        => $validated['nama'],
            'peran'       => $validated['peran'],
            'peran_level' => $validated['peran_level'],
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('struktur', 'public');
        }

        $item = StrukturOrganisasi::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Anggota berhasil ditambahkan',
            'id' => $item->id,
            'data' => $item
        ]);
    }

    /**
     * Update data anggota.
     */
    public function update(Request $request, StrukturOrganisasi $strukturOrganisasi)
    {
        $validated = $request->validate([
            'nama'  => 'required|string|max:100',
            'peran' => 'required|string|max:100',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = [
            'nama'  => $validated['nama'],
            'peran' => $validated['peran'],
        ];

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($strukturOrganisasi->image) {
                Storage::disk('public')->delete($strukturOrganisasi->image);
            }
            $data['image'] = $request->file('image')->store('struktur', 'public');
        }

        $strukturOrganisasi->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diperbarui',
            'id' => $strukturOrganisasi->id,
            'data' => $strukturOrganisasi->fresh()
        ]);
    }

    /**
     * Hapus anggota organisasi.
     */
    public function destroy(StrukturOrganisasi $strukturOrganisasi)
    {
        try {
            // Hapus file image jika ada
            if ($strukturOrganisasi->image && Storage::disk('public')->exists($strukturOrganisasi->image)) {
                Storage::disk('public')->delete($strukturOrganisasi->image);
            }

            $strukturOrganisasi->delete();

            return response()->json([
                'success' => true,
                'message' => 'Anggota berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus: ' . $e->getMessage()
            ], 500);
        }
    }

    private function seedDefaultSlots()
    {
        if (StrukturOrganisasi::count() > 0) return;

        $slots = [
            // Level 1
            ['peran' => 'Ketua',             'peran_level' => 1, 'urutan' => 1],
            // Level 2
            ['peran' => 'Wakil Ketua',       'peran_level' => 2, 'urutan' => 1],
            ['peran' => 'Sekretaris',        'peran_level' => 2, 'urutan' => 2],
            ['peran' => 'Bendahara',         'peran_level' => 2, 'urutan' => 3],

        ];

        foreach ($slots as $slot) {
            StrukturOrganisasi::create($slot);
        }
    }
}
