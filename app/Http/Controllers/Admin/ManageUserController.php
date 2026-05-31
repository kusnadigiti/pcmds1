<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ManageUserController extends Controller
{
    public function index()
    {
        $columns = [
            ['key' => 'name', 'label' => 'Nama'],
            ['key' => 'email', 'label' => 'Email'],
            ['key' => 'role', 'label' => 'Role'],
            ['key' => 'created_at', 'label' => 'Tanggal Dibuat'],
        ];

        $rows = User::latest('created_at')
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => ucfirst($user->role),
                    'created_at' => $user->created_at
                        ? $user->created_at->format('d M Y')
                        : '-',
                ];
            });

        return view('pages.admin.manage-user.index', compact('columns', 'rows'));
    }


    public function create()
    {
        return view('pages.admin.manage-user.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,penulis,bendahara',
        ]);

        User::create($validated);

        return redirect()
            ->route('admin.manage-user')
            ->with('success', 'User berhasil dibuat!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('pages.admin.manage-user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $manage_user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $manage_user->id,
            'password' => 'nullable|min:6',
            'role' => 'required|in:admin,penulis,bendahara',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $manage_user->update($validated);

        return redirect()
            ->route('admin.manage-user')
            ->with('success', 'User berhasil diupdate!');
    }

    public function destroy($id)
    {
        if (auth()->id() == $id) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak dapat menghapus akun Anda sendiri!'
            ], 400);
        }

        $user = User::findOrFail($id);

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User berhasil dihapus!'
        ]);
    }
}
