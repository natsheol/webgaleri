<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General Settings
            ['key' => 'site_name', 'value' => 'Hogwarts School', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'Welcome to Hogwarts School of Witchcraft and Wizardry', 'type' => 'textarea', 'group' => 'general'],
            ['key' => 'site_keywords', 'value' => 'hogwarts, school, magic, wizardry', 'type' => 'text', 'group' => 'general'],
            
            // Appearance Settings
            ['key' => 'site_logo', 'value' => '', 'type' => 'image', 'group' => 'appearance'],
            ['key' => 'site_favicon', 'value' => '', 'type' => 'image', 'group' => 'appearance'],
            ['key' => 'primary_color', 'value' => '#b03535', 'type' => 'text', 'group' => 'appearance'],
            ['key' => 'secondary_color', 'value' => '#3c5e5e', 'type' => 'text', 'group' => 'appearance'],
            
            // Contact Settings
            ['key' => 'contact_email', 'value' => 'info@hogwarts.edu', 'type' => 'email', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value' => '+44 123 456 7890', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_address', 'value' => 'Hogwarts Castle, Scotland', 'type' => 'textarea', 'group' => 'contact'],
            ['key' => 'contact_map_url', 'value' => '', 'type' => 'url', 'group' => 'contact'],
            
            // Social Media Settings
            ['key' => 'social_facebook', 'value' => '', 'type' => 'url', 'group' => 'social'],
            ['key' => 'social_twitter', 'value' => '', 'type' => 'url', 'group' => 'social'],
            ['key' => 'social_instagram', 'value' => '', 'type' => 'url', 'group' => 'social'],
            ['key' => 'social_youtube', 'value' => '', 'type' => 'url', 'group' => 'social'],
            ['key' => 'social_linkedin', 'value' => '', 'type' => 'url', 'group' => 'social'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
