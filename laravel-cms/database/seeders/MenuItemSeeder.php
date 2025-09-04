<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Coffee Lover Menu
        $coffeeItems = [
            [
                'name' => ['vi' => 'ESPRESSO', 'en' => 'ESPRESSO'],
                'description' => ['vi' => 'Medium roasted double shot, chỉ phục vụ nóng', 'en' => 'Medium roasted double shot, only hot'],
                'price' => 45000,
                'category' => 'coffee',
                'order' => 1,
            ],
            [
                'name' => ['vi' => 'ESPRESSO TONIC', 'en' => 'ESPRESSO TONIC'],
                'description' => ['vi' => 'Medium roasted double shot, chỉ phục vụ đá', 'en' => 'Medium roasted double shot, only iced'],
                'price' => 65000,
                'category' => 'coffee',
                'order' => 2,
            ],
            [
                'name' => ['vi' => 'AMERICANO', 'en' => 'AMERICANO'],
                'description' => ['vi' => 'Medium roasted double shot, nước - nóng/đá', 'en' => 'Medium roasted double shot, water - hot/iced'],
                'price' => 45000,
                'category' => 'coffee',
                'order' => 3,
            ],
            [
                'name' => ['vi' => 'FLAT WHITE', 'en' => 'FLAT WHITE'],
                'description' => ['vi' => 'Medium roasted blend, sữa tươi/yến mạch/hạnh nhân', 'en' => 'Medium roasted blend, fresh milk/oat/almond'],
                'price' => 60000,
                'category' => 'coffee',
                'order' => 4,
            ],
            [
                'name' => ['vi' => 'LATTE', 'en' => 'LATTE'],
                'description' => ['vi' => 'Medium roasted blend, sữa tươi/yến mạch/hạnh nhân', 'en' => 'Medium roasted blend, fresh milk/oat/almond'],
                'price' => 60000,
                'category' => 'coffee',
                'order' => 5,
            ],
            [
                'name' => ['vi' => 'CAPPUCCINO', 'en' => 'CAPPUCCINO'],
                'description' => ['vi' => 'Medium roasted blend, sữa tươi/yến mạch/hạnh nhân', 'en' => 'Medium roasted blend, fresh milk/oat/almond'],
                'price' => 60000,
                'category' => 'coffee',
                'order' => 6,
            ],
            [
                'name' => ['vi' => 'MOCHA', 'en' => 'MOCHA'],
                'description' => ['vi' => 'Medium roasted double shot, sô cô la, sữa tươi', 'en' => 'Medium roasted double shot, chocolate, fresh milk'],
                'price' => 65000,
                'category' => 'coffee',
                'order' => 7,
            ],
            [
                'name' => ['vi' => 'CARAMEL MACCHIATO', 'en' => 'CARAMEL MACCHIATO'],
                'description' => ['vi' => 'Medium roasted double shot, caramel, sữa tươi', 'en' => 'Medium roasted double shot, caramel, fresh milk'],
                'price' => 65000,
                'category' => 'coffee',
                'order' => 8,
            ],
        ];

        // Vietnamese Robusta Menu
        $vietnameseItems = [
            [
                'name' => ['vi' => 'CÀ PHÊ ĐEN', 'en' => 'BLACK COFFEE'],
                'description' => ['vi' => 'Dark roasted, đường - nóng/đá', 'en' => 'Dark roasted, sugar - hot/iced'],
                'price' => 40000,
                'category' => 'vietnamese',
                'order' => 1,
            ],
            [
                'name' => ['vi' => 'CÀ PHÊ SỮA', 'en' => 'MILK COFFEE'],
                'description' => ['vi' => 'Dark roasted, sữa đặc - nóng/đá', 'en' => 'Dark roasted, condensed milk - hot/iced'],
                'price' => 40000,
                'category' => 'vietnamese',
                'order' => 2,
            ],
            [
                'name' => ['vi' => 'BẠC XỈU', 'en' => 'WHITE COFFEE'],
                'description' => ['vi' => 'Dark roasted, sữa tươi/yến mạch/hạnh nhân, sữa đặc', 'en' => 'Dark roasted, fresh milk/oat/almond, condensed milk'],
                'price' => 50000,
                'category' => 'vietnamese',
                'order' => 3,
            ],
            [
                'name' => ['vi' => 'COCONUT COFFEE', 'en' => 'COCONUT COFFEE'],
                'description' => ['vi' => 'Dark roasted, sữa đặc, kem dừa', 'en' => 'Dark roasted, condensed milk, coconut cream'],
                'price' => 55000,
                'category' => 'vietnamese',
                'order' => 4,
            ],
            [
                'name' => ['vi' => 'SALTED COFFEE', 'en' => 'SALTED COFFEE'],
                'description' => ['vi' => 'Dark roasted, sữa đặc, kem muối', 'en' => 'Dark roasted, condensed milk, salted cream'],
                'price' => 50000,
                'category' => 'vietnamese',
                'order' => 5,
            ],
        ];

        // Hand Brew Menu
        $handbrewItems = [
            [
                'name' => ['vi' => 'HAND BREW', 'en' => 'HAND BREW'],
                'description' => ['vi' => 'Light roasted, single origin, Aeropress/Origami/V60', 'en' => 'Light roasted, single origin, Aeropress/Origami/V60'],
                'price' => 70000,
                'category' => 'handbrew',
                'order' => 1,
            ],
            [
                'name' => ['vi' => 'COLD BREW', 'en' => 'COLD BREW'],
                'description' => ['vi' => 'Light roasted, single origin - Ethiopia', 'en' => 'Light roasted, single origin - Ethiopia'],
                'price' => 65000,
                'category' => 'handbrew',
                'order' => 2,
            ],
            [
                'name' => ['vi' => 'RIVERSIDE', 'en' => 'RIVERSIDE'],
                'description' => ['vi' => 'Medium light roasted blend - Ethiopia, dừa', 'en' => 'Medium light roasted blend - Ethiopia, coconut'],
                'price' => 65000,
                'category' => 'handbrew',
                'order' => 3,
            ],
            [
                'name' => ['vi' => 'DOWNTOWN', 'en' => 'DOWNTOWN'],
                'description' => ['vi' => 'Medium light roasted blend - Ethiopia, dâu tằm', 'en' => 'Medium light roasted blend - Ethiopia, mulberry'],
                'price' => 65000,
                'category' => 'handbrew',
                'order' => 4,
            ],
        ];

        // Food Menu
        $foodItems = [
            [
                'name' => ['vi' => 'BAGEL HAM/BACON', 'en' => 'BAGEL HAM/BACON'],
                'description' => ['vi' => 'Trứng khuấy, ham/bacon/cá hồi hun khói, cà chua, rau diếp, rocket, sốt kem cheese', 'en' => 'Swirled egg, ham/bacon/smoked salmon, tomato, lettuce, rocket, cream cheese sauce'],
                'price' => 110000,
                'category' => 'food',
                'order' => 1,
            ],
            [
                'name' => ['vi' => 'BAGEL SALMON', 'en' => 'BAGEL SALMON'],
                'description' => ['vi' => 'Bagel, dưa chuột, bơ, rocket, cá hồi hun khói, trứng, sốt kem cheese', 'en' => 'Bagel, cucumber, avocado, rocket, smoked salmon, eggs, cream cheese sauce'],
                'price' => 130000,
                'category' => 'food',
                'order' => 2,
            ],
            [
                'name' => ['vi' => 'ENGLISH MEAL', 'en' => 'ENGLISH MEAL'],
                'description' => ['vi' => 'Bánh mì, 2 trứng, 2 xúc xích, 2 hashbrown, rau củ, cà chua cherry, nấm, bacon', 'en' => 'Bread, 2 eggs, 2 sausages, 2 hashbrown, vegetables, tomato cherry, mushroom, bacon'],
                'price' => 140000,
                'category' => 'food',
                'order' => 3,
            ],
            [
                'name' => ['vi' => 'EGG BENEDICT BACON', 'en' => 'EGG BENEDICT BACON'],
                'description' => ['vi' => 'Muffin, rau bina hoặc rocket, bacon, trứng poached, sốt hollandaise', 'en' => 'Muffin, spinach or rocket, bacon, poached egg, hollandaise sauce'],
                'price' => 120000,
                'category' => 'food',
                'order' => 4,
            ],
            [
                'name' => ['vi' => 'EGG BENEDICT SALMON', 'en' => 'EGG BENEDICT SALMON'],
                'description' => ['vi' => 'Muffin, rau bina hoặc rocket, cá hồi, trứng poached, sốt hollandaise', 'en' => 'Muffin, spinach or rocket, salmon, poached egg, hollandaise sauce'],
                'price' => 135000,
                'category' => 'food',
                'order' => 5,
            ],
            [
                'name' => ['vi' => 'AVOCADO TOAST POACHED/SCRAMBLE', 'en' => 'AVOCADO TOAST POACHED/SCRAMBLE'],
                'description' => ['vi' => 'Bánh mì sourdough, bơ, trứng, rau củ', 'en' => 'Sourdough slice, avocado, eggs, vegetables'],
                'price' => 90000,
                'category' => 'food',
                'order' => 6,
            ],
            [
                'name' => ['vi' => 'AVOCADO TOAST SALMON', 'en' => 'AVOCADO TOAST SALMON'],
                'description' => ['vi' => 'Bánh mì sourdough, bơ, cá hồi, trứng, rau củ', 'en' => 'Sourdough slice, avocado, salmon, eggs, vegetables'],
                'price' => 125000,
                'category' => 'food',
                'order' => 7,
            ],
            [
                'name' => ['vi' => 'SMOKED HAM CROISSANT', 'en' => 'SMOKED HAM CROISSANT'],
                'description' => ['vi' => 'Croissant, ham hun khói, cheddar, trứng, rocket/rau củ', 'en' => 'Croissant, smoked ham, cheddar, egg, rocket/vegetables'],
                'price' => 125000,
                'category' => 'food',
                'order' => 8,
            ],
            [
                'name' => ['vi' => 'SWIRLED EGGS TOAST BACON/HAM', 'en' => 'SWIRLED EGGS TOAST BACON/HAM'],
                'description' => ['vi' => 'Bánh mì sourdough, bơ, trứng khuấy, bacon/ham hun khói, rau củ', 'en' => 'Sourdough slice, avocado, swirled eggs, bacon/smoked ham, vegetables'],
                'price' => 110000,
                'category' => 'food',
                'order' => 9,
            ],
            [
                'name' => ['vi' => 'SWIRLED EGGS TOAST SALMON', 'en' => 'SWIRLED EGGS TOAST SALMON'],
                'description' => ['vi' => 'Bánh mì sourdough, bơ, trứng khuấy, cá hồi hun khói, rau củ', 'en' => 'Sourdough slice, avocado, swirled eggs, smoked salmon, vegetables'],
                'price' => 125000,
                'category' => 'food',
                'order' => 10,
            ],
            [
                'name' => ['vi' => 'TRIPLE GREEN', 'en' => 'TRIPLE GREEN'],
                'description' => ['vi' => 'Bơ, gà, rocket, trứng poached, cà chua, rau diếp, sốt mè', 'en' => 'Avocado, chicken, rocket, poached egg, tomatoes, lettuce, sesame dressing'],
                'price' => 90000,
                'category' => 'food',
                'order' => 11,
            ],
            [
                'name' => ['vi' => 'SWEET & SAVORY BAGEL', 'en' => 'SWEET & SAVORY BAGEL'],
                'description' => ['vi' => 'Bagel, kem cheese, rocket/rau củ, trứng, bacon, trái cây, sốt mật ong/caramel', 'en' => 'Bagel, cream cheese, rocket/vegetables, egg, bacon, fruits, honey/caramel sauce'],
                'price' => 140000,
                'category' => 'food',
                'order' => 12,
            ],
            [
                'name' => ['vi' => 'FRENCH TOAST', 'en' => 'FRENCH TOAST'],
                'description' => ['vi' => 'Bánh mì nướng, kem vanilla, trái cây, sốt caramel', 'en' => 'Toast, vanilla ice cream, fruits, caramel sauce'],
                'price' => 90000,
                'category' => 'food',
                'order' => 13,
            ],
            [
                'name' => ['vi' => 'SMOKED SALMON HEAVY CREAM EGGS', 'en' => 'SMOKED SALMON HEAVY CREAM EGGS'],
                'description' => ['vi' => 'Cá hồi hun khói, caper, dill/dưa chuột, 4 trứng, sốt kem cay', 'en' => 'Smoked salmon, caper, dill/cucumber, 4 eggs, spicy cream sauce'],
                'price' => 110000,
                'category' => 'food',
                'order' => 14,
            ],
        ];

        // Non-Coffee Menu
        $nonCoffeeItems = [
            [
                'name' => ['vi' => 'MATCHA LATTE', 'en' => 'MATCHA LATTE'],
                'description' => ['vi' => 'Matcha, đường, sữa tươi/yến mạch/hạnh nhân', 'en' => 'Matcha, sugar, fresh milk/oat/almond'],
                'price' => 60000,
                'category' => 'noncoffee',
                'order' => 1,
            ],
            [
                'name' => ['vi' => 'CHOCOLATE', 'en' => 'CHOCOLATE'],
                'description' => ['vi' => 'Sốt sô cô la, bột sô cô la, sữa tươi/yến mạch/hạnh nhân', 'en' => 'Chocolate sauce, chocolate powder, fresh milk/oat/almond'],
                'price' => 60000,
                'category' => 'noncoffee',
                'order' => 2,
            ],
            [
                'name' => ['vi' => 'HOUJICHA CHOCO', 'en' => 'HOUJICHA CHOCO'],
                'description' => ['vi' => 'Sô cô la, houjicha, sữa tươi/yến mạch/hạnh nhân', 'en' => 'Chocolate, houjicha, fresh milk/oat/almond'],
                'price' => 70000,
                'category' => 'noncoffee',
                'order' => 3,
            ],
            [
                'name' => ['vi' => 'GREEK YOGURT', 'en' => 'GREEK YOGURT'],
                'description' => ['vi' => 'Museli, sữa chua granola', 'en' => 'Museli, granola yogurt'],
                'price' => 60000,
                'category' => 'noncoffee',
                'order' => 4,
            ],
            [
                'name' => ['vi' => 'MANGO SMOOTHIE', 'en' => 'MANGO SMOOTHIE'],
                'description' => ['vi' => 'Đá, đường, xoài, sữa chua', 'en' => 'Iced, sugar, mango, yogurt'],
                'price' => 65000,
                'category' => 'noncoffee',
                'order' => 5,
            ],
            [
                'name' => ['vi' => 'STRAWBERRY SMOOTHIE', 'en' => 'STRAWBERRY SMOOTHIE'],
                'description' => ['vi' => 'Đá, dâu tây, đường, sữa chua', 'en' => 'Iced, strawberry, sugar, yogurt'],
                'price' => 65000,
                'category' => 'noncoffee',
                'order' => 6,
            ],
            [
                'name' => ['vi' => 'MANGONADA', 'en' => 'MANGONADA'],
                'description' => ['vi' => 'Đá, chamoy, sốt, gia vị tajin', 'en' => 'Iced, chamoy, sauce, tajin seasoning'],
                'price' => 70000,
                'category' => 'noncoffee',
                'order' => 7,
            ],
        ];

        // Combine and create all items
        $allItems = array_merge($coffeeItems, $vietnameseItems, $handbrewItems, $foodItems, $nonCoffeeItems);
        
        foreach ($allItems as $item) {
            MenuItem::create($item);
        }
    }
}
