<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FacilityCategory;
use Illuminate\Support\Str;

class FacilityCategoryController extends Controller
{
    // Tampilkan semua kategori + galeri
    public function index()
    {
        $categories = FacilityCategory::with('photos')->get();
        return view('admin.facilities.categories.index', compact('categories'));
    }

    // Form tambah kategori baru
    public function create()
    {
        return view('admin.facilities.categories.create');
    }

    // Simpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:facility_categories,name',
            'is_active' => 'nullable|boolean',
        ]);

        // Generate slug unik
        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $counter = 1;
        while (FacilityCategory::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        FacilityCategory::create([
            'name' => $request->name,
            'slug' => $slug,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.facilities.categories.index')
                         ->with('success', 'Category created successfully!');
    }

    // Form edit kategori
    public function edit(FacilityCategory $category)
    {
        return view('admin.facilities.categories.edit', compact('category'));
    }

    // Update kategori
    public function update(Request $request, FacilityCategory $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:facility_categories,name,' . $category->id,
            'is_active' => 'nullable|boolean',
        ]);

        // Generate slug unik
        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $counter = 1;
        while (FacilityCategory::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $category->update([
            'name' => $request->name,
            'slug' => $slug,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.facilities.categories.index')
                         ->with('success', 'Category updated successfully!');
    }

    // Hapus kategori
    public function destroy(FacilityCategory $category)
    {
        $category->delete();
        return redirect()->route('admin.facilities.categories.index')
                         ->with('success', 'Category deleted successfully!');
    }
}
