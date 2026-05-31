<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class NewsController extends Controller
{
    public function index()
    {
        $columns = [
            ['key' => 'user_id', 'label' => 'Nama Akun'],
            ['key' => 'judul', 'label' => 'Judul'],
            ['key' => 'kategori', 'label' => 'Kategori'],
            ['key' => 'gambar', 'label' => 'Gambar'],
            ['key' => 'status', 'label' => 'Status'],
            ['key' => 'created_at', 'label' => 'Tanggal'],
        ];

        $query = Berita::latest('created_at');

        if (auth()->user()->role === 'penulis') {
            $query->where('user_id', auth()->id());
        }

        $rows = $query
            ->get()
            ->map(function ($berita) {
                return [
                    'id' => $berita->id,
                    'user_id' => $berita->user->name ?? '-',
                    'judul' => Str::limit($berita->judul, 50),
                    'kategori' => ucfirst($berita->kategori ?? 'Unknown'),
                    'status' => ucfirst($berita->status ?? 'draft'),
                    'created_at' => $berita->created_at?->format('d M Y') ?? 'N/A',
                    'gambar' => asset(
                        $berita->gambar
                            ? 'storage/' . $berita->gambar
                            : 'https://picsum.photos/100/100?random=' . $berita->id
                    ),
                    'email' => (string) $berita->id,
                ];
            })
            ->toArray();

        return view('pages.admin.news.index', compact('columns', 'rows'));
    }

    public function create()
    {
        return view('pages.admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'kategori' => ['required', Rule::in(['dakwah', 'pendidikan', 'sosial', 'organisasi'])],
            'status' => ['required', Rule::in(['draft', 'published'])],
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $slug = Str::slug($request->judul);
        $count = Berita::where('slug', 'like', $slug . '%')->count();
        $validated['slug'] = $count ? "{$slug}-" . ($count + 1) : $slug;
        $validated['user_id'] = Auth::id();

        Berita::create($validated);

        if (auth()->user()->role === 'admin' || auth()->user()->role === 'superadmin') {
            return redirect()->route('admin.berita.index')
                ->with('success', '✅ Berita berhasil disimpan!');
        }

        return redirect()->route('penulis.berita.index')
            ->with('success', '✅ Berita berhasil disimpan!');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);

        if (
            auth()->user()->role === 'penulis' &&
            $berita->user_id !== Auth::id()
        ) {
            abort(403);
        }

        return view('pages.admin.news.edit', compact('berita'));
    }
    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        if (
            auth()->user()->role === 'penulis' &&
            $berita->user_id !== Auth::id()
        ) {
            abort(403);
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'kategori' => ['required', Rule::in(['dakwah', 'pendidikan', 'sosial', 'organisasi'])],
            'status' => ['required', Rule::in(['draft', 'published'])],
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        if ($request->judul !== $berita->judul) {
            $slug = Str::slug($request->judul);
            $count = Berita::where('slug', 'like', $slug . '%')
                ->where('id', '!=', $id)
                ->count();
            $validated['slug'] = $count ? "{$slug}-" . ($count + 1) : $slug;
        }

        $berita->update($validated);

        $role = auth()->user()->role;
        $prefix = ($role === 'admin' || $role === 'superadmin') ? 'admin' : 'penulis';

        return redirect()->route($prefix . '.berita.index')
            ->with('success', '✅ Berita berhasil diupdate!');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        if (
            auth()->user()->role === 'penulis' &&
            $berita->user_id !== Auth::id()
        ) {
            abort(403);
        }

        if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
            Storage::disk('public')->delete($berita->gambar);
        }
        $berita->delete();

        return response()->json([
            'success' => true,
            'message' => '✅ Berita berhasil dihapus!'
        ]);
    }
}
