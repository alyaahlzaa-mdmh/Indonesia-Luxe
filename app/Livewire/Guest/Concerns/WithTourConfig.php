<?php

namespace App\Livewire\Guest\Concerns;

use App\Enums\PackageType;

/**
 * Shared configuration constants for guest tour pages.
 */
trait WithTourConfig
{
    /**
     * Get type labels from PackageType enum (single source of truth).
     */
    public static function getTypeLabels(): array
    {
        return collect(PackageType::cases())
            ->mapWithKeys(fn(PackageType $type) => [$type->value => $type->label()])
            ->all();
    }

    /**
     * Sort options for tour listing.
     */
    public const SORT_OPTIONS = [
        'terbaru' => 'Terbaru',
        'harga_terendah' => 'Harga Terendah',
        'harga_tertinggi' => 'Harga Tertinggi',
        'rating_tertinggi' => 'Rating Tertinggi',
        'paling_populer' => 'Paling Populer',
    ];

    /**
     * Rating filter options.
     */
    public const RATING_OPTIONS = [
        '3' => '3+',
        '3.5' => '3.5+',
        '4' => '4+',
        '4.5' => '4.5+',
    ];

    /**
     * Activity metadata (icons & images) for each package type.
     */
    public const ACTIVITY_META = [
        'open_trip' => [
            'img' => 'more.jpg',
            'icon' => '<svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>',
        ],
        'private_tour' => [
            'img' => 'private.jpg',
            'icon' => '<svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>',
        ],
        'hiking_camping' => [
            'img' => 'hiking.jpg',
            'icon' => '<svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 21l9-15 9 15 M12 6v15 M8 21l4-7 4 7" /></svg>',
        ],
        'rafting' => [
            'img' => 'rafting.jpg',
            'icon' => '<svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M3 15c2.5 0 2.5 3 5 3s2.5-3 5-3 2.5 3 5 3 2.5-3 5-3 M3 9c2.5 0 2.5 3 5 3s2.5-3 5-3 2.5 3 5 3 2.5-3 5-3" /></svg>',
        ],
        'snorkeling_diving' => [
            'img' => 'snorkeling.jpg',
            'icon' => '<svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 15l2 4h12l2-4M12 3v12M8 7h8" /></svg>',
        ],
        'jeep_adventure' => [
            'img' => 'jeep.jpg',
            'icon' => '<svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 21v-2a4 4 0 014-4h0a4 4 0 014 4v2m-8 0h8M5 10h14a2 2 0 012 2v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4a2 2 0 012-2zm2-5h10l1.5 5H4.5L7 5z" /></svg>',
        ],
        'local_experience' => [
            'img' => 'local.jpg',
            'icon' => '<svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" /></svg>',
        ],
    ];
}
