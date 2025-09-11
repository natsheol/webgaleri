<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\House;
use App\Models\HouseStudent;
use App\Models\Achievement;
use Carbon\Carbon;



class HouseController extends Controller
{
    public function index()
    {
        $houses = House::all();
        return view('admin.houses.index', compact('houses'));
    }

    public function edit(House $house)
    {
        $house->load('studentsRelation');

        $currentYear = date('Y');
        $sevenYearsAgo = $currentYear - 6;

        // Total students 7 angkatan terakhir
        $totalStudents = $house->studentsRelation()
            ->whereBetween('year', [$sevenYearsAgo, $currentYear])
            ->count();

        // Jumlah student per tahun
        $studentsPerYear = $house->studentsRelation()
            ->whereBetween('year', [$sevenYearsAgo, $currentYear])
            ->selectRaw('year, count(*) as total')
            ->groupBy('year')
            ->orderByDesc('year')
            ->get();

        $achievements = $house->achievements()->latest()->get();

        return view('admin.houses.edit', compact('house', 'totalStudents', 'studentsPerYear', 'achievements'));
    }


    public function update(Request $request, House $house)
    {
        $validated = $request->validate([
            'description' => 'nullable|string',
            'characteristics' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('houses', 'public');
            $validated['logo'] = $path;
        }

        if (!empty($validated['characteristics'])) {
            $validated['characteristics'] = explode(',', $validated['characteristics']);
        }

        $house->update($validated);

        return redirect()->route('admin.houses.edit', $house->id)->with('success', 'House updated successfully!');
    }

    public function storeStudents(Request $request, House $house)
    {
        $studentsData = $request->input('students', []);

        foreach ($studentsData as $year => $total) {
            $house->students()->updateOrCreate(
                ['year' => $year],
                ['total_students' => $total]
            );
        }

        return redirect()->route('admin.houses.edit', $house->id)->with('success', 'Student counts updated successfully!');
    }

    public function storeAchievement(Request $request, House $house)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'date' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('achievements', 'public');
        }

        // Assign house_id otomatis dari route
        $validated['house_id'] = $house->id;

        Achievement::create($validated);

        return redirect()->route('admin.houses.edit', $house->id)
                        ->with('success', 'Achievement added successfully.');
    }


}
