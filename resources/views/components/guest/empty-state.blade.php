{{--
Empty State — Reusable empty state display for tour listings.

Props:
  - $title: string — main message
  - $subtitle: string — supporting text
  - $showReset: bool — show reset filter button
  - $showHome: bool — show back to home button
  - $variant: 'search' | 'promo' — visual style variant
--}}
@props([
    'title' => 'Tidak ada tour ditemukan',
    'subtitle' => 'Coba ubah filter atau kata kunci pencarian',
    'showReset' => true,
    'showHome' => true,
    'variant' => 'search',
])

<div class="col-span-full py-{{ $variant === 'promo' ? '16' : '20' }} text-center {{ $variant === 'promo' ? 'bg-white rounded-[24px] border border-gray-100 shadow-sm' : '' }}">
    <div class="max-w-sm mx-auto">
        {{-- Icon --}}
        <div class="w-16 h-16 rounded-full {{ $variant === 'promo' ? 'bg-orange-50' : 'bg-gray-100' }} flex items-center justify-center mx-auto mb-5">
            @if($variant === 'promo')
                <svg class="w-8 h-8 text-orange-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            @else
                <x-guest.icons.search class="w-8 h-8 text-gray-300" />
            @endif
        </div>

        <h3 class="text-lg font-bold text-slate-700 mb-2">{{ $title }}</h3>
        <p class="text-sm text-gray-400 mb-6">{{ $subtitle }}</p>

        @if($showReset || $showHome)
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                @if($showReset)
                    <button wire:click="resetFilters"
                            class="flex items-center gap-2 px-6 py-2.5 rounded-full text-sm font-medium text-slate-600 border border-gray-200 bg-white hover:bg-gray-50 transition-colors shadow-sm">
                        <x-guest.icons.reset class="w-4 h-4" />
                        Reset Filter
                    </button>
                @endif
                @if($showHome)
                    <a href="{{ route('home') }}"
                       class="px-6 py-2.5 rounded-full text-sm font-semibold text-white bg-[#FF7A45] hover:bg-[#ff692a] transition-colors shadow-sm">
                        Kembali ke Beranda
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>
