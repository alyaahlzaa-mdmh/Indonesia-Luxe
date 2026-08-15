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
        Schema::table('tour_packages', function (Blueprint $table) {
            $table->string('duration')->nullable()->after('duration_hours');
            $table->date('start_date')->nullable()->after('max_participants');
            $table->date('end_date')->nullable()->after('start_date');
            $table->json('extra_photos')->nullable()->after('cover_image_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tour_packages', function (Blueprint $table) {
            $table->dropColumn(['duration', 'start_date', 'end_date', 'extra_photos']);
        });
    }
};
