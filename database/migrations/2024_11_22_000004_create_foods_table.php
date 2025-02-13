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
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('meal_type',  ['Breakfast', 'Lunch','Snack','Dinner']);
            $table->integer('calories');  
            $table->integer('protein');  
            $table->integer('carbs');  
            $table->integer('fat');
            $table->json('portion'); 
            $table->string('food_image')->nullable();
            $table->timestamps();
            $table->string('cuisine_type')->nullable();
            $table->integer('cooking_time')->nullable();
            $table->json('dietary_preferences')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foods');
    }
};
