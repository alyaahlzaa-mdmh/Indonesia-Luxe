<aside class="hidden lg:flex fixed left-0 top-16 bottom-0 w-56 bg-white border-r border-gray-100 flex-col z-30">
  <div class="px-5 py-5 border-b border-gray-100">
    <p class="text-[10px] text-gray-400 uppercase tracking-widest mb-2">Vendor Dashboard</p>
    <div class="flex items-center gap-3">
      <div class="w-9 h-9 rounded-xl bg-linear-to-br from-[#b8860b] to-amber-400 flex items-center justify-center text-white text-base font-medium shrink-0">
        @if(auth()->user()->avatar)
        <img src="{{ auth()->user()->getAvatarUrl() }}" class="w-full h-full object-cover rounded-xl border border-white/20">
        @else
        {{ auth()->user()->initials() }}
        @endif
      </div>
      <div class="min-w-0">
        <p class="text-sm text-gray-800 font-medium truncate">{{ auth()->user()->name }}</p>
        <p class="text-[10px] text-gray-400 truncate">{{ auth()->user()->email }}</p>
      </div>
    </div>
  </div>
  <nav class="flex-1 p-3 space-y-0.5 overflow-y-auto">
    @php
    $navItems = [
    [
    'label' => 'Overview',
    'route' => 'vendor.dashboard',
    'icon' => 'layout-dashboard',
    'active' => request()->routeIs('vendor.dashboard'),
    ],
    [
    'label' => 'Paket Tour',
    'route' => 'vendor.packages.*',
    'icon' => 'package',
    'active' => request()->routeIs('vendor.packages.*'),
    ],
    [
    'label' => 'Pesanan',
    'route' => 'vendor.bookings.*',
    'icon' => 'shopping-bag',
    'active' => request()->routeIs('vendor.bookings.*'),
    ],
    [
    'label' => 'Ulasan',
    'route' => 'vendor.review.*',
    'icon' => 'message-square',
    'active' => request()->routeIs('vendor.review.*'),
    ],
    [
    'label' => 'Laporan',
    'route' => 'vendor.reports.*',
    'icon' => 'chart-column',
    'active' => request()->routeIs('vendor.reports.*'),
    ],
    [
    'label' => 'Promo',
    'route' => 'vendor.promo.*',
    'icon' => 'percent',
    'active' => request()->routeIs('vendor.promo.*'),
    ],
    [
    'label' => 'Wallet',
    'route' => 'vendor.wallet.*',
    'icon' => 'wallet',
    'active' => request()->routeIs('vendor.wallet.*'),
    ],
    ];
    @endphp

    @foreach($navItems as $item)
    <a href="{{ Route::has($item['route']) ? route($item['route']) : (str_contains($item['route'], '*') ? (Route::has(str_replace('.*', '.index', $item['route'])) ? route(str_replace('.*', '.index', $item['route'])) : (Route::has(str_replace('.*', '.sales', $item['route'])) ? route(str_replace('.*', '.sales', $item['route'])) : '#')) : '#') }}"
      class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm text-left transition-all {{ $item['active'] ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-800' }}">
      @if($item['icon'] === 'layout-dashboard')
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-dashboard w-4 h-4 shrink-0 {{ $item['active'] ? 'text-amber-600' : 'text-gray-400' }}">
        <rect width="7" height="9" x="3" y="3" rx="1"></rect>
        <rect width="7" height="5" x="14" y="3" rx="1"></rect>
        <rect width="7" height="9" x="14" y="12" rx="1"></rect>
        <rect width="7" height="5" x="3" y="16" rx="1"></rect>
      </svg>
      @elseif($item['icon'] === 'package')
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package w-4 h-4 shrink-0 {{ $item['active'] ? 'text-amber-600' : 'text-gray-400' }}">
        <path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"></path>
        <path d="M12 22V12"></path>
        <polyline points="3.29 7 12 12 20.71 7"></polyline>
        <path d="m7.5 4.27 9 5.15"></path>
      </svg>
      @elseif($item['icon'] === 'shopping-bag')
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag w-4 h-4 shrink-0 {{ $item['active'] ? 'text-amber-600' : 'text-gray-400' }}">
        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path>
        <path d="M3 6h18"></path>
        <path d="M16 10a4 4 0 0 1-8 0"></path>
      </svg>
      @elseif($item['icon'] === 'chart-column')
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chart-column w-4 h-4 shrink-0 {{ $item['active'] ? 'text-amber-600' : 'text-gray-400' }}">
        <path d="M3 3v16a2 2 0 0 0 2 2h16"></path>
        <path d="M18 17V9"></path>
        <path d="M13 17V5"></path>
        <path d="M8 17v-3"></path>
      </svg>
      @elseif($item['icon'] === 'message-square')
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-square-icon lucide-message-square w-4 h-4 shrink-0 {{ $item['active'] ? 'text-amber-600' : 'text-gray-400' }}">
        <path d="M22 17a2 2 0 0 1-2 2H6.828a2 2 0 0 0-1.414.586l-2.202 2.202A.71.71 0 0 1 2 21.286V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2z" />
      </svg>
      @elseif($item['icon'] === 'percent')
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-percent w-4 h-4 shrink-0 {{ $item['active'] ? 'text-amber-600' : 'text-gray-400' }}">
        <line x1="19" x2="5" y1="5" y2="19"></line>
        <circle cx="6.5" cy="6.5" r="2.5"></circle>
        <circle cx="17.5" cy="17.5" r="2.5"></circle>
      </svg>
      @elseif($item['icon'] === 'wallet')
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wallet w-4 h-4 shrink-0 {{ $item['active'] ? 'text-amber-600' : 'text-gray-400' }}">
        <path d="M19 7V4a1 1 0 0 0-1-1H5a2 2 0 0 0 0 4h15a1 1 0 0 1 1 1v4h-3a2 2 0 0 0 0 4h3a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1"></path>
        <path d="M3 5v14a2 2 0 0 0 2 2h15a1 1 0 0 0 1-1v-4"></path>
      </svg>
      @endif
      <span class="flex-1">{{ $item['label'] }}</span>
      @if($item['active'])
      <span class="ml-auto w-1.5 h-1.5 rounded-full bg-amber-500 shrink-0"></span>
      @endif
    </a>
    @endforeach

  </nav>
  <div class="p-4 border-t border-gray-100">
    <div class="flex items-center gap-2 bg-amber-50 border border-amber-200 text-amber-700 text-xs px-3 py-2 rounded-xl">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big w-3 h-3 shrink-0">
        <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
        <path d="m9 11 3 3L22 4"></path>
      </svg>
      <span>Vendor Verified</span>
    </div>
  </div>
</aside>