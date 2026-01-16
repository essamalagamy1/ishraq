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
        Schema::create('features', function (Blueprint $table) {
            $table->id();
            $table->string('section'); // why_choose_us, core_values, etc.
            $table->string('icon'); // Font Awesome class
            $table->string('title');
            $table->text('description');
            $table->string('color_from')->default('blue-500');
            $table->string('color_to')->default('cyan-500');
            $table->string('badge_text')->nullable();
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
        Schema::dropIfExists('features');
    }
};
