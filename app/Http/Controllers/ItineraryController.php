<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Itinerary;
use App\Models\Package;
use Illuminate\Support\Facades\DB;

class ItineraryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $sort = $request->get('sort');
        $direction = $request->get('direction', 'asc');

        // daftar kolom yang boleh di sort
        $allowedSorts = ['name', 'itineraries'];
        // daftar direction
        $allowedDirections = ['asc', 'desc'];

        // cek apakah sort ada di daftar yang diizinkan
        if (!in_array($sort, $allowedSorts)) {
            $sort = null;
        }

        // cek direction valid atau tidak
        if (!in_array($direction, $allowedDirections)) {
            $direction = 'asc';
        }

        $nameColumn = app()->getLocale() == 'id'
            ? 'name_id'
            : 'name_en';

        $query = Package::withCount('itineraries');

        // SEARCH
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name_en', 'like', "%{$search}%")
                    ->orWhere('name_id', 'like', "%{$search}%");
            });
        }

        // SORTING
        if ($sort === 'name') {
            $query->orderBy($nameColumn, $direction);
        } elseif ($sort === 'itineraries') {
            $query->orderBy('itineraries_count', $direction);
        } else {
            $query->latest();
        }

        $packages = $query
            ->paginate(10)
            ->withQueryString();

        return view('admin.package.itinerary.index', compact(
            'packages',
            'sort',
            'direction'
        ));
    }

    public function create()
    {
        $packages = Package::all();

        return view('admin.package.itinerary.create', compact('packages'));
    }

    // Menyimpan itinerary beserta details
    public function store(Request $request)
    {
        $validated = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'itineraries' => 'required|array',

            'itineraries.*.day' => 'required|integer',
            'itineraries.*.time' => 'required|date_format:H:i',
            'itineraries.*.title_id' => 'required|string|max:255',
            'itineraries.*.title_en' => 'required|string|max:255',

            'itineraries.*.details' => 'nullable|array',
            'itineraries.*.details.*.description_id' => 'required|string',
            'itineraries.*.details.*.description_en' => 'required|string',
        ]);

        // Gunakan return DB::transaction untuk menyimpan $itinerary (kalau semua berhasil → commit, kalau ada error → rollback)
        DB::transaction(function () use ($validated) {

            foreach ($validated['itineraries'] as $itineraryData) { // loop itinerary

                $itinerary = Itinerary::create([
                    'package_id' => $validated['package_id'],
                    'day'        => $itineraryData['day'],
                    'time'       => $itineraryData['time'],
                    'title_id'   => $itineraryData['title_id'],
                    'title_en'   => $itineraryData['title_en'],
                ]);

                if (!empty($itineraryData['details'])) {

                    foreach ($itineraryData['details'] as $detail) { // loop detail
                        $itinerary->details()->create($detail);
                    }
                }
            }
        });

        return redirect()
            ->route('package.itinerary.index')
            ->with('success', 'Itinerary created successfully!');
    }

    public function edit($packageId)
    {
        $package = Package::with('itineraries.details')->findOrFail($packageId);
        $packages = Package::all();

        return view('admin.package.itinerary.edit', compact('package', 'packages'));
    }

    // Update itinerary beserta details
    public function update(Request $request, $packageId)
    {
        $validated = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'itineraries' => 'required|array',

            'itineraries.*.day' => 'required|integer',
            'itineraries.*.time' => 'required',
            'itineraries.*.title_id' => 'required',
            'itineraries.*.title_en' => 'required',

            'itineraries.*.details.*.description_id' => 'required',
            'itineraries.*.details.*.description_en' => 'required',
        ]);

        DB::transaction(function () use ($validated, $packageId) {

            $existingItineraryIds = []; // untuk menyimpan ID itinerary yang masih ada

            foreach ($validated['itineraries'] as $itineraryData) { // loop itinerary

                // update kalau data ditemukan, create kalau tidak ada
                $itinerary = Itinerary::updateOrCreate(
                    ['id' => $itineraryData['id'] ?? null],
                    [
                        'package_id' => $validated['package_id'],
                        'day'        => $itineraryData['day'],
                        'time' => $itineraryData['time'],
                        'title_id' => $itineraryData['title_id'],
                        'title_en' => $itineraryData['title_en'],
                    ]
                );

                $existingItineraryIds[] = $itinerary->id; // menyimpan id itinerary yang masih ada

                // DETAILS
                $existingDetailIds = []; // menyimpan detail yang masih ada

                if (!empty($itineraryData['details'])) {

                    foreach ($itineraryData['details'] as $detail) { // looping detail

                        $detailModel = $itinerary->details()->updateOrCreate( // update kalau ada id, create kalau baru
                            ['id' => $detail['id'] ?? null],
                            $detail
                        );

                        $existingDetailIds[] = $detailModel->id; // menyimpan detail yang masih ada
                    }
                }

                // Hapus detail yg dihapus admin
                $itinerary->details()
                    ->whereNotIn('id', $existingDetailIds) // id-nya tidak ada dalam daftar detail aktif
                    ->delete();
            }

            // Hapus itinerary yg dihapus admin
            Itinerary::where('package_id', $packageId)
                ->whereNotIn('id', $existingItineraryIds) // // id-nya tidak ada dalam daftar itinerary aktif
                ->delete();
        });

        return redirect()
            ->route('package.itinerary.index')
            ->with('success', 'Itinerary updated!');
    }

    // Hapus itinerary beserta details
    public function destroy($packageId)
    {
        DB::transaction(function () use ($packageId) {

            $itineraries = Itinerary::where('package_id', $packageId)->get();

            foreach ($itineraries as $itinerary) { // loop itinerary (hapus satu-satu)
                $itinerary->details()->delete(); // hapus detail dulu
                $itinerary->delete(); // hapus itinerary
            }
        });

        return redirect()
            ->route('package.itinerary.index')
            ->with('success', 'All Itinerary deleted!');
    }
}
