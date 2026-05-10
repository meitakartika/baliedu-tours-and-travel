<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\User;
use App\Models\PackageReview;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // ================= PERIODE =================
        $month = $request->filled('month') // kalau month diisi → ambil month
            ? (int)$request->month
            : null;
        $year = $request->year ?? now()->year; // kalau request punya year → pakai itu, kalau tidak → pakai tahun sekarang

        // ================= TOTAL & GROWTH =================
        [$totalPackages, $growthPackages] = $this->calculateGrowth(Package::class, $month, $year);
        [$totalUsers, $growthUsers] = $this->calculateGrowth(User::class, $month, $year);
        [$totalTestimonials, $growthTestimonials] = $this->calculateGrowth(PackageReview::class, $month, $year);
        [$totalBookings, $growthBookings] = $this->calculateGrowth(Booking::class, $month, $year);

        // ================= STATUS =================
        if ($month) { // kalau month ada
            $startDate = Carbon::createFromDate($year, $month)->startOfMonth(); // tanggal awal bulan
            $endDate   = Carbon::createFromDate($year, $month)->endOfMonth(); // tanggal akhir bulan
        } else {
            $startDate = Carbon::createFromDate($year)->startOfYear(); // awal tahun
            $endDate   = Carbon::createFromDate($year)->endOfYear(); // akhir tahun
        }

        // Hitung status booking
        $pending = Booking::where('status', 'pending')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $confirmed = Booking::where('status', 'confirmed')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $completed = Booking::where('status', 'completed')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $cancelled = Booking::where('status', 'cancelled')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $totalStatus = $pending + $confirmed + $completed + $cancelled;

        // persentase
        $pendingPercent = $totalStatus ? round(($pending / $totalStatus) * 100) : 0;
        $confirmedPercent = $totalStatus ? round(($confirmed / $totalStatus) * 100) : 0;
        $completedPercent = $totalStatus ? round(($completed / $totalStatus) * 100) : 0;
        $cancelledPercent = $totalStatus ? round(($cancelled / $totalStatus) * 100) : 0;

        // ================= CHART BOOKINGS =================
        if ($month) {
            // chart harian dalam 1 bulan
            $bookings = Booking::selectRaw('DATE(created_at) as date, COUNT(*) as total') // mengambil tanggal & jumlah booking per tanggal
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('date')
                ->pluck('total', 'date');

            $labels = [];
            $data   = [];

            $period = Carbon::parse($startDate);
            while ($period <= $endDate) { // loop sampai akhir bulan
                $date = $period->toDateString();
                $labels[] = $period->format('d M');
                $data[]   = $bookings[$date] ?? 0;
                $period->addDay();
            }
        } else {
            // chart bulanan dalam 1 tahun
            $bookings = Booking::selectRaw('MONTH(created_at) as month, COUNT(*) as total') // mengambil nomor bulan, total booking
                ->whereYear('created_at', $year)
                ->groupBy('month')
                ->pluck('total', 'month');

            $labels = [];
            $data   = [];

            for ($m = 1; $m <= 12; $m++) { // loop januari–desember
                $labels[] = Carbon::createFromDate($year, $m, 1)->format('M');
                $data[]   = $bookings[$m] ?? 0;
            }
        }

        return view('admin.dashboard.index', compact(
            'totalPackages',
            'totalUsers',
            'totalTestimonials',
            'totalBookings',
            'growthBookings',
            'pendingPercent',
            'confirmedPercent',
            'completedPercent',
            'cancelledPercent',
            'month',
            'year',
            'growthPackages',
            'growthUsers',
            'growthTestimonials',
            'labels',
            'data'
        ));
    }

    private function calculateGrowth($model, $month, $year) // method helper untuk menghitung growth
    {
        if ($month) {
            $start = Carbon::createFromDate($year, $month)->startOfMonth(); // awal bulan sekarang
            $end   = Carbon::createFromDate($year, $month)->endOfMonth(); // akhir bulan sekarang

            $prevStart = (clone $start)->subMonth(); // awal bulan sebelumnya
            $prevEnd   = (clone $end)->subMonth(); // akhir bulan sebelumnya

        } else {
            $start = Carbon::createFromDate($year)->startOfYear(); // awal tahun sekarang
            $end   = Carbon::createFromDate($year)->endOfYear(); // akhir tahun sekarang

            $prevStart = (clone $start)->subYear(); // awal tahun sebelumnya
            $prevEnd   = (clone $end)->subYear(); // akhir tahun sebelumnya
        }

        $current = $model::whereBetween('created_at', [$start, $end])->count(); // jumlah data periode sekarang

        $previous = $model::whereBetween('created_at', [$prevStart, $prevEnd])->count(); // jumlah data periode sebelumnya

        // growth calc
        if ($previous == 0) {
            $growth = $current > 0 ? 100 : 0;
        } else {
            $growth = (($current - $previous) / $previous) * 100;
        }

        return [$current, round($growth, 1)];
    }
}
