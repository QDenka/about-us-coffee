<?php

namespace Database\Seeders;

use App\Models\GalleryImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GalleryImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleryImages = [
            [
                'title' => [
                    'vi' => 'About Us Coffee',
                    'en' => 'About Us Coffee'
                ],
                'alt_text' => [
                    'vi' => 'About Us Coffee',
                    'en' => 'About Us Coffee'
                ],
                'image_path' => 'gallery/2025-02-25.webp',
                'order' => 1,
            ],
            [
                'title' => [
                    'vi' => 'About Us Coffee',
                    'en' => 'About Us Coffee'
                ],
                'alt_text' => [
                    'vi' => 'About Us Coffee',
                    'en' => 'About Us Coffee'
                ],
                'image_path' => 'gallery/2025-01-02.webp',
                'order' => 2,
            ],
            [
                'title' => [
                    'vi' => 'About Us Coffee',
                    'en' => 'About Us Coffee'
                ],
                'alt_text' => [
                    'vi' => 'About Us Coffee',
                    'en' => 'About Us Coffee'
                ],
                'image_path' => 'gallery/2025-01-02 (1).webp',
                'order' => 3,
            ],
            [
                'title' => [
                    'vi' => 'About Us Coffee',
                    'en' => 'About Us Coffee'
                ],
                'alt_text' => [
                    'vi' => 'About Us Coffee',
                    'en' => 'About Us Coffee'
                ],
                'image_path' => 'gallery/2025-01-08.webp',
                'order' => 4,
            ],
            [
                'title' => [
                    'vi' => 'About Us Coffee',
                    'en' => 'About Us Coffee'
                ],
                'alt_text' => [
                    'vi' => 'About Us Coffee',
                    'en' => 'About Us Coffee'
                ],
                'image_path' => 'gallery/2025-01-08 (1).webp',
                'order' => 5,
            ],
            [
                'title' => [
                    'vi' => 'About Us Coffee',
                    'en' => 'About Us Coffee'
                ],
                'alt_text' => [
                    'vi' => 'About Us Coffee',
                    'en' => 'About Us Coffee'
                ],
                'image_path' => 'gallery/2025-02-11.webp',
                'order' => 6,
            ],
        ];

        foreach ($galleryImages as $image) {
            GalleryImage::create($image);
        }
    }
}
