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
        Schema::table('company_settings', function (Blueprint $table) {
            $table->string('google_place_id')->nullable()->default('ChIJaZWC9s-eqaMRIK6tEKGwZlA')->after('google_review_url');
            $table->string('google_places_api_key')->nullable()->after('google_place_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->dropColumn(['google_place_id', 'google_places_api_key']);
        });
    }
};
