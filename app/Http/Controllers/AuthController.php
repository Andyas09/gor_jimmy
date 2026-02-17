<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }
    public function proses_login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if (
            Auth::attempt([
                'username' => $request->username,
                'password' => $request->password,
            ])
        ) {

            $user = Auth::user();
            if ($user->status !== 'Aktif') {
                Auth::logout();
                return back()->with('error', 'Akun tidak aktif');
            }

            $request->session()->regenerate();
            if ($user->role === 'Admin') {
                return redirect()
                    ->route('admin.dashboard')
                    ->with('success', 'Berhasil Login sebagai Admin');
            }

            if ($user->role === 'Member') {
                return redirect()
                    ->route('booking.index')
                    ->with('success', 'Berhasil Login sebagai Member');
            }
            Auth::logout();
            return back()->with('error', 'Role tidak dikenali');
        }

        return back()->with('error', 'Username atau Password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        return redirect('/gor-jimmy')->with('success', 'Berhasil logout');
    }

    public function register()
    {
        return view('admin.auth.register');
    }

    public function proses_register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'whatsapp' => 'required|string|max:20',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
        ]);

        try {
            User::create([
                'name' => $request->name,
                'whatsapp' => $request->whatsapp,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role' => 'Member',
                'jenis' => 'Member',
                'status' => 'Aktif',
            ]);

            return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan login.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mendaftar: ' . $e->getMessage())->withInput();
        }
    }
}