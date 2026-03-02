<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Itinerary;
use App\Models\Package;
use Illuminate\Support\Facades\DB;

class ItineraryController extends Controller
{
    // Menampilkan semua itinerary
    public function index(Request $request)
    {
        $search = $request->search;
        $sort = $request->get('sort');
        $direction = $request->get('direction', 'asc');

        /*
    =====================
    VALIDASI
    =====================
    */
        $allowedSorts = ['name', 'itineraries'];
        $allowedDirections = ['asc', 'desc'];

        if (!in_array($sort, $allowedSorts)) {
            $sort = null;
        }

        if (!in_array($direction, $allowedDirections)) {
            $direction = 'asc';
        }

        $nameColumn = app()->getLocale() == 'id'
            ? 'name_id'
            : 'name_en';

        $query = Package::withCount('itineraries');

        /*
    =====================
    SEARCH
    =====================
    */
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name_en', 'like', "%{$search}%")
                    ->orWhere('name_id', 'like', "%{$search}%");
            });
        }

        /*
    =====================
    SORTING
    =====================
    */
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

    // Membuat itinerary beserta details
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

        // Gunakan return DB::transaction untuk menyimpan $itinerary
        DB::transaction(function () use ($validated) {

            foreach ($validated['itineraries'] as $itineraryData) {

                $itinerary = Itinerary::create([
                    'package_id' => $validated['package_id'],
                    'day'        => $itineraryData['day'],
                    'time'       => $itineraryData['time'],
                    'title_id'   => $itineraryData['title_id'],
                    'title_en'   => $itineraryData['title_en'],
                ]);

                if (!empty($itineraryData['details'])) {

                    foreach ($itineraryData['details'] as $detail) {
                        $itinerary->details()->create($detail);
                    }
                }
            }
        });

        // Sekarang $itinerary sudah tersedia di luar
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

            $existingItineraryIds = [];

            foreach ($validated['itineraries'] as $itineraryData) {

                // UPDATE atau CREATE
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

                $existingItineraryIds[] = $itinerary->id;

                // DETAILS
                $existingDetailIds = [];

                if (!empty($itineraryData['details'])) {

                    foreach ($itineraryData['details'] as $detail) {

                        $detailModel = $itinerary->details()->updateOrCreate(
                            ['id' => $detail['id'] ?? null],
                            $detail
                        );

                        $existingDetailIds[] = $detailModel->id;
                    }
                }

                // DELETE detail yg dihapus admin
                $itinerary->details()
                    ->whereNotIn('id', $existingDetailIds)
                    ->delete();
            }

            // DELETE itinerary yg dihapus admin
            Itinerary::where('package_id', $packageId)
                ->whereNotIn('id', $existingItineraryIds)
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

            foreach ($itineraries as $itinerary) {
                $itinerary->details()->delete();
                $itinerary->delete();
            }
        });

        return redirect()
            ->route('package.itinerary.index')
            ->with('success', 'All Itinerary deleted!');
    }
}
