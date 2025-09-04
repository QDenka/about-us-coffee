<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TeamMember::create([
            'name' => 'NGUYEN VAN MINH',
            'title' => [
                'vi' => 'Barista Chính & Chủ Quán',
                'en' => 'Head Barista & Owner'
            ],
            'bio' => [
                'vi' => 'Với hơn 10 năm kinh nghiệm trong cà phê chuyên nghiệp, Minh mang đến đam mê và chuyên môn cho từng tách cà phê. Được chứng nhận Q Grader và huấn luyện viên SCA, anh ấy tận tâm chia sẻ nghệ thuật và khoa học cà phê với cộng đồng của chúng tôi. 🏆 Vô địch Barista Việt Nam 2022 📚 Huấn luyện viên được chứng nhận SCA ☕ Chứng nhận Q Grader',
                'en' => 'With over 10 years of experience in specialty coffee, Minh brings passion and expertise to every cup. Certified Q Grader and SCA trainer, he\'s dedicated to sharing the art and science of coffee with our community. 🏆 Vietnam Barista Champion 2022 📚 SCA Certified Trainer ☕ Q Grader Certified'
            ],
            'image' => 'gallery/2025-03-26 (1).webp',
            'order' => 1,
        ]);
    }
}
