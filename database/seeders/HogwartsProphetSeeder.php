<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\HogwartsProphet;

class HogwartsProphetSeeder extends Seeder
{
    public function run(): void
    {
        $dummyImages = [
            'https://picsum.photos/400/600?random=1',
            'https://picsum.photos/400/600?random=2',
            'https://picsum.photos/400/600?random=3',
            'https://picsum.photos/400/600?random=4',
            'https://picsum.photos/400/600?random=5',
        ];

        $titles = [
            'The Return of the Dark Lord',
            'Triwizard Tournament Ends in Chaos',
            'The Chosen One Strikes Again',
            'Secrets Beneath the Forbidden Forest',
            'Dumbledore’s Army Rises Once More',
        ];

        $contents = [
            'Rumors swirl as He-Who-Must-Not-Be-Named is said to be back. The Ministry denies all claims.',
            'An unexpected tragedy at the final task leaves the wizarding world in shock.',
            'Harry Potter saves the day again, this time during a mysterious attack at Hogsmeade.',
            'Students report strange noises and movements beneath the Forbidden Forest.',
            'A secret student organization trains in defense against dark magic under Hogwarts’ nose.',
        ];

        foreach ($dummyImages as $index => $url) {
            // Ambil ekstensi dari URL
            $extension = pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION) ?: 'jpg';
            $filename = "img-hp-" . ($index + 1) . "." . $extension;

            // Download dan simpan ke storage
            $imageContent = Http::get($url)->body();
            Storage::disk('public')->put("hogwarts-prophet/{$filename}", $imageContent);

            // Simpan ke database
            HogwartsProphet::create([
                'title'   => $titles[$index],
                'content' => $contents[$index],
                'writer'  => 'Daily Prophet Reporter',
                'image'   => "hogwarts-prophet/{$filename}",
            ]);
        }
    }
}
