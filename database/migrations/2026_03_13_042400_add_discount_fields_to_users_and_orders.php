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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('luxe_points')->default(0)->after('role');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('promo_id')->nullable()->after('user_id')->constrained('promos')->nullOnDelete();
            $table->foreignId('gift_card_id')->nullable()->after('promo_id')->constrained('gift_cards')->nullOnDelete();
            $table->decimal('promo_discount_amount', 12, 2)->default(0)->after('total_amount');
            $table->decimal('gift_card_discount_amount', 12, 2)->default(0)->after('promo_discount_amount');
            $table->integer('luxe_points_used')->default(0)->after('gift_card_discount_amount');
            $table->decimal('luxe_points_discount_amount', 12, 2)->default(0)->after('luxe_points_used');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('luxe_points');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['promo_id']);
            $table->dropForeign(['gift_card_id']);
            $table->dropColumn([
                'promo_id',
                'gift_card_id',
                'promo_discount_amount',
                'gift_card_discount_amount',
                'luxe_points_used',
                'luxe_points_discount_amount',
            ]);
        });
    }
};
