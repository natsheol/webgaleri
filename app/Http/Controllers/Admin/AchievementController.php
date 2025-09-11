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
        return view('admin.achievements.create', compact('house_id', 'houses', 'categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
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
            'image' => 'nullable|image|max:2048',
            'house_id' => 'nullable|exists:houses,id',
            'date' => 'nullable|date',
        ]);

        $data = $request->only(['title', 'description', 'house_id', 'date']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('achievements', 'public');
        }

        $achievement->update($data);

        return redirect()->route('admin.achievements.index')->with('success', 'Achievement updated!');
    }

    public function destroy(Achievement $achievement)
    {
        $achievement->delete();
        return redirect()->route('admin.achievements.index')->with('success', 'Achievement deleted!');
    }
}
