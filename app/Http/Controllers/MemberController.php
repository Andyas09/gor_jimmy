<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    private function setActive($page)
    {
        return [
            'Dashboard' => $page,
            'DashboardActive' => true,
        ];
    }
    public function index()
    {
        return view('member.pages.dashboard', array_merge($this->setActive('dashboard')));
    }
    public function profil()
    {
        return view('admin.pages.akun', array_merge($this->setActive('profil')));
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->whatsapp = $request->whatsapp;
        if ($request->filled('old_password')) {
            if (!Hash::check($request->old_password, $user->password)) {
                return back()->with('error', 'Password lama salah!');
            }
            $request->validate([
                'new_password' => 'required|min:6|confirmed',
            ]);

            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

}
