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
        try {
            // Validate the request
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'birth_year' => 'required|integer|min:500|max:' . date('Y'),
                'description' => 'nullable|string',
                'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            ]);

            // Get or create school profile
            $schoolProfile = SchoolProfile::firstOrCreate(
                ['id' => 1],
                [
                    'title' => 'Hogwarts School of Witchcraft and Wizardry',
                    'about' => 'A magical school for young wizards and witches.',
                    'address' => 'Scotland, United Kingdom',
                    'phone' => '+44 123 456 7890',
                    'email' => 'info@hogwarts.edu',
                    'founded_year' => 990,
                    'motto' => 'Draco Dormiens Nunquam Titillandus',
                    'vision' => 'To provide the finest magical education in the world.',
                    'mission' => 'To nurture young witches and wizards in the magical arts.',
                ]
            );

            // Handle file upload
            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('public/founders');
                $validated['photo'] = str_replace('public/', '', $path);
            }

            // Create founder with validated data
            $founder = new Founder($validated);
            $founder->school_profile_id = $schoolProfile->id;
            $founder->save();

            return redirect()
                ->route('admin.school-profile.founders.index')
                ->with('success', 'Pendiri berhasil ditambahkan!');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal menambahkan pendiri: ' . $e->getMessage());
        }
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

        
        if ($request->hasFile('photo')) {
            
            if ($founder->photo && Storage::disk('public')->exists($founder->photo)) {
                Storage::disk('public')->delete($founder->photo);
            }

            
            $validated['photo'] = $request->file('photo')->store('founders', 'public');
        }

        
        $founder->update($validated);

        return redirect()->route('admin.school-profile.edit')
    ->with('success', 'Founder updated successfully!');
    }




    public function destroy(Founder $founder)
    {
        $founder->delete();
        return redirect()->route('admin.school-profile.founders.edit')
            ->with('success', 'Founder deleted successfully!');
    }
}
