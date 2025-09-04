<?php

namespace Database\Seeders;

use App\Models\JourneyStep;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JourneyStepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $journeySteps = [
            [
                'step_number' => 1,
                'icon' => '🌱',
                'title' => [
                    'vi' => 'NGUỒN GỐC',
                    'en' => 'SOURCING'
                ],
                'description' => [
                    'vi' => 'Arabica cao cấp từ cao nguyên Ethiopia và robusta Việt Nam chất lượng từ Tây Nguyên. Những nguồn gốc được lựa chọn cẩn thận cho hương vị đa dạng. Hạt cà phê chất lượng từ các nguồn đáng tin cậy.',
                    'en' => 'Premium arabica from Ethiopian highlands and quality Vietnamese robusta from Central Highlands. Carefully selected origins for diverse flavor profiles. Quality beans from trusted sources.'
                ],
            ],
            [
                'step_number' => 2,
                'icon' => '🔥',
                'title' => [
                    'vi' => 'RANG XAY',
                    'en' => 'ROASTING'
                ],
                'description' => [
                    'vi' => 'Rang nhẹ cho single origin chuyên nghiệp, vừa cho blend espresso, đậm cho phong cách Việt Nam truyền thống. Mỗi profile được tối ưu hóa cho phương pháp pha. Hương vị cân bằng hoàn hảo.',
                    'en' => 'Light roasts for specialty single origins, medium for espresso blends, dark for traditional Vietnamese style. Each profile optimized for brewing method. Perfectly balanced flavor profiles.'
                ],
            ],
            [
                'step_number' => 3,
                'icon' => '⚗️',
                'title' => [
                    'vi' => 'PHA CHẾ',
                    'en' => 'BREWING'
                ],
                'description' => [
                    'vi' => 'Nhiều phương pháp: Máy espresso, AeroPress, V60, Origami, cold brew và phin truyền thống. Mỗi phương pháp đều mang lại đặc tính riêng biệt. Chuyên môn pha chế đa dạng.',
                    'en' => 'Multiple methods: Espresso machine, AeroPress, V60, Origami, cold brew, and traditional phin filters. Each method brings out unique characteristics. Diverse brewing expertise.'
                ],
            ],
            [
                'step_number' => 4,
                'icon' => '☕',
                'title' => [
                    'vi' => 'PHỤC VỤ',
                    'en' => 'SERVING'
                ],
                'description' => [
                    'vi' => 'Từ latte chuyên nghiệp với sữa thay thế đến cà phê sữa truyền thống. Mọi đồ uống đều được chế biến để làm nổi bật phẩm chất tốt nhất của cà phê. Cà phê hoàn hảo cho mọi sở thích.',
                    'en' => 'From specialty lattes with alternative milks to traditional ca phe sua. Every drink crafted to highlight the coffee\'s best qualities. The perfect coffee for every preference.'
                ],
            ],
        ];

        foreach ($journeySteps as $step) {
            JourneyStep::create($step);
        }
    }
}
