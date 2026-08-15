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
        DB::table('cart_items')
            ->whereNull('pickup_point')
            ->update(['pickup_point' => '']);

        $this->ensureIndexExists('cart_items', 'cart_items_cart_id_index', ['cart_id']);

        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropUnique(['cart_id', 'tour_departure_slot_id']);
            $table->string('pickup_point')->default('')->nullable(false)->change();
            $table->unique(['cart_id', 'tour_departure_slot_id', 'pickup_point'], 'cart_items_slot_pickup_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Deduplicate rows that would violate the restored 2-column unique index.
        // Keep the row with the lowest id for each (cart_id, tour_departure_slot_id) pair.
        $duplicates = DB::table('cart_items')
            ->select('cart_id', 'tour_departure_slot_id')
            ->groupBy('cart_id', 'tour_departure_slot_id')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        foreach ($duplicates as $duplicate) {
            $keepId = DB::table('cart_items')
                ->where('cart_id', $duplicate->cart_id)
                ->where('tour_departure_slot_id', $duplicate->tour_departure_slot_id)
                ->orderBy('id')
                ->value('id');

            DB::table('cart_items')
                ->where('cart_id', $duplicate->cart_id)
                ->where('tour_departure_slot_id', $duplicate->tour_departure_slot_id)
                ->where('id', '!=', $keepId)
                ->delete();
        }

        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropUnique('cart_items_slot_pickup_unique');
            $table->string('pickup_point')->nullable()->default(null)->change();
            $table->unique(['cart_id', 'tour_departure_slot_id']);
        });

        $this->dropIndexIfExists('cart_items', 'cart_items_cart_id_index');
    }

    /**
     * @param  list<string>  $columns
     */
    private function ensureIndexExists(string $table, string $indexName, array $columns): void
    {
        if ($this->indexExists($table, $indexName)) {
            return;
        }

        Schema::table($table, function (Blueprint $blueprint) use ($columns, $indexName): void {
            $blueprint->index($columns, $indexName);
        });
    }

    private function dropIndexIfExists(string $table, string $indexName): void
    {
        if (! $this->indexExists($table, $indexName)) {
            return;
        }

        Schema::table($table, function (Blueprint $blueprint) use ($indexName): void {
            $blueprint->dropIndex($indexName);
        });
    }

    private function indexExists(string $table, string $indexName): bool
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'mysql') {
            $indexes = DB::select('SHOW INDEX FROM `'.$table.'` WHERE Key_name = ?', [$indexName]);

            return $indexes !== [];
        }

        if ($driver === 'sqlite') {
            $indexes = DB::select("PRAGMA index_list('{$table}')");

            return collect($indexes)->contains(fn (object $index): bool => $index->name === $indexName);
        }

        return false;
    }
};
