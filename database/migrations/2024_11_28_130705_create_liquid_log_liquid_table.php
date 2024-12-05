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
        Schema::create('liquid_log_liquid', function (Blueprint $table) {
            $table->id();
            $table->foreignId('liquid_log_id')->constrained('liquid_logs')->onDelete('cascade');
            $table->foreignId('liquid_id')->constrained('liquids')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liquid_log_liquid');
    }
};
