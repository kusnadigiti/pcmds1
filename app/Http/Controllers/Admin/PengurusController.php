<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengurus;
use App\Models\Organisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PengurusController extends Controller
{
    public function index()
    {
        $pengurus = Pengurus::with('organisasi')->latest()->get();

        $columns = [
            ['key' => 'nama',           'label' => 'Nama',           'sortable' => true],
            ['key' => 'organisasi',     'label' => 'Organisasi',     'sortable' => true],
            ['key' => 'jabatan',        'label' => 'Jabatan',        'sortable' => true],
            ['key' => 'level',          'label' => 'Level',          'sortable' => true],
            ['key' => 'bidang',         'label' => 'Bidang',         'sortable' => true],
            ['key' => 'no_hp',          'label' => 'No. HP',         'sortable' => false],
            ['key' => 'periode_mulai',  'label' => 'Periode Mulai',  'sortable' => true],
            ['key' => 'periode_selesai', 'label' => 'Periode Selesai', 'sortable' => true],
            ['key' => 'urutan',         'label' => 'Urutan',         'sortable' => true],
            ['key' => 'is_active',      'label' => 'Status',         'sortable' => true],
            ['key' => 'foto',           'label' => 'Foto',           'sortable' => false],
        ];

        $rows = $pengurus->map(fn($p) => [
            'id'              => (string) $p->id,
            'email'           => (string) $p->id, // Untuk identifier di data-table
            'nama'            => $p->nama,
            'organisasi'      => $p->organisasi?->nama ?? '—',
            'jabatan'         => $p->jabatan,
            'level'           => $p->level,
            'bidang'          => $p->bidang ?? '—',
            'no_hp'           => $p->no_hp ?? '—',
            'email_pengurus'  => $p->email ?? '—',
            'periode_mulai'   => $p->periode_mulai,
            'periode_selesai' => $p->periode_selesai,
            'urutan'          => $p->urutan ?? 0,
            'is_active'       => $p->is_active,
            'foto'            => $p->foto ? asset('storage/' . $p->foto) : null,
        ])->toArray();

        return view('pages.admin.pengurus.index', compact('columns', 'rows', 'pengurus'));
    }

    public function create()
    {
        $organisasis = Organisasi::aktif()->orderBy('nama')->get();
        return view('pages.admin.pengurus.create', compact('organisasis'));
    }

    public function store(Request $request)
    {
        // Ambil data organisasi
        $organisasi = Organisasi::findOrFail($request->organisasi_otonom_id);

        // Definisikan rules validasi
        $rules = [
            'organisasi_otonom_id' => 'required|exists:organisasi_otonom,id',
            'nama'                 => 'required|string|max:200',
            'jabatan'              => 'required|string|max:100',
            'level'                => 'required|in:inti,majelis,lembaga',
            'bidang'               => 'nullable|string|max:100',
            'foto'                 => 'nullable|image|mimes:png,jpg|max:2048',
            'no_hp'                => 'nullable|string|max:20',
            'email'                => 'nullable|email|max:100',
            'periode_mulai' => [
                'required',
                'numeric',
                'min:1900',
                'max:2100',
                // 'gte:' . ($organisasi->periode_mulai - 1),
            ],
            'periode_selesai' => [
                'required',
                'numeric',
                'min:1900',
                'max:2100',
                'gte:periode_mulai',
                // 'lte:' . ($organisasi->periode_selesai + 1),
            ],
            'urutan'               => 'nullable|integer|min:0',
            'is_active'            => 'boolean',
        ];

        // Definisikan pesan error custom
        $messages = [
            'periode_mulai.gte' => 'Periode mulai tidak boleh kurang dari ' . ($organisasi->periode_mulai - 1),
            'periode_selesai.lte' => 'Periode selesai tidak boleh lebih dari ' . ($organisasi->periode_selesai + 1),
            'periode_selesai.gte' => 'Periode selesai harus lebih besar atau sama dengan periode mulai',
            'organisasi_otonom_id.required' => 'Organisasi wajib dipilih',
            'organisasi_otonom_id.exists' => 'Organisasi tidak valid',
            'nama.required' => 'Nama pengurus wajib diisi',
            'jabatan.required' => 'Jabatan wajib diisi',
            'level.required' => 'Level pengurus wajib dipilih',
            'level.in' => 'Level pengurus tidak valid',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format foto harus PNG atau JPG',
            'foto.max' => 'Ukuran foto maksimal 2MB',
            'email.email' => 'Format email tidak valid',
        ];

        // Jalankan validasi
        $validated = $request->validate($rules, $messages);

        // Handle upload foto
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('pengurus', 'public');
        }

        // Set default values
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['urutan']    = $validated['urutan'] ?? 0;

        // Simpan ke database
        Pengurus::create($validated);

        return redirect()
            ->route('admin.pengurus.index')
            ->with('success', 'Pengurus berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $pengurus    = Pengurus::findOrFail($id);
        $organisasis = Organisasi::aktif()->orderBy('nama')->get();
        return view('pages.admin.pengurus.edit', compact('pengurus', 'organisasis'));
    }

    public function update(Request $request, string $id)
    {
        $pengurus = Pengurus::findOrFail($id);

        // Ambil data organisasi yang dipilih
        $organisasi = Organisasi::findOrFail($request->organisasi_otonom_id);

        // Definisikan rules validasi (sama seperti store)
        $rules = [
            'organisasi_otonom_id' => 'required|exists:organisasi_otonom,id',
            'nama'                 => 'required|string|max:200',
            'jabatan'              => 'required|string|max:100',
            'level'                => 'required|in:inti,majelis,lembaga',
            'bidang'               => 'nullable|string|max:100',
            'foto'                 => 'nullable|image|mimes:png,jpg|max:2048',
            'no_hp'                => 'nullable|string|max:20',
            'email'                => 'nullable|email|max:100',
            'periode_mulai' => [
                'required',
                'numeric',
                'min:1900',
                'max:2100',
                // 'gte:' . ($organisasi->periode_mulai - 1),
            ],
            'periode_selesai' => [
                'required',
                'numeric',
                'min:1900',
                'max:2100',
                'gte:periode_mulai',
                // 'lte:' . ($organisasi->periode_selesai + 1),
            ],
            'urutan'               => 'nullable|integer|min:0',
            'is_active'            => 'boolean',
        ];

        // Definisikan pesan error custom
        $messages = [
            'periode_mulai.gte' => 'Periode mulai tidak boleh kurang dari ' . ($organisasi->periode_mulai - 1) . ' (periode organisasi: ' . $organisasi->periode_mulai . ')',
            'periode_selesai.lte' => 'Periode selesai tidak boleh lebih dari ' . ($organisasi->periode_selesai + 1) . ' (periode organisasi: ' . $organisasi->periode_selesai . ')',
            'periode_selesai.gte' => 'Periode selesai harus lebih besar atau sama dengan periode mulai',
        ];

        // Jalankan validasi
        $validated = $request->validate($rules, $messages);

        // Handle upload foto
        if ($request->hasFile('foto')) {
            // Hapus foto lama kalau ada
            if ($pengurus->foto && Storage::disk('public')->exists($pengurus->foto)) {
                Storage::disk('public')->delete($pengurus->foto);
            }
            $validated['foto'] = $request->file('foto')->store('pengurus', 'public');
        } else {
            $validated['foto'] = $pengurus->foto;
        }

        // Set default values
        $validated['is_active'] = $request->boolean('is_active');
        $validated['urutan']    = $validated['urutan'] ?? $pengurus->urutan;

        // Update ke database
        $pengurus->update($validated);

        return redirect()
            ->route('admin.pengurus.index')
            ->with('success', 'Data pengurus berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        try {
            $pengurus = Pengurus::findOrFail($id);

            if ($pengurus->foto && Storage::disk('public')->exists($pengurus->foto)) {
                Storage::disk('public')->delete($pengurus->foto);
            }

            $pengurus->delete();

            return response()->json([
                'success' => true,
                'message' => 'Pengurus berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data',
            ], 500);
        }
    }
}
