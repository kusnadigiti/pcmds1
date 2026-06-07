<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AmalUsaha;
use App\Models\Organisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AmalUsahaController extends Controller
{
    private function formatTipe($value): string
    {
        return match ($value) {
            'bidang_sosial'     => 'Bidang Sosial',
            'bidang_kesehatan'  => 'Bidang Kesehatan',
            'bidang_pendidikan' => 'Bidang Pendidikan',
            default             => '-',
        };
    }

    public function index()
    {
        $columns = [
            ['label' => 'Organisasi Ortonom', 'key' => 'organisasi_otonom'],
            ['label' => 'Nama Amal Usaha',   'key' => 'nama'],
            ['label' => 'Tipe',              'key' => 'tipe'],
            ['label' => 'Deskripsi',         'key' => 'deskripsi'],
        ];

        $rows = AmalUsaha::with('organisasiOtonom')
            ->get()
            ->map(function ($item) {
                return [
                    'id'                => $item->id,
                    'email'             => $item->id,
                    'organisasi_otonom' => $item->organisasiOtonom?->nama,
                    'nama'              => $item->nama,
                    'tipe'              => $this->formatTipe($item->tipe),
                    'deskripsi'         => $item->deskripsi,
                ];
            });

        return view('pages.admin.amal-usaha.index', compact('columns', 'rows'));
    }

    public function create()
    {
        $organisasiOtonoms = Organisasi::orderBy('nama')->get();

        return view('pages.admin.amal-usaha.create', compact('organisasiOtonoms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'organisasi_otonom_id' => ['required', 'exists:organisasi_otonom,id'],
            'nama'                 => ['required', 'string', 'max:255'],
            'deskripsi'            => ['nullable', 'string'],
            'tipe'                 => ['required', 'in:bidang_sosial,bidang_kesehatan,bidang_pendidikan'],
            'foto'                 => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,gif,svg', 'max:2048'],
        ], [
            'organisasi_otonom_id.required' => 'Organisasi ortonom wajib dipilih.',
            'organisasi_otonom_id.exists'   => 'Organisasi ortonom tidak ditemukan.',
            'nama.required'                 => 'Nama amal usaha wajib diisi.',
            'tipe.required'                 => 'Tipe bidang wajib dipilih.',
            'tipe.in'                       => 'Tipe bidang tidak valid.',
            'foto.image'                    => 'File harus berupa gambar.',
            'foto.mimes'                    => 'Format gambar harus PNG, JPG, JPEG, WEBP, GIF, atau SVG.',
            'foto.max'                      => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('amal-usaha', 'public');
        }

        AmalUsaha::create($validated);

        return redirect()
            ->route('admin.amal-usaha.index')
            ->with('success', 'Amal usaha berhasil disimpan.');
    }

    public function edit(string $id)
    {
        $organisasiOtonoms = Organisasi::orderBy('nama')->get();
        $amalUsaha = AmalUsaha::findOrFail($id);

        return view('pages.admin.amal-usaha.edit', compact('amalUsaha', 'organisasiOtonoms'));
    }

    public function update(Request $request, string $id)
    {
        $amalUsaha = AmalUsaha::findOrFail($id);

        $validated = $request->validate([
            'organisasi_otonom_id' => ['required', 'exists:organisasi_otonom,id'],
            'nama'                 => ['required', 'string', 'max:255'],
            'deskripsi'            => ['nullable', 'string'],
            'tipe'                 => ['required', 'in:bidang_sosial,bidang_kesehatan,bidang_pendidikan'],
            'foto'                 => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,gif,svg', 'max:2048'],
        ], [
            'organisasi_otonom_id.required' => 'Organisasi ortonom wajib dipilih.',
            'organisasi_otonom_id.exists'   => 'Organisasi ortonom tidak ditemukan.',
            'nama.required'                 => 'Nama amal usaha wajib diisi.',
            'tipe.required'                 => 'Tipe bidang wajib dipilih.',
            'tipe.in'                       => 'Tipe bidang tidak valid.',
            'foto.image'                    => 'File harus berupa gambar.',
            'foto.mimes'                    => 'Format gambar harus PNG, JPG, JPEG, WEBP, GIF, atau SVG.',
            'foto.max'                      => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($request->hasFile('foto')) {
            if ($amalUsaha->foto) {
                Storage::disk('public')->delete($amalUsaha->foto);
            }
            $validated['foto'] = $request->file('foto')->store('amal-usaha', 'public');
        }

        $amalUsaha->update($validated);

        return redirect()
            ->route('admin.amal-usaha.index')
            ->with('success', 'Amal usaha berhasil diperbarui.');
    }

    public function destroy($id)
    {
        try {

            $amalUsaha = AmalUsaha::findOrFail($id);

            if ($amalUsaha->foto && Storage::disk('public')->exists($amalUsaha->foto)) {
                Storage::disk('public')->delete($amalUsaha->foto);
            }

            $amalUsaha->delete();

            return response()->json([
                'success' => true,
                'message' => 'Amal Usaha berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus amal usaha: ' . $e->getMessage()
            ], 500);
        }
    }
}
