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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('client_position')->nullable();
            $table->string('client_company')->nullable();
            $table->string('client_avatar')->nullable();
            $table->integer('rating')->default(5); // 1-5
            $table->text('testimonial');
            $table->string('badge_text')->nullable();
            $table->string('badge_color_from')->default('blue-600');
            $table->string('badge_color_to')->default('cyan-500');
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
