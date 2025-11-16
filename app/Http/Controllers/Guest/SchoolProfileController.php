<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\SchoolProfile;
use App\Models\House;
use App\Models\Student;
use App\Models\Professor;

class SchoolProfileController extends Controller
{
    public function index()
    {
        $profile  = SchoolProfile::with('founders')->first();
        $founders = $profile ? $profile->founders : collect();
        $currentYear = now()->year;

        // Students per house (last 7 years) - align with Admin controller logic
        $houses = House::all();
        $houseStats = $houses->map(function ($house) use ($currentYear) {
            $activeCount = Student::where('house_id', $house->id)
                                  ->where('year', '>=', $currentYear - 6)
                                  ->count();
            $house->students_last7years = $activeCount;
            return $house;
        });

        // Total active students (last 7 years)
        $studentsTotal = Student::where('year', '>=', $currentYear - 6)->count();

        // Total professors
        $totalProfessors = Professor::count();

        // Total students per year (last 7 years) - align order and filter
        $years = [];
        $totals = [];
        for ($i = 6; $i >= 0; $i--) {
            $year = $currentYear - $i;
            $years[] = $year;
            $totals[] = Student::where('year', $year)
                               ->where('year', '>=', $currentYear - 6)
                               ->count();
        }
        $studentPerYear = [
            'years' => $years,
            'totals' => $totals,
        ];

        return view('guest.sections.school-profiles', compact(
            'profile',
            'founders',
            'houses',
            'houseStats',
            'studentsTotal',
            'totalProfessors',
            'studentPerYear',
            'hero_image'
        ));
    }
}
