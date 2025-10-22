<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FacilityCategory;

class FacilityController extends Controller
{
    public function index()
    {
        $categories = FacilityCategory::with('photos')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.facilities.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.facilities.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:facility_categories,slug',
            'sort_order' => 'nullable|integer',
            'is_active' => 'required|boolean',
        ]);

        FacilityCategory::create($data);

        return redirect()->route('admin.facilities.index')->with('success', 'Category created successfully!');
    }

    public function edit(FacilityCategory $category)
    {
        return view('admin.facilities.edit', compact('category'));
    }

    public function update(Request $request, FacilityCategory $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:facility_categories,slug,' . $category->id,
            'sort_order' => 'nullable|integer',
            'is_active' => 'required|boolean',
        ]);

        $category->update($data);

        return redirect()->route('admin.facilities.index')->with('success', 'Category updated successfully!');
    }

    public function destroy(FacilityCategory $category)
    {
        $category->delete();

        return redirect()->route('admin.facilities.index')->with('success', 'Category deleted successfully!');
    }
}
