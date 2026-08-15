<?php

use App\Enums\PackageStatus;
use App\Enums\PackageType;
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
        Schema::create('tour_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('tour_category_id')->constrained()->cascadeOnDelete();
            $table->string('status')->default(PackageStatus::Draft->value)->index();
            $table->string('type')->default(PackageType::OpenTrip->value)->index();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('meeting_point')->nullable();
            $table->unsignedInteger('duration_hours')->nullable();
            $table->unsignedInteger('max_participants')->nullable();
            $table->decimal('price_per_person', 12, 2);
            $table->string('cover_image_path')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('approved_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('rejected_reason')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['vendor_id', 'status']);
            $table->index(['type', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_packages');
    }
};
