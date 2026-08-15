<x-layouts.site :title="__('Dashboard')">
    <div class="md:hidden min-h-screen bg-gray-50 pb-24">
        <div class="bg-linear-to-br from-amber-400 via-amber-500 to-amber-600 px-4 pt-10 pb-6">
            <div class="flex items-start justify-between mb-5">
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <div class="w-20 h-20 text-3xl rounded-full bg-linear-to-br from-amber-400 to-amber-600 flex items-center justify-center text-white shadow border-2 border-white overflow-hidden">
                            @if($user->avatar)
                            <img src="{{ Storage::url($user->avatar) }}" class="w-full h-full object-cover">
                            @else
                            {{ $user->initials() }}
                            @endif
                        </div>
                        <a href="{{ route('profile.edit') }}" class="absolute -bottom-1 -right-1 w-7 h-7 bg-white rounded-full shadow-md flex items-center justify-center border border-amber-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil w-3.5 h-3.5 text-amber-600">
                                <path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"></path>
                                <path d="m15 5 4 4"></path>
                            </svg>
                        </a>
                    </div>
                    <div>
                        <p class="text-white/80 text-sm tracking-widest">★★★★★</p>
                        <p class="text-white text-xl">{{ $user->name }}</p>
                        <a class="flex items-center gap-1 text-white/80 text-sm mt-0.5" href="{{ route('profile.edit') }}" data-discover="true">
                            {{ __('profile.update_personal_info') }}
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-3.5 h-3.5">
                                <path d="m9 18 6-6-6-6"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3 bg-white rounded-2xl px-4 py-3 shadow-sm border border-gray-100 opacity-50">
                <div class="w-11 h-11 rounded-full bg-linear-to-br from-amber-400 to-amber-600 flex items-center justify-center shrink-0 shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles w-5 h-5 text-white">
                        <path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path>
                        <path d="M20 3v4"></path>
                        <path d="M22 5h-4"></path>
                        <path d="M4 17v2"></path>
                        <path d="M5 18H3"></path>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-1.5 flex-wrap">
                        <span class="text-[11px] bg-amber-100 text-amber-700 px-2 py-0.5 rounded-full whitespace-nowrap">Lv.1</span>
                        <span class="text-[11px] bg-amber-500 text-white px-2 py-0.5 rounded-full whitespace-nowrap">Explorer</span>
                    </div>
                    <p class="text-[11px] text-amber-600 mt-1 whitespace-nowrap">4 benefits · 1X Luxe Points</p>
                </div>
                <button class="flex items-center gap-1 text-[11px] text-amber-600 hover:text-amber-700 shrink-0 whitespace-nowrap">
                    Claim rewards
                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 inline-block">

                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-3.5 h-3.5">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </button>
            </div>
        </div>
        <div class="px-4 pt-3 space-y-3">
            <div class="grid grid-cols-3 divide-x divide-gray-100 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="flex flex-col items-center py-4 px-2 opacity-50 transition group" href="/profile/promo-codes" data-discover="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ticket w-5 h-5 text-amber-500 mb-1 group-hover:scale-110 transition-transform">
                        <path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"></path>
                        <path d="M13 5v2"></path>
                        <path d="M13 17v2"></path>
                        <path d="M13 11v2"></path>
                    </svg>
                    <span class="text-[10px] text-gray-500 text-center leading-tight">
                        <span class="block text-gray-400 text-[9px]">{{ __('profile.view') }}</span>{{ __('profile.promo_code') }}
                    </span>
                </div>
                <div class="flex flex-col items-center py-4 px-2 opacity-50 transition group" href="/profile/luxe-points" data-discover="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-coins w-5 h-5 text-amber-500 mb-1 group-hover:scale-110 transition-transform">
                        <circle cx="8" cy="8" r="6">

                        </circle>
                        <path d="M18.09 10.37A6 6 0 1 1 10.34 18"></path>
                        <path d="M7 6h1v4"></path>
                        <path d="m16.71 13.88.7.71-2.82 2.82"></path>
                    </svg>
                    <span class="text-[10px] text-gray-500 text-center leading-tight">
                        <span class="block text-gray-400 text-[9px]">{{ __('profile.view') }}</span>
                        {{ __('profile.luxe_points') }}
                    </span>
                </div>
                <div class="flex flex-col items-center py-4 px-2 opacity-50 transition group" href="/profile/gift-cards" data-discover="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-gift w-5 h-5 text-amber-500 mb-1 group-hover:scale-110 transition-transform">
                        <rect x="3" y="8" width="18" height="4" rx="1">

                        </rect>
                        <path d="M12 8v13"></path>
                        <path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7"></path>
                        <path d="M7.5 8a2.5 2.5 0 0 1 0-5A4.8 8 0 0 1 12 8a4.8 8 0 0 1 4.5-5 2.5 2.5 0 0 1 0 5"></path>
                    </svg>
                    <span class="text-[10px] text-gray-500 text-center leading-tight">
                        <span class="block text-gray-400 text-[9px]">{{ __('profile.view') }}</span>
                        {{ __('profile.gift_cards') }}
                    </span>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <a class="flex items-center gap-3 px-5 py-4 hover:bg-amber-50 transition " href="{{ route('bookings.index') }}" data-discover="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package w-5 h-5 text-gray-400 shrink-0">
                        <path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"></path>
                        <path d="M12 22V12"></path>
                        <polyline points="3.29 7 12 12 20.71 7">

                        </polyline>
                        <path d="m7.5 4.27 9 5.15"></path>
                    </svg>
                    <span class="flex-1 text-sm text-gray-700">{{ __('profile.my_bookings') }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-4 h-4 text-gray-300">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </a>
                <a href="{{ route('profile.wishlist.index') }}" class="flex items-center gap-3 px-5 py-4 hover:bg-amber-50 transition border-t border-gray-50" data-discover="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart w-5 h-5 text-gray-400 shrink-0">
                        <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"></path>
                    </svg>
                    <span class="flex-1 text-sm text-gray-700">{{ __('profile.wishlist') }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-4 h-4 text-gray-300">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </a>
                <div class="flex items-center gap-3 px-5 py-4 opacity-50 transition border-t border-gray-50" href="/profile/reviews" data-discover="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-square w-5 h-5 text-gray-400 shrink-0">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    </svg>
                    <span class="flex-1 text-sm text-gray-700">{{ __('profile.reviews') }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-4 h-4 text-gray-300">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </div>
                <div class="flex items-center gap-3 px-5 py-4 opacity-50 transition border-t border-gray-50" href="/profile/participants" data-discover="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user w-5 h-5 text-gray-400 shrink-0">
                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4">

                        </circle>
                    </svg>
                    <span class="flex-1 text-sm text-gray-700">{{ __('profile.participants') }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-4 h-4 text-gray-300">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </div>
                <div class="flex items-center gap-3 px-5 py-4 opacity-50 transition border-t border-gray-50" href="/profile/delivery" data-discover="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail w-5 h-5 text-gray-400 shrink-0">
                        <rect width="20" height="16" x="2" y="4" rx="2">

                        </rect>
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                    </svg>
                    <span class="flex-1 text-sm text-gray-700">{{ __('profile.delivery') }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-4 h-4 text-gray-300">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="flex items-center gap-3 px-5 py-4 opacity-50 transition " href="/profile/settings" data-discover="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings w-5 h-5 text-gray-400 shrink-0">
                        <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"></path>
                        <circle cx="12" cy="12" r="3">

                        </circle>
                    </svg>
                    <span class="flex-1 text-sm text-gray-700">{{ __('profile.settings') }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-4 h-4 text-gray-300">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </div>
                <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="w-full flex items-center gap-3 px-5 py-4 hover:bg-red-50 transition text-red-500 border-t border-gray-50 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out w-5 h-5 shrink-0">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" x2="9" y1="12" y2="12"></line>
                    </svg>
                    <span class="text-sm">{{ __('profile.logout') }}</span>
                </button>
            </div>
        </div>
    </div>
    <div class="hidden md:block bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex gap-6 items-start">
                <aside class="w-72 shrink-0 self-start sticky top-20">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 mb-4">
                        <div class="bg-linear-to-br from-amber-400 via-amber-500 to-amber-600 px-6 pt-6 pb-10 rounded-t-2xl">
                            <div class="w-20 h-20 text-3xl rounded-full bg-linear-to-br from-amber-400 to-amber-600 flex items-center justify-center text-white shadow border-2 border-white overflow-hidden">
                                @if($user->avatar)
                                <img src="{{ Storage::url($user->avatar) }}" class="w-full h-full object-cover">
                                @else
                                {{ $user->initials() }}
                                @endif
                            </div>
                            <div class="mt-3">
                                <p class="text-white/80 text-sm">★★★★★</p>
                                <p class="text-white text-lg">{{ $user->name }}</p>
                            </div>
                        </div>
                        <div class="-mt-6 px-6 pb-4">
                            <a class="flex items-center gap-2 bg-white shadow rounded-xl px-4 py-2.5 text-sm text-amber-600 hover:bg-amber-50 transition border border-amber-100" href="{{ route('profile.edit') }}" data-discover="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-camera w-4 h-4">
                                    <path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"></path>
                                    <circle cx="12" cy="13" r="3">

                                    </circle>
                                </svg>
                                {{ __('profile.update_personal_info') }}
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-3.5 h-3.5 ml-auto">
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>
                            </a>
                        </div>
                        <div class="px-4 pb-4 opacity-50">
                            <div class="flex items-center gap-3 bg-white rounded-2xl px-4 py-3 shadow-sm border border-gray-100">
                                <div class="w-11 h-11 rounded-full bg-linear-to-br from-amber-400 to-amber-600 flex items-center justify-center shrink-0 shadow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles w-5 h-5 text-white">
                                        <path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path>
                                        <path d="M20 3v4"></path>
                                        <path d="M22 5h-4"></path>
                                        <path d="M4 17v2"></path>
                                        <path d="M5 18H3"></path>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-1.5 flex-wrap">
                                        <span class="text-[11px] bg-amber-100 text-amber-700 px-2 py-0.5 rounded-full whitespace-nowrap">Lv.1</span>
                                        <span class="text-[11px] bg-amber-500 text-white px-2 py-0.5 rounded-full whitespace-nowrap">Explorer</span>
                                    </div>
                                    <p class="text-[11px] text-amber-600 mt-1 whitespace-nowrap">4 benefits · 1X Luxe Points</p>
                                </div>
                                <button class="flex items-center gap-1 text-[11px] text-amber-600 hover:text-amber-700 shrink-0 whitespace-nowrap">Claim rewards<span class="w-1.5 h-1.5 rounded-full bg-red-500 inline-block">

                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-3.5 h-3.5">
                                        <path d="m9 18 6-6-6-6"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="border-t border-gray-100 rounded-b-2xl overflow-hidden opacity-50">
                            <div class="w-full flex items-center gap-3 px-6 py-3 transition text-sm text-gray-700 border-b border-gray-50 last:border-0" href="/profile/promo-codes" data-discover="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ticket w-4 h-4 text-amber-500 shrink-0">
                                    <path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"></path>
                                    <path d="M13 5v2"></path>
                                    <path d="M13 17v2"></path>
                                    <path d="M13 11v2"></path>
                                </svg>
                                <span class="flex-1 text-left text-gray-500 text-xs">{{ __('profile.view') }}</span>
                                <span class="text-gray-900">{{ __('profile.promo_code') }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-3.5 h-3.5 text-gray-300">
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>
                            </div>
                            <div class="w-full flex items-center gap-3 px-6 py-3 transition text-sm text-gray-700 border-b border-gray-50 last:border-0" href="/profile/luxe-points" data-discover="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-coins w-4 h-4 text-amber-500 shrink-0">
                                    <circle cx="8" cy="8" r="6">

                                    </circle>
                                    <path d="M18.09 10.37A6 6 0 1 1 10.34 18"></path>
                                    <path d="M7 6h1v4"></path>
                                    <path d="m16.71 13.88.7.71-2.82 2.82"></path>
                                </svg>
                                <span class="flex-1 text-left text-gray-500 text-xs">{{ __('profile.view') }}</span>
                                <span class="text-gray-900">{{ __('profile.luxe_points') }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-3.5 h-3.5 text-gray-300">
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>
                            </div>
                            <div class="w-full flex items-center gap-3 px-6 py-3 transition text-sm text-gray-700 border-b border-gray-50 last:border-0" href="/profile/gift-cards" data-discover="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-gift w-4 h-4 text-amber-500 shrink-0">
                                    <rect x="3" y="8" width="18" height="4" rx="1">

                                    </rect>
                                    <path d="M12 8v13"></path>
                                    <path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7"></path>
                                    <path d="M7.5 8a2.5 2.5 0 0 1 0-5A4.8 8 0 0 1 12 8a4.8 8 0 0 1 4.5-5 2.5 2.5 0 0 1 0 5"></path>
                                </svg>
                                <span class="flex-1 text-left text-gray-500 text-xs">{{ __('profile.view') }}</span>
                                <span class="text-gray-900">{{ __('profile.gift_cards') }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-3.5 h-3.5 text-gray-300">
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-4">
                        <a class="flex items-center gap-3 px-5 py-3.5 hover:bg-amber-50 transition text-sm text-gray-700 " href="{{ route('bookings.index') }}" data-discover="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package w-4 h-4 text-gray-400 shrink-0">
                                <path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"></path>
                                <path d="M12 22V12"></path>
                                <polyline points="3.29 7 12 12 20.71 7">

                                </polyline>
                                <path d="m7.5 4.27 9 5.15"></path>
                            </svg>
                            <span class="flex-1">{{ __('profile.my_bookings') }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-4 h-4 text-gray-300">
                                <path d="m9 18 6-6-6-6"></path>
                            </svg>
                        </a>
                        <a href="{{ route('profile.wishlist.index') }}" class="flex items-center gap-3 px-5 py-3.5 transition text-sm hover:bg-amber-50 text-gray-700 border-t border-gray-50" data-discover="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart w-4 h-4 text-gray-400 shrink-0">
                                <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"></path>
                            </svg>
                            <span class="flex-1">{{ __('profile.wishlist') }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-4 h-4 text-gray-300">
                                <path d="m9 18 6-6-6-6"></path>
                            </svg>
                        </a>
                        <div class="flex items-center gap-3 px-5 py-3.5 opacity-50 transition text-sm text-gray-700 border-t border-gray-50" href="/profile/reviews" data-discover="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-square w-4 h-4 text-gray-400 shrink-0">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                            </svg>
                            <span class="flex-1">Ulasan</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-4 h-4 text-gray-300">
                                <path d="m9 18 6-6-6-6"></path>
                            </svg>
                        </div>
                        <div class="flex items-center gap-3 px-5 py-3.5 opacity-50 transition text-sm text-gray-700 border-t border-gray-50" href="/profile/participants" data-discover="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user w-4 h-4 text-gray-400 shrink-0">
                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4">

                                </circle>
                            </svg>
                            <span class="flex-1">Detail Peserta</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-4 h-4 text-gray-300">
                                <path d="m9 18 6-6-6-6"></path>
                            </svg>
                        </div>
                        <div class="flex items-center gap-3 px-5 py-3.5 opacity-50 transition text-sm text-gray-700 border-t border-gray-50" href="/profile/delivery" data-discover="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail w-4 h-4 text-gray-400 shrink-0">
                                <rect width="20" height="16" x="2" y="4" rx="2">

                                </rect>
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                            </svg>
                            <span class="flex-1">Detail Pengiriman</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-4 h-4 text-gray-300">
                                <path d="m9 18 6-6-6-6"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="flex items-center gap-3 px-5 py-3.5 opacity-50 transition text-sm text-gray-700 " href="/profile/settings" data-discover="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings w-4 h-4 text-gray-400 shrink-0">
                                <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"></path>
                                <circle cx="12" cy="12" r="3">

                                </circle>
                            </svg>
                            <span class="flex-1">Pengaturan</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-4 h-4 text-gray-300">
                                <path d="m9 18 6-6-6-6"></path>
                            </svg>
                        </div>
                        <button @click="showLogout = true" type="button" class="w-full flex items-center gap-3 px-5 py-3.5 hover:bg-red-50 transition text-sm text-red-500 border-t border-gray-50 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out w-4 h-4 shrink-0">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" x2="9" y1="12" y2="12"></line>
                            </svg>
                            <span>Logout</span>
                        </button>
                    </div>
                </aside>
                <div class="flex-1 min-w-0">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 mb-6 overflow-hidden" x-data="{ tab: 'all' }">
                        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                            <div class="flex items-center gap-2">
                                <h2 class="text-gray-900 text-xl font-semibold">{{ __('profile.my_bookings') }}</h2>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-4 h-4 text-gray-400">
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>
                            </div>
                            <div class="hidden md:flex gap-2">
                                <button @click="tab = 'all'" :class="tab === 'all' ? 'bg-amber-500 text-white' : 'text-gray-500 hover:bg-gray-50'" class="capitalize px-4 py-1.5 rounded-full transition text-xs font-medium cursor-pointer">{{ __('profile.all') }}</button>
                                <button @click="tab = 'upcoming'" :class="tab === 'upcoming' ? 'bg-amber-500 text-white' : 'text-gray-500 hover:bg-gray-50'" class="capitalize px-4 py-1.5 rounded-full transition text-xs font-medium cursor-pointer">{{ __('profile.upcoming') }}</button>
                                <button @click="tab = 'completed'" :class="tab === 'completed' ? 'bg-amber-500 text-white' : 'text-gray-500 hover:bg-gray-50'" class="capitalize px-4 py-1.5 rounded-full transition text-xs font-medium cursor-pointer">{{ __('profile.completed') }}</button>
                                <button @click="tab = 'cancelled'" :class="tab === 'cancelled' ? 'bg-amber-500 text-white' : 'text-gray-500 hover:bg-gray-50'" class="capitalize px-4 py-1.5 rounded-full transition text-xs font-medium cursor-pointer">{{ __('profile.cancelled') }}</button>
                            </div>
                        </div>

                        <!-- All Bookings -->
                        <div x-show="tab === 'all'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translateY-4" x-transition:enter-end="opacity-100 translateY-0">
                            @forelse($bookings as $booking)
                            @include('profile.partials.booking-card', ['booking' => $booking])
                            @empty
                            @include('profile.partials.empty-bookings')
                            @endforelse
                        </div>

                        <!-- Upcoming Bookings -->
                        <div x-show="tab === 'upcoming'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translateY-4" x-transition:enter-end="opacity-100 translateY-0">
                            @forelse($upcomingBookings as $booking)
                            @include('profile.partials.booking-card', ['booking' => $booking])
                            @empty
                            @include('profile.partials.empty-bookings')
                            @endforelse
                        </div>

                        <!-- Completed Bookings -->
                        <div x-show="tab === 'completed'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translateY-4" x-transition:enter-end="opacity-100 translateY-0">
                            @forelse($completedBookings as $booking)
                            @include('profile.partials.booking-card', ['booking' => $booking])
                            @empty
                            @include('profile.partials.empty-bookings')
                            @endforelse
                        </div>

                        <!-- Cancelled Bookings -->
                        <div x-show="tab === 'cancelled'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translateY-4" x-transition:enter-end="opacity-100 translateY-0">
                            @forelse($cancelledBookings as $booking)
                            @include('profile.partials.booking-card', ['booking' => $booking])
                            @empty
                            @include('profile.partials.empty-bookings')
                            @endforelse
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100">
                            <h2 class="text-gray-900 text-xl font-semibold">{{ __('profile.favorite_choices') }}</h2>
                        </div>
                        <div class="py-16 flex flex-col items-center gap-4">
                            <div class="w-20 h-20 bg-amber-50 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star-icon lucide-star w-10 h-10 text-amber-300">
                                    <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
                                </svg>
                            </div>
                            <div class="text-center">
                                <p class="text-gray-900 mb-1">{{ __('profile.no_favorite') }}</p>
                                <p class="text-sm text-gray-500">{{ __('profile.favorite_desc') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.site>