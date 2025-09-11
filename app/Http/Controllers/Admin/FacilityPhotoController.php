<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FacilityCategory;
use App\Models\FacilityPhoto;

class FacilityPhotoController extends Controller
{
    public function create(FacilityCategory $category)
    {
        return view('admin.facilities.photos.create', compact('category'));
    }

    public function store(Request $request, FacilityCategory $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('image')->store('facility_photos', 'public');

        $category->photos()->create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $path,
        ]);

        return redirect()->route('admin.facilities.categories.index')
                         ->with('success', 'Photo uploaded successfully!');
    }
}
