<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Http\Request;
use App\Models\House;

class AchievementController extends Controller
{
    public function index()
    {
        $achievements = Achievement::latest()->get();
        return view('admin.achievements.index', compact('achievements'));
    }

    public function create(Request $request)
    {
        $house_id = $request->query('house_id'); 
        $houses = House::all(); 
        return view('admin.achievements.create', compact('house_id', 'houses'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'house_id' => 'nullable|exists:houses,id',
            'date' => 'nullable|date',
        ]);

        $data = $request->only(['title', 'description', 'house_id', 'date']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('achievements', 'public');
        }

        Achievement::create($data);

        return redirect()->route('admin.achievements.index')->with('success', 'Achievement added!');
    }

    public function edit(Achievement $achievement)
    {
        $houses = House::all();
        return view('admin.achievements.edit', compact('achievement', 'houses'));
    }

    public function update(Request $request, Achievement $achievement)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        'house_id' => 'nullable|exists:houses,id',
        'date' => 'nullable|date',
    ]);

    $data = $request->only(['title', 'description', 'house_id', 'date']);

    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        if ($achievement->image && file_exists(public_path('storage/' . $achievement->image))) {
            unlink(public_path('storage/' . $achievement->image));
        }

        // Simpan gambar baru
        $data['image'] = $request->file('image')->store('achievements', 'public');
    }

    $achievement->update($data);

    // Biar tetap di halaman yang sama (misal edit house)
    return redirect()->back()->with('success', 'Achievement updated successfully!');
}

    public function destroy(Achievement $achievement)
    {
        $achievement->delete();
        return redirect()->route('admin.achievements.index')->with('success', 'Achievement deleted!');
    }
}
