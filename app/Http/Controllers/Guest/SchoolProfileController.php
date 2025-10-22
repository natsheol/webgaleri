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
        $houses   = House::all();
        $currentYear = now()->year;

        // Students per house (last 7 years)
        $houseStats = House::withCount([
            'students as students_last7years' => function ($query) use ($currentYear) {
                $query->where('year', '>=', $currentYear - 6);
            }
        ])->get();

        // Total active students (last 7 years)
        $studentsTotal = Student::where('year', '>=', $currentYear - 6)->count();

        // Total professors
        $totalProfessors = Professor::count();

        // Optional: total students per year for chart
        $studentPerYear = [];
        for ($i = 0; $i < 7; $i++) {
            $year = $currentYear - 6 + $i;
            $studentPerYear['years'][]  = $year;
            $studentPerYear['totals'][] = Student::where('year', $year)->count();
        }

        return view('guest.sections.school-profiles', compact(
            'profile',
            'founders',
            'houses',
            'houseStats',
            'studentsTotal',
            'totalProfessors',
            'studentPerYear'
        ));
    }
}
