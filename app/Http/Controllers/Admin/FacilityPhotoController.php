<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FacilityCategory;
use App\Models\FacilityPhoto;
use Illuminate\Support\Facades\Storage;

class FacilityPhotoController extends Controller
{
    // List photos per category
    public function index(FacilityCategory $category)
    {
        $photos = $category->photos()->get();
        return view('admin.facilities.photos.index', compact('category', 'photos'));
    }

    // Show form create photo
    public function create(FacilityCategory $category)
    {
        return view('admin.facilities.photos.create', compact('category'));
    }

    // Store photo
    public function store(Request $request, FacilityCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = $request->file('image')->store('facilities', 'public');

        $photo = $category->photos()->create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'image' => $imagePath,
        ]);

        // Set as cover if checked
        if ($request->has('set_as_cover')) {
            $category->cover_photo_id = $photo->id;
            $category->save();
        }

        return redirect()
            ->route('admin.facilities.categories.photos.index', $category->id)
            ->with('success', 'Photo uploaded successfully!');
    }

    // Show edit form
    public function edit(FacilityCategory $category, FacilityPhoto $photo)
    {
        return view('admin.facilities.photos.edit', compact('category', 'photo'));
    }

    // Update photo
    public function update(Request $request, FacilityCategory $category, FacilityPhoto $photo)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $photo->name = $validated['name'];
        $photo->description = $validated['description'] ?? $photo->description;

        // If new image uploaded
        if ($request->hasFile('image')) {
            if ($photo->image && Storage::disk('public')->exists($photo->image)) {
                Storage::disk('public')->delete($photo->image);
            }
            $photo->image = $request->file('image')->store('facilities', 'public');
        }

        $photo->save();

        // Handle cover photo
        if ($request->has('set_as_cover')) {
            $category->cover_photo_id = $photo->id;
            $category->save();
        } else {
            if ($category->cover_photo_id === $photo->id) {
                $category->cover_photo_id = null;
                $category->save();
            }
        }

        return redirect()
            ->route('admin.facilities.categories.photos.index', $category->id)
            ->with('success', 'Photo updated successfully!');
    }

    // Delete photo
    public function destroy(FacilityCategory $category, FacilityPhoto $photo)
    {
        // If this photo is currently cover, reset cover
        if ($category->cover_photo_id === $photo->id) {
            $category->cover_photo_id = null;
            $category->save();
        }

        if ($photo->image && Storage::disk('public')->exists($photo->image)) {
            Storage::disk('public')->delete($photo->image);
        }

        $photo->delete();

        return redirect()
            ->route('admin.facilities.categories.photos.index', $category->id)
            ->with('success', 'Photo deleted successfully!');
    }
}

