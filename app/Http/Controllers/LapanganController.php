<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lapangan;
use App\Models\Jenis;
use Illuminate\Support\Str;

class LapanganController extends Controller
{
    private function setActive($page)
    {
        return [
            'Lapangan' => $page,
            'LapanganActive' => true,
        ];
    }
    public function index(Request $request)
    {
        $query = Lapangan::query();

        if ($request->search) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $lapangan = $query->paginate(10)->withQueryString();

        return view(
            'admin.pages.lapangan',
            compact('lapangan'),
            $this->setActive('lapangan')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);
        Lapangan::create([
            'id' => 'LAP-' . strtoupper(Str::random(6)),
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
        ]);

        return back()->with('success', 'Lapangan berhasil ditambahkan');
    }
    public function update(Request $request, Lapangan $lapangan, $id)
    {
        $lapangan = Lapangan::where('id', $id)->firstOrFail();
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);
        $lapangan->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
        ]);
        return redirect()->route('lapangan.index')->with('success', 'Lapangan berhasil diupdate');
    }
    public function destroy($id)
    {
        $lapangan = Lapangan::where('id', $id)->firstOrFail();
        $lapangan->delete();

        return redirect()->route('lapangan.index')->with('success', 'Lapangan berhasil dihapus.');
    }
}
