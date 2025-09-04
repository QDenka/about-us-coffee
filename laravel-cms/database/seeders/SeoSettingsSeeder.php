<?php

namespace Database\Seeders;

use App\Models\SeoSettings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeoSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SeoSettings::create([
            'page' => 'home',
            'meta_title' => [
                'vi' => 'ABOUT US Coffee & Eatery - Cà phê chuyên nghiệp • Arabica chất lượng • Đà Nẵng',
                'en' => 'ABOUT US Coffee & Eatery - Specialty Coffee • Quality Arabica • Da Nang'
            ],
            'meta_description' => [
                'vi' => 'Cà phê chuyên nghiệp cao cấp tại Đà Nẵng. Arabica chất lượng, pha tay, cà phê Việt Nam truyền thống và ăn cả ngày. Tầng 2 làm việc với WiFi miễn phí.',
                'en' => 'Premium specialty coffee in Da Nang. Quality arabica, hand brew, traditional Vietnamese coffee & all-day dining. Second floor workspace with free WiFi.'
            ],
            'meta_keywords' => [
                'vi' => 'cà phê chuyên nghiệp Đà Nẵng, cà phê arabica, pha tay, cà phê Việt Nam, quán cà phê làm việc, An Thượng',
                'en' => 'specialty coffee Da Nang, arabica coffee, hand brew, Vietnamese coffee, cafe workspace, An Thuong coffee shop'
            ],
            'og_title' => [
                'vi' => 'ABOUT US Coffee & Eatery - Cà phê chuyên nghiệp tại Đà Nẵng',
                'en' => 'ABOUT US Coffee & Eatery - Specialty Coffee in Da Nang'
            ],
            'og_description' => [
                'vi' => 'Trải nghiệm cà phê cao cấp với arabica chất lượng, phương pháp pha truyền thống và văn hóa cà phê hiện đại tại trung tâm An Thượng.',
                'en' => 'Premium coffee experience with quality arabica, traditional brewing methods, and modern cafe culture in the heart of An Thuong.'
            ],
            'og_image' => null,
            'schema_markup' => [
                'vi' => null,
                'en' => null
            ]
        ]);
    }
}
