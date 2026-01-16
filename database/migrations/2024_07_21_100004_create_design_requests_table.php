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
        Schema::create('design_requests', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('company_name')->nullable();
            $table->string('project_type');
            $table->string('budget_range')->nullable();
            $table->string('deadline')->nullable();
            $table->longText('details');
            $table->string('attachment_path')->nullable();
            $table->string('status')->default('new'); // new/in_progress/closed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('design_requests');
    }
};
