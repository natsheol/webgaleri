<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolProfile;
use App\Models\House;
use App\Models\Student;
use App\Models\Professor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SchoolProfileController extends Controller
{
    public function index()
    {
        $profile = SchoolProfile::with('founders')->first();
        
        // If no profile exists, create a default one
        if (!$profile) {
            $profile = SchoolProfile::create([
                'title' => 'Hogwarts School of Witchcraft and Wizardry',
                'about' => 'A magical school for young wizards and witches.',
                'address' => 'Scotland, United Kingdom',
                'phone' => '+44 123 456 7890',
                'email' => 'info@hogwarts.edu',
                'founded_year' => 990,
                'motto' => 'Draco Dormiens Nunquam Titillandus',
                'vision' => 'To provide the finest magical education in the world.',
                'mission' => 'To nurture young witches and wizards in the magical arts.',
            ]);
        }

        $founders = $profile->founders;
        $houses = House::all();
        $currentYear = now()->year;

        // Hitung siswa aktif 7 tahun terakhir
        $houseStats = House::withCount([
            'students as students_last7years' => function ($query) use ($currentYear) {
                $query->where('year', '>=', $currentYear - 6);
            }
        ])->get();

        $totalStudents = Student::where('year', '>=', $currentYear - 6)->count();
        $totalProfessors = Professor::count();

        return view('admin.school_profiles.index', compact(
            'profile',
            'founders',
            'houses',
            'houseStats',
            'totalStudents',
            'totalProfessors'
        ));
    }

    public function edit()
    {
        $profile = SchoolProfile::with('founders')->first();
        
        if (!$profile) {
            return redirect()->route('admin.school-profile.index')
                ->with('error', 'School profile not found. Please create one first.');
        }

        return view('admin.school_profiles.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = SchoolProfile::first();
        
        if (!$profile) {
            return redirect()->route('admin.school-profile.index')
                ->with('error', 'School profile not found.');
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'about' => 'nullable|string',
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'founded_year' => 'nullable|integer|min:1000|max:' . now()->year,
            'motto' => 'nullable|string|max:255',
            'headmaster_name' => 'nullable|string|max:255',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'facebook_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'map_embed' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'headmaster_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        // Handle file uploads
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($profile->logo && Storage::disk('public')->exists($profile->logo)) {
                Storage::disk('public')->delete($profile->logo);
            }
            $data['logo'] = $request->file('logo')->store('school-profile', 'public');
        }

        if ($request->hasFile('hero_image')) {
            // Delete old hero image if exists
            if ($profile->hero_image && Storage::disk('public')->exists($profile->hero_image)) {
                Storage::disk('public')->delete($profile->hero_image);
            }
            $data['hero_image'] = $request->file('hero_image')->store('school-profile', 'public');
        }

        if ($request->hasFile('headmaster_photo')) {
            // Delete old headmaster photo if exists
            if ($profile->headmaster_photo && Storage::disk('public')->exists($profile->headmaster_photo)) {
                Storage::disk('public')->delete($profile->headmaster_photo);
            }
            $data['headmaster_photo'] = $request->file('headmaster_photo')->store('school-profile', 'public');
        }

        $profile->update($data);

        return redirect()->route('admin.school-profile.index')
            ->with('success', 'School profile updated successfully.');
    }
}
