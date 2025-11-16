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

    public function edit(Request $request, House $house)
{
    $house->load('studentsRelation');

    $currentYear = date('Y');
    $sevenYearsAgo = $currentYear - 6;

    // total 7 trahir
    $totalStudents = $house->studentsRelation()
        ->whereBetween('year', [$sevenYearsAgo, $currentYear])
        ->count();

    // total/yr
    $studentsPerYear = $house->studentsRelation()
        ->whereBetween('year', [$sevenYearsAgo, $currentYear])
        ->selectRaw('year, count(*) as total')
        ->groupBy('year')
        ->orderByDesc('year')
        ->get();

    $achievements = $house->achievements()->latest()->get();

    $filter = $request->get('status', 'active');

    $studentsQuery = $house->studentsRelation();

    $houses = \App\Models\House::all();

    if ($filter === 'active') {
        $studentsQuery->where('year', '>=', $sevenYearsAgo);
    } elseif ($filter === 'alumni') {
        $studentsQuery->where('year', '<', $sevenYearsAgo);
    }

    $students = $studentsQuery->orderByDesc('year')->get();

    return view('admin.houses.edit', compact(
        'house',
        'totalStudents',
        'studentsPerYear',
        'achievements',
        'students',
        'filter',
        'houses'
    ));
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

    public function downloadSummary(Request $request, House $house)
    {
        $range = (int) $request->query('range', 3);
        $status = $request->query('status', 'active');
        $endYear = (int) $request->query('end_year', date('Y'));

        $startYear = $endYear - $range + 1;

        // Dummy data (nanti ganti pake query beneran)
        $summary = $house->studentsRelation()
            ->whereBetween('year', [$startYear, $endYear])
            ->get(['year', 'total_students']);

        // Sementara: tampilkan teks di browser biar ga error
        return response()->make("
            <h2>Summary PDF Preview (dummy)</h2>
            <p>House: {$house->name}</p>
            <p>Status: {$status}</p>
            <p>Years: {$startYear} - {$endYear}</p>
            <pre>".print_r($summary->toArray(), true)."</pre>
        ");
    }




}
