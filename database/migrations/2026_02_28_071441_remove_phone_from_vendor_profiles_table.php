<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Migrate phone numbers from vendor_profiles to users
        DB::table('vendor_profiles')
            ->whereNotNull('phone')
            ->orderBy('id')
            ->chunk(100, function ($profiles) {
                foreach ($profiles as $profile) {
                    DB::table('users')
                        ->where('id', $profile->user_id)
                        ->update(['phone' => $profile->phone]);
                }
            });

        Schema::table('vendor_profiles', function (Blueprint $table) {
            $table->dropColumn('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vendor_profiles', function (Blueprint $table) {
            $table->string('phone')->nullable();
        });

        // Migrate phone numbers back from users to vendor_profiles
        DB::table('users')
            ->join('vendor_profiles', 'users.id', '=', 'vendor_profiles.user_id')
            ->whereNotNull('users.phone')
            ->orderBy('vendor_profiles.id')
            ->select('users.id', 'users.phone')
            ->chunk(100, function ($users) {
                foreach ($users as $user) {
                    DB::table('vendor_profiles')
                        ->where('user_id', $user->id)
                        ->update(['phone' => $user->phone]);
                }
            });
    }
};
