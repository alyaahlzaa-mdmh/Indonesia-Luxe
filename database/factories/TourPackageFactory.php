<?php

namespace Database\Factories;

use App\Enums\PackageStatus;
use App\Enums\PackageType;
use App\Models\TourCategory;
use App\Models\User;
use App\Models\VendorProfile;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TourPackage>
 */
class TourPackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->sentence(3);

        return [
            'vendor_id' => User::factory()->vendor()->afterCreating(function (User $user): void {
                VendorProfile::factory()->approved()->create(['user_id' => $user->id]);
            }),
            'tour_category_id' => TourCategory::factory(),
            'status' => PackageStatus::Published,
            'type' => fake()->randomElement(PackageType::cases()),
            'title' => $title,
            'slug' => Str::slug($title).'-'.fake()->unique()->numberBetween(100, 999),
            'description' => fake()->paragraph(3),
            'highlights' => [
                fake()->words(2, true),
                fake()->words(2, true),
            ],
            'included' => [
                fake()->words(2, true),
                fake()->words(2, true),
            ],
            'meeting_point' => fake()->city(),
            'duration_hours' => fake()->numberBetween(2, 12),
            'max_participants' => fake()->numberBetween(5, 30),
            'price_per_person' => fake()->randomFloat(2, 150000, 5000000),
            'cover_image_path' => null,
            'is_active' => true,
            'approved_at' => now(),
            'approved_by_user_id' => null,
            'rejected_reason' => null,
        ];
    }

    public function pendingApproval(): static
    {
        return $this->state(fn (): array => [
            'status' => PackageStatus::PendingApproval,
            'approved_at' => null,
        ]);
    }
}
