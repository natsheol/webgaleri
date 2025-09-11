<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\House;
use App\Models\Professor;
use App\Models\Achievement;
use App\Models\HogwartsProphet;

class AdminController extends Controller
{
    public function index()
    {
        $admin = auth()->guard('admin')->user();
        $currentYear = now()->year;

        // 1️⃣ Total students (last 7 years)
        $studentsTotal = Student::whereYear('created_at', '>=', $currentYear - 6)->count();

        // 2️⃣ House stats (students per house, last 7 years)
        $houses = House::all();
        $houseStats = $houses->map(function($house) use ($currentYear) {
            $totalsPerHouse = [];
            for ($i = 6; $i >= 0; $i--) {
                $year = $currentYear - $i;
                $totalsPerHouse[] = Student::where('house_id', $house->id)
                                            ->whereYear('created_at', $year)
                                            ->count();
            }
            $house->students_last7years = array_sum($totalsPerHouse);
            return $house;
        });

        // 3️⃣ Chart: students per year (last 7 years)
        $years = [];
        $totals = [];
        for ($i = 6; $i >= 0; $i--) {
            $year = $currentYear - $i;
            $years[] = $year;
            $totals[] = Student::whereYear('created_at', $year)->count();
        }
        $studentPerYear = ['years' => $years, 'totals' => $totals];

        // 4️⃣ Professors count
        $professorsTotal = Professor::count();

        // 5️⃣ Latest Hogwarts Prophet (3 latest news)
        $latestNews = HogwartsProphet::latest()->take(3)->get();

        // 6️⃣ Latest Achievements (3 latest)
        $latestAchievements = Achievement::latest()->take(3)->get();

        // 7️⃣ School profile
        $school = \App\Models\SchoolProfile::first();

        return view('admin.dashboard', compact(
            'admin',
            'studentsTotal',
            'houseStats',
            'studentPerYear',
            'professorsTotal',
            'latestNews',
            'latestAchievements',
            'school'
        ));
    }
}
