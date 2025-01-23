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
        Schema::create('nutritionist_profiles', function (Blueprint $table) {
            $table->id(); 
             $table->string('name');
            $table->foreignId(column: 'user_id')->constrained()->onDelete('cascade');
        
            $table->text('credentials');
            $table->string('certificate_image');
            $table->string('profile_image')->nullable();
            $table->text('bio_description')->nullable();

            $table->decimal('rating', 2, 1)->default(0.0); 
            $table->integer('total_ratings')->default(0);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('nutritionist_profiles');
    }
};
