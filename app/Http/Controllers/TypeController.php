<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Category;

class TypeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $sort = $request->get('sort');
        $direction = $request->get('direction', 'asc');

        // daftar kolom yang boleh di sort
        $allowedSorts = ['name', 'description', 'category'];
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

        $nameColumn = app()->getLocale() == 'id' ? 'name_id' : 'name_en';
        $descColumn = app()->getLocale() == 'id' ? 'description_id' : 'description_en';
        $categoryNameColumn = app()->getLocale() == 'id' ? 'categories.name_id' : 'categories.name_en';

        $query = Type::with('category');

        // SEARCH
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name_id', 'like', "%{$search}%")
                    ->orWhere('name_en', 'like', "%{$search}%")
                    ->orWhere('description_id', 'like', "%{$search}%")
                    ->orWhere('description_en', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($category) use ($search) {
                        $category->where('name_id', 'like', "%{$search}%")
                            ->orWhere('name_en', 'like', "%{$search}%");
                    });
            });
        }

        // FILTER CATEGORY
        if ($request->filled('category')) {
            $query->whereIn('category_id', $request->category);
        }

        // SORTING
        if ($sort === 'name') {
            $query->orderBy($nameColumn, $direction);
        } elseif ($sort === 'description') {
            $query->orderBy($descColumn, $direction);
        } elseif ($sort === 'category') {
            $query->join('categories', 'types.category_id', '=', 'categories.id')
                ->orderBy($categoryNameColumn, $direction)
                ->select('types.*');
        } else {
            $query->latest();
        }

        $types = $query
            ->paginate(10)
            ->withQueryString();

        $categories = Category::all();

        return view('admin.package.type.index', compact('types', 'categories', 'sort', 'direction'));
    }

    public function create()
    {
        $type = new Type();
        $categories = Category::all();

        return view('admin.package.type.create', compact('type', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name_id'     => 'required|string|max:255',
            'name_en'     => 'required|string|max:255',
            'description_id' => 'nullable|string',
            'description_en' => 'nullable|string',
        ]);

        Type::create($validated);

        return redirect()
            ->route('package.type.index')
            ->with('success', 'Type berhasil ditambahkan.');
    }

    public function edit(Type $type)
    {
        $categories = Category::all();
        return view('admin.package.type.edit', compact('type', 'categories'));
    }

    public function update(Request $request, Type $type)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name_id'     => 'required|string|max:255',
            'name_en'     => 'required|string|max:255',
            'description_id' => 'nullable|string',
            'description_en' => 'nullable|string',
        ]);

        $type->update($validated);

        return redirect()
            ->route('package.type.index')
            ->with('success', 'Type berhasil diupdate.');
    }

    public function destroy(Type $type)
    {
        $type->delete();

        return redirect()
            ->route('package.type.index')
            ->with('success', 'Type berhasil dihapus.');
    }

    /**
     * Tipe berdasarkan kategori (untuk di package admin)
     */
    public function getByCategory(Category $category)
    {
        $locale = app()->getLocale();
        $column = $locale === 'id' ? 'name_id' : 'name_en';

        $types = $category->types()
            ->select('id', 'name_id', 'name_en')
            ->orderBy($column)
            ->get();

        return response()->json($types);
    }
}
