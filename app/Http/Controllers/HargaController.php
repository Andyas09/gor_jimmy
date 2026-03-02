<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Harga;
use Illuminate\Support\Str;

class HargaController extends Controller
{
    private function setActive($page)
    {
        return [
            'Harga' => $page,
            'HargaActive' => true,
        ];
    }

    public function index(Request $request)
    {
        $query = Harga::query();
        $harga = $query->paginate(10)->withQueryString();

        return view(
            'admin.pages.harga',
            compact('harga'),
            $this->setActive(page: 'harga')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
        ]);

        Harga::create([
            'id' => 'HRG-' . strtoupper(Str::random(6)),
            'nama' => $request->nama,
            'harga' => $request->harga,
        ]);

        return back()->with('success', 'Harga berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $harga = Harga::where('id', $id)->firstOrFail();

        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
        ]);

        $harga->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
        ]);

        return redirect()->route('harga.index')->with('success', 'Harga berhasil diupdate');
    }

    public function destroy($id)
    {
        $harga = Harga::where('id', $id)->firstOrFail();
        $harga->delete();

        return redirect()->route('harga.index')->with('success', 'Harga berhasil dihapus');
    }
}
