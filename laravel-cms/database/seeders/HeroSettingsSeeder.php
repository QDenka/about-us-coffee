<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HeroSettings;

class HeroSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HeroSettings::create([
            'title' => [
                'vi' => 'ABOUT US',
                'en' => 'ABOUT US'
            ],
            'subtitle' => 'Your next cup, Your best cup.',
            'background_image' => null
        ]);
    }
}
