<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeroSections;
use Illuminate\Support\Facades\Storage;

class HeroSectionsController extends Controller
{
    public function index()
    {
        $columns = [
            ['key' => 'image', 'label' => 'Banner'],
            ['key' => 'tagline', 'label' => 'Tagline'],
            ['key' => 'title', 'label' => 'Judul'],
            ['key' => 'created_at', 'label' => 'Tanggal Dibuat'],
        ];

        $rows = HeroSections::latest()
            ->get()
            ->map(function ($hero) {
                return [
                    'id' => $hero->id,

                    'image' => $hero->image
                        ? asset('storage/' . $hero->image)
                        : null,

                    'tagline' => $hero->tagline ?? '-',

                    'title' => $hero->title,

                    'created_at' => $hero->created_at
                        ? $hero->created_at->format('d M Y')
                        : '-',
                ];
            });

        return view('pages.admin.header.index', compact('columns', 'rows'));
    }

    public function create()
    {
        return view('pages.admin.header.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tagline' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request
                ->file('image')
                ->store('banner', 'public');
        }

        HeroSections::create($validated);

        return redirect()
            ->route('admin.banner.index')
            ->with('success', 'Banner berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $banner = HeroSections::findOrFail($id);

        return view('pages.admin.header.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $banner = HeroSections::findOrFail($id);

        $validated = $request->validate([
            'tagline' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {

            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }

            $validated['image'] = $request
                ->file('image')
                ->store('banner', 'public');
        }

        $banner->update($validated);

        return redirect()
            ->route('admin.banner.index')
            ->with('success', 'Banner berhasil diupdate.');
    }

    public function destroy($id)
    {
        try {
            $hero = HeroSections::findOrFail($id);

            // hapus gambar
            if ($hero->image && Storage::disk('public')->exists($hero->image)) {
                Storage::disk('public')->delete($hero->image);
            }

            // hapus data
            $hero->delete();

            return response()->json([
                'success' => true,
                'message' => 'Banner berhasil dihapus.',
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus banner.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
