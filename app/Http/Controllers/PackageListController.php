<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PackageList;
use App\Models\Package;

class PackageListController extends Controller
{
    /**
     * List semua item package list untuk sebuah package
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $sort = $request->get('sort');
        $direction = $request->get('direction', 'asc');

        /*
    ==========================
    VALIDASI SORT
    ==========================
    */
        $allowedSorts = [
            'name',
            'includes',
            'not_includes',
            'must_bring'
        ];

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

        $query = Package::withCount([
            'packageLists as includes_count' =>
            fn($q) => $q->where('type', 'includes'),

            'packageLists as not_includes_count' =>
            fn($q) => $q->where('type', 'not_includes'),

            'packageLists as must_bring_count' =>
            fn($q) => $q->where('type', 'must_bring'),
        ]);

        /*
    ==========================
    SEARCH
    ==========================
    */
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name_en', 'like', "%{$search}%")
                    ->orWhere('name_id', 'like', "%{$search}%");
            });
        }

        /*
    ==========================
    SORTING
    ==========================
    */
        if ($sort === 'name') {
            $query->orderBy($nameColumn, $direction);
        } elseif ($sort === 'includes') {
            $query->orderBy('includes_count', $direction);
        } elseif ($sort === 'not_includes') {
            $query->orderBy('not_includes_count', $direction);
        } elseif ($sort === 'must_bring') {
            $query->orderBy('must_bring_count', $direction);
        } else {
            $query->latest();
        }

        $packages = $query
            ->paginate(10)
            ->withQueryString();

        return view('admin.package.list.index', compact(
            'packages',
            'sort',
            'direction'
        ));
    }

    public function create()
    {
        $packages = Package::all();

        return view('admin.package.list.create', compact('packages'));
    }

    /**
     * Buat item package list baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',

            'list.includes.*.content_id' => 'required|string',
            'list.includes.*.content_en' => 'required|string',

            'list.not_includes.*.content_id' => 'required|string',
            'list.not_includes.*.content_en' => 'required|string',

            'list.must_bring.*.content_id' => 'required|string',
            'list.must_bring.*.content_en' => 'required|string',
        ]);

        foreach ($request->list as $type => $items) {

            foreach ($items as $item) {

                if (!empty($item['content_id']) || !empty($item['content_en'])) {

                    PackageList::create([
                        'package_id' => $request->package_id,
                        'type'       => $type,
                        'content_id' => $item['content_id'],
                        'content_en' => $item['content_en'],
                    ]);
                }
            }
        }

        return redirect()
            ->route('package.list.index')
            ->with('success', 'List created successfully!');
    }

    public function edit($id)
    {
        $package = Package::with('packageLists')->findOrFail($id);
        $packages = Package::all();

        // grouping by type
        $lists = $package->packageLists->groupBy('type');

        return view('admin.package.list.edit', compact('package', 'packages', 'lists'));
    }


    /**
     * Update item package list
     */
    public function update(Request $request, $id)
    {
        $package = Package::findOrFail($id);

        $request->validate([
            'package_id' => 'required|exists:packages,id',

            'list.includes.*.content_id' => 'required|string',
            'list.includes.*.content_en' => 'required|string',

            'list.not_includes.*.content_id' => 'required|string',
            'list.not_includes.*.content_en' => 'required|string',

            'list.must_bring.*.content_id' => 'required|string',
            'list.must_bring.*.content_en' => 'required|string',
        ]);

        $existingIds = [];

        foreach ($request->list as $type => $items) {

            foreach ($items as $item) {

                // UPDATE
                if (!empty($item['id'])) {

                    $list = PackageList::find($item['id']);

                    if ($list) {
                        $list->update([
                            'content_id' => $item['content_id'],
                            'content_en' => $item['content_en'],
                            'type'       => $type,
                        ]);

                        $existingIds[] = $list->id;
                    }
                } else {

                    // CREATE
                    $new = PackageList::create([
                        'package_id' => $package->id,
                        'type'       => $type,
                        'content_id' => $item['content_id'],
                        'content_en' => $item['content_en'],
                    ]);

                    $existingIds[] = $new->id;
                }
            }
        }

        // DELETE yang tidak dikirim
        PackageList::where('package_id', $package->id)
            ->whereNotIn('id', $existingIds)
            ->delete();

        return redirect()
            ->route('package.list.index')
            ->with('success', 'List updated successfully!');
    }

    /**
     * Hapus item package list
     */
    public function destroy($id)
    {
        PackageList::where('package_id', $id)->delete();

        return redirect()
            ->route('package.list.index')
            ->with('success', 'All lists deleted!');
    }
}
