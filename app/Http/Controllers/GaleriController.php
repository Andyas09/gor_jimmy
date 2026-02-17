<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;
use Illuminate\Support\Str;

class GaleriController extends Controller
{
    private function setActive($page)
    {
        return [
            'galeri' => $page,
            'GaleriActive' => true,
        ];
    }
    public function index(Request $request)
    {
        $query = Galeri::query();
        $galeri = $query->paginate(10)->withQueryString();

        return view(
            'admin.pages.galeri',
            compact('galeri'),
            $this->setActive(page: 'galeri')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'nullable|max:2048',
        ]);
        $namaFile = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage'), $namaFile);
        }
        Galeri::create([
            'id' => 'GAL-' . strtoupper(Str::random(6)),
            'gambar' => $namaFile,
        ]);

        return back()->with('success', 'Galeri berhasil ditambahkan');
    }
    public function update(Request $request, Galeri $galeri, $id)
    {
        $galeri = Galeri::where('id', $id)->firstOrFail();
        $request->validate([
            'gambar' => 'nullable|max:2048',
        ]);
         if ($request->hasFile('gambar')) {
            if ($galeri->gambar && file_exists(public_path('storage/' . $galeri->gambar))) {
                unlink(public_path('storage/' . $galeri->gambar));
            }
            $file = $request->file('gambar');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage'), $namaFile);
            $galeri->update(['gambar' => $namaFile]);
        }
        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil diupdate');
    }
    public function destroy($id)
    {
        $galeri = Galeri::where('id', $id)->firstOrFail();
        $galeri->delete();

        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil dihapus.');
    }
}
