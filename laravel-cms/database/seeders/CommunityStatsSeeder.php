<?php

namespace Database\Seeders;

use App\Models\CommunityStats;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommunityStatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $communityStats = [
            [
                'stat_number' => '500+',
                'stat_label' => [
                    'vi' => 'Người Yêu Cà Phê',
                    'en' => 'Coffee Lovers'
                ],
                'order' => 1,
            ],
            [
                'stat_number' => '24',
                'stat_label' => [
                    'vi' => 'Sự Kiện Năm Nay',
                    'en' => 'Events This Year'
                ],
                'order' => 2,
            ],
            [
                'stat_number' => '15',
                'stat_label' => [
                    'vi' => 'Nghệ Sĩ Địa Phương Tham Gia',
                    'en' => 'Local Artists Featured'
                ],
                'order' => 3,
            ],
        ];

        foreach ($communityStats as $stat) {
            CommunityStats::create($stat);
        }
    }
}
