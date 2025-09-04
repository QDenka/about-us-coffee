<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('page_sections', function (Blueprint $table) {
            $table->id();
            $table->string('section_key')->unique();
            $table->boolean('is_visible')->default(true);
            $table->integer('sort_order')->default(0);
            $table->boolean('is_required')->default(false);
            $table->timestamps();
        });

        // Insert default sections
        DB::table('page_sections')->insert([
            ['section_key' => 'hero', 'is_visible' => true, 'sort_order' => 1, 'is_required' => true, 'created_at' => now(), 'updated_at' => now()],
            ['section_key' => 'story', 'is_visible' => true, 'sort_order' => 2, 'is_required' => false, 'created_at' => now(), 'updated_at' => now()],
            ['section_key' => 'menu', 'is_visible' => true, 'sort_order' => 3, 'is_required' => false, 'created_at' => now(), 'updated_at' => now()],
            ['section_key' => 'workspace', 'is_visible' => true, 'sort_order' => 4, 'is_required' => false, 'created_at' => now(), 'updated_at' => now()],
            ['section_key' => 'journey', 'is_visible' => true, 'sort_order' => 5, 'is_required' => false, 'created_at' => now(), 'updated_at' => now()],
            ['section_key' => 'events', 'is_visible' => true, 'sort_order' => 6, 'is_required' => false, 'created_at' => now(), 'updated_at' => now()],
            ['section_key' => 'team', 'is_visible' => true, 'sort_order' => 7, 'is_required' => false, 'created_at' => now(), 'updated_at' => now()],
            ['section_key' => 'gallery', 'is_visible' => true, 'sort_order' => 8, 'is_required' => false, 'created_at' => now(), 'updated_at' => now()],
            ['section_key' => 'contact', 'is_visible' => true, 'sort_order' => 9, 'is_required' => false, 'created_at' => now(), 'updated_at' => now()],
            ['section_key' => 'footer', 'is_visible' => true, 'sort_order' => 10, 'is_required' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_sections');
    }
};
