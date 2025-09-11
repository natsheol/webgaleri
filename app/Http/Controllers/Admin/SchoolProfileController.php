<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;

class SchoolProfileController extends Controller
{

    public function index()
    {
        $profile = SchoolProfile::first();

        if (!$profile) {
            $profile = SchoolProfile::create([
                'title' => 'School Profile',
                'about' => '',
                'vision' => '',
                'mission' => '',
            ]);
        }

        return view('admin.school_profiles.index', compact('profile'));
    }

    public function edit()
    {
        $profile = SchoolProfile::first();

        // Kalau belum ada record, bikin default
        if (!$profile) {
            $profile = SchoolProfile::create([
                'title'   => 'Hogwarts School of Wizard and Witchcraft',
                'about'   => '',
                'address' => '',
                'phone'   => '',
                'email'   => '',
                'map_embed' => '',
                'vision'  => '',
                'mission' => '',
                'facebook_url' => '',
                'instagram_url' => '',
                'youtube_url' => '',
                'twitter_url' => '',
            ]);
        }

        return view('admin.school_profiles.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = SchoolProfile::firstOrFail();

        $request->validate([
            'title'   => 'required|string|max:255',
            'logo'    => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048',
            'about'   => 'nullable|string',
            'address' => 'required|string',
            'phone'   => 'required|string|max:20',
            'email'   => 'required|email',
            'map_embed' => 'nullable|string',
            'vision'  => 'nullable|string',
            'mission' => 'nullable|string',
            'facebook_url'  => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'youtube_url'   => 'nullable|url',
            'twitter_url'   => 'nullable|url',
        ]);

        // Upload logo kalau ada file baru
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('school-logos', 'public');
            $profile->logo = $path;
        }

        $profile->update([
            'title'   => $request->title,
            'about'   => $request->about,
            'address' => $request->address,
            'phone'   => $request->phone,
            'email'   => $request->email,
            'map_embed' => $request->map_embed,
            'vision'  => $request->vision,
            'mission' => $request->mission,
            'facebook_url'  => $request->facebook_url,
            'instagram_url' => $request->instagram_url,
            'youtube_url'   => $request->youtube_url,
            'twitter_url'   => $request->twitter_url,
        ]);

        return redirect()
            ->route('admin.school-profile.edit')
            ->with('success', 'Profil sekolah berhasil diperbarui!');
    }
}
