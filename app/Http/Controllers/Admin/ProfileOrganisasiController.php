<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Models\Profile;
use App\Models\ProfileOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileOrganisasiController extends Controller
{
    public function index()
    {
        $profile = ProfileOrganisasi::latest('created_at')->get();

        $hero = $profile->first();

        $columns = [
            ['key' => 'nama',    'label' => 'Nama',    'sortable' => true],
            ['key' => 'visi',    'label' => 'Visi',    'sortable' => false],
            ['key' => 'misi',    'label' => 'Misi',    'sortable' => false],
            ['key' => 'tagline', 'label' => 'Tagline', 'sortable' => false],
            ['key' => 'image',   'label' => 'Image',   'sortable' => false],
        ];

        $rows = $profile->map(fn($p) => [
            'nama'    => $p->nama,
            'visi'    => $p->visi,
            'misi'    => $p->misi,
            'tagline' => $p->tagline,
            'image'   => asset('storage/' . $p->image),
            'id'      => $p->id,
        ])->toArray();

        return view('pages.admin.profile-org.profile-organisasi', compact('profile', 'columns', 'rows', 'hero'));
    }

    public function create()
    {
        return view('pages.admin.profile-org.profile-organisasi-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:200',
            'visi' => 'required|string|max:200',
            'misi' => 'required|string|max:200',
            'image' => 'required|mimes:png,jpg|max:2048',
            'tagline' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images-profile', 'public');
            $validated['image'] = $path;
        }

        ProfileOrganisasi::create($validated);

        return redirect()->route('admin.profile-organisasi')->with('success', 'Data profile berhasil dibuat');
    }

    public function edit($id)
    {
        $profile = ProfileOrganisasi::findOrFail($id);
        return view('pages.admin.profile-org.profile-organisasi-edit', compact('profile'));
    }

    public function update(Request $request, string $id)
    {
        $profile = ProfileOrganisasi::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:200',
            'visi' => 'required|string|max:200',
            'misi' => 'required|string|max:200',
            'image' => 'nullable|mimes:png,jpg|max:2048',
            'tagline' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            if ($profile->image && Storage::disk('public')->exists($profile->image)) {
                Storage::disk('public')->delete($profile->image);
            }
            $path = $request->file('image')->store('images-profile', 'public');
            $validated['image'] = $path;
        } else {
            $validated['image'] = $profile->image;
        }

        $profile->update($validated);
        return redirect()->route('admin.profile-organisasi')->with('success', 'Data profile berhasil diperbarui');
    }

    public function destroy($id)
    {
        try {
            $profile = ProfileOrganisasi::findOrFail($id);

            if ($profile->image && Storage::disk('public')->exists($profile->image)) {
                Storage::disk('public')->delete($profile->image);
            }

            $profile->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
