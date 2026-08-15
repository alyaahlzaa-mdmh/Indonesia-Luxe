<?php

namespace Database\Seeders;

use App\Models\TourCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TourCategorySeeder extends Seeder
{
    /**
     * @var array<int, string>
     */
    private array $categories = [
        'Open Trip',
        'Private Tour',
        'Hiking / Camping',
        'Rafting',
        'Snorkeling / Diving',
        'Jeep Adventure',
        'Local Experience',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->categories as $categoryName) {
            TourCategory::query()->updateOrCreate(
                ['slug' => Str::slug($categoryName)],
                [
                    'name' => $categoryName,
                    'description' => sprintf('Kategori aktivitas %s', $categoryName),
                ],
            );
        }
    }
}
