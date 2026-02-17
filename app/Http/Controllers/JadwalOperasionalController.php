<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lapangan;
use App\Models\Jadwal;
use App\Models\Jenis;
use Illuminate\Support\Str;

class JadwalOperasionalController extends Controller
{
    private function setActive($page)
    {
        return [
            'Jadwal' => $page,
            'JadwalActive' => true,
        ];
    }
    public function index(Request $request)
    {
        $query = Jadwal::with('lap')
            ->orderByDesc('updated_at');

        if ($request->hari) {
            $query->where('hari', $request->hari);
        }

        if ($request->lapangan_id) {
            $query->where('lapangan', $request->lapangan_id);
        }

        if ($request->waktu) {
            $query->where('waktu', $request->waktu);
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        $jadwal = $query->paginate(100)->withQueryString();
        $lapangan = Lapangan::all();
        $jadwalTerpakai = Jadwal::select('lapangan', 'hari', 'waktu')->get();

        return view(
            'admin.pages.jadwal',
            compact('jadwal', 'jadwalTerpakai', 'lapangan'),
            $this->setActive('jadwal')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'lapangan' => 'required',
            'hari' => 'required|string',
            'waktu' => 'required|string',
        ]);
        $cek = Jadwal::where('lapangan', $request->lapangan)
            ->where('hari', $request->hari)
            ->where('waktu', $request->waktu)
            ->exists();

        if ($cek) {
            return back()->withErrors([
                'waktu' => 'Waktu tersebut sudah terpakai!'
            ])->withInput();
        }
        Jadwal::create([
            'id' => 'JAD-' . strtoupper(Str::random(6)),
            'lapangan' => $request->lapangan,
            'hari' => $request->hari,
            'waktu' => $request->waktu,
            'status' => 'Tersedia',
        ]);

        return back()->with('success', 'Jadwal berhasil ditambahkan');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Tersedia,Booked,Blokir',
        ]);
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->status = $request->status;
        $jadwal->save();
        return redirect()
            ->route('jadwal.index')
            ->with('success', 'Status jadwal berhasil diperbarui.');
    }
}
