<?php

namespace Database\Seeders;

use App\Models\Workspace;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkspaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Workspace::create([
            'title' => [
                'vi' => 'CHỖ NGỒI TẦNG HAI',
                'en' => 'SECOND FLOOR SEATING'
            ],
            'description_1' => [
                'vi' => 'Khu vực chỗ ngồi đơn giản ở tầng hai. Bàn ghế miễn phí cho bất kỳ ai muốn có một không gian yên tĩnh hơn để thưởng thức cà phê.',
                'en' => 'Simple seating area on the second floor. Free tables and chairs for anyone who wants a quieter space to enjoy their coffee.'
            ],
            'description_2' => [
                'vi' => 'Ánh sáng tự nhiên từ cửa sổ, chỗ ngồi thoải mái và bầu không khí yên bình. Chúng tôi phục vụ cả cà phê Việt Nam truyền thống và arabica chất lượng từ nhiều nguồn gốc khác nhau.',
                'en' => 'Natural light from windows, comfortable seating, and a peaceful atmosphere. We serve both traditional Vietnamese coffee and quality arabica from various origins.'
            ],
            'description_3' => [
                'vi' => 'Chỉ cần lấy cà phê ở tầng dưới và lên trên để có trải nghiệm thư giãn hơn.',
                'en' => 'Just grab your coffee downstairs and head up for a more relaxed experience.'
            ],
            'features' => [
                'vi' => ['Chỗ ngồi miễn phí', 'Ánh sáng tự nhiên', 'Không gian yên tĩnh', 'WiFi nhanh'],
                'en' => ['Free Seating', 'Natural Light', 'Quiet Space', 'Fast WiFi']
            ],
            'ground_floor_title' => [
                'vi' => 'TẦNG TRỆT',
                'en' => 'GROUND FLOOR'
            ],
            'ground_floor_description' => [
                'vi' => 'Quầy Cà Phê • Ăn Uống',
                'en' => 'Coffee Bar • Eatery'
            ],
            'ground_floor_image' => null,
            'second_floor_title' => [
                'vi' => 'TẦNG HAI',
                'en' => 'SECOND FLOOR'
            ],
            'second_floor_description' => [
                'vi' => 'Bàn Lớn • Khu Vực Yên Tĩnh',
                'en' => 'Large Tables • Quiet Area'
            ],
            'second_floor_image' => null,
            'wifi_speed' => '300mbps'
        ]);
    }
}
