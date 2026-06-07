<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    public function index()
    {
        $columns = [
            ['key' => 'title', 'label' => 'Judul'],
            ['key' => 'author', 'label' => 'Penulis'],
            ['key' => 'content', 'label' => 'Konten'],
            ['key' => 'thumbnail', 'label' => 'Gambar'],
            ['key' => 'status', 'label' => 'Status'],
            ['key' => 'created_at', 'label' => 'Tanggal'],
        ];

        $query = Article::latest('created_at');

        if (auth()->user()->role === 'penulis') {
            $query->where('user_id', auth()->id());
        }

        $rows = $query->get()->map(function ($article) {
            return [
                'id' => $article->id,
                'title' => $article->title,
                'author' => $article->author ?? 'Unknown',
                'content' => Str::limit(strip_tags($article->content), 50),
                'thumbnail' => asset(
                    $article->thumbnail
                    ? 'storage/' . $article->thumbnail
                    : 'https://picsum.photos/100/100?random=' . $article->id
                ),
                'status' => ucfirst($article->status ?? 'draft'),
                'created_at' => $article->created_at?->format('d M Y') ?? 'N/A',
                'email' => (string) $article->id,
            ];
        });

        return view('pages.admin.articles.index', compact('columns', 'rows'));
    }

    public function create()
    {
        return view('pages.admin.articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg,webp|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        // Generate slug unique
        $slug = Str::slug($request->title);
        $count = Article::where('slug', 'like', $slug . '%')->count();
        $validated['slug'] = $count ? "{$slug}-" . ($count + 1) : $slug;

        // Tambahkan user_id
        $validated['user_id'] = Auth::id();

        Article::create($validated);

        // Redirect sesuai role
        if (auth()->user()->role === 'admin' || auth()->user()->role === 'superadmin') {
            return redirect()->route('admin.articles')
                ->with('success', '✅ Artikel berhasil dibuat!');
        }

        return redirect()->route('penulis.articles')
            ->with('success', '✅ Artikel berhasil dibuat!');
    }

    public function edit(string $id)
    {
        $article = Article::findOrFail($id);

        // Penulis tidak boleh edit artikel orang lain
        if (
            auth()->user()->role === 'penulis' &&
            $article->user_id !== Auth::id()
        ) {
            abort(403);
        }

        return view('pages.admin.articles.edit', compact('article'));
    }

    public function update(Request $request, string $id)
    {
        $article = Article::findOrFail($id);

        if (
            auth()->user()->role === 'penulis' &&
            $article->user_id !== Auth::id()
        ) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg,webp|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        if ($request->hasFile('thumbnail')) {

            if ($article->thumbnail) {
                Storage::disk('public')->delete($article->thumbnail);
            }

            $validated['thumbnail'] = $request->file('thumbnail')
                ->store('thumbnails', 'public');
        }

        if ($request->title !== $article->title) {
            $slug = Str::slug($request->title);

            $count = Article::where('slug', 'like', $slug . '%')
                ->where('id', '!=', $id)
                ->count();

            $validated['slug'] = $count
                ? "{$slug}-" . ($count + 1)
                : $slug;
        }

        $article->update($validated);

        $role = auth()->user()->role;
        $prefix = ($role === 'admin' || $role === 'superadmin') ? 'admin' : 'penulis';

        return redirect()->route($prefix . '.articles')
            ->with('success', '✅ Artikel berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        if (
            auth()->user()->role === 'penulis' &&
            $article->user_id !== Auth::id()
        ) {
            abort(403);
        }

        if ($article->thumbnail && Storage::disk('public')->exists($article->thumbnail)) {
            Storage::disk('public')->delete($article->thumbnail);
        }

        $article->delete();

        return response()->json([
            'success' => true,
            'message' => '✅ Artikel berhasil dihapus!'
        ]);
    }
}
