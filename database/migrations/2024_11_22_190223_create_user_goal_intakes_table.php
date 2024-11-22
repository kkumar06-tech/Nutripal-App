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
        Schema::create('user_goal_intakes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_profile_id')->constrained('user_profiles')->onDelete('cascade');
            $table->integer('calorie_goal')->unsigned();
            $table->decimal('water_goal', 5, 2)->unsigned();
            $table->integer('protein_goal')->unsigned();
            $table->integer('carbohydrate_goal')->unsigned();
            $table->integer('fat_goal')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_goal_intakes');
    }
};
