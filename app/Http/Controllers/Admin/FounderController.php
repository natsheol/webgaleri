<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Founder;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FounderController extends Controller
{
    public function index()
    {
        $founders = Founder::with('schoolProfile')->get();
        return view('admin.school_profiles.founders.index', compact('founders'));
    }

    public function create()
    {
        $profiles = SchoolProfile::all();
        return view('admin.school_profiles.founders.create', compact('profiles'));
    }

    public function store(Request $request)
    {
        // Get the first school profile or create a default one
        $schoolProfile = SchoolProfile::first();
        if (!$schoolProfile) {
            $schoolProfile = SchoolProfile::create([
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

        $request->validate([
            'name' => 'required|string|max:255',
            'birth_year' => 'required|integer|min:500|max:' . date('Y'),
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $data = $request->all();
        $data['school_profile_id'] = $schoolProfile->id;

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('founders', 'public');
        }

        Founder::create($data);

        return redirect()->route('admin.school-profile.founders.index')
            ->with('success', 'Founder created successfully!');
    }

    public function edit(Founder $founder)
    {
        $profiles = SchoolProfile::all();
        return view('admin.school_profiles.founders.edit', compact('founder', 'profiles'));
    }

    public function update(Request $request, Founder $founder)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'birth_year' => 'required|integer|min:500|max:' . date('Y'),
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        // ✅ Handle upload foto
        if ($request->hasFile('photo')) {
            // Hapus foto lama kalau ada
            if ($founder->photo && Storage::disk('public')->exists($founder->photo)) {
                Storage::disk('public')->delete($founder->photo);
            }

            // Simpan foto baru
            $validated['photo'] = $request->file('photo')->store('founders', 'public');
        }

        // Update founder (keep existing school_profile_id)
        $founder->update($validated);

        return redirect()->route('admin.school-profile.founders.index')
                        ->with('success', 'Founder updated successfully!');
    }




    public function destroy(Founder $founder)
    {
        $founder->delete();
        return redirect()->route('admin.school-profile.founders.index')
            ->with('success', 'Founder deleted successfully!');
    }
}
