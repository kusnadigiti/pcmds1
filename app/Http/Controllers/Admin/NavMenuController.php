<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NavMenu;
use Illuminate\Http\Request;

class NavMenuController extends Controller
{
    /**
     * Tampilkan halaman kelola navbar menu.
     */
    public function index()
    {
        $menus = NavMenu::topLevel()->with('children')->get();

        return view('pages.admin.navbar-menu.index', compact('menus'));
    }

    /**
     * Simpan menu baru (top-level atau sub-item).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'label'        => 'required|string|max:100',
            'url'          => 'nullable|string|max:500',
            'parent_id'    => 'nullable|exists:nav_menus,id',
            'open_new_tab' => 'boolean',
        ]);

        // Tentukan urutan: taruh di akhir
        $maxOrder = NavMenu::where('parent_id', $validated['parent_id'] ?? null)->max('order') ?? 0;

        NavMenu::create([
            'label'        => $validated['label'],
            'url'          => $validated['url'] ?? null,
            'parent_id'    => $validated['parent_id'] ?? null,
            'order'        => $maxOrder + 1,
            'is_visible'   => true,
            'open_new_tab' => $validated['open_new_tab'] ?? false,
        ]);

        return back()->with('success', 'Menu berhasil ditambahkan.');
    }

    /**
     * Update label, url, open_new_tab sebuah menu item.
     */
    public function update(Request $request, NavMenu $navMenu)
    {
        $validated = $request->validate([
            'label'        => 'required|string|max:100',
            'url'          => 'nullable|string|max:500',
            'open_new_tab' => 'boolean',
        ]);

        $navMenu->update([
            'label'        => $validated['label'],
            'url'          => $validated['url'] ?? null,
            'open_new_tab' => $validated['open_new_tab'] ?? false,
        ]);

        return back()->with('success', 'Menu berhasil diperbarui.');
    }

    /**
     * Hapus menu item (beserta sub-itemnya via cascade).
     */
    public function destroy(NavMenu $navMenu)
    {
        $navMenu->delete();

        return back()->with('success', 'Menu berhasil dihapus.');
    }

    /**
     * Toggle visibility sebuah menu item.
     */
    public function toggleVisibility(NavMenu $navMenu)
    {
        $navMenu->update(['is_visible' => ! $navMenu->is_visible]);

        return response()->json([
            'success'    => true,
            'is_visible' => $navMenu->is_visible,
        ]);
    }

    /**
     * Simpan urutan baru dari drag & drop.
     * Payload: [{ id, order, parent_id }, ...]
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'items'            => 'required|array',
            'items.*.id'       => 'required|exists:nav_menus,id',
            'items.*.order'    => 'required|integer|min:0',
            'items.*.parent_id' => 'nullable|exists:nav_menus,id',
        ]);

        foreach ($request->items as $item) {
            NavMenu::where('id', $item['id'])->update([
                'order'     => $item['order'],
                'parent_id' => $item['parent_id'] ?? null,
            ]);
        }

        return response()->json(['success' => true]);
    }
}
