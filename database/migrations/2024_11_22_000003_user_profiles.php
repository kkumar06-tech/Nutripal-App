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

            $table->string('name');
            $table->date('date_of_birth');
            $table->float('weight');
            $table->float('height');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->enum('fitness_goal', ['maintenance', 'weight_loss', 'muscle_building']);
            $table->enum('weekly_exercise_frequency', [
                '0 days',
                '1-2 days',
                '3-4 days',
                '5-6 days',
                '7 days'
            ]);
            $table->integer('daily_goal_ml')->default(2000); 
            $table->integer('daily_goal_calories')->default(2000);
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
