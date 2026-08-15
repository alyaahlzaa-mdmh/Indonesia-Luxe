<x-layouts.vendor :title="'Vendor Dashboard'">
    <div class="flex items-center justify-between mb-5 lg:hidden">
        <div>
            <p class="text-xs text-gray-400 uppercase tracking-wider">{{ __('vendor.dashboard') }}</p>
            <h1 class="text-gray-900">{{ $user->name }}</h1>
        </div>
        <div class="flex items-center gap-1.5 bg-amber-50 border border-amber-200 text-amber-700 text-xs px-3 py-1.5 rounded-full"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big w-3 h-3">
                <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                <path d="m9 11 3 3L22 4"></path>
            </svg> {{ __('vendor.verified') }}</div>
    </div>
    <div class="hidden lg:flex items-center justify-between mb-6">
        <div>
            <h2 class="text-gray-800">{{ __('vendor.overview') }}</h2>
            <p class="text-xs text-gray-400 mt-0.5">{{ __('vendor.packages_count', ['count' => $totalPackages]) }} · {{ __('vendor.orders_count', ['count' => $totalOrders]) }}</p>
        </div>
    </div>
    <div class="space-y-5">
        <div class="relative w-full h-48 sm:h-64 lg:h-80 rounded-2xl overflow-hidden shadow-lg"><img src="https://images.unsplash.com/photo-1751643274240-91affce4d875?crop=entropy&amp;cs=tinysrgb&amp;fit=max&amp;fm=jpg&amp;ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxCcm9tbyUyMHZvbGNhbm8lMjBJbmRvbmVzaWElMjBjcmF0ZXIlMjBzdW5yaXNlfGVufDF8fHx8MTc3MjI2NTUxNnww&amp;ixlib=rb-4.1.0&amp;q=80&amp;w=1080" alt="Gunung Bromo, Jawa Timur" class="absolute inset-0 w-full h-full object-cover" style="opacity: 1; transition: opacity 0.6s;">
            <div class="absolute inset-0 bg-linear-to-t from-black/70 via-black/20 to-transparent"></div>
            <div class="absolute top-4 left-4"><span class="text-[10px] sm:text-xs tracking-[0.2em] text-[#e8c97a] uppercase bg-black/30 backdrop-blur-sm px-2.5 py-1 rounded-full">✦ Indonesia Luxe Travel</span></div>
            <div class="absolute bottom-0 left-0 right-0 p-4 sm:p-6" style="opacity: 1; transition: opacity 0.5s;">
                <p class="text-white text-base sm:text-xl mb-0.5 drop-shadow">{{ __('vendor.dashboard_promo_title') }}</p>
                <p class="text-white/75 text-[11px] sm:text-sm leading-snug drop-shadow hidden sm:block">{{ __('vendor.dashboard_promo_subtitle') }}</p>
            </div>
            <div class="absolute bottom-4 right-12 sm:bottom-6 sm:right-14 flex gap-1.5 items-center"><button class="rounded-full focus:outline-none" style="width: 6px; height: 6px; background: rgba(255, 255, 255, 0.45); transition: 0.3s;"></button><button class="rounded-full focus:outline-none" style="width: 6px; height: 6px; background: rgba(255, 255, 255, 0.45); transition: 0.3s;"></button><button class="rounded-full focus:outline-none" style="width: 6px; height: 6px; background: rgba(255, 255, 255, 0.45); transition: 0.3s;"></button><button class="rounded-full focus:outline-none" style="width: 20px; height: 6px; background: rgb(232, 201, 122); transition: 0.3s;"></button><button class="rounded-full focus:outline-none" style="width: 6px; height: 6px; background: rgba(255, 255, 255, 0.45); transition: 0.3s;"></button><button class="rounded-full focus:outline-none" style="width: 6px; height: 6px; background: rgba(255, 255, 255, 0.45); transition: 0.3s;"></button></div><button class="absolute left-3 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-black/30 backdrop-blur-sm flex items-center justify-center text-white hover:bg-black/50 transition-colors"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg></button><button class="absolute right-3 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-black/30 backdrop-blur-sm flex items-center justify-center text-white hover:bg-black/50 transition-colors"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg></button>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center mb-2 bg-green-50 text-green-600"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package w-4 h-4">
                        <path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"></path>
                        <path d="M12 22V12"></path>
                        <polyline points="3.29 7 12 12 20.71 7"></polyline>
                        <path d="m7.5 4.27 9 5.15"></path>
                    </svg></div>
                <p class="text-xs text-gray-400">{{ __('vendor.active_packages') }}</p>
                <p class="text-xl text-gray-900">{{ $activePackages }}</p>
            </div>
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center mb-2 bg-amber-50 text-amber-600"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-alert w-4 h-4">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" x2="12" y1="8" y2="12"></line>
                        <line x1="12" x2="12.01" y1="16" y2="16"></line>
                    </svg></div>
                <p class="text-xs text-gray-400">{{ __('vendor.pending_packages') }}</p>
                <p class="text-xl text-gray-900">{{ $pendingPackages }}</p>
            </div>
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center mb-2 bg-blue-50 text-blue-600"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag w-4 h-4">
                        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path>
                        <path d="M3 6h18"></path>
                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                    </svg></div>
                <p class="text-xs text-gray-400">{{ __('vendor.total_orders') }}</p>
                <p class="text-xl text-gray-900">{{ $totalOrders }}</p>
            </div>
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center mb-2 bg-purple-50 text-purple-600"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star w-4 h-4">
                        <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path>
                    </svg></div>
                <p class="text-xs text-gray-400">{{ __('vendor.rating') }}</p>
                <p class="text-xl text-gray-900">{{ $rating }}</p>
            </div>
        </div>
        <div class="grid sm:grid-cols-2 gap-3">
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
                <div class="flex items-center gap-2 mb-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-up w-4 h-4 text-amber-500">
                        <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline>
                        <polyline points="16 7 22 7 22 13"></polyline>
                    </svg>
                    <h3 class="text-gray-800 text-sm">{{ __('vendor.total_revenue') }}</h3>
                </div>
                <p class="text-2xl text-amber-600">Rp {{ number_format($confirmedRevenue, 0, ',', '.') }}</p>
                <p class="text-xs text-gray-400 mt-1">{{ __('vendor.revenue_desc', ['count' => $confirmedBookingsCount]) }}</p>
            </div>
            <a href="{{ route('vendor.wallet.index') }}" class="bg-linear-to-br from-[#b8860b] to-amber-500 rounded-2xl p-5 text-white cursor-pointer block">
                <div class="flex items-center gap-2 mb-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wallet w-4 h-4 text-white/80">
                        <path d="M19 7V4a1 1 0 0 0-1-1H5a2 2 0 0 0 0 4h15a1 1 0 0 1 1 1v4h-3a2 2 0 0 0 0 4h3a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1"></path>
                        <path d="M3 5v14a2 2 0 0 0 2 2h15a1 1 0 0 0 1-1v-4"></path>
                    </svg>
                    <h3 class="text-white text-sm">{{ __('vendor.wallet_balance') }}</h3>
                </div>
                <p class="text-2xl text-white">Rp {{ number_format($walletBalance, 0, ',', '.') }}</p>
                <p class="text-white/70 text-xs mt-1">{{ __('vendor.wallet_desc') }}</p>
            </a>
        </div>
        @if($pendingPackages > 0)
        <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 flex items-start gap-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-alert w-5 h-5 text-amber-500 shrink-0 mt-0.5">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" x2="12" y1="8" y2="12"></line>
                <line x1="12" x2="12.01" y1="16" y2="16"></line>
            </svg>
            <div>
                <p class="text-sm text-amber-800">{{ __('vendor.pending_alert', ['count' => $pendingPackages]) }}</p>
                <a href="{{ route('vendor.packages.index') }}" class="text-xs text-amber-600 underline mt-0.5 inline-block">{{ __('vendor.view_packages') }} →</a>
            </div>
        </div>
        @endif
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
            <h3 class="text-sm text-gray-800 mb-3">{{ __('vendor.recent_bookings') }}</h3>
            <div class="space-y-2">
                @forelse($recentBookings as $booking)
                <div class="flex items-center justify-between py-2 border-b border-gray-50 last:border-0">
                    <div class="min-w-0">
                        <p class="text-sm text-gray-800 truncate">{{ $booking->user->name }}</p>
                        <p class="text-xs text-gray-400">{{ $booking->created_at->format('d/m/Y') }}</p>
                    </div>
                    <div class="text-right shrink-0 ml-3">
                        <p class="text-sm text-amber-600">Rp {{ number_format($booking->orderItem->line_total ?? 0, 0, ',', '.') }}</p>
                        <span class="inline-flex items-center gap-1.5 text-xs {{ $booking->status->color() }} px-2 py-0.5 rounded-full">
                            <span class="w-1.5 h-1.5 rounded-full shrink-0 bg-current"></span>
                            {{ $booking->status->label() }}
                        </span>
                    </div>
                </div>
                @empty
                <p class="text-sm text-gray-500 py-4 text-center">{{ __('vendor.no_recent_bookings') }}</p>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts.vendor>