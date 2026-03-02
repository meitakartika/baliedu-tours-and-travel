<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Category;
use App\Models\Type;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PackageController extends Controller
{
    /**
     * List semua package + gallery
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $sort = $request->get('sort');
        $direction = $request->get('direction', 'asc');

        /*
    =====================
    VALIDASI SORT
    =====================
    */
        $allowedSorts = [
            'name',
            'category',
            'type',
            'price',
            'duration',
            'guests'
        ];

        $allowedDirections = ['asc', 'desc'];

        if (!in_array($sort, $allowedSorts)) {
            $sort = null;
        }

        if (!in_array($direction, $allowedDirections)) {
            $direction = 'asc';
        }

        // Locale column
        $nameColumn = app()->getLocale() == 'id' ? 'name_id' : 'name_en';
        $categoryNameColumn = app()->getLocale() == 'id'
            ? 'categories.name_id'
            : 'categories.name_en';
        $typeNameColumn = app()->getLocale() == 'id'
            ? 'types.name_id'
            : 'types.name_en';

        $query = Package::query()->with(['category', 'type']);

        /*
    =====================
    SEARCH
    =====================
    */
        if ($search) {
            $query->where(function ($q) use ($search) {

                $q->where('name_id', 'like', "%$search%")
                    ->orWhere('name_en', 'like', "%$search%")

                    ->orWhereHas('category', function ($cat) use ($search) {
                        $cat->where('name_id', 'like', "%$search%")
                            ->orWhere('name_en', 'like', "%$search%");
                    })

                    ->orWhereHas('type', function ($type) use ($search) {
                        $type->where('name_id', 'like', "%$search%")
                            ->orWhere('name_en', 'like', "%$search%");
                    });
            });
        }

        /*
    =====================
    FILTER CATEGORY
    =====================
    */
        if ($request->category) {
            $query->whereIn('category_id', $request->category);
        }

        /*
    =====================
    FILTER TYPE
    =====================
    */
        if ($request->type) {
            $query->whereIn('type_id', $request->type);
        }

        /*
    =====================
    SORTING
    =====================
    */
        if ($sort === 'name') {
            $query->orderBy($nameColumn, $direction);
        } elseif ($sort === 'price') {
            $query->orderBy('price', $direction);
        } elseif ($sort === 'duration') {
            $query->orderBy('duration', $direction);
        } elseif ($sort === 'guests') {
            $query->orderBy('guest_min', $direction)->orderBy('guest_max', $direction);
        } elseif ($sort === 'category') {
            $query->join('categories', 'packages.category_id', '=', 'categories.id')
                ->orderBy($categoryNameColumn, $direction)
                ->select('packages.*');
        } elseif ($sort === 'type') {
            $query->join('types', 'packages.type_id', '=', 'types.id')
                ->orderBy($typeNameColumn, $direction)
                ->select('packages.*');
        } else {
            $query->latest();
        }

        $packages = $query
            ->paginate(10)
            ->withQueryString();

        $categories = Category::all();
        $types = Type::all();

        return view('admin.package.tour.index', compact(
            'packages',
            'categories',
            'types',
            'sort',
            'direction'
        ));
    }

    public function create()
    {
        $categories = Category::all();
        $types = collect();
        $package = new Package();

        return view('admin.package.tour.create', compact('package', 'categories', 'types'));
    }

    /**
     * Simpan package + gambar utama + gallery
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id'   => 'required|exists:categories,id',
            'type_id'       => 'required|exists:types,id',
            'name_id'       => 'required|string|max:255',
            'name_en'       => 'required|string|max:255',
            'overview_id'   => 'required|string',
            'overview_en'   => 'required|string',
            'duration'      => 'required|string',
            'guest_min'     => 'required|integer',
            'guest_max'     => 'required|integer|gte:guest_min',
            'price'         => 'required|numeric',
            'image_url'     => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'galleries'     => 'nullable|array|max:10',
            'galleries.*'   => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $package = DB::transaction(function () use ($request, $validated) {
            // Upload gambar utama dulu
            if ($request->hasFile('image_url')) {
                $mainImagePath = $request->file('image_url')->store('package_main', 'public');
                $validated['image_url'] = $mainImagePath;
            }

            // Buat package
            $package = Package::create($validated);

            // Simpan galleries jika ada
            if ($request->hasFile('galleries')) {
                foreach ($request->file('galleries') as $image) {
                    $path = $image->store('package_galleries', 'public');
                    $package->galleries()->create([
                        'image_url' => $path,
                    ]);
                }
            }

            return $package;
        });

        return redirect()
            ->route('package.tour.index')
            ->with('success', 'Package created successfully!');
    }

    public function edit(Package $package)
    {
        $package->load('galleries');
        $categories = Category::all();
        $types = collect();

        return view('admin.package.tour.edit', compact('package', 'categories', 'types'));
    }

    /**
     * Update package + gambar utama + gallery
     */
    public function update(Request $request, Package $package)
    {
        $removedIds = $request->input('removed_galleries', []);

        $validated = $request->validate([
            'category_id'         => 'required|exists:categories,id',
            'type_id'             => 'required|exists:types,id',
            'name_id'             => 'required|string|max:255',
            'name_en'             => 'required|string|max:255',
            'overview_id'         => 'required|string',
            'overview_en'         => 'required|string',
            'duration'            => 'required|string',
            'guest_min'           => 'required|integer',
            'guest_max'           => 'required|integer|gte:guest_min',
            'price'               => 'required|numeric',
            'image_url'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'galleries'           => 'nullable|array',
            'galleries.*'         => 'image|mimes:jpg,jpeg,png|max:2048',
            'removed_galleries'   => 'nullable|array|max:10',
            'removed_galleries.*' => 'integer|exists:package_galleries,id',
        ]);

        DB::transaction(function () use ($request, $validated, $package, $removedIds) {

            $data = collect($validated)->except([
                'galleries',
                'removed_galleries'
            ])->toArray();

            // Update gambar utama jika ada upload baru
            if ($request->hasFile('image_url')) {
                // Hapus gambar lama
                if ($package->image_url && Storage::disk('public')->exists($package->image_url)) {
                    Storage::disk('public')->delete($package->image_url);
                }
                $data['image_url'] = $request
                    ->file('image_url')
                    ->store('package_main', 'public');
            }

            // Update package utama
            $package->update($data);

            // Hapus gallery jika ada request delete
            if (!empty($removedIds)) {
                $galleries = $package->galleries()->whereIn('id', $removedIds)->get();
                foreach ($galleries as $gallery) {
                    if (Storage::disk('public')->exists($gallery->image_url)) {
                        Storage::disk('public')->delete($gallery->image_url);
                    }
                    $gallery->delete();
                }
            }

            // Upload gambar baru untuk gallery
            foreach ($request->file('galleries', []) as $image) {
                $path = $image->store('package_galleries', 'public');
                $package->galleries()->create([
                    'image_url' => $path
                ]);
            }
        });

        return redirect()
            ->route('package.tour.index', $package->id)
            ->with('success', 'Package updated successfully!');
    }

    /**
     * Hapus package + galleries
     */
    public function destroy(Package $package)
    {
        DB::transaction(function () use ($package) {
            // Hapus semua gallery
            foreach ($package->galleries as $gallery) {

                Storage::disk('public')->delete($gallery->image_url);

                $gallery->delete();
            }

            // Hapus gambar utama
            if ($package->image_url) {
                Storage::disk('public')->delete($package->image_url);
            }

            // Hapus package
            $package->delete();
        });

        return redirect()
            ->route('package.tour.index')
            ->with('success', 'Package berhasil dihapus.');
    }
}
