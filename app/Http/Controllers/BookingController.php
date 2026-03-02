<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Package;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $statusFilter = $request->status;

        $sort = $request->get('sort');
        $direction = $request->get('direction', 'asc');

        /*
    ==========================
    VALIDASI SORT
    ==========================
    */
        $allowedSorts = [
            'id',
            'name',
            'package',
            'date',
            'guests',
            'price',
            'status'
        ];

        $allowedDirections = ['asc', 'desc'];

        if (!in_array($sort, $allowedSorts)) {
            $sort = null;
        }

        if (!in_array($direction, $allowedDirections)) {
            $direction = 'asc';
        }

        $packageNameColumn = app()->getLocale() == 'id'
            ? 'packages.name_id'
            : 'packages.name_en';

        $query = Booking::with(['user', 'package'])
            ->leftJoin('users', 'bookings.user_id', '=', 'users.id')
            ->leftJoin('packages', 'bookings.package_id', '=', 'packages.id')
            ->select('bookings.*');

        /*
    ==========================
    SEARCH
    ==========================
    */
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('users.first_name', 'like', "%{$search}%")
                    ->orWhere('users.last_name', 'like', "%{$search}%")
                    ->orWhere('packages.name_id', 'like', "%{$search}%")
                    ->orWhere('packages.name_en', 'like', "%{$search}%");
            });
        }

        /*
    ==========================
    FILTER STATUS
    ==========================
    */
        if ($statusFilter) {
            $query->whereIn('bookings.status', $statusFilter);
        }

        /*
    ==========================
    SORTING
    ==========================
    */
        if ($sort === 'id') {
            $query->orderBy('bookings.id', $direction);
        } elseif ($sort === 'name') {
            $query->orderBy('users.first_name', $direction);
        } elseif ($sort === 'package') {
            $query->orderBy($packageNameColumn, $direction);
        } elseif ($sort === 'date') {
            $query->orderBy('bookings.tour_date', $direction);
        } elseif ($sort === 'guests') {
            $query->orderBy('bookings.guest_count', $direction);
        } elseif ($sort === 'price') {
            $query->orderBy('bookings.total_price', $direction);
        } elseif ($sort === 'status') {
            $query->orderBy('bookings.status', $direction);
        } else {
            $query->latest('bookings.created_at');
        }

        $bookings = $query
            ->paginate(10)
            ->withQueryString();

        $status = ['pending', 'confirmed', 'cancelled', 'completed'];

        return view('admin.bookings.index', compact(
            'bookings',
            'status',
            'sort',
            'direction'
        ));
    }

    public function edit(Booking $booking)
    {
        return view('admin.bookings.edit', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);

        $booking->update($validated);

        return redirect()
            ->route('bookings.index')
            ->with('success', 'Booking berhasil diupdate.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()
            ->route('bookings.index')
            ->with('success', 'Booking berhasil dihapus.');
    }

    public function booking(Request $request)
    {
        $request->validate([
            'date'       => 'required|date',
            'guests'     => 'required|integer',
            'package_id' => 'required|exists:packages,id',
        ]);

        session([
            'booking.date'       => $request->date,
            'booking.guests'     => (int) $request->guests,
            'booking.package_id' => $request->package_id,
        ]);

        return redirect()->route('booking.step1');
    }

    public function step1()
    {
        if (!session()->has('booking')) {
            return redirect()->route('home');
        }

        $booking = session('booking');
        $package = Package::findOrFail($booking['package_id']);

        $fromDate = Carbon::parse($booking['date']);
        $toDate = $fromDate->copy()->addDays($package->duration - 1);
        $guests   = $booking['guests'];

        return view('booking.step1-detail', compact(
            'package',
            'fromDate',
            'toDate',
            'guests'
        ));
    }

    public function storeStep1(Request $request)
    {
        $request->validate([
            'date'   => 'required|date',
            'guests' => 'required|integer|min:1',
        ]);

        $booking = session('booking');

        session([
            'booking' => [
                'package_id' => $booking['package_id'], // tetap paket awal
                'date'       => $request->date,         // tanggal baru
                'guests'     => (int) $request->guests, // guest baru
            ]
        ]);

        return redirect()->route('booking.step2');
    }

    public function step2()
    {
        $booking = session('booking');

        if (!$booking) {
            return redirect('/booking/step1');
        }

        $package = Package::findOrFail($booking['package_id']);
        $fromDate = Carbon::parse($booking['date']);
        $guests = $booking['guests'];
        $totalPrice = $package->price * $guests;

        return view('booking.step2-user', compact('booking', 'package', 'fromDate', 'guests', 'totalPrice'));
    }

    public function step3()
    {
        $booking = session('booking');

        if (!$booking) {
            return redirect()->route('booking.step1');
        }

        $package   = Package::findOrFail($booking['package_id']);
        $fromDate  = Carbon::parse($booking['date']);
        $guests    = $booking['guests'];
        $totalPrice = $package->price * $guests;

        return view('booking.step3-payment', compact(
            'booking',
            'package',
            'fromDate',
            'guests',
            'totalPrice'
        ));
    }

    public function storeBooking(Request $request)
    {
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $booking = session('booking');
        if (!$booking) {
            return redirect()->route('booking.step1');
        }

        // price
        $package = Package::findOrFail($booking['package_id']);
        $totalPrice = $package->price * $booking['guests'];

        // upload file
        $path = $request->file('payment_proof')->store('payments', 'public');

        // simpan ke tabel bookings
        Booking::create([
            'package_id'   => $booking['package_id'],
            'user_id'      => Auth::id(),
            'tour_date'    => $booking['date'],
            'guest_count'  => $booking['guests'],
            'total_price'  => $totalPrice,
            'payment_proof' => $path,
            'status'       => 'pending', // menunggu verifikasi admin
        ]);

        // hapus session booking
        session()->forget('booking');

        return redirect()->route('booking.success');
    }
}
