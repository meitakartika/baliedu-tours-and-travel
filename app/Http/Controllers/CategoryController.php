<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Tampilkan daftar kategori
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $sort = $request->get('sort');
        $direction = $request->get('direction', 'asc');

        // daftar kolom yang boleh di sort
        $allowedSorts = ['name', 'description'];
        // daftar direction
        $allowedDirections = ['asc', 'desc'];

        // cek apakah sort ada di daftar yang diizinkan
        if (! in_array($sort, $allowedSorts)) {
            $sort = null;
        }

        // cek direction valid atau tidak
        if (! in_array($direction, $allowedDirections)) {
            $direction = 'asc';
        }

        $nameColumn = app()->getLocale() == 'id' ? 'name_id' : 'name_en';
        $descColumn = app()->getLocale() == 'id' ? 'description_id' : 'description_en';

        $query = Category::query();

        // SEARCH
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name_id', 'like', "%{$search}%")
                    ->orWhere('name_en', 'like', "%{$search}%")
                    ->orWhere('description_id', 'like', "%{$search}%")
                    ->orWhere('description_en', 'like', "%{$search}%");
            });
        }

        // SORTING
        if ($sort === 'name') {
            $query->orderBy($nameColumn, $direction);
        } elseif ($sort === 'description') {
            $query->orderBy($descColumn, $direction);
        } else {
            $query->latest();
        }

        $categories = $query
            ->paginate(10)
            ->withQueryString();

        return view('admin.package.category.index', compact('categories', 'sort', 'direction'));
    }

    public function create()
    {
        $category = new Category;

        return view('admin.package.category.create', compact('category'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_id' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_id' => 'required|string',
            'description_en' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')
            ->store('categories', 'public');
        }

        Category::create($validated);

        return redirect()
            ->route('package.category.index')
            ->with('success', 'Category berhasil ditambahkan.');
    }

    public function edit(Category $category)
    {
        return view('admin.package.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name_id' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_id' => 'required|string',
            'description_en' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'remove_image' => 'nullable|boolean',
        ]);

        // Hapus gambar lama jika diminta
        if ($request->remove_image && $category->image) {
            Storage::disk('public')->delete($category->image);
            $validated['image'] = null;
        }

        // Jika upload gambar baru
        if ($request->hasFile('image')) {

            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }

            $validated['image'] = $request->file('image')
                ->store('categories', 'public');
        }

        unset($validated['remove_image']);

        $category->update($validated);

        return redirect()
            ->route('package.category.index')
            ->with('success', 'Category berhasil diupdate.');
    }

    public function destroy(Category $category)
    {
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()
            ->route('package.category.index')
            ->with('success', 'Category berhasil dihapus.');
    }
}
