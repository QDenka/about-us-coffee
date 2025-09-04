<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'title' => [
                    'vi' => 'BUỔI CUPPING CÀ PHÊ',
                    'en' => 'COFFEE CUPPING SESSION'
                ],
                'description' => [
                    'vi' => 'Tham gia cùng chúng tôi trong buổi thử hương vị có hướng dẫn về các loại cà phê single-origin mới từ Ethiopia và Colombia. Thứ Bảy, 2:00 CH - 4:00 CH',
                    'en' => 'Join us for a guided tasting of our new single-origin coffees from Ethiopia and Colombia. Saturday, 2:00 PM - 4:00 PM'
                ],
                'date' => '2025-01-15',
                'time' => '14:00:00',
                'is_featured' => true,
            ],
            [
                'title' => [
                    'vi' => 'WORKSHOP LATTE ART',
                    'en' => 'LATTE ART WORKSHOP'
                ],
                'description' => [
                    'vi' => 'Học những kiến thức cơ bản về latte art từ các barista chuyên nghiệp của chúng tôi. Chào đón tất cả các trình độ kỹ năng! Thứ Bảy, 10:00 SA - 12:00 CH',
                    'en' => 'Learn the basics of latte art from our expert baristas. All skill levels welcome! Saturday, 10:00 AM - 12:00 PM'
                ],
                'date' => '2025-01-22',
                'time' => '10:00:00',
                'is_featured' => true,
            ],
            [
                'title' => [
                    'vi' => 'THỨ SÁU ACOUSTIC SỐNG',
                    'en' => 'LIVE ACOUSTIC FRIDAY'
                ],
                'description' => [
                    'vi' => 'Thưởng thức nhạc acoustic sống trong khi nhâm nhi cà phê yêu thích của bạn. Showcase của các nghệ sĩ địa phương. Thứ Sáu, 7:00 CH - 9:00 CH',
                    'en' => 'Enjoy live acoustic music while sipping your favorite coffee. Local artists showcase. Friday, 7:00 PM - 9:00 PM'
                ],
                'date' => '2025-01-29',
                'time' => '19:00:00',
                'is_featured' => false,
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
