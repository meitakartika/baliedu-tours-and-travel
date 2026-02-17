<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Tampilkan daftar kategori
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $categories = Category::query()
            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {
                    $q->where('name_id', 'like', "%{$search}%")
                        ->orWhere('name_en', 'like', "%{$search}%")
                        ->orWhere('description_id', 'like', "%{$search}%")
                        ->orWhere('description_en', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.package.category.index', compact('categories'));
    }

    /**
     * Tampilkan form tambah kategori
     */
    public function create()
    {
        $category = new Category();

        return view('admin.package.category.create', compact('category'));
    }

    /**
     * Simpan kategori baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_id' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_id' => 'required|string',
            'description_en' => 'required|string',
        ]);

        Category::create($validated);

        return redirect()
            ->route('package.category.index')
            ->with('success', 'Category berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit kategori
     */
    public function edit(Category $category)
    {
        return view('admin.package.category.edit', compact('category'));
    }

    /**
     * Update kategori
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name_id' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_id' => 'required|string',
            'description_en' => 'required|string',
        ]);

        $category->update($validated);

        return redirect()
            ->route('package.category.index')
            ->with('success', 'Category berhasil diupdate.');
    }

    /**
     * Hapus kategori
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()
            ->route('package.category.index')
            ->with('success', 'Category berhasil dihapus.');
    }
}
