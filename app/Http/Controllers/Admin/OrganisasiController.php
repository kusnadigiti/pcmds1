<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OrganisasiController extends Controller
{
    public function index()
    {
        $organisasis = Organisasi::latest()->get();

        $columns = [
            ['key' => 'nama',      'label' => 'Nama Organisasi', 'sortable' => true],
            ['key' => 'singkatan', 'label' => 'Singkatan',       'sortable' => false],
            ['key' => 'tipe',      'label' => 'Tipe',            'sortable' => true],
            ['key' => 'deskripsi', 'label' => 'Deskripsi',       'sortable' => false], // TAMBAHKAN INI
            ['key' => 'is_active', 'label' => 'Status',          'sortable' => true],
            ['key' => 'logo',      'label' => 'Logo',            'sortable' => false],
            ['key' => 'periode_mulai',   'label' => 'Periode Mulai',         'sortable' => true],
            ['key' => 'periode_selesai', 'label' => 'Periode Selesai',       'sortable' => true],
        ];

        $rows = $organisasis->map(fn($o) => [
            'id'        => (string) $o->id,
            'email'     => (string) $o->id,
            'nama'      => $o->nama,
            'singkatan' => $o->singkatan,
            'tipe'      => $o->tipe,
            'deskripsi' => $o->deskripsi, // TAMBAHKAN INI
            'is_active' => $o->is_active,
            'logo'      => $o->logo ? asset('storage/' . $o->logo) : null,
            'periode_mulai'   => $o->periode_mulai,
            'periode_selesai' => $o->periode_selesai,
        ])->toArray();

        return view('pages.admin.organisasi.index', compact('columns', 'rows', 'organisasis'));
    }

    public function create()
    {
        return view('pages.admin.organisasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'            => 'required|string|max:200',
            'singkatan'       => 'required|string|max:10',
            'tipe'            => 'required|in:otonom,lembaga,majelis',
            'deskripsi'       => 'nullable|string',
            'logo'            => 'nullable|image|mimes:png,jpg,webp|max:2048',
            'periode_mulai'   => 'required|digits:4|integer|min:1900|max:2100',
            'periode_selesai' => 'required|digits:4|integer|min:1900|max:2100|gte:periode_mulai',
            'is_active'       => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logo-organisasi', 'public');
        }

        $validated['slug']      = Str::slug($validated['nama']);
        $validated['is_active'] = $request->boolean('is_active', true);

        Organisasi::create($validated);

        return redirect()
            ->route('admin.organisasi-otonom')
            ->with('success', 'Organisasi berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $organisasi = Organisasi::findOrFail($id);
        return view('pages.admin.organisasi.edit', compact('organisasi'));
    }

    public function update(Request $request, string $id)
    {
        $organisasi = Organisasi::findOrFail($id);

        $validated = $request->validate([
            'nama'            => 'required|string|max:200',
            'singkatan'       => 'required|string|max:10',
            'tipe'            => 'required|in:otonom,lembaga,majelis',
            'deskripsi'       => 'nullable|string',
            'logo'            => 'nullable|image|mimes:png,jpg,webp|max:2048',
            'periode_mulai'   => 'required|digits:4|integer|min:1900|max:2100',
            'periode_selesai' => 'required|digits:4|integer|min:1900|max:2100|gte:periode_mulai',
            'is_active'       => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            if ($organisasi->logo && Storage::disk('public')->exists($organisasi->logo)) {
                Storage::disk('public')->delete($organisasi->logo);
            }
            $validated['logo'] = $request->file('logo')->store('logo-organisasi', 'public');
        } else {
            $validated['logo'] = $organisasi->logo;
        }

        $validated['slug']      = Str::slug($validated['nama']);
        $validated['is_active'] = $request->boolean('is_active');

        $organisasi->update($validated);

        return redirect()
            ->route('admin.organisasi-otonom')
            ->with('success', 'Organisasi berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        try {
            $organisasi = Organisasi::findOrFail($id);

            if ($organisasi->logo && Storage::disk('public')->exists($organisasi->logo)) {
                Storage::disk('public')->delete($organisasi->logo);
            }

            $organisasi->delete();

            return response()->json([
                'success' => true,
                'message' => 'Organisasi berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data',
            ], 500);
        }
    }
}
