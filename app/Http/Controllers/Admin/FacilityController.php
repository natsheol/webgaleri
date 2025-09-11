<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FacilityCategory;

class FacilityController extends Controller
{
    /**
     * Tampilkan semua kategori fasilitas (admin)
     */
    public function index()
    {
        $categories = FacilityCategory::with('photos')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.facilities.categories.index', compact('categories'));
    }

    /**
     * Form tambah kategori baru
     */
    public function create()
    {
        return view('admin.facilities.create');
    }

    /**
     * Simpan kategori baru
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:facility_categories,slug',
            'sort_order' => 'nullable|integer',
            'is_active' => 'required|boolean',
        ]);

        FacilityCategory::create($data);

        return redirect()->route('admin.facilities.index')
                         ->with('success', 'Category created successfully!');
    }

    /**
     * Form edit kategori
     */
    public function edit(FacilityCategory $category)
    {
        return view('admin.facilities.edit', compact('category'));
    }

    /**
     * Update kategori
     */
    public function update(Request $request, FacilityCategory $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:facility_categories,slug,' . $category->id,
            'sort_order' => 'nullable|integer',
            'is_active' => 'required|boolean',
        ]);

        $category->update($data);

        return redirect()->route('admin.facilities.index')
                         ->with('success', 'Category updated successfully!');
    }

    /**
     * Hapus kategori
     */
    public function destroy(FacilityCategory $category)
    {
        $category->delete();

        return redirect()->route('admin.facilities.index')
                         ->with('success', 'Category deleted successfully!');
    }
}
