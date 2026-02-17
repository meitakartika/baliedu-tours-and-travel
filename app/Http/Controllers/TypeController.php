<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Category;

class TypeController extends Controller
{
    /**
     * Tampilkan daftar tipe
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $types = Type::with('category')
            ->when($search, function ($query) use ($search) {

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
            })
            ->when($request->filled('category'), function ($q) use ($request) {
                $q->whereIn('category_id', $request->category);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $categories = Category::all();

        return view('admin.package.type.index', compact('types', 'categories'));
    }

    /**
     * Tampilkan form tambah tipe
     */
    public function create()
    {
        $type = new Type();
        $categories = Category::all();

        return view('admin.package.type.create', compact('type', 'categories'));
    }

    /**
     * Simpan tipe baru
     */
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

    /**
     * Tampilkan form edit tipe
     */
    public function edit(Type $type)
    {
        $categories = Category::all();
        return view('admin.package.type.edit', compact('type', 'categories'));
    }

    /**
     * Update tipe
     */
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

    /**
     * Hapus tipe
     */
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
