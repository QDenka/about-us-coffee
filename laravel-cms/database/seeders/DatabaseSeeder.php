<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Seed all content data
        $this->call([
            SeoSettingsSeeder::class,
            HeroSettingsSeeder::class,
            StorySeeder::class,
            MenuItemSeeder::class,
            JourneyStepSeeder::class,
            EventSeeder::class,
            TeamMemberSeeder::class,
            WorkspaceSeeder::class,
            GalleryImageSeeder::class,
            CommunityStatsSeeder::class,
            FooterSettingsSeeder::class,
        ]);
    }
}
