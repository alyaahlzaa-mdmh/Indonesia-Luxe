@php
    $slides = [
        [
            'image' => asset('images/hero1.jpg'),
            'location' => 'PAPUA BARAT, INDONESIA',
            'title' => 'Raja Ampat Paradise',
        ],
        [
            'image' => asset('images/hero2.jpg'),
            'location' => 'NUSA TENGGARA TIMUR',
            'title' => 'Komodo National Park',
        ],
        [
            'image' => asset('images/hero3.jpg'),
            'location' => 'JAWA TIMUR, INDONESIA',
            'title' => 'Mount Bromo Sunrise',
        ],
        [
            'image' => asset('images/hero4.jpg'),
            'location' => 'LOMBOK, INDONESIA',
            'title' => 'Gili Islands Escape',
        ],
    ];
    $pendingOrderPercentage = $totalTransactions > 0 ? ($pendingOrderCount / $totalTransactions) * 100 : 0;
@endphp

<div>
    <!-- Hero Header Carousel -->
    <div x-data='adminCarousel({ slides: @json($slides), interval: 2000 })'
        class="relative w-full h-48 md:h-64 rounded-2xl overflow-hidden mb-6 group bg-gray-900"
    >
        <template x-for="(slide, index) in slides" :key="index">
            <div x-show="activeSlide === index"
                 x-transition:enter="transition ease-in-out duration-500"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in-out duration-500 absolute inset-0"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute inset-0">
                <div class="absolute inset-0 bg-cover bg-center" :style="`background-image: url('${slide.image}'); opacity: 0.8`"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
                
                <div class="absolute bottom-6 left-6 text-white">
                    <p class="text-sm font-semibold tracking-wider text-gray-300 mb-1 flex items-center gap-1">
                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span x-text="slide.location"></span>
                    </p>
                    <h2 class="text-3xl font-serif" x-text="slide.title"></h2>
                </div>
            </div>
        </template>
        
        <!-- Live Destinations Badge (Fixed at top right) -->
        <div class="absolute top-4 right-4 z-10">
            <span class="bg-black/50 backdrop-blur text-white text-xs px-3 py-1.5 rounded-full border border-white/20">Live Destinations</span>
        </div>

        <!-- Dots Indicators (Bottom Right) -->
        <div class="absolute bottom-6 right-6 flex items-center gap-1.5 z-10">
            <template x-for="(slide, index) in slides" :key="index">
                <button @click="activeSlide = index" 
                        class="h-1 rounded-full transition-all duration-300"
                        :class="activeSlide === index ? 'w-4 bg-[#cca462]' : 'w-1 bg-white/50 hover:bg-white/80'">
                </button>
            </template>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">
        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 flex flex-col justify-center relative overflow-hidden">
            <div class="absolute top-0 left-0 w-1 h-full bg-yellow-500"></div>
            <p class="text-[10px] text-gray-500 font-semibold uppercase tracking-wider mb-1">Total User</p>
            <div class="flex items-end gap-2">
                <span class="text-2xl font-bold text-gray-800">{{ $totalUsers }}</span>
                <span class="text-xs text-gray-500 mb-1">aktif</span>
            </div>
        </div>
        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 flex flex-col justify-center relative overflow-hidden">
            <div class="absolute top-0 left-0 w-1 h-full bg-blue-500"></div>
            <p class="text-[10px] text-gray-500 font-semibold uppercase tracking-wider mb-1">Total Vendor</p>
            <div class="flex items-end gap-2">
                <span class="text-2xl font-bold text-gray-800">{{ $totalVendors }}</span>
                <span class="text-xs text-gray-500 mb-1">{{ $pendingVendors }} pending</span>
            </div>
        </div>
        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 flex flex-col justify-center relative overflow-hidden">
            <div class="absolute top-0 left-0 w-1 h-full bg-green-500"></div>
            <p class="text-[10px] text-gray-500 font-semibold uppercase tracking-wider mb-1">Paket Tour</p>
            <div class="flex items-end gap-2">
                <span class="text-2xl font-bold text-gray-800">{{ $liveTours }}</span>
                <span class="text-xs text-green-500 font-medium mb-1">live</span>
            </div>
        </div>
        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 flex flex-col justify-center relative overflow-hidden">
            <div class="absolute top-0 left-0 w-1 h-full bg-blue-400"></div>
            <p class="text-[10px] text-gray-500 font-semibold uppercase tracking-wider mb-1">Total Transaksi</p>
            <div class="flex items-end gap-2">
                <span class="text-2xl font-bold text-gray-800">{{ $totalTransactions }}</span>
                <span class="text-xs text-gray-500 mb-1">semua waktu</span>
            </div>
        </div>
        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 flex flex-col justify-center relative overflow-hidden">
            <div class="absolute top-0 left-0 w-1 h-full bg-red-400"></div>
            <p class="text-[10px] text-gray-500 font-semibold uppercase tracking-wider mb-1">Pending Bayar</p>
            <div class="flex items-end gap-2">
                <span class="text-2xl font-bold text-gray-800">{{ $pendingPayments }}</span>
                <span class="text-xs text-red-500 font-medium mb-1">perlu review</span>
            </div>
        </div>
        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 flex flex-col justify-center relative overflow-hidden">
            <div class="absolute top-0 left-0 w-1 h-full bg-purple-500"></div>
            <p class="text-[10px] text-gray-500 font-semibold uppercase tracking-wider mb-1">Total Revenue</p>
            <div class="flex items-end gap-2">
                <span class="text-xl font-bold text-gray-800">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</span>
                <span class="text-[10px] text-gray-500 mb-1">confirmed</span>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Line Chart -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h3 class="font-serif text-lg text-gray-800">Tren Revenue & Transaksi</h3>
                    <p class="text-xs text-gray-400">6 bulan terakhir</p>
                </div>
                <button class="text-gray-400 hover:text-gray-600">
                    <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                </button>
            </div>

            <div
                wire:ignore
                x-data="adminTrendChart(@js($trendChart))"
                class="space-y-4"
            >
                <div class="relative h-56">
                    <canvas
                        x-ref="canvas"
                        id="admin-trend-chart"
                        aria-label="Grafik tren revenue dan transaksi"
                        class="h-full w-full"
                    ></canvas>

                    <div
                        x-ref="tooltip"
                        class="pointer-events-none absolute z-20 hidden min-w-36 rounded-2xl border border-slate-100 bg-white/95 px-4 py-3 shadow-[0_18px_40px_rgba(15,23,42,0.12)] backdrop-blur-sm"
                    ></div>
                </div>

                <div class="mt-4 flex items-center gap-4 px-1 text-xs text-gray-500">
                    <div class="flex items-center gap-2">
                        <span class="size-2 rounded-full bg-amber-600"></span>
                        <span>Revenue</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="size-2 rounded-full bg-indigo-500"></span>
                        <span>Transaksi</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Doughnut Chart -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h3 class="font-serif text-lg text-gray-800">Status Transaksi</h3>
                    <p class="text-xs text-gray-400">Semua order</p>
                </div>
                <button class="text-gray-400 hover:text-gray-600">
                    <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path></svg>
                </button>
            </div>
            
            <div class="h-48 flex items-center justify-center relative mb-4">
                <svg class="h-32 w-32" viewBox="0 0 36 36">
                    <path class="text-gray-100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="4" />
                    <!-- Pending orange arc -->
                    <path class="text-orange-400" stroke-dasharray="{{ $pendingOrderPercentage }}, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="4" />
                </svg>
            </div>
            
            <div class="flex items-center justify-between text-xs">
                <div class="flex items-center gap-2">
                    <div class="size-2 rounded-full bg-orange-400"></div>
                    <span class="text-gray-600">Pending</span>
                </div>
                <span class="font-semibold text-gray-800">{{ $pendingOrderCount }}</span>
            </div>
        </div>
    </div>

    <!-- Alert Banner -->
    <div class="bg-orange-50 border border-orange-100 rounded-xl p-4 mb-6 flex items-start gap-4">
        <div class="text-orange-400 mt-0.5">
            <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        </div>
        <div>
            <h4 class="font-medium text-orange-800 mb-2">Perlu Perhatian</h4>
            <div class="flex gap-2 flex-wrap">
                <a href="{{ route('admin.vendors.index') }}" class="inline-flex items-center gap-1 bg-white border border-orange-200 text-orange-600 px-3 py-1 rounded-full text-xs font-semibold hover:bg-orange-50">
                    {{ $pendingVendors }} Vendor Pending <svg class="size-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
                <a href="{{ route('admin.packages.index') }}" class="inline-flex items-center gap-1 bg-white border border-orange-200 text-orange-600 px-3 py-1 rounded-full text-xs font-semibold hover:bg-orange-50">
                    {{ $pendingPackages }} Paket Pending <svg class="size-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
                <a href="{{ route('admin.payments.index') }}" class="inline-flex items-center gap-1 bg-white border border-orange-200 text-orange-600 px-3 py-1 rounded-full text-xs font-semibold hover:bg-orange-50">
                    {{ $pendingPayments }} Pembayaran Pending <svg class="size-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-5 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center gap-2 text-gray-800 font-serif text-lg">
                <svg class="size-5 text-[#cca462]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                Transaksi Terbaru
            </div>
            
            <!-- Filters -->
            <div class="flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto">
                <!-- Search with debounce -->
                <x-admin.search-input model="search" :value="$search" :debounce="300" placeholder="Cari customer atau kode order..." class="w-full sm:w-72" />
                
                <a href="{{ route('admin.transactions.index') }}" class="text-[#cca462] hover:text-[#b58c49] text-sm font-medium flex items-center gap-1 shrink-0">
                    Lihat semua <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="text-[10px] text-gray-500 uppercase tracking-wider bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 font-semibold">TANGGAL</th>
                        <th class="px-6 py-4 font-semibold">CUSTOMER</th>
                        <th class="px-6 py-4 font-semibold">TOTAL</th>
                        <th class="px-6 py-4 font-semibold">PAYMENT</th>
                        <th class="px-6 py-4 font-semibold">STATUS</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($recentOrders as $order)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 {{ $loop->iteration > 4 ? 'text-gray-400' : 'text-gray-700' }}">{{ $order->created_at->format('j/n/Y') }}</td>
                            <td class="px-6 py-4">
                                <div class="font-medium {{ $loop->iteration > 4 ? 'text-gray-500' : 'text-gray-800' }}">{{ $order->user->name }}</div>
                                <div class="text-xs text-gray-400">{{ $order->code }} • {{ $order->user->email }}</div>
                            </td>
                            <td class="px-6 py-4 font-semibold {{ $loop->iteration > 4 ? 'text-[#cca462]/60' : 'text-[#cca462]' }}">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $payment = $order->paymentSubmissions->first();
                                @endphp
                                @if($payment)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold {{ $payment->status->value === 'approved' ? 'bg-green-50 text-green-600 border border-green-100' : ($payment->status->value === 'rejected' ? 'bg-red-50 text-red-600 border border-red-100' : 'bg-gray-100 text-gray-600 border border-gray-200') }}">
                                        {{ $payment->status->value === 'pending' ? 'proof_uploaded' : $payment->status->value }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-orange-50 text-orange-600 border border-orange-100">pending</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-xl text-xs font-bold {{ $order->status->color() }}">
                                    {{ $order->status->label() }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">Tidak ada transaksi ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination Hook rendered here -->
        @if($recentOrders->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $recentOrders->links() }}
        </div>
        @endif
    </div>
</div>
