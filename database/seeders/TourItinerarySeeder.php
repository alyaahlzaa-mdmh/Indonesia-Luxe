<?php

namespace Database\Seeders;

use App\Models\TourPackage;
use Illuminate\Database\Seeder;

class TourItinerarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = TourPackage::all();

        foreach ($packages as $package) {
            // Check if existing
            if ($package->itineraries()->count() > 0) {
                continue;
            }

            // Generic 1 day itinerary
            $itineraries = [
                ['day_number' => 1, 'time' => '08:00', 'title' => 'Berkumpul di Meeting Point', 'description' => 'Persiapan dan briefing.'],
                ['day_number' => 1, 'time' => '09:00', 'title' => 'Perjalanan Menuju Destinasi Utama', 'description' => 'Berangkat menggunakan transportasi darat/laut.'],
                ['day_number' => 1, 'time' => '11:00', 'title' => 'Eksplorasi Tempat Wisata', 'description' => 'Menikmati keindahan alam dan aktivitas seru.'],
                ['day_number' => 1, 'time' => '13:00', 'title' => 'Makan Siang', 'description' => 'Istirahat dan santap siang.'],
                ['day_number' => 1, 'time' => '15:00', 'title' => 'Acara Bebas', 'description' => 'Sesi bebas untuk berfoto.'],
                ['day_number' => 1, 'time' => '17:00', 'title' => 'Perjalanan Pulang', 'description' => 'Kembali menuju meeting point awal.'],
            ];

            if ($package->duration_hours > 24) {
                // Adjust for multi-day
                $itineraries = [
                    ['day_number' => 1, 'time' => '08:00', 'title' => 'Berkumpul di Meeting Point', 'description' => 'Briefing perjalanan.'],
                    ['day_number' => 1, 'time' => '11:00', 'title' => 'Destinasi Hari Pertama', 'description' => 'Eksplorasi destinasi pertama.'],
                    ['day_number' => 1, 'time' => '16:00', 'title' => 'Check-in Penginapan', 'description' => 'Istirahat dan makan malam.'],
                    ['day_number' => 2, 'time' => '07:00', 'title' => 'Sarapan', 'description' => 'Persiapan hari kedua.'],
                    ['day_number' => 2, 'time' => '09:00', 'title' => 'Destinasi Puncak', 'description' => 'Eksplorasi destinasi unggulan.'],
                    ['day_number' => 2, 'time' => '14:00', 'title' => 'Perjalanan Pulang', 'description' => 'Kembali ke meeting point.'],
                ];
            }

            foreach ($itineraries as $item) {
                $package->itineraries()->create($item);
            }
        }
    }
}
