<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('workspaces', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->json('description_1');
            $table->json('description_2');
            $table->json('description_3');
            $table->json('features');
            $table->json('ground_floor_title');
            $table->json('ground_floor_description');
            $table->json('second_floor_title');
            $table->json('second_floor_description');
            $table->string('wifi_speed')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workspaces');
    }
};
