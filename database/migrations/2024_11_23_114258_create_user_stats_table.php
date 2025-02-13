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
        Schema::create('user_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('user_profiles') ->onDelete('cascade');
            
            $table->date('date');                     /* ->default(DB::raw('CURRENT_DATE')); */
            $table->integer('calories')->default(0);
            $table->integer('protein')->default(0);
            $table->integer('fat')->default(0);
            $table->integer('carbs')->default(0);
            $table->integer('liquid_intake')->default(0);

            $table->timestamps();

            $table->unique(['user_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_stats');
    }
};
