<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Lapangan;
use Carbon\Carbon;
use DB;

class LaporanController extends Controller
{
    private function setActive($page)
    {
        return [
            'Laporan' => $page,
            'LaporanActive' => true,
        ];
    }

    public function index(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth()->toDateString());
        $endDate = $request->get('end_date', Carbon::now()->endOfMonth()->toDateString());

        $query = Booking::with('lap', 'jad')
            ->whereBetween('tanggal', [$startDate, $endDate]);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $bookings = $query->orderBy('tanggal', 'desc')->get();

        // Statistics
        $totalPendapatan = $bookings->whereIn('status', ['Booked', 'Selesai'])->sum(function ($b) {
            return (int) $b->dp; // Note: In this system, 'dp' or 'total_bayar' might be used.
            // Adjusting to sum total_bayar but parsed from string if necessary
        });

        // Reparse total_bayar for correct sum
        $actualTotalPendapatan = $bookings->whereIn('status', ['Booked', 'Selesai'])->sum(function ($b) {
            return (int) preg_replace('/[^0-9]/', '', $b->total_bayar);
        });

        $totalBooking = $bookings->count();
        $bookingSelesai = $bookings->where('status', 'Selesai')->count();
        $bookingPending = $bookings->where('status', 'Pending')->count();

        $lapanganStats = $bookings->groupBy('lapangan')->map(function ($group) {
            return [
                'nama' => $group->first()->lap->nama ?? 'Unknown',
                'count' => $group->count(),
                'income' => $group->whereIn('status', ['Booked', 'Selesai'])->sum(function ($b) {
                    return (int) preg_replace('/[^0-9]/', '', $b->total_bayar);
                })
            ];
        })->sortByDesc('count');

        return view('admin.pages.laporan', array_merge([
            'bookings' => $bookings,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'totalPendapatan' => $actualTotalPendapatan,
            'totalBooking' => $totalBooking,
            'bookingSelesai' => $bookingSelesai,
            'bookingPending' => $bookingPending,
            'lapanganStats' => $lapanganStats,
        ], $this->setActive('laporan')));
    }
}
