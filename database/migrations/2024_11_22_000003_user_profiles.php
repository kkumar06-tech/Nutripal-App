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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references(columns: 'id')->on('users')->onDelete('cascade');

            $table->string('name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->float('weight')->nullable();
            $table->float('height')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->enum('fitness_goal', ['maintainance', 'weight_loss', 'build_muscle'])->nullable();
            $table->enum('weekly_exercise_frequency', [
                'sedentary',
                'lightly_active',
                'moderately_active',
                'very_active',
                'extremely_active'
            ])->nullable();
            $table->integer('daily_goal_ml')->default(2000)->nullable(); 
            $table->integer('daily_goal_calories')->default(2000)->nullable();
            $table->string('profile_image')->nullable();

            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('user_profiles');
    }
};
