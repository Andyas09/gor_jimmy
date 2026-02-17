<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    private function setActive($page)
    {
        return [
            'User' => $page,
            'userActive' => true,
        ];
    }
    public function index(Request $request)
    {
        $query = User::orderBy('created_at', 'desc');
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%");
            });
        }
        if ($request->has('role') && $request->role) {
            $query->where('role', $request->role);
        }
        $totalUsers = User::count();
        $adminCount = User::where('role', 'admin')->count();
        $users = $query->paginate(10);

        return view('admin.pages.user', compact(
            'users',
            'totalUsers',
            'adminCount'
        ), $this->setActive('user'));
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => [
                'required',
                'string'
            ],
        ]);

        try {

            $user->update($validated);
            return redirect()->route('user.index')
                ->with('success', 'Pengguna berhasil diperbarui');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui pengguna: ' . $e->getMessage())
                ->withInput();
        }
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->id == auth()->id()) {
            return redirect()->route('user.index')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri');
        }

        try {
            $user->delete();

            return redirect()->route('user.index')
                ->with('success', 'Pengguna berhasil dihapus');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus pengguna: ' . $e->getMessage());
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string',
        ]);

        User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role'     => 'Admin',
            'status'   => 'Aktif',
        ]);

        return back()->with('success', 'Akun berhasil ditambah');
    }


}