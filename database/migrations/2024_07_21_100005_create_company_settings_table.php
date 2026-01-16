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
        Schema::create('company_settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('main_email');
            $table->string('secondary_email')->nullable();
            $table->string('phone_primary')->nullable();
            $table->string('phone_secondary')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('location_text')->nullable();
            $table->text('about_short')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('logo_2_path')->nullable();
            $table->string('favicon_path')->nullable();
            $table->longText('terms_conditions')->nullable();
            $table->longText('privacy_policy')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_settings');
    }
};
