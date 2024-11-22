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
        Schema::create('food_foodlog', function (Blueprint $table) {
            $table->id();
            $table->foreignId('food_id')->constrained('foods')->onDelete('cascade');
            $table->foreignId('foodlog_id')->constrained('food_logs')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_foodlog');
    }
};
