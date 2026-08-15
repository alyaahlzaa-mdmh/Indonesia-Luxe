<div>
    <!-- Hero Section -->
    <section
        x-data="{ activeImg: 0 }"
        x-init="setInterval(() => activeImg = (activeImg + 1) % 4, 1500)"
        class="w-full relative h-[calc(100vh-73px)] min-h-[500px] flex flex-col justify-center items-center overflow-hidden mb-12">
        <!-- Background Images -->
        @for($i = 0; $i < 4; $i++)
            <div class="absolute inset-0 w-full h-full transition-opacity duration-1500 ease-in-out" :class="activeImg === {{ $i }} ? 'opacity-100 z-0' : 'opacity-0 -z-10'">
            <img src="{{ asset('images/hero' . ($i + 1) . '.jpg') }}" class="absolute inset-0 w-full h-full object-cover" />
            <div class="absolute inset-0 bg-black/50"></div>
</div>
@endfor

<div class="relative z-10 text-center px-4 w-full flex flex-col items-center -mt-10">
    <h1 class="text-3xl md:text-5xl lg:text-[56px] font-serif text-white mb-4 tracking-wide leading-tight drop-shadow-lg">
        {{ __('home.hero_title_prefix') }} <span class="text-[#F59E0B] font-bold">{{ __('home.hero_title_highlight') }}</span>
    </h1>
    <p class="text-[15px] md:text-lg lg:text-[18px] mb-10 text-gray-200 max-w-2xl mx-auto leading-relaxed font-medium tracking-wide drop-shadow-md">
        {{ __('home.hero_subtitle_line1') }}<br class="hidden md:block">
        {{ __('home.hero_subtitle_line2') }}
    </p>

    <div class="bg-[#515049]/80 border border-white/20 p-1.5 rounded-full w-full max-w-[700px] mx-auto flex items-center shadow-2xl hover:bg-[#515049]/90 transition-colors duration-300">
        <div class="flex-1 flex items-center pl-4 sm:pl-6 pr-2 min-w-0">
            <input
                id="typed-search"
                type="text"
                class="bg-transparent border-none focus:ring-0 text-white placeholder-gray-300 w-full min-w-0 outline-none font-medium text-[13px] md:text-base py-2 shadow-none"
                onkeydown="if(event.key === 'Enter') document.getElementById('search-btn').click()" />
        </div>
        <button id="search-btn" onclick="
                    let el = document.getElementById('typed-search');
                    let target = el.value;
                    if (!target && el.getAttribute('placeholder')) {
                        target = el.getAttribute('placeholder').replace(/{{ app()->getLocale() === 'en' ? 'Search ' : 'Cari ' }}|[&quot;']/g, '').trim();
                    }
                    window.location.href='{{ route('tours.index') }}?q=' + encodeURIComponent(target);
                " class="bg-[#F59E0B] hover:bg-[#D97706] text-white px-5 sm:px-8 md:px-12 py-2.5 md:py-3 rounded-full font-bold transition-colors cursor-pointer flex items-center justify-center gap-1.5 md:gap-2 flex-shrink-0 text-[13px] md:text-base shadow-md">
            <x-guest.icons.search class="w-5 h-5" />
            {{ __('home.hero_search_button') }}
        </button>
    </div>
</div>
</section>

<!-- Rest of content wrapped in standard container -->
<div class="max-w-6xl mx-auto px-4 w-full">
    <!-- Activity Categories -->
    <section class="mb-20 text-center">
        <h2 class="text-3xl md:text-4xl font-serif text-[#1e293b] mb-2 font-medium">{{ __('home.categories_title') }}</h2>
        <p class="text-slate-500 text-sm md:text-base mb-10">{{ __('home.categories_subtitle', ['count' => count($categories)]) }}</p>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:flex md:flex-wrap md:justify-center gap-4 md:gap-5 pb-6">
            @foreach($activityMeta as $typeValue => $meta)
            @php $count = $typeCounts[$typeValue] ?? 0; @endphp
            <a href="{{ route('tours.index') }}?type={{ $typeValue }}" class="flex flex-col items-center group w-full md:w-[136px]">
                <div class="w-full aspect-square md:w-[136px] md:h-[136px] rounded-[18px] overflow-hidden relative mb-3 cursor-pointer shadow-sm group-hover:shadow-lg transition-all duration-300 group-hover:-translate-y-1">
                    <img src="{{ asset('images/' . $meta['img']) }}" alt="{{ $typeLabels[$typeValue] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors duration-300"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        {!! $meta['icon'] !!}
                    </div>
                </div>
                <h3 class="font-serif font-medium text-slate-800 text-[14px] sm:text-[15px] mb-1 leading-tight group-hover:text-amber-600 transition-colors text-center">{!! str_replace(' / ', ' /<br>', $typeLabels[$typeValue]) !!}</h3>
                <p class="text-slate-400 text-[11px] leading-tight text-center px-1">{{ __('home.categories_packages_available', ['count' => $count]) }}</p>
            </a>
            @endforeach
        </div>
    </section>

    <!-- Popular Tours -->
    <section class="mb-16">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h2 class="text-3xl md:text-4xl font-serif text-[#1e293b] mb-1 font-medium">{{ __('home.tours_title') }}</h2>
                <p class="text-slate-500 text-sm md:text-base">{{ __('home.tours_subtitle') }}</p>
            </div>
            <a href="{{ route('tours.index') }}" class="hidden md:flex items-center gap-2 text-amber-600 hover:text-amber-700 transition" data-discover="true">
                {{ __('home.tours_view_all') }}
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right w-4 h-4">
                    <path d="M5 12h14"></path>
                    <path d="m12 5 7 7-7 7"></path>
                </svg></a>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 md:gap-6">
            @forelse ($featuredPackages as $tourPackage)
            <x-guest.tour-card :tourPackage="$tourPackage" :typeLabels="$typeLabels" variant="default" />
            @empty
            <p class="text-sm text-gray-500 col-span-2 lg:col-span-4 text-center py-8">{{ __('home.tours_empty') }}</p>
            @endforelse
        </div>
        <div class="text-center mt-8 md:hidden">
            <a href="{{ route('tours.index') }}" class="inline-flex items-center gap-2 bg-amber-500 text-white px-6 py-3 rounded-full hover:bg-amber-600 transition" data-discover="true">
                {{ __('home.tours_view_all') }}
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-4 h-4">
                    <path d="m9 18 6-6-6-6"></path>
                </svg>
            </a>
        </div>
    </section>

    <!-- Promos -->
    <section class="mb-20">
        <h2 class="text-3xl md:text-3xl font-serif text-[#1e293b] mb-2 font-medium">{{ __('home.promos_title') }}</h2>
        <p class="text-slate-500 text-sm md:text-base mb-8">{{ __('home.promos_subtitle') }}</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 pb-6">
            @php
            $promos = [
            ['img' => 'hero2.jpg', 'gradient' => 'from-rose-500/90 to-orange-500/90', 'bottomGradient' => 'from-orange-600/60', 'title' => __('home.promo_new_user_title'), 'desc' => __('home.promo_new_user_desc'), 'discount' => __('home.promo_new_user_discount'), 'slug' => 'pengguna-baru', 'iconPath' => 'M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.66-1.546z'],
            ['img' => 'hero4.jpg', 'gradient' => 'from-cyan-500/90 to-emerald-500/90', 'bottomGradient' => 'from-emerald-700/60', 'title' => __('home.promo_weekend_title'), 'desc' => __('home.promo_weekend_desc'), 'discount' => __('home.promo_weekend_discount'), 'slug' => 'weekend-getaway', 'iconPath' => 'M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5'],
            ['img' => 'hero3.jpg', 'gradient' => 'from-fuchsia-500/90 to-indigo-600/90', 'bottomGradient' => 'from-indigo-700/60', 'title' => __('home.promo_group_title'), 'desc' => __('home.promo_group_desc'), 'discount' => __('home.promo_group_discount'), 'slug' => 'group-deals', 'iconPath' => 'M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z'],
            ];
            @endphp

            @foreach($promos as $promo)
            <div class="relative rounded-[20px] overflow-hidden h-[220px] md:h-[260px] w-full group shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <img src="{{ asset('images/' . $promo['img']) }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                <div class="absolute inset-0 bg-linear-to-br {{ $promo['gradient'] }} mix-blend-multiply"></div>
                <div class="absolute inset-0 bg-linear-to-t {{ $promo['bottomGradient'] }} to-transparent"></div>

                <div class="absolute inset-0 p-6 flex flex-col justify-between z-10">
                    <div class="flex justify-between items-start">
                        <span class="bg-white/20 backdrop-blur-md px-3 py-1.5 rounded-full text-xs font-medium text-white flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="19" y1="5" x2="5" y2="19"></line>
                                <circle cx="6.5" cy="6.5" r="2.5"></circle>
                                <circle cx="17.5" cy="17.5" r="2.5"></circle>
                            </svg>
                            {{ $promo['discount'] }}
                        </span>
                        <div class="w-8 h-8 rounded-full border border-white/40 flex items-center justify-center text-white backdrop-blur-sm">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $promo['iconPath'] }}"></path>
                            </svg>
                        </div>
                    </div>

                    <div>
                        <h3 class="font-serif text-2xl font-bold text-white mb-1 drop-shadow-sm">{{ $promo['title'] }}</h3>
                        <p class="text-white/90 text-sm mb-4">{{ $promo['desc'] }}</p>
                        <a href="{{ route('promo.show', $promo['slug']) }}" class="bg-white/20 hover:bg-white/30 backdrop-blur-md border border-white/30 text-white font-medium px-4 py-2 rounded-full text-[13px] transition-colors flex items-center gap-2 inline-flex">
                            {{ __('home.promo_claim') }} <span>&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Destinasi Populer -->
    <section class="mb-20 relative max-w-[1400px] mx-auto">
        <div class="flex justify-between items-end mb-6">
            <h2 class="text-3xl md:text-3xl font-serif text-[#1e293b] font-medium">{{ __('home.destinations_title') }}</h2>
            <div class="hidden md:flex gap-3">
                <button onclick="document.getElementById('destinasi-scroll').scrollBy({left: -300, behavior: 'smooth'})" class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-50 transition-colors">
                    <x-guest.icons.chevron-left class="w-5 h-5 text-gray-500" />
                </button>
                <button onclick="document.getElementById('destinasi-scroll').scrollBy({left: 300, behavior: 'smooth'})" class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-50 transition-colors">
                    <svg class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>

        <div id="destinasi-scroll" class="flex overflow-x-auto gap-4 md:gap-5 pb-4 -mx-4 px-4 md:mx-0 md:px-0 snap-x snap-mandatory hide-scrollbar">
            @php
            $destinations = [
            ['name' => 'Jakarta', 'count' => '85', 'img' => 'jakarta.jpg'],
            ['name' => 'Bali', 'count' => '210', 'img' => 'bali.jpg'],
            ['name' => 'Yogyakarta', 'count' => '120', 'img' => 'yogyakarta.jpg'],
            ['name' => 'Lombok', 'count' => '75', 'img' => 'lombok.jpg'],
            ['name' => 'Raja Ampat', 'count' => '45', 'img' => 'raja-ampat.jpg'],
            ['name' => 'Labuan Bajo', 'count' => '65', 'img' => 'labuan-bajo.jpg'],
            ['name' => 'Malang', 'count' => '55', 'img' => 'malang.jpg'],
            ['name' => 'Bandung', 'count' => '90', 'img' => 'bandung.jpg'],
            ];
            @endphp
            @foreach($destinations as $dest)
            <a href="{{ route('tours.index') }}?location={{ urlencode($dest['name']) }}" class="relative w-[140px] md:w-[170px] h-[200px] md:h-[240px] rounded-[16px] overflow-hidden flex-shrink-0 snap-start group transition-shadow duration-300">
                <img src="{{ asset('images/destinasi/' . $dest['img']) }}" alt="{{ $dest['name'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                <div class="absolute inset-0 bg-linear-to-t from-black/80 via-black/20 to-transparent opacity-80 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="absolute bottom-4 left-4 right-4 z-10 text-white transform transition-transform duration-300 group-hover:-translate-y-1">
                    <h3 class="font-serif text-lg md:text-xl font-medium leading-tight mb-0.5 drop-shadow-md tracking-wide">{{ $dest['name'] }}</h3>
                    <p class="text-[11px] md:text-sm text-gray-300 font-light">{{ __('home.destinations_activities', ['count' => $dest['count']]) }}</p>
                </div>
            </a>
            @endforeach
        </div>

        <div class="text-center mt-6">
            <a href="{{ route('tours.index') }}" class="inline-block border border-gray-200 text-slate-600 rounded-full px-8 py-2 text-sm hover:border-slate-800 hover:text-slate-800 transition-colors bg-white hover:bg-slate-50">
                {{ __('home.destinations_view_all') }}
            </a>
        </div>
    </section>

    <!-- Form / App Promo -->
    <section class="mb-20 rounded-[24px] md:rounded-[28px] overflow-hidden shadow-lg flex flex-col md:flex-row bg-linear-to-tr from-[#FF7A45] to-[#FF3B6B]">
        <div class="md:w-1/2 p-7 sm:p-10 md:p-14 lg:p-16 flex flex-col justify-center">
            <div class="inline-flex w-fit items-center gap-1.5 bg-white/20 backdrop-blur-sm text-white text-[12px] md:text-[13px] tracking-wide font-medium px-3.5 py-1.5 rounded-full mb-5 md:mb-6">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                </svg>
                {{ __('home.app_badge') }}
            </div>

            <h2 class="text-2xl md:text-3xl lg:text-4xl font-serif text-white mb-3 md:mb-4 font-medium leading-[1.3] drop-shadow-sm">
                {{ __('home.app_title') }}
            </h2>

            <p class="text-white/90 text-[15px] lg:text-[16px] mb-10 leading-relaxed font-light">
                {{ __('home.app_desc_line1') }}<br class="hidden lg:block">
                {{ __('home.app_desc_line2') }}
            </p>

            <div>
                <p class="text-white text-[13px] mb-3 font-medium opacity-90">{{ __('home.app_magic_link') }}</p>
                <div class="flex flex-col sm:flex-row gap-2 max-w-[420px]">
                    <div class="flex-1 bg-white/95 rounded-full shadow-inner flex items-center px-2">
                        <input
                            type="email"
                            placeholder="Email"
                            class="w-full bg-transparent border-none focus:ring-0 text-slate-800 placeholder-slate-400 py-3 px-4 text-sm font-medium outline-none" />
                    </div>
                    <button class="bg-[#0f172a] hover:bg-[#1e293b] text-white px-8 py-3 rounded-full text-sm font-semibold transition-colors flex items-center justify-center gap-2 shadow-md flex-shrink-0">
                        {{ __('home.app_send') }}
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="22" y1="2" x2="11" y2="13"></line>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div class="md:w-1/2 relative min-h-[250px] sm:min-h-[350px] md:min-h-[550px] lg:min-h-[650px]">
            <img src="{{ asset('images/more.jpg') }}" alt="{{ __('home.app_title') }}" class="absolute inset-0 w-full h-full object-cover object-center" />
            <div class="absolute inset-0 bg-linear-to-l from-transparent to-[#FF3B6B]/60 mix-blend-color-burn"></div>
            <div class="absolute inset-0 bg-linear-to-t from-[#FF7A45]/30 to-transparent mix-blend-multiply"></div>
        </div>
    </section>

    <!-- Keuntungan -->
    <section class="mb-20 py-8 md:py-10 text-center max-w-5xl mx-auto">
        <h2 class="text-2xl md:text-3xl font-serif text-[#1e293b] font-medium mb-8 md:mb-14">{{ __('home.benefits_title') }}</h2>

        @php
        $benefits = [
        ['icon' => '<circle cx="12" cy="12" r="10"></circle>
        <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
        <line x1="9" y1="9" x2="9.01" y2="9"></line>
        <line x1="15" y1="9" x2="15.01" y2="9"></line>', 'title' => __('home.benefit_joy_title'), 'desc' => __('home.benefit_joy_desc')],
        ['icon' => '<polyline points="20 12 20 22 4 22 4 12"></polyline>
        <rect x="2" y="7" width="20" height="5"></rect>
        <line x1="12" y1="22" x2="12" y2="7"></line>
        <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path>
        <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path>', 'title' => __('home.benefit_deals_title'), 'desc' => __('home.benefit_deals_desc')],
        ['icon' => '<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
        <circle cx="12" cy="10" r="3"></circle>', 'title' => __('home.benefit_explore_title'), 'desc' => __('home.benefit_explore_desc')],
        ['icon' => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
        <polyline points="9 12 11 14 15 10"></polyline>', 'title' => __('home.benefit_trust_title'), 'desc' => __('home.benefit_trust_desc')],
        ];
        @endphp

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-8 md:gap-x-8 md:gap-y-12">
            @foreach($benefits as $benefit)
            <div class="flex flex-col items-center text-center">
                <div class="w-[50px] h-[50px] bg-[#fef3c7] rounded-[16px] flex items-center justify-center mb-5">
                    <svg class="w-6 h-6 text-amber-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">{!! $benefit['icon'] !!}</svg>
                </div>
                <h3 class="font-serif font-medium text-slate-800 text-[15px] mb-2 leading-tight">{{ $benefit['title'] }}</h3>
                <p class="text-[12px] text-slate-500 leading-relaxed font-light">{{ $benefit['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Eksplor Lainnya -->
    <section class="mb-24 mt-16">
        <div class="pt-10 max-w-5xl mx-auto px-4 md:px-2">
            <h2 class="text-2xl md:text-[28px] font-serif text-[#1e293b] font-medium mb-1.5 tracking-wide">{{ __('home.explore_title') }}</h2>
            <p class="text-slate-500 text-[13px] mb-8 font-light tracking-wide">{{ __('home.explore_subtitle') }}</p>

            <div class="flex flex-wrap gap-x-2.5 gap-y-3.5">
                @php
                $tags = ['Gunung Batur', 'Nusa Penida', 'Waterbom Bali', 'Ubud', 'Likupang', 'Banyuwangi', 'Pantai Seminyak', 'Canggu', 'Nusa Lembongan', 'Jimbaran', 'Gilimanuk', 'Nusa Dua', 'Sanur', 'Pura Ulun Danu', 'Kuta', 'Alam Hutan Bali', 'Legian', 'Elephant Cave', 'Pura Tirta Empul', 'Bali Bird Park'];
                @endphp
                @foreach($tags as $tag)
                <a href="{{ route('tours.index') }}?q={{ urlencode($tag) }}" class="border border-[#e2e8f0] text-[#64748b] hover:text-[#0f172a] hover:border-slate-400 bg-white px-5 py-2 rounded-full text-[12.5px] font-medium transition-colors">
                    {{ $tag }}
                </a>
                @endforeach
            </div>
        </div>
    </section>

</div>
</div>

<script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
<script>
    function initTyped() {
        if (typeof Typed === 'undefined' || !document.getElementById('typed-search')) {
            setTimeout(initTyped, 100);
            return;
        }
        if (window.typedInstance) window.typedInstance.destroy();

        window.typedInstance = new Typed('#typed-search', {
            strings: {
                !!json_encode(explode('|', __('home.hero_search_strings'))) !!
            },
            typeSpeed: 60,
            backSpeed: 30,
            backDelay: 1500,
            loop: true,
            attr: 'placeholder',
            bindInputFocusEvents: true
        });
    }

    document.addEventListener('livewire:navigated', initTyped);
    document.addEventListener('DOMContentLoaded', initTyped);
    if (document.readyState === 'complete' || document.readyState === 'interactive') {
        initTyped();
    }
</script>