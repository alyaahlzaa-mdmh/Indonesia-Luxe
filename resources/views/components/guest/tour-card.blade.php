{{--
Tour Card Component — Reusable tour package card used across home, search, and promo pages.

Props:
  - $tourPackage: TourPackage model instance (with reviews_avg_rating, reviews_count loaded)
  - $variant: 'default' | 'search' | 'promo' — controls card visual variant
  - $typeLabels: array of type => label mappings
--}}
@props([
    'tourPackage',
    'variant' => 'default',
    'typeLabels' => [],
])

@php
    $rating = number_format((float) ($tourPackage->reviews_avg_rating ?? 0), 1);
    $typeLabel = $typeLabels[$tourPackage->type->value] ?? $tourPackage->type->value;
    $price = 'Rp ' . number_format($tourPackage->price_per_person, 0, ',', '.');
    $location = $tourPackage->meeting_point ?? 'Indonesia';

    $isPromo = $variant === 'promo';
    $isSearch = $variant === 'search';
    $isDefault = $variant === 'default';

    $cardBg = $isPromo ? 'bg-[#FDFBF7]' : 'bg-white';
    $imgHeight = match($variant) {
        'default' => 'h-36 sm:h-44 md:h-52',
        'search' => 'h-52',
        'promo' => 'h-[180px]',
    };
@endphp

@php
    $isFavorited = auth()->check() ? $tourPackage->isFavoritedBy(auth()->user()) : false;
@endphp

<a href="{{ route('tours.show', $tourPackage) }}"
   class="{{ $cardBg }} rounded-[16px] {{ $isSearch ? 'shadow-sm' : 'shadow-[0_2px_8px_rgba(0,0,0,0.04)]' }} border border-gray-100 overflow-hidden hover:shadow-lg transition-all hover:-translate-y-1 flex flex-col group cursor-pointer no-underline h-full"
   wire:key="tour-card-{{ $tourPackage->id }}"
>
    {{-- Card Image --}}
    <div class="relative {{ $imgHeight }} bg-gray-200 overflow-hidden">
        <img src="{{ $tourPackage->coverImageUrl() }}"
             alt="{{ $tourPackage->title }}"
             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out"
             loading="lazy" />

        {{-- Badge --}}
        @if($isPromo)
            <div class="absolute top-3 left-3 bg-[#b48c47] px-3 py-1.5 rounded-full text-[10px] font-bold text-white shadow-sm z-10 tracking-wide">
                -15%
            </div>
        @else
            <div class="absolute top-2 left-2 sm:top-3 sm:left-3 bg-[#ff9e52]/90 backdrop-blur-sm px-2.5 py-1 rounded-full text-[10px] sm:text-[11px] font-medium text-white shadow-sm flex items-center gap-1 z-10 tracking-wide">
                {{ $typeLabel }}
            </div>
        @endif

        {{-- Favorite Button --}}
        <button wire:click.prevent="toggleWishlist({{ $tourPackage->id }})"
                class="absolute top-2 right-2 sm:top-3 sm:right-3 bg-white/80 backdrop-blur-md p-1.5 sm:p-2 rounded-full {{ $isFavorited ? 'text-[#FF7A45]' : 'text-slate-500' }} hover:text-[#FF7A45] shadow-sm transition z-20 flex items-center justify-center">
            <x-guest.icons.heart class="w-4 h-4" :fill="$isFavorited ? 'currentColor' : 'none'" />
        </button>
    </div>

    {{-- Card Content --}}
    <div class="p-3 sm:p-4 flex flex-col flex-1 {{ $isPromo ? 'bg-white' : '' }}">
        @if($isPromo)
            {{-- Promo variant: type · location subtitle --}}
            <p class="text-[11px] text-gray-400 mb-1 truncate">
                {{ $typeLabel }} · {{ $location }}
            </p>
        @endif

        @if(!$isPromo)
            {{-- Rating (shown first for default/search) --}}
            <div class="flex items-center gap-1 text-[#ff9e52] mb-1.5">
                <x-guest.icons.star class="w-3.5 h-3.5 sm:w-4 sm:h-4" />
                <span class="text-[12px] sm:text-[13px] font-medium">{{ $rating }}</span>
                <span class="text-[11px] sm:text-[12px] text-slate-400">({{ $tourPackage->reviews_count }})</span>
            </div>
        @endif

        {{-- Title --}}
        <h3 class="font-serif font-medium text-[13px] sm:text-[15px] text-slate-800 leading-snug mb-1 line-clamp-2">
            {{ $tourPackage->title }}
        </h3>

        @if($isPromo)
            {{-- Rating (shown after title for promo) --}}
            <div class="flex items-center gap-1 text-[#ff9e52] mb-3">
                <x-guest.icons.star class="w-3.5 h-3.5" />
                <span class="text-xs font-bold text-slate-700">{{ $rating }}</span>
                <span class="text-xs text-gray-400">({{ $tourPackage->reviews_count }})</span>
            </div>
        @endif

        @if(!$isPromo)
            {{-- Location --}}
            <p class="text-[10px] sm:text-[11px] text-slate-500 flex items-center gap-1">
                <x-guest.icons.location class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-slate-400 shrink-0" />
                <span class="truncate">{{ $location }}</span>
            </p>
        @endif

        @if($isSearch)
            {{-- Description (search only) --}}
            <p class="text-xs text-gray-500 leading-relaxed line-clamp-2 mt-1.5">
                {{ Str::limit(strip_tags($tourPackage->description), 100) }}
            </p>
        @endif

        {{-- Price --}}
        <div class="mt-auto pt-2 {{ $isSearch ? 'pt-4 flex justify-between items-center border-t border-gray-100' : '' }}">
            @if($isPromo)
                <p class="text-[14px] font-semibold text-[#b48c47]">{{ __('tour_card.starts_from') }} {{ $price }}</p>
            @elseif($isSearch)
                <p class="text-base font-bold text-[#b48c47]">{{ $price }}<span class="text-[10px] text-gray-400 font-normal">/{{ __('tour_card.person') }}</span></p>
                @if($tourPackage->duration_hours)
                    <div class="bg-gray-50 border border-gray-100 px-3 py-1.5 rounded-lg text-xs font-medium text-gray-600 shadow-sm">
                        {{ ceil($tourPackage->duration_hours / 24) }} {{ __('tour_card.days') }}
                    </div>
                @endif
            @else
                <p class="text-[12px] sm:text-[14px] font-medium text-[#b48c47]">{{ $price }} <span class="text-[9px] sm:text-[10px] text-slate-400 font-normal">/{{ __('tour_card.person') }}</span></p>
            @endif
        </div>
    </div>
</a>
