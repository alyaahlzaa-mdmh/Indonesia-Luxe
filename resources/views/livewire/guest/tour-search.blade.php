<div>
    <!-- Hero Banner with Curve -->
    <div class="relative w-full mb-12 bg-gray-50">
        <div class="absolute inset-0 w-full h-[400px] overflow-hidden" style="z-index: 0;">
            <img src="{{ asset('images/hero1.jpg') }}" alt="Hero Background" class="absolute inset-0 w-full h-full object-cover object-center" />
            <div class="absolute inset-0 bg-[#d95c2b]/80 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-gradient-to-br from-[#c6491a]/90 to-[#e97a3a]/80"></div>
        </div>
        
        <!-- SVG Wave Divider -->
        <div class="absolute bottom-[-1px] left-0 w-full overflow-hidden leading-none z-10 pointer-events-none">
            <svg class="relative block w-full h-[40px] md:h-[70px] text-gray-50" preserveAspectRatio="none" viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,120 C400,10 800,10 1200,90 L1200,120 L0,120 Z" fill="currentColor"></path>
            </svg>
        </div>

        <div class="relative z-20 w-full max-w-6xl mx-auto px-4 pt-10 pb-[90px]">
            <!-- Breadcrumb & Header -->
            <div class="mb-8 mt-4">
                <a href="{{ route('home') }}" class="text-[13px] font-medium text-white/90 hover:text-white flex items-center gap-1.5 transition-colors w-max">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    {{ __('tour_search.back_to_home') }}
                </a>
                <h1 class="text-3xl md:text-5xl font-serif font-medium mt-6 text-white tracking-tight">{{ __('tour_search.title') }}</h1>
                <p class="text-white/90 mt-2 text-sm md:text-base font-light">{{ __('tour_search.subtitle') }}</p>
            </div>

            <!-- Search Input with Debounce -->
            <div class="relative max-w-[700px] mb-6">
                <div class="flex items-center rounded-full overflow-hidden shadow-lg border border-white/20 bg-black/20 backdrop-blur-sm focus-within:ring-2 focus-within:ring-white/50 transition-all">
                    <div class="pl-6 pr-2 flex items-center pointer-events-none text-white/80">
                        <x-guest.icons.search class="h-4 w-4" />
                    </div>
                    <input 
                        id="tour-search-input"
                        wire:model.live.debounce.500ms="q" 
                        type="text" 
                        placeholder="Labuan Bajo..." 
                        class="w-full py-3.5 md:py-4 bg-transparent text-white placeholder-white/80 focus:outline-none focus:ring-0 border-none text-[14px] md:text-[15px] font-medium" 
                    />
                    <button class="bg-[#FF7A45] hover:bg-[#ff692a] text-white font-medium px-8 md:px-10 py-3.5 md:py-4 h-full transition-colors flex items-center gap-2 whitespace-nowrap text-[14px] md:text-[15px]">
                        <x-guest.icons.search class="h-4 w-4" />
                        {{ __('tour_search.search_button') }}
                    </button>
                </div>
            </div>

            <!-- Metadata underneath Search -->
            <div class="flex flex-wrap items-center gap-4 md:gap-8 text-[12px] md:text-[13px] text-white/90 font-medium ml-2 md:ml-4">
                <div class="flex items-center gap-2">
                    <svg class="w-3.5 h-3.5 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ $totalResults }} {{ __('tour_search.tours_found') }}
                </div>
                <div class="flex items-center gap-2">
                    <x-guest.icons.location class="w-3.5 h-3.5 opacity-80" />
                    {{ __('tour_search.destinations_available') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Results Section -->
    <div class="w-full max-w-6xl mx-auto px-4 pb-16">
        
        @php
            $filterCount = $this->getActiveFilterCount();
        @endphp
        <div class="mb-8" x-data="{ open: @entangle('showFilterPanel') }">
            <div class="flex items-center justify-between gap-2 pb-3 pt-1">
                <!-- Filter Toggle Button -->
                <button 
                    wire:click="toggleFilterPanel"
                    class="relative px-5 py-2.5 rounded-xl text-[14px] font-bold transition-all border flex items-center gap-2.5 flex-shrink-0 shadow-sm"
                    :class="(open || {{ $filterCount }} > 0) ? 'bg-[#FF7A45] text-white border-[#FF7A45]' : 'bg-white text-slate-700 border-gray-200 hover:bg-gray-50'"
                >
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                    <span>{{ __('tour_search.filter') }}</span>

                    @if($filterCount > 0)
                    <span class="absolute -top-1.5 -right-1.5 bg-[#EF4444] text-white text-[10px] font-bold rounded-full min-w-[20px] h-5 px-1 flex items-center justify-center border-2 border-white shadow-sm transition-transform scale-110">
                        {{ $filterCount }}
                    </span>
                    @endif
                </button>

                <!-- Sorting Dropdown & Count -->
                <div class="flex items-center gap-3">
                    <span class="hidden md:block text-xs font-medium text-gray-500">{{ $totalResults }} {{ __('tour_search.tours_found') }}</span>
                    <select wire:model.live="sortBy" class="pl-3 pr-8 py-2.5 rounded-xl border border-gray-200 text-xs font-medium text-slate-700 bg-white focus:outline-none focus:ring-2 focus:ring-[#FF7A45] cursor-pointer shadow-sm min-w-[120px]">
                        @foreach($sortOptions as $sortValue => $sortLabel)
                            <option value="{{ $sortValue }}">{{ __('tour_search.' . $sortValue) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Filter Panel (Collapsible) -->
            <div 
                x-show="open"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-2"
                x-cloak
                class="mt-4 bg-white rounded-2xl border border-gray-100 shadow-lg overflow-hidden"
            >
                <div class="p-5 md:p-6">
                    <!-- Panel Header -->
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-2 text-slate-800">
                            <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                            <span class="text-sm font-semibold">{{ __('tour_search.filter') }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <button wire:click="resetFilters" class="flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-[#FF7A45] hover:bg-orange-50 rounded-full transition-colors border border-transparent hover:border-orange-100">
                                <x-guest.icons.reset class="w-3.5 h-3.5" />
                                {{ __('tour_search.reset') }}
                            </button>
                            <button wire:click="closeFilterPanel" class="text-gray-400 hover:text-gray-600 transition-colors p-1">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- KATEGORI -->
                    <div class="mb-6">
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-3">{{ __('tour_search.category') }}</label>
                        <div class="flex flex-wrap gap-2">
                            <button wire:click="$set('category', '')" class="px-4 py-2 rounded-full text-xs font-medium transition-colors border {{ $category === '' ? 'bg-[#FF7A45] text-white border-[#FF7A45]' : 'bg-white text-slate-600 border-gray-200 hover:bg-gray-50' }}">
                                {{ __('tour_search.all') }}
                            </button>
                            @foreach($categories as $cat)
                                <button wire:click="$set('category', '{{ $cat->slug }}')" class="px-4 py-2 rounded-full text-xs font-medium transition-colors border {{ $category === $cat->slug ? 'bg-[#FF7A45] text-white border-[#FF7A45]' : 'bg-white text-slate-600 border-gray-200 hover:bg-gray-50' }}">
                                    {{ $cat->name }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- HARGA MAKS -->
                    <div class="mb-6" 
                        x-data="{ price: {{ $maxPrice }}, upperBound: {{ $maxPriceUpperBound }} }"
                    >
                        <div class="flex items-center justify-between mb-3">
                            <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">{{ __('tour_search.max_price') }}</label>
                            <span class="text-sm font-semibold text-[#FF7A45]" x-text="'Rp ' + Number(price).toLocaleString('id-ID')"></span>
                        </div>
                        <div class="relative">
                            <input 
                                type="range" 
                                wire:model.live.debounce.500ms="maxPrice"
                                x-on:input="price = Number($event.target.value)"
                                min="0" 
                                x-bind:max="upperBound" 
                                step="1000"
                                x-bind:value="price"
                                class="w-full h-2 rounded-full appearance-none cursor-pointer"
                                x-bind:style="`background: linear-gradient(to right, #FF7A45 0%, #FF7A45 ${upperBound > 0 ? (price / upperBound) * 100 : 100}%, #e5e7eb ${upperBound > 0 ? (price / upperBound) * 100 : 100}%, #e5e7eb 100%);`"
                            />
                            <div class="flex justify-between text-[10px] text-gray-400 mt-1.5">
                                <span>Rp 0</span>
                                <span x-text="'Rp ' + Number(upperBound).toLocaleString('id-ID')"></span>
                            </div>
                        </div>
                    </div>

                    <!-- RATING MINIMUM -->
                    <div class="mb-6">
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-3">{{ __('tour_search.min_rating') }}</label>
                        <div class="flex flex-wrap gap-2">
                            <button wire:click="$set('minRating', '')" class="px-4 py-2 rounded-full text-xs font-medium transition-colors border {{ $minRating === '' ? 'bg-[#FF7A45] text-white border-[#FF7A45]' : 'bg-white text-slate-600 border-gray-200 hover:bg-gray-50' }}">
                                {{ __('tour_search.all') }}
                            </button>
                            @foreach($ratingOptions as $ratingValue => $ratingLabel)
                                <button wire:click="$set('minRating', '{{ $ratingValue }}')" class="px-4 py-2 rounded-full text-xs font-medium transition-colors border flex items-center gap-1 {{ $minRating === (string) $ratingValue ? 'bg-[#FF7A45] text-white border-[#FF7A45]' : 'bg-white text-slate-600 border-gray-200 hover:bg-gray-50' }}">
                                    <x-guest.icons.star class="w-3 h-3 {{ $minRating === (string) $ratingValue ? 'text-white' : 'text-amber-400' }}" />
                                    {{ $ratingLabel }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- URUTKAN -->
                    <div class="mb-2">
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-3">{{ __('tour_search.sort_by') }}</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                            @foreach($sortOptions as $sortValue => $sortLabel)
                                <button 
                                    wire:click="$set('sortBy', '{{ $sortValue }}')"
                                    class="px-4 py-2.5 rounded-xl text-xs font-medium transition-all border text-left {{ $sortBy === $sortValue ? 'bg-[#FF7A45] text-white border-[#FF7A45] shadow-sm' : 'bg-white text-slate-600 border-gray-200 hover:bg-gray-50' }}"
                                >
                                    {{ __('tour_search.' . $sortValue) }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Panel Footer -->
                <div class="flex items-center justify-between px-5 md:px-6 py-4 bg-gray-50/80 border-t border-gray-100">
                    <span class="text-xs font-medium text-[#FF7A45]">{{ $totalResults }} <span class="text-gray-500">{{ __('tour_search.tours_found') }}</span></span>
                    <div class="flex items-center gap-3">
                        <button wire:click="resetFilters" class="px-4 py-2 text-xs font-medium text-gray-500 hover:text-gray-700 transition-colors">
                            {{ __('tour_search.reset') }}
                        </button>
                        <button wire:click="applyFilters" class="px-6 py-2 rounded-full text-xs font-semibold bg-[#FF7A45] hover:bg-[#ff692a] text-white transition-colors shadow-sm">
                            {{ __('tour_search.see_results') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Results Grid -->
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @forelse ($tourPackages as $tourPackage)
                <x-guest.tour-card :tourPackage="$tourPackage" :typeLabels="$typeLabels" variant="search" />
            @empty
                <x-guest.empty-state 
                    title="{{ __('tour_search.no_tours_found') }}" 
                    subtitle="{{ __('tour_search.try_change_filter') }}" 
                    variant="search" 
                />
            @endforelse
        </div>

        <div class="mt-12 mb-4">
            {{ $tourPackages->links() }}
        </div>
    </div>
</div>

<script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
<script>
    function initTourSearchTyped() {
        if (typeof Typed === 'undefined' || !document.getElementById('tour-search-input')) {
            setTimeout(initTourSearchTyped, 100);
            return;
        }
        
        let inputEl = document.getElementById('tour-search-input');
        if (inputEl.value.trim() !== '') return;
        
        if(window.tourSearchTypedInstance) window.tourSearchTypedInstance.destroy();
        
        window.tourSearchTypedInstance = new Typed('#tour-search-input', {
            strings: ['Labuan Bajo', 'Bali Cultural Experience', 'Gunung Bromo Sunrise', 'Raja Ampat', 'Nusa Penida'],
            typeSpeed: 60,
            backSpeed: 30,
            backDelay: 1500,
            loop: true,
            attr: 'placeholder',
            bindInputFocusEvents: true
        });
    }

    document.addEventListener('livewire:navigated', initTourSearchTyped);
    document.addEventListener('DOMContentLoaded', initTourSearchTyped);
    if(document.readyState === 'complete' || document.readyState === 'interactive') {
        initTourSearchTyped();
    }
</script>
