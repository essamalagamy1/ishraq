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
        Schema::create('hero_sections', function (Blueprint $table) {
            $table->id();
            $table->string('page')->unique(); // home, about, services, contact, portfolio
            $table->string('badge_icon')->nullable();
            $table->string('badge_text')->nullable();
            $table->string('title_line1');
            $table->string('title_line2');
            $table->text('subtitle')->nullable();
            $table->string('cta_primary_text')->nullable();
            $table->string('cta_primary_link')->nullable();
            $table->string('cta_secondary_text')->nullable();
            $table->string('cta_secondary_link')->nullable();
            $table->string('background_image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_sections');
    }
};
