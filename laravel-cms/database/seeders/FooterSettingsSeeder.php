<?php

namespace Database\Seeders;

use App\Models\FooterSettings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FooterSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FooterSettings::create([
            'contact_email' => 'dothanhsang1908@gmail.com',
            'contact_phone' => '0866 095 557',
            'address' => [
                'vi' => '09 An Thượng 11, Bắc Mỹ Phú, Ngũ Hành Sơn, Đà Nẵng 550000, Việt Nam',
                'en' => '09 An Thượng 11, Bắc Mỹ Phú, Ngũ Hành Sơn, Đà Nẵng 550000, Vietnam'
            ],
            'opening_hours' => [
                'vi' => 'Hàng ngày: 7:30 SA - 9:30 CH',
                'en' => 'Every day: 7:30 AM - 9:30 PM'
            ],
            'social_facebook' => 'https://web.facebook.com/profile.php?id=61569478955284',
            'social_instagram' => 'https://www.instagram.com/about_us.coffee/',
            'copyright_text' => [
                'vi' => '© 2025 ABOUT US Coffee & Eatery | Cà phê chuyên nghiệp & Văn hóa quán cà phê hiện đại tại Đà Nẵng',
                'en' => '© 2025 ABOUT US Coffee & Eatery | Specialty Coffee & Modern Cafe Culture in Da Nang'
            ]
        ]);
    }
}
