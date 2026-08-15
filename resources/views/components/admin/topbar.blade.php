<header class="bg-white border-b h-16 flex items-center justify-between px-4 md:px-6 shrink-0 z-10 sticky top-0">
    <div class="flex items-center gap-3 md:gap-4">
        <!-- Mobile Toggle -->
        <button @click="sidebarOpen = true" class="lg:hidden p-2 -ml-2 text-gray-600 hover:text-gray-900 focus:outline-none">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Logo here -->
        <a href="{{ route('home') }}" class="flex items-center gap-2 md:gap-3">
            <img src="{{ asset('apple-touch-icon.png') }}" alt="Indonesia Luxe Logo" class="h-7 md:h-8 w-auto rounded" />
            <span class="font-bold text-[#cca462] tracking-widest uppercase text-xs md:text-sm whitespace-nowrap">Indonesia Luxe</span>
        </a>
    </div>

    <div class="flex items-center gap-3 md:gap-6">
        <!-- Language Selector -->
        <div x-data="{ showLang: false }" @click.away="showLang = false" class="relative">
            <button @click="showLang = !showLang" class="flex items-center gap-2 border border-gray-200 rounded-xl px-3 py-1.5 hover:bg-gray-50 transition shadow-sm bg-white">
                <div class="w-6 h-4 rounded-[2px] overflow-hidden flex shadow-sm relative shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 3 2" class="w-full h-full" preserveAspectRatio="none">
                        <rect width="3" height="1" fill="#ce1126"/>
                        <rect y="1" width="3" height="1" fill="#ffffff"/>
                    </svg>
                    <!-- Very faint border inside for white part of flag -->
                    <div class="absolute inset-0 border border-black/5 rounded-[2px]"></div>
                </div>
                
                <div class="flex items-center gap-1.5">
                    <span class="text-[13px] font-semibold text-[#9ca3af]">ID</span>
                    <span class="hidden sm:inline-block text-[14px] font-medium text-[#4b5563]">Indonesia</span>
                </div>

                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down text-gray-400 w-4 h-4 ml-1"><path d="m6 9 6 6 6-6"/></svg>
            </button>

            <!-- Language Dropdown -->
            <div
                x-show="showLang"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                class="absolute right-0 top-full mt-2 bg-white shadow-lg rounded-xl w-48 z-50 border border-gray-100 overflow-hidden"
                style="display: none;"
            >
                <!-- ID (Active) -->
                <button type="button" @click="showLang = false" class="w-full flex items-center justify-between px-4 py-2.5 bg-[#fefce8] hover:bg-[#fefce8] transition cursor-pointer border-b border-gray-50">
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-4 rounded-[2px] overflow-hidden flex shadow-sm shrink-0 relative">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 3 2" class="w-full h-full" preserveAspectRatio="none">
                                <rect width="3" height="1" fill="#ce1126"/>
                                <rect y="1" width="3" height="1" fill="#ffffff"/>
                            </svg>
                            <div class="absolute inset-0 border border-black/5 rounded-[2px]"></div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-[13px] font-semibold text-[#9ca3af]">ID</span>
                            <span class="text-sm font-medium text-[#c4532c]">Indonesia</span>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-[#eaa633]"><path d="M20 6 9 17l-5-5"/></svg>
                </button>
                
                <!-- EN (Inactive) -->
                <button type="button" @click="showLang = false" class="w-full flex items-center justify-between px-4 py-2.5 hover:bg-gray-50 transition cursor-pointer">
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-4 rounded-[2px] overflow-hidden flex shadow-sm shrink-0 relative">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 30" width="60" height="30" class="w-full h-full" preserveAspectRatio="none">
                                <clipPath id="ukp1">
                                    <path d="M0,0 v30 h60 v-30 z"/>
                                </clipPath>
                                <clipPath id="ukp2">
                                    <path d="M30,15 h30 v15 z v15 h-30 z h-30 v-15 z v-15 h30 z"/>
                                </clipPath>
                                <g clip-path="url(#ukp1)">
                                    <path d="M0,0 v30 h60 v-30 z" fill="#012169"/>
                                    <path d="M0,0 L60,30 M60,0 L0,30" stroke="#fff" stroke-width="6"/>
                                    <path d="M0,0 L60,30 M60,0 L0,30" clip-path="url(#ukp2)" stroke="#C8102E" stroke-width="4"/>
                                    <path d="M30,0 v30 M0,15 h60" stroke="#fff" stroke-width="10"/>
                                    <path d="M30,0 v30 M0,15 h60" stroke="#C8102E" stroke-width="6"/>
                                </g>
                            </svg>
                            <div class="absolute inset-0 border border-black/5 rounded-[2px]"></div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-[13px] font-semibold text-[#9ca3af]">GB</span>
                            <span class="text-sm font-medium text-[#4b5563]">English</span>
                        </div>
                    </div>
                </button>
            </div>
        </div>

        <!-- Avatar -->
        <div class="relative" x-data="{ open: false, confirmingLogout: false }" @click.away="open = false" @close.stop="open = false; confirmingLogout = false">
            <button @click="open = ! open" class="flex items-center justify-center size-8 rounded-full bg-orange-400 text-white font-semibold shadow focus:outline-none focus:ring-2 focus:ring-[#cca462]">
                A
            </button>

            <div x-show="open"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="absolute right-0 z-50 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 py-1"
                 style="display: none;">
                <button
                    type="button"
                    class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100"
                    data-test="admin-logout-trigger"
                    @click="open = false; confirmingLogout = true">
                    Keluar
                </button>
            </div>

            <form id="admin-logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
                @csrf
            </form>

            <div
                x-show="confirmingLogout"
                x-cloak
                @keydown.escape.window="confirmingLogout = false"
                class="fixed inset-0 z-50 flex items-center justify-center p-4">
                <div
                    x-show="confirmingLogout"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    @click="confirmingLogout = false"
                    class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>

                <div
                    x-show="confirmingLogout"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="relative w-full max-w-lg overflow-hidden rounded-[32px] bg-white shadow-2xl">
                    <div class="px-6 py-8 text-center sm:px-8 sm:py-10">
                        <div class="mx-auto mb-6 flex size-16 items-center justify-center rounded-full bg-red-50 text-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-7.5a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 6 21h7.5a2.25 2.25 0 0 0 2.25-2.25V15m-3-3h8.25m0 0-3-3m3 3-3 3" />
                            </svg>
                        </div>

                        <h3 class="mb-2 text-2xl font-serif text-gray-800">Keluar dari akun?</h3>
                        <p class="mb-8 text-sm leading-relaxed text-gray-500">
                            Kamu akan keluar dari sesi ini.
                        </p>

                        <div class="flex flex-col gap-3 sm:flex-row">
                            <button
                                type="button"
                                class="w-full rounded-2xl border border-gray-200 px-6 py-3 text-sm font-semibold text-gray-600 transition-colors hover:bg-gray-50"
                                @click="confirmingLogout = false">
                                Batal
                            </button>

                            <button
                                type="button"
                                class="w-full rounded-2xl bg-[#ff3341] px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-red-100 transition-colors hover:bg-[#e62e3b]"
                                data-test="admin-logout-confirm"
                                @click="document.getElementById('admin-logout-form').submit()">
                                Ya, Keluar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
