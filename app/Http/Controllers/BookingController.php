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

        $bookings = Booking::with(['user', 'package'])

            ->when($search, function ($query) use ($search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('first_name', 'like', "%$search%")
                    ->orWhere('last_name', 'like', "%{$search}%");
                })
                    ->orWhereHas('package', function ($q) use ($search) {
                        $q->where('name_id', 'like', "%$search%")
                        ->orWhere('name_en', 'like', "%{$search}%");
                    });
            })

            ->when($statusFilter, function ($query) use ($statusFilter) {
                $query->whereIn('status', $statusFilter);
            })

            ->latest()
            ->paginate(10)
            ->withQueryString();

        $status = ['Pending', 'Confirmed', 'Cancelled','Completed'];

        return view('admin.bookings.index', compact('bookings', 'status'));
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
