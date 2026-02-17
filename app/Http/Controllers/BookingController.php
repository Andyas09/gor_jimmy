<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lapangan;
use App\Models\Jadwal;
use Carbon\Carbon;
use App\Models\Booking;
use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Transaction;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use DB;
class BookingController extends Controller
{
    private function setActive($page)
    {
        return [
            'Booking' => $page,
            'BookingActive' => true,
        ];
    }
    public function index(Request $request)
    {
        $query = Booking::with('lap', 'jad');

        if (auth()->user()->role === 'Member') {
            $query->where('whatsapp', auth()->user()->whatsapp);
        }

        if ($request->kode) {
            $query->where('kode_booking', 'like', '%' . $request->kode . '%');
        }
        if ($request->nama) {
            $query->where('nama', 'like', '%' . $request->nama . '%');
        }
        if ($request->jenis) {
            $query->where('jenis', $request->jenis);
        }
        if ($request->lapangan) {
            $query->where('lapangan', $request->lapangan);
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->urutkan === 'terlama') {
            $query->orderBy('updated_at', 'asc');
        } else {
            $query->orderBy('updated_at', 'desc');
        }

        // Untuk Member, group by kode
        if (Auth::user()->role === 'Member') {
            $allBookings = $query->get();
            $groupedBookings = $allBookings->groupBy('kode')->map(function ($group) {
                $first = $group->first();
                $first->slots = $group; // Simpan semua slot untuk ditampilkan
                return $first;
            })->values();

            // Manual pagination
            $perPage = 10;
            $currentPage = request()->get('page', 1);
            $offset = ($currentPage - 1) * $perPage;
            $items = $groupedBookings->slice($offset, $perPage)->values();

            $booking = new \Illuminate\Pagination\LengthAwarePaginator(
                $items,
                $groupedBookings->count(),
                $perPage,
                $currentPage,
                ['path' => request()->url(), 'query' => request()->query()]
            );
        } else {
            $booking = $query->paginate(10)->withQueryString();
        }

        $lapangan = Lapangan::orderBy('nama')->get();
        $jadwal = Jadwal::orderBy('hari')->get();
        return view(
            'admin.pages.booking',
            compact('booking', 'lapangan', 'jadwal'),
            $this->setActive('booking')
        );
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'whatsapp' => 'required',
            'lapangan' => 'required',
            'dp' => 'required',
            'hari' => 'required',
            'total_bayar' => 'required',
            'jadwal' => 'required',
            'tanggal' => 'required|date',
            'status' => 'required|in:Pending,Booked,Selesai,Dibatalkan',
            'bukti_booking' => 'nullable|image|max:2048'
        ]);
        $cek = Booking::where('jadwal', $request->jadwal)
            ->where('tanggal', $request->tanggal)
            ->whereIn('status', ['Booked', 'Pending'])
            ->exists();

        if ($cek) {
            return back()->with('error', 'Jadwal sudah dibooking');
        }
        $bukti = null;
        if ($request->hasFile('bukti_booking')) {
            $bukti = $request->file('bukti_booking')
                ->store('bukti-booking', 'public');
        }
        $jenis = (Auth::check() && Auth::user()->role === 'Member') ? 'Member' : 'Biasa';

        $booking = Booking::create([
            'id' => 'BO-' . strtoupper(Str::random(6)),
            'kode' => 'KODE-' . strtoupper(Str::random(6)),
            'nama' => $request->nama,
            'whatsapp' => $request->whatsapp,
            'jenis' => $jenis,
            'lapangan' => $request->lapangan,
            'jadwal' => $request->jadwal,
            'hari' => $request->hari,
            'dp' => $request->dp,
            'total_bayar' => $request->total_bayar,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
            'bukti' => $bukti,
        ]);
        Jadwal::where('id', $request->jadwal)
            ->update(['status' => 'Booked']);
        return redirect()->back()
            ->with('success', 'Booking berhasil ditambahkan dan jadwal dibooking');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Booked,Selesai,Dibatalkan',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->status = $request->status;
        $booking->save();
        if ($request->status === 'Selesai') {
            Jadwal::where('id', $booking->jadwal)
                ->update(['status' => 'Tersedia']);
        }
        if ($request->status === 'Dibatalkan') {
            Jadwal::where('id', $booking->jadwal)
                ->update(['status' => 'Tersedia']);
        }
        if ($request->status === 'Booked') {
            Jadwal::where('id', $booking->jadwal)
                ->update(['status' => 'Booked']);
        }
        return redirect()
            ->route('booking.index')
            ->with('success', 'Status Booking berhasil diperbarui.');
    }
    public function cekJadwal(Request $request)
    {
        $hari = Carbon::parse($request->tanggal)
            ->locale('id')
            ->translatedFormat('l');

        $jadwal = Jadwal::where('hari', $hari)
            ->where('lapangan', $request->lapangan)
            ->orderBy('waktu', 'asc')
            ->get()
            ->map(function ($j) use ($request) {
                $booked = Booking::where('lapangan', $request->lapangan)
                    ->where('tanggal', $request->tanggal)
                    ->where('jadwal', $j->id)
                    ->where('status', 'Booked')
                    ->exists();

                return [
                    'id' => $j->id,
                    'waktu' => $j->waktu,
                    'booked' => $booked
                ];
            });

        return response()->json($jadwal);
    }

    public function storeBooking(Request $request)
    {
        if ($request->existing_kode) {
            $booking = Booking::where('kode', $request->existing_kode)->first();
            if (!$booking) {
                return response()->json(['error' => 'Booking tidak ditemukan'], 404);
            }

            // Parse total_bayar - bisa berupa angka atau string terformat
            $totalHarga = (int) preg_replace('/[^0-9]/', '', $booking->total_bayar);
            $dp = (int) $booking->dp;
            $sisa = $totalHarga - $dp;

            // Debug log
            \Log::info('Repayment Check', [
                'kode' => $request->existing_kode,
                'total_bayar_raw' => $booking->total_bayar,
                'total_bayar_parsed' => $totalHarga,
                'dp' => $dp,
                'sisa' => $sisa
            ]);

            if ($sisa <= 0) {
                return response()->json([
                    'error' => 'Pembayaran sudah lunas',
                    'debug' => [
                        'total_bayar' => $booking->total_bayar,
                        'total_harga_parsed' => $totalHarga,
                        'dp' => $dp,
                        'sisa' => $sisa
                    ]
                ]);
            }
            $repayOrderId = $booking->kode . '-REPAY-' . time();

            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = true;
            Config::$is3ds = true;

            $params = [
                'transaction_details' => [
                    'order_id' => $repayOrderId,
                    'gross_amount' => $sisa,
                ],
                'customer_details' => [
                    'first_name' => $booking->nama,
                    'phone' => $booking->whatsapp,
                ],
            ];

            $snapToken = Snap::getSnapToken($params);

            return response()->json([
                'snap_token' => $snapToken,
                'order_id' => $repayOrderId
            ]);
        }

        $request->validate([
            'lapangan' => 'required',
            'tanggal' => 'required|date',
            'jadwal_ids' => 'required',
            'name' => 'required|string',
            'whatsapp' => 'required',
            'dp' => 'required|numeric|min:0',
        ]);

        $lapanganId = $request->lapangan;
        $tanggal = $request->tanggal;
        $jadwalIds = explode(',', $request->jadwal_ids);
        $hari = Carbon::parse($tanggal)->locale('id')->translatedFormat('l');

        $jadwal = Jadwal::whereIn('id', $jadwalIds)
            ->where('hari', $hari)
            ->get();

        if ($jadwal->count() !== count($jadwalIds)) {
            return back()->with('error', 'Jadwal tidak sesuai hari');
        }

        foreach ($jadwalIds as $jid) {
            if (
                Booking::where([
                    'lapangan' => $lapanganId,
                    'tanggal' => $tanggal,
                    'jadwal' => $jid,
                    'status' => 'Booked'
                ])->exists()
            ) {
                return back()->with('error', 'Jadwal sudah dibooking');
            }
        }

        $totalHarga = $this->hitungTotalHarga($jadwal, $tanggal);

        if ($request->dp > $totalHarga) {
            return back()->with('error', 'DP melebihi total');
        }

        DB::beginTransaction();
        try {

            $orderId = 'ORDER-' . strtoupper(Str::random(8));

            $jenis = (Auth::check() && Auth::user()->role === 'Member') ? 'Member' : 'Biasa';

            // simpan booking status pending
            foreach ($jadwalIds as $jid) {
                Booking::create([
                    'id' => 'BO-' . strtoupper(Str::random(6)),
                    'kode' => $orderId,
                    'lapangan' => $lapanganId,
                    'tanggal' => $tanggal,
                    'jadwal' => $jid,
                    'hari' => $hari,
                    'nama' => $request->name,
                    'whatsapp' => $request->whatsapp,
                    'jenis' => $jenis,
                    'dp' => $request->dp,
                    'total_bayar' => $totalHarga,
                    'status' => 'Pending',
                ]);
            }

            // konfigurasi midtrans
            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = true;
            Config::$is3ds = true;

            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => $request->dp,
                ],
                'customer_details' => [
                    'first_name' => $request->name,
                    'phone' => $request->whatsapp,
                ],
            ];

            $snapToken = Snap::getSnapToken($params);

            DB::commit();

            return response()->json([
                'snap_token' => $snapToken,
                'order_id' => $orderId
            ]);


        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
    private function hitungTotalHarga($jadwal, $tanggal)
    {
        $hari = Carbon::parse($tanggal)->dayOfWeek;
        $isWeekend = in_array($hari, [Carbon::SATURDAY, Carbon::SUNDAY]);

        $total = 0;

        foreach ($jadwal as $j) {
            $jamMulai = (int) explode('.', explode('-', $j->waktu)[0])[0];
            if ($jamMulai >= 18 && $jamMulai < 23) {
                $total += 90000;
            }
            // WEEKEND
            elseif ($isWeekend) {
                $total += 100000;
            }
            // WEEKDAY
            else {
                $total += 75000;
            }
        }
        return $total;
    }
    public function invoice($orderId)
    {
        // Cek apakah ini repayment order ID
        if (strpos($orderId, '-REPAY-') !== false) {
            // Extract original order ID
            $originalOrderId = explode('-REPAY-', $orderId)[0];
            return $this->handleRepaymentInvoice($orderId, $originalOrderId);
        }

        $bookings = Booking::with('lap', 'jad')
            ->where('kode', $orderId)
            ->get();

        if ($bookings->isEmpty()) {
            abort(404);
        }

        // konfigurasi midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');

        try {
            $status = Transaction::status($orderId);

            if (
                $status->transaction_status === 'settlement' ||
                $status->transaction_status === 'capture'
            ) {
                DB::transaction(function () use ($orderId, $bookings) {
                    // update status booking
                    Booking::where('kode', $orderId)
                        ->update(['status' => 'Booked']);

                    // update status jadwal (pakai ID)
                    Jadwal::whereIn(
                        'id',
                        $bookings->pluck('jadwal')
                    )->update(['status' => 'Booked']);
                });
            }

        } catch (\Exception $e) {
        }

        return view('invoice', [
            'orderId' => $orderId,
            'booking' => $bookings->first(),
            'jadwal' => $bookings
        ]);
    }

    private function handleRepaymentInvoice($repayOrderId, $originalOrderId)
    {
        $bookings = Booking::with('lap', 'jad')
            ->where('kode', $originalOrderId)
            ->get();

        if ($bookings->isEmpty()) {
            abort(404);
        }

        // konfigurasi midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');

        try {
            // Cek status transaksi repayment
            $status = Transaction::status($repayOrderId);

            if (
                $status->transaction_status === 'settlement' ||
                $status->transaction_status === 'capture'
            ) {
                DB::transaction(function () use ($originalOrderId, $bookings) {
                    $booking = $bookings->first();
                    $totalHarga = (int) preg_replace('/[^0-9]/', '', $booking->total_bayar);

                    // Update dp to total_bayar (fully paid)
                    Booking::where('kode', $originalOrderId)
                        ->update([
                            'dp' => $totalHarga,
                            'status' => 'Booked'
                        ]);

                    // Update status jadwal (pakai ID)
                    Jadwal::whereIn(
                        'id',
                        $bookings->pluck('jadwal')
                    )->update(['status' => 'Booked']);
                });
            }

        } catch (\Exception $e) {
        }

        return view('invoice', [
            'orderId' => $originalOrderId,
            'booking' => $bookings->first(),
            'jadwal' => $bookings
        ]);
    }
}
