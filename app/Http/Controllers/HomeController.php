<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lapangan;
use App\Models\Jadwal;
class HomeController extends Controller
{
    public function index()
    {
        // Data untuk pricing
        $pricingPlans = [
            [
                'name' => 'Weekday',
                'price' => '75.000',
                'features' => ['Senin - Jumat', 'Jam 08:00 - 16:00', 'Include shuttlecock', 'Free air mineral'],
                'is_featured' => false
            ],
            [
                'name' => 'Weekend',
                'price' => '100.000',
                'features' => ['Sabtu - Minggu', 'Jam 08:00 - 22:00', 'Include shuttlecock', 'Free air mineral & snack'],
                'is_featured' => true
            ],
            [
                'name' => 'Malam Hari',
                'price' => '90.000',
                'features' => ['Setiap Hari', 'Jam 18:00 - 23:00', 'Include shuttlecock', 'Free air mineral'],
                'is_featured' => false
            ]
        ];
        $facilities = [
            ['icon' => 'layer-group', 'title' => 'Lapangan Standar Internasional', 'desc' => 'Lapangan dengan permukaan vinyl berkualitas tinggi'],
            ['icon' => 'lightbulb', 'title' => 'Penerangan Optimal', 'desc' => 'Penerangan LED 300 lux untuk kenyamanan bermain'],
            ['icon' => 'wind', 'title' => 'AC dan Ventilasi', 'desc' => 'Sistem pendingin dan ventilasi udara yang optimal'],
            ['icon' => 'shower', 'title' => 'Kamar Mandi & Loker', 'desc' => 'Fasilitas kamar mandi bersih dan loker pribadi']
        ];
        $map = [
            'lat' => -7.795580,
            'lng' => 110.369490,
            'place' => 'GOR Jimmy'
        ];
        $lapangan = Lapangan::all();
        return view('welcome', compact('pricingPlans', 'map', 'facilities', 'lapangan'));
    }

    public function booking(Request $request)
    {
        // Validasi form booking
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email',
            'date' => 'required|date',
            'time' => 'required',
            'duration' => 'required|integer|min:1',
            'court_type' => 'required|string'
        ]);

        // Logika penyimpanan booking (bisa disimpan ke database)
        // Untuk sekarang, kita hanya return success message

        return back()->with('success', 'Booking berhasil dikirim! Kami akan menghubungi Anda untuk konfirmasi.');
    }
    public function getJadwal(Request $request)
    {
        $lapangan = $request->lapangan;
        $hari = $request->hari;
        $durasi = (int) $request->duration;

        if (!$lapangan || !$hari || !$durasi) {
            return response()->json([]);
        }

        $jadwal = Jadwal::where('lapangan', $lapangan)
            ->where('hari', $hari)
            ->where('status', 'Tersedia')
            ->orderByRaw("STR_TO_DATE(SUBSTRING_INDEX(waktu,' - ',1),'%H.%i')")
            ->get();

        $hasil = [];

        for ($i = 0; $i < $jadwal->count(); $i++) {

            $totalHarga = 0;
            $jamMulai = '';
            $jamAkhir = '';
            $valid = true;

            for ($j = 0; $j < $durasi; $j++) {

                if (!isset($jadwal[$i + $j])) {
                    $valid = false;
                    break;
                }

                [$mulai, $akhir] = explode(' - ', $jadwal[$i + $j]->waktu);

                if ($j === 0)
                    $jamMulai = $mulai;
                $jamAkhir = $akhir;

                $jam = (int) substr($mulai, 0, 2);
                if (in_array($hari, ['Sabtu', 'Minggu'])) {
                    $harga = 100000;
                } elseif ($jam >= 18 && $jam <= 23) {
                    $harga = 90000;
                } else {
                    $harga = 75000;
                }

                $totalHarga += $harga;
            }

            if ($valid) {
                $hasil[] = [
                    'id' => $jadwal[$i]->id,
                    'label' => "$jamMulai - $jamAkhir",
                    'harga' => $totalHarga
                ];
            }
        }

        return response()->json($hasil);
    }
}