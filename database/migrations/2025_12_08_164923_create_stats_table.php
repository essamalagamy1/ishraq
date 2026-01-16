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
        Schema::create('stats', function (Blueprint $table) {
            $table->id();
            $table->string('page'); // home, about, services, etc.
            $table->string('icon'); // Font Awesome class
            $table->string('number'); // +250, 99%, 5+, etc.
            $table->string('label');
            $table->string('description')->nullable();
            $table->string('color_from')->default('blue-400');
            $table->string('color_to')->default('cyan-400');
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
        Schema::dropIfExists('stats');
    }
};
