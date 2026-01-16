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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('description');
            $table->string('icon')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('color_from')->default('blue-500');
            $table->string('color_to')->default('cyan-500');
            $table->string('badge_icon')->nullable();
            $table->string('badge_color')->default('yellow-400');
            $table->string('price_starting')->nullable();
            $table->string('price_label')->default('يبدأ من');
            $table->string('duration')->nullable();
            $table->string('cta_text')->default('اطلب الآن');
            $table->string('cta_link')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
