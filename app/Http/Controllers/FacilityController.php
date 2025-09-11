<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FacilityCategory;

class FacilityController extends Controller
{
    // Tampilkan semua kategori fasilitas (public)
    public function index()
    {
        $categories = FacilityCategory::with('photos')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('guest.facilities.index', compact('categories'));
    }

    // Tampilkan detail kategori tertentu
    public function show(string $slug)
    {
        $category = FacilityCategory::where('slug', $slug)
            ->where('is_active', true)
            ->with('photos')
            ->firstOrFail();

        return view('guest.facilities.show', compact('category'));
    }
}
