<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\House;
use Illuminate\Http\Request;
use App\Models\Achievement;

class HouseController extends Controller
{
public function index()
{
    $houses = House::with([
        'studentsRelation',
        'achievements' => fn($q) => $q->latest()->take(3),
        'professors'
    ])->get();

    $houseStats = $houses->map(function($house){
        $currentYear = now()->year;

        $studentsLast7Years = $house->studentsRelation
            ->where('year', '>=', $currentYear - 6)
            ->count();

        $totalAlumni = 1000;

        $professorsCount = $house->professors->count();

        return (object)[
            'id' => $house->id,
            'name' => $house->name,
            'logo' => $house->logo,
            'description' => $house->description,
            'characteristics' => $house->characteristics,
            'students_last7years' => $studentsLast7Years,
            'total_alumni' => $totalAlumni,
            'professors_count' => $professorsCount,
            'achievements' => $house->achievements,
        ];
    });

    // Ambil hero slides dari 6 achievements terbaru
    $latestAchievements = Achievement::latest()->take(6)->get();

    return view('guest.houses.index', [
        'houseStats' => $houseStats,
        'latestAchievements' => $latestAchievements,
    ]);
}

}
