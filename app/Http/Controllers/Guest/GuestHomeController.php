<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\SchoolProfile;
use App\Models\House;
use App\Models\Student;
use App\Models\FacilityCategory;
use App\Models\HogwartsProphet;
use App\Models\Founder;
use App\Models\Professor;
use App\Models\Achievement;

class GuestHomeController extends Controller
{
    public function index()
    {
        $houseStats = House::withCount([
            'students as students_last7years' => function ($query) {
                $query->where('created_at', '>=', now()->subYears(7));
            }
        ])->get();

        $schoolProfile = SchoolProfile::first();

        $houses = House::withCount('students')->get();

        $news = HogwartsProphet::latest()->take(3)->get();

        $categories = FacilityCategory::with('coverPhoto')
        ->orderBy('sort_order')
        ->limit(8)
        ->get();

        $achievements = Achievement::latest()->take(6)->get();
        

        $founders = Founder::all();

        $totalStudents = Student::count();

        $totalProfessors = Professor::count();

        return view('guest.home', compact(
            'houses',
            'news',
            'categories',   
            'founders',
            'houseStats',
            'totalStudents',
            'totalProfessors',
            'achievements'
        ))->with('profile', $schoolProfile);
    }
}
