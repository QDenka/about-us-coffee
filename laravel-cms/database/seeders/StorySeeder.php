<?php

namespace Database\Seeders;

use App\Models\Story;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $storyCards = [
            [
                'title' => [
                    'vi' => 'VĂN HÓA CÀ PHÊ',
                    'en' => 'COFFEE CULTURE'
                ],
                'description' => [
                    'vi' => 'Tọa lạc tại trung tâm quận An Thượng của Đà Nẵng. Chúng tôi tôn vinh cả văn hóa cà phê chuyên nghiệp và cách pha truyền thống của Việt Nam, cung cấp arabica chất lượng cùng với các loại cà phê địa phương yêu thích.',
                    'en' => 'Located in the heart of Da Nang\'s An Thuong district. We celebrate both specialty coffee culture and traditional Vietnamese brewing, offering quality arabica alongside local favorites.'
                ],
                'order' => 1,
            ],
            [
                'title' => [
                    'vi' => 'TẬP TRUNG VÀO CHẤT LƯỢNG',
                    'en' => 'QUALITY FOCUS'
                ],
                'description' => [
                    'vi' => 'Từ single origin Ethiopia đến robusta Việt Nam cổ điển. Các phương pháp pha tay, đồ uống espresso và pha phin truyền thống. Mọi tách cà phê đều được chế biến với sự chú ý đến từng chi tiết.',
                    'en' => 'From Ethiopian single origins to classic Vietnamese robusta. Hand brew methods, espresso-based drinks, and traditional phin brewing. Every cup crafted with attention to detail.'
                ],
                'order' => 2,
            ],
            [
                'title' => [
                    'vi' => 'KHÔNG GIAN CỘNG ĐỒNG',
                    'en' => 'COMMUNITY SPACE'
                ],
                'description' => [
                    'vi' => 'Không chỉ là một quán cà phê - chúng tôi là trung tâm khu phố của bạn. Tầng trệt cho cà phê nhanh, tầng 2 không gian làm việc với WiFi miễn phí. Nơi cà phê chất lượng gặp gỡ sự thoải mái hiện đại.',
                    'en' => 'More than a cafe – we\'re your neighborhood hub. Ground floor for quick coffee, second floor workspace with free WiFi. A place where quality coffee meets modern comfort.'
                ],
                'order' => 3,
            ],
        ];

        foreach ($storyCards as $story) {
            Story::create($story);
        }
    }
}
