<?php

namespace Database\Seeders;

use App\Enums\PackageStatus;
use App\Enums\PackageType;
use App\Enums\UserRole;
use App\Enums\VendorStatus;
use App\Models\TourCategory;
use App\Models\TourDepartureSlot;
use App\Models\TourPackage;
use App\Models\User;
use App\Models\VendorProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DemoMarketplaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendor = User::query()->updateOrCreate(
            ['email' => 'vendor@indonesialuxe.test'],
            [
                'name' => 'Luxe Adventure Partner',
                'role' => UserRole::Vendor,
                'phone' => '+628111111111',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ],
        );

        VendorProfile::query()->updateOrCreate(
            ['user_id' => $vendor->id],
            [
                'status' => VendorStatus::Approved,
                'business_name' => 'Luxe Adventure Partner',
                'business_description' => 'Partner demo untuk paket aktivitas.',
                'address' => 'Bali, Indonesia',
                'bank_name' => 'BCA',
                'bank_account_name' => 'Luxe Adventure Partner',
                'bank_account_number' => '1234567890',
                'approved_at' => now(),
                'rejected_reason' => null,
            ],
        );

        User::query()->updateOrCreate(
            ['email' => 'customer@indonesialuxe.test'],
            [
                'name' => 'Indonesia Luxe Customer',
                'role' => UserRole::Customer,
                'phone' => '+628222222222',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ],
        );

        $categories = TourCategory::query()->get()->keyBy('slug');

        // Ensure storage directory exists and copy seed assets
        if (! Storage::disk('public')->exists('tour-covers')) {
            Storage::disk('public')->makeDirectory('tour-covers');
        }

        foreach (['bromo.jpg', 'snorkeling.jpg'] as $image) {
            $sourcePath = resource_path("seeders/tour-covers/{$image}");
            if (file_exists($sourcePath)) {
                Storage::disk('public')->put(
                    "tour-covers/{$image}",
                    file_get_contents($sourcePath)
                );
            }
        }

        $this->seedPackage(
            $vendor->id,
            $categories['open-trip']->id,
            PackageType::OpenTrip,
            'Bromo Sunrise Open Trip',
            450000,
            'tour-covers/bromo.jpg'
        );

        $this->seedPackage(
            $vendor->id,
            $categories['snorkeling-diving']->id,
            PackageType::SnorkelingDiving,
            'Nusa Penida Snorkeling Experience',
            750000,
            'tour-covers/snorkeling.jpg',
        );
    }

    private function seedPackage(int $vendorId, int $categoryId, PackageType $packageType, string $title, int $price, string $coverImagePath): void
    {
        $tourPackage = TourPackage::query()->updateOrCreate(
            ['slug' => \Illuminate\Support\Str::slug($title)],
            [
                'vendor_id' => $vendorId,
                'tour_category_id' => $categoryId,
                'status' => PackageStatus::Published,
                'type' => $packageType,
                'title' => $title,
                'description' => sprintf('%s - Nikmati pengalaman luar biasa mengeksplorasi keindahan alam Indonesia dengan layanan premium dan guide profesional.', $title),
                'meeting_point' => 'Pusat Kota (Dekat Stasiun/Bandara)',
                'duration' => '1 Hari',
                'duration_hours' => 12,
                'max_participants' => 15,
                'price_per_person' => $price,
                'start_date' => now()->addDays(7),
                'end_date' => now()->addMonths(6),
                'cover_image_path' => $coverImagePath,
                'highlights' => [
                    'Pemandangan matahari terbit yang estetik',
                    'Spot foto instagenic di setiap sudut',
                    'Guide lokal berpengalaman',
                    'Transportasi nyaman dan bersih',
                ],
                'included' => [
                    'Tiket masuk objek wisata',
                    'Transportasi PP dari meeting point',
                    'Makan siang (Local Cuisine)',
                    'Air mineral selama perjalanan',
                ],
                'is_active' => true,
                'approved_at' => now(),
            ],
        );

        // Seed Itineraries
        $tourPackage->itineraries()->delete();
        $tourPackage->itineraries()->createMany([
            [
                'day_number' => 1,
                'title' => 'Penjemputan & Briefing',
                'description' => 'Bertemu di meeting point yang telah ditentukan, briefing perjalanan, dan mulai perjalanan.',
                'time' => '08:00',
            ],
            [
                'day_number' => 1,
                'title' => 'Eksplorasi Destinasi Utama',
                'description' => 'Mengunjungi destinasi utama, sesi foto, dan menikmati suasana alam.',
                'time' => '10:00',
            ],
            [
                'day_number' => 1,
                'title' => 'Makan Siang & Istirahat',
                'description' => 'Menikmati hidangan khas lokal di restoran terpilih.',
                'time' => '12:00',
            ],
        ]);

        // Seed Pickup Points
        $tourPackage->pickupPoints()->delete();
        $tourPackage->pickupPoints()->createMany([
            [
                'location_name' => 'Bandara Internasional Terdekat',
                'order' => 1,
            ],
            [
                'location_name' => 'Stasiun Kereta Api Utama',
                'order' => 2,
            ],
            [
                'location_name' => 'Lobby Hotel (Area Pusat Kota)',
                'order' => 3,
            ],
        ]);

        TourDepartureSlot::query()->updateOrCreate(
            [
                'tour_package_id' => $tourPackage->id,
                'departure_date' => now()->addDays(7)->toDateString(),
                'start_time' => '08:00:00',
            ],
            [
                'end_time' => '20:00:00',
                'quota' => 15,
                'booked_count' => 0,
                'price_per_person' => $price,
            ],
        );

        TourDepartureSlot::query()->updateOrCreate(
            [
                'tour_package_id' => $tourPackage->id,
                'departure_date' => now()->addDays(14)->toDateString(),
                'start_time' => '08:00:00',
            ],
            [
                'end_time' => '20:00:00',
                'quota' => 15,
                'booked_count' => 0,
                'price_per_person' => $price,
            ],
        );
    }
}
