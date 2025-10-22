<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::orderBy('group')->orderBy('key')->get()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
        ]);

        foreach ($request->settings as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            
            if ($setting) {
                // Handle file upload for image type
                if ($setting->type === 'image' && $request->hasFile("settings.{$key}")) {
                    // Delete old image if exists
                    if ($setting->value && Storage::disk('public')->exists($setting->value)) {
                        Storage::disk('public')->delete($setting->value);
                    }
                    
                    $path = $request->file("settings.{$key}")->store('settings', 'public');
                    $value = $path;
                }
                
                $setting->update(['value' => $value]);
            }
        }

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully!');
    }

    public function reset()
    {
        // Reset to default values
        $defaults = [
            ['key' => 'site_name', 'value' => 'Hogwarts School', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'Welcome to Hogwarts School of Witchcraft and Wizardry', 'type' => 'textarea', 'group' => 'general'],
            ['key' => 'site_logo', 'value' => '', 'type' => 'image', 'group' => 'appearance'],
            ['key' => 'site_favicon', 'value' => '', 'type' => 'image', 'group' => 'appearance'],
            ['key' => 'contact_email', 'value' => 'info@hogwarts.edu', 'type' => 'email', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value' => '+44 123 456 7890', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_address', 'value' => 'Hogwarts Castle, Scotland', 'type' => 'textarea', 'group' => 'contact'],
            ['key' => 'social_facebook', 'value' => '', 'type' => 'url', 'group' => 'social'],
            ['key' => 'social_twitter', 'value' => '', 'type' => 'url', 'group' => 'social'],
            ['key' => 'social_instagram', 'value' => '', 'type' => 'url', 'group' => 'social'],
            ['key' => 'social_youtube', 'value' => '', 'type' => 'url', 'group' => 'social'],
        ];

        foreach ($defaults as $default) {
            Setting::updateOrCreate(
                ['key' => $default['key']],
                $default
            );
        }

        return redirect()->route('admin.settings.index')->with('success', 'Settings reset to defaults!');
    }
}
