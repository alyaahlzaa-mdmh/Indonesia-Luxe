<x-layouts.vendor :title="'Vendor Promo'">
    <div class="flex items-center justify-between mb-5 lg:hidden">
        <div>
            <p class="text-xs text-gray-400 uppercase tracking-wider">Vendor Dashboard</p>
            <h1 class="text-gray-900">{{ auth()->user()->name }}</h1>
        </div>
        <div
            class="flex items-center gap-1.5 bg-amber-50 border border-amber-200 text-amber-700 text-xs px-3 py-1.5 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-circle-check-big w-3 h-3">
                <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                <path d="m9 11 3 3L22 4"></path>
            </svg> Vendor Verified</div>
    </div>
    <div class="hidden lg:flex items-center justify-between mb-6">
        <div>
            <h2 class="text-gray-800">Promo</h2>
            <p class="text-xs text-gray-400 mt-0.5">Kelola promo &amp; diskon</p>
        </div>
    </div>

    @php
        $generatePromoCode = "() => {
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    let result = 'LUXE';
    for (let i = 0; i < 6; i++) {
        result +=characters.charAt(Math.floor(Math.random() * characters.length));
        }
        result +='26' ;
        return result;
        }";

        $generateGiftCode = "() => {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let result = 'GIFT-';
            for (let i = 0; i < 8; i++) {
                result += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            return result;
        }";
    @endphp

    <div x-data="{
        tab: 'promo',
        showCreatePromo: false,
        showCreateGift: false,
        editingPromoId: null,
        editingGiftId: null,
        showCopyToast: false,
        promoCode: '',
        giftCode: '',
        generatePromo() { this.promoCode = ({{ $generatePromoCode }})(); },
        generateGift() { this.giftCode = ({{ $generateGiftCode }})(); }
    }">
        <div class="space-y-6">
            <div class="flex gap-1 bg-gray-100 rounded-xl p-1">
                <button @click="tab = 'promo'"
                    :class="tab == 'promo' ? 'bg-white text-amber-800 shadow-sm' : 'text-gray-500 hover:text-gray-700'"
                    class="flex-1 flex items-center justify-center gap-2 py-2.5 rounded-lg text-sm transition font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-tag w-4 h-4">
                        <path
                            d="M12.586 2.586A2 2 0 0 0 11.172 2H4a2 2 0 0 0-2 2v7.172a2 2 0 0 0 .586 1.414l8.704 8.704a2.426 2.426 0 0 0 3.42 0l6.58-6.58a2.426 2.426 0 0 0 0-3.42z">
                        </path>
                        <circle cx="7.5" cy="7.5" r=".5" fill="currentColor"></circle>
                    </svg>
                    <span class="hidden sm:inline">Kode Promo</span>
                    @if ($promos->count() > 0)
                        <span
                            class="min-w-4.5 h-4.5 px-1 rounded-full bg-amber-100 text-amber-700 text-[10px] flex items-center justify-center">{{ $promos->count() }}</span>
                    @endif
                </button>
                <button @click="tab = 'gift'"
                    :class="tab == 'gift' ? 'bg-white text-amber-800 shadow-sm' : 'text-gray-500 hover:text-gray-700'"
                    class="flex-1 flex items-center justify-center gap-2 py-2.5 rounded-lg text-sm transition font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-gift w-4 h-4">
                        <rect x="3" y="8" width="18" height="4" rx="1"></rect>
                        <path d="M12 8v13"></path>
                        <path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7"></path>
                        <path d="M7.5 8a2.5 2.5 0 0 1 0-5A4.8 8 0 0 1 12 8a4.8 8 0 0 1 4.5-5 2.5 2.5 0 0 1 0 5"></path>
                    </svg>
                    <span class="hidden sm:inline">Gift Cards</span>
                    @if ($giftCards->count() > 0)
                        <span
                            class="min-w-4.5 h-4.5 px-1 rounded-full bg-amber-100 text-amber-700 text-[10px] flex items-center justify-center">{{ $giftCards->count() }}</span>
                    @endif
                </button>
            </div>

            <div class="flex items-start gap-3 bg-blue-50 border border-blue-200 rounded-xl px-4 py-3"><svg
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-shield-check w-4 h-4 text-blue-500 shrink-0 mt-0.5">
                    <path
                        d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z">
                    </path>
                    <path d="m9 12 2 2 4-4"></path>
                </svg>
                <p class="text-xs text-blue-700">Semua promo dan gift card memerlukan persetujuan admin sebelum bisa
                    digunakan pelanggan. Item yang di-edit akan kembali ke status Pending.</p>
            </div>

            {{-- PROMO TAB content --}}
            <div x-show="tab == 'promo'" class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-gray-900 font-semibold">Kelola Kode Promo</h3>
                        <p class="text-xs text-gray-400 mt-0.5">Buat kode promo yang bisa dipakai pelanggan saat
                            checkout</p>
                    </div>
                    <button @click="showCreatePromo = !showCreatePromo"
                        class="bg-amber-500 hover:bg-amber-600 text-white text-sm px-5 py-2.5 rounded-xl transition flex items-center gap-2 font-bold shadow-sm">
                        <svg x-show="!showCreatePromo" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                            stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus">
                            <path d="M5 12h14"></path>
                            <path d="M12 5v14"></path>
                        </svg>
                        <svg x-show="showCreatePromo" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                            stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                        <span x-text="showCreatePromo ? 'Batal' : 'Tambah Promo'"></span>
                    </button>
                </div>

                {{-- STATS GRID --}}
                @if ($promos->count() > 0)
                    <div class="grid grid-cols-3 gap-2">
                        <div
                            class="flex items-center gap-2.5 bg-amber-50 border border-amber-100 rounded-xl px-3 py-2.5">
                            <div class="w-7 h-7 bg-amber-100 rounded-lg flex items-center justify-center shrink-0"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-clock w-3.5 h-3.5 text-amber-600">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg></div>
                            <div>
                                <p class="text-lg leading-none text-amber-700">{{ $pendingPromos }}</p>
                                <p class="text-[10px] text-amber-500 mt-0.5">Menunggu</p>
                            </div>
                        </div>
                        <div
                            class="flex items-center gap-2.5 bg-emerald-50 border border-emerald-100 rounded-xl px-3 py-2.5">
                            <div class="w-7 h-7 bg-emerald-100 rounded-lg flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-shield-check w-3.5 h-3.5 text-emerald-600">
                                    <path
                                        d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z">
                                    </path>
                                    <path d="m9 12 2 2 4-4"></path>
                                </svg></div>
                            <div>
                                <p class="text-lg leading-none text-emerald-700">{{ $activePromos }}</p>
                                <p class="text-[10px] text-emerald-500 mt-0.5">Disetujui</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2.5 bg-red-50 border border-red-100 rounded-xl px-3 py-2.5">
                            <div class="w-7 h-7 bg-red-100 rounded-lg flex items-center justify-center shrink-0"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-shield-x w-3.5 h-3.5 text-red-500">
                                    <path
                                        d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z">
                                    </path>
                                    <path d="m14.5 9.5-5 5"></path>
                                    <path d="m9.5 9.5 5 5"></path>
                                </svg></div>
                            <div>
                                <p class="text-lg leading-none text-red-600">{{ $rejectedPromos }}</p>
                                <p class="text-[10px] text-red-400 mt-0.5">Ditolak</p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- CREATE PROMO FORM --}}
                <div x-show="showCreatePromo" x-transition
                    class="bg-white border border-gray-200 rounded-2xl p-5 sm:p-6 shadow-sm">
                    <form action="{{ route('vendor.promo.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs text-gray-500 mb-1.5 block font-medium">Kode Promo *</label>
                                <div class="flex gap-2">
                                    <input name="code" x-model="promoCode" required
                                        placeholder="cth. LUXESUMMER25"
                                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-amber-400 focus:ring-1 focus:ring-amber-200 outline-none transition bg-white flex-1 font-mono tracking-wider">
                                    <button type="button" @click="generatePromo()"
                                        class="shrink-0 text-xs text-amber-600 hover:text-amber-700 font-semibold px-4 py-2 border border-amber-200 rounded-xl hover:bg-amber-50 transition">Auto</button>
                                </div>
                            </div>
                            <div>
                                <label class="text-xs text-gray-500 mb-1.5 block font-medium">Grup Promo</label>
                                <input name="group" placeholder="cth. Flash Sale, Weekend Deal"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-amber-400 focus:ring-1 focus:ring-amber-200 outline-none transition bg-white">
                            </div>
                        </div>
                        <div>
                            <label class="text-xs text-gray-500 mb-1.5 block font-medium">Deskripsi Promo *</label>
                            <input name="description" required placeholder="cth. Diskon 25% Semua Tour Musim Panas"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-amber-400 focus:ring-1 focus:ring-amber-200 outline-none transition bg-white">
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label class="text-xs text-gray-500 mb-1.5 block font-medium">Tipe Diskon</label>
                                <select name="discount_type"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-amber-400 focus:ring-1 focus:ring-amber-200 outline-none transition bg-white">
                                    <option value="percent">Persen (%)</option>
                                    <option value="flat">Nominal (Rp)</option>
                                </select>
                            </div>
                            <div>
                                <label class="text-xs text-gray-500 mb-1.5 block font-medium">Nilai Diskon</label>
                                <input name="discount_value" type="number" step="0.01" required placeholder="25"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-amber-400 focus:ring-1 focus:ring-amber-200 outline-none transition bg-white">
                            </div>
                            <div>
                                <label class="text-xs text-gray-500 mb-1.5 block font-medium">Min. Pembelian
                                    (Rp)</label>
                                <input name="min_purchase" type="number" step="0.01" placeholder="0"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-amber-400 focus:ring-1 focus:ring-amber-200 outline-none transition bg-white">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs text-gray-500 mb-1.5 block font-medium">Kategori (kosong =
                                    semua)</label>
                                <select name="category_restriction"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-amber-400 focus:ring-1 focus:ring-amber-200 outline-none transition bg-white">
                                    <option value="">Semua Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <label class="text-xs text-gray-500 mb-1.5 block font-medium">Berlaku Dari</label>
                                    <input name="valid_from" type="date"
                                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-amber-400 focus:ring-1 focus:ring-amber-200 outline-none transition bg-white">
                                </div>
                                <div>
                                    <label class="text-xs text-gray-500 mb-1.5 block font-medium">Berlaku
                                        Sampai</label>
                                    <input name="valid_until" type="date"
                                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-amber-400 focus:ring-1 focus:ring-amber-200 outline-none transition bg-white">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 pt-2">
                            <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" checked
                                    class="rounded border-gray-300 text-amber-500 focus:ring-amber-500">
                                Aktifkan promo langsung setelah disetujui
                            </label>
                        </div>
                        <div class="flex gap-3 pt-4 border-t border-gray-50">
                            <button type="submit"
                                class="bg-amber-500 hover:bg-amber-600 text-white text-sm px-6 py-3 rounded-xl transition flex items-center justify-center gap-2 font-bold flex-1 sm:flex-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                    stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save">
                                    <path
                                        d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z">
                                    </path>
                                    <path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"></path>
                                    <path d="M7 3v4a1 1 0 0 0 1 1h7"></path>
                                </svg> Ajukan Promo
                            </button>
                        </div>
                    </form>
                </div>

                {{-- PROMO LIST --}}
                <div class="space-y-3">
                    @forelse($promos as $promo)
                        <div x-show="editingPromoId !== {{ $promo->id }}"
                            class="bg-white border border-gray-200 rounded-2xl p-4 sm:p-5 flex items-center justify-between gap-4 hover:border-amber-200 transition">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 shrink-0 rounded-lg flex items-center justify-center bg-amber-50 text-amber-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-percent w-4 h-4">
                                        <line x1="19" x2="5" y1="5" y2="19"></line>
                                        <circle cx="6.5" cy="6.5" r="2.5"></circle>
                                        <circle cx="17.5" cy="17.5" r="2.5"></circle>
                                    </svg></div>
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <h4 class="text-sm font-bold text-gray-900 font-mono tracking-tight">
                                            {{ $promo->code }}</h4>
                                        <button
                                            @click="navigator.clipboard.writeText('{{ $promo->code }}'); showCopyToast = true; setTimeout(() => showCopyToast = false, 3000)"
                                            class="text-gray-300 hover:text-amber-500 transition">
                                            <svg x-show="!showCopyToast" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="lucide lucide-copy w-3.5 h-3.5">
                                                <rect width="14" height="14" x="8" y="8" rx="2"
                                                    ry="2"></rect>
                                                <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2">
                                                </path>
                                            </svg>
                                            <svg x-show="showCopyToast" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"
                                                class="lucide lucide-check w-3.5 h-3.5 text-emerald-500">
                                                <path d="M20 6 9 17l-5-5"></path>
                                            </svg>
                                        </button>
                                        <span
                                            class="inline-flex items-center gap-1 text-[10px] {{ $promo->status->badgeClass() }} px-2 py-0.5 rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-clock w-3 h-3">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <polyline points="12 6 12 12 16 14"></polyline>
                                            </svg>
                                            {{ $promo->status->label() }}
                                        </span>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-0.5 mb-2">{{ $promo->description }}</p>
                                    <div class="flex flex-wrap items-center gap-x-3 gap-y-1 mt-1.5">
                                        <span
                                            class="text-[10px] text-emerald-600 font-semibold bg-emerald-50 px-2 py-0.5 rounded text-nowrap">
                                            @if ($promo->discount_type->value == 'percent')
                                                Diskon {{ number_format($promo->discount_value, 0) }}%
                                            @else
                                                Diskon Rp {{ number_format($promo->discount_value, 0, ',', '.') }}
                                            @endif
                                        </span>
                                        <span class="text-[10px] text-gray-400">Min. Rp
                                            {{ number_format($promo->min_purchase, 0, ',', '.') }}</span>
                                        @if ($promo->valid_until)
                                            <span class="text-[10px] text-gray-400 flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-calendar-clock">
                                                    <path
                                                        d="M21 7.5V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h3.5" />
                                                    <path d="M16 2v4" />
                                                    <path d="M8 2v4" />
                                                    <path d="M3 10h5" />
                                                    <path d="M17.5 17.5 16 16.25V14" />
                                                    <circle cx="16" cy="16" r="6" />
                                                </svg>
                                                Hingga {{ $promo->valid_until->format('d M Y') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="hidden sm:block">
                                <div class="flex gap-1 shrink-0">
                                    <button @click="editingPromoId = {{ $promo->id }}"
                                        class="p-1.5 hover:bg-gray-100 rounded-lg transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-square-pen w-3.5 h-3.5 text-gray-400">
                                            <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path
                                                d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z">
                                            </path>
                                        </svg>
                                    </button>
                                    <form action="{{ route('vendor.promo.destroy', $promo) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus kode promo ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 hover:bg-red-50 rounded-lg transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-trash2 lucide-trash-2 w-3.5 h-3.5 text-red-400">
                                                <path d="M3 6h18"></path>
                                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                                <line x1="10" x2="10" y1="11" y2="17">
                                                </line>
                                                <line x1="14" x2="14" y1="11" y2="17">
                                                </line>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- EDIT PROMO FORM --}}
                        <div x-show="editingPromoId === {{ $promo->id }}" x-transition
                            class="bg-white border-2 border-amber-200 rounded-2xl p-5 sm:p-6 shadow-md">
                            <div class="flex items-center justify-between mb-4 pb-4 border-b border-gray-100">
                                <h4 class="font-bold text-gray-900">Edit Kode Promo</h4>
                                <button @click="editingPromoId = null"
                                    class="text-gray-400 hover:text-gray-600 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x">
                                        <path d="M18 6 6 18"></path>
                                        <path d="m6 6 12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            <form action="{{ route('vendor.promo.update', $promo) }}" method="POST"
                                class="space-y-4">
                                @csrf
                                @method('PUT')
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-xs text-gray-500 mb-1.5 block font-medium">Kode Promo
                                            *</label>
                                        <input name="code" value="{{ $promo->code }}" required
                                            placeholder="cth. LUXESUMMER25"
                                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-amber-400 focus:ring-1 focus:ring-amber-200 outline-none transition bg-white font-mono tracking-wider">
                                    </div>
                                    <div>
                                        <label class="text-xs text-gray-500 mb-1.5 block font-medium">Grup
                                            Promo</label>
                                        <input name="group" value="{{ $promo->group }}"
                                            placeholder="cth. Flash Sale, Weekend Deal"
                                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-amber-400 focus:ring-1 focus:ring-amber-200 outline-none transition bg-white">
                                    </div>
                                </div>
                                <div>
                                    <label class="text-xs text-gray-500 mb-1.5 block font-medium">Deskripsi Promo
                                        *</label>
                                    <input name="description" value="{{ $promo->description }}" required
                                        placeholder="cth. Diskon 25% Semua Tour Musim Panas"
                                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-amber-400 focus:ring-1 focus:ring-amber-200 outline-none transition bg-white">
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    <div>
                                        <label class="text-xs text-gray-500 mb-1.5 block font-medium">Tipe
                                            Diskon</label>
                                        <select name="discount_type"
                                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-amber-400 focus:ring-1 focus:ring-amber-200 outline-none transition bg-white">
                                            <option value="percent"
                                                {{ $promo->discount_type->value == 'percent' ? 'selected' : '' }}>
                                                Persen (%)</option>
                                            <option value="flat"
                                                {{ $promo->discount_type->value == 'flat' ? 'selected' : '' }}>Nominal
                                                (Rp)</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="text-xs text-gray-500 mb-1.5 block font-medium">Nilai
                                            Diskon</label>
                                        <input name="discount_value" value="{{ (float) $promo->discount_value }}"
                                            type="number" step="0.01" required placeholder="25"
                                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-amber-400 focus:ring-1 focus:ring-amber-200 outline-none transition bg-white">
                                    </div>
                                    <div>
                                        <label class="text-xs text-gray-500 mb-1.5 block font-medium">Min. Pembelian
                                            (Rp)</label>
                                        <input name="min_purchase" value="{{ (float) $promo->min_purchase }}"
                                            type="number" step="0.01" placeholder="0"
                                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-amber-400 focus:ring-1 focus:ring-amber-200 outline-none transition bg-white">
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-xs text-gray-500 mb-1.5 block font-medium">Kategori (kosong
                                            = semua)</label>
                                        <select name="category_restriction"
                                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-amber-400 focus:ring-1 focus:ring-amber-200 outline-none transition bg-white">
                                            <option value="">Semua Kategori</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->name }}"
                                                    {{ $promo->category_restriction == $category->name ? 'selected' : '' }}>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="grid grid-cols-2 gap-2">
                                        <div>
                                            <label class="text-xs text-gray-500 mb-1.5 block font-medium">Berlaku
                                                Dari</label>
                                            <input name="valid_from" type="date"
                                                value="{{ $promo->valid_from?->format('Y-m-d') }}"
                                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-amber-400 focus:ring-1 focus:ring-amber-200 outline-none transition bg-white">
                                        </div>
                                        <div>
                                            <label class="text-xs text-gray-500 mb-1.5 block font-medium">Berlaku
                                                Sampai</label>
                                            <input name="valid_until" type="date"
                                                value="{{ $promo->valid_until?->format('Y-m-d') }}"
                                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-amber-400 focus:ring-1 focus:ring-amber-200 outline-none transition bg-white">
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 pt-2">
                                    <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                        <input type="checkbox" name="is_active" value="1"
                                            {{ $promo->is_active ? 'checked' : '' }}
                                            class="rounded border-gray-300 text-amber-500 focus:ring-amber-500">
                                        Aktifkan promo langsung setelah disetujui
                                    </label>
                                </div>
                                <div class="flex gap-3 pt-4 border-t border-gray-50">
                                    <button type="submit"
                                        class="bg-amber-500 hover:bg-amber-600 text-white text-sm px-6 py-3 rounded-xl transition flex items-center justify-center gap-2 font-bold flex-1">
                                        Simpan Perubahan
                                    </button>
                                    <button type="button" @click="editingPromoId = null"
                                        class="bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm px-6 py-3 rounded-xl transition font-bold flex-1">
                                        Batal
                                    </button>
                                </div>
                            </form>
                        </div>
                    @empty
                        <div x-show="!showCreatePromo"
                            class="bg-white border border-gray-200 rounded-2xl py-16 text-center shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-tag w-8 h-8 text-gray-200 mx-auto mb-3">
                                <path
                                    d="M12.586 2.586A2 2 0 0 0 11.172 2H4a2 2 0 0 0-2 2v7.172a2 2 0 0 0 .586 1.414l8.704 8.704a2.426 2.426 0 0 0 3.42 0l6.58-6.58a2.426 2.426 0 0 0 0-3.42z">
                                </path>
                                <circle cx="7.5" cy="7.5" r=".5" fill="currentColor"></circle>
                            </svg>
                            <p class="text-sm text-gray-400 font-medium">Belum ada kode promo</p>
                            <p class="text-xs text-gray-300 mt-1">Buat kode promo pertama untuk menarik pelanggan</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- GIFT CARD TAB content --}}
            <div x-show="tab == 'gift'" class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-gray-900 font-semibold">Kelola Gift Cards</h3>
                        <p class="text-xs text-gray-400 mt-0.5">Buat gift card yang bisa digunakan pelanggan untuk
                            pembayaran</p>
                    </div>
                    <button @click="showCreateGift = !showCreateGift"
                        class="bg-amber-500 hover:bg-amber-600 text-white text-sm px-5 py-2.5 rounded-xl transition flex items-center gap-2 font-bold shadow-sm">
                        <svg x-show="!showCreateGift" xmlns="http://www.w3.org/2000/svg" width="20"
                            height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-gift">
                            <rect x="3" y="8" width="18" height="4" rx="1"></rect>
                            <path d="M12 8v13"></path>
                            <path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7"></path>
                            <path d="M7.5 8a2.5 2.5 0 0 1 0-5A4.8 8 0 0 1 12 8a4.8 8 0 0 1 4.5-5 2.5 2.5 0 0 1 0 5">
                            </path>
                        </svg>
                        <svg x-show="showCreateGift" xmlns="http://www.w3.org/2000/svg" width="20"
                            height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-x">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                        <span x-text="showCreateGift ? 'Batal' : 'Buat Gift Card'"></span>
                    </button>
                </div>

                @if ($giftCards->count() > 0)
                    <div class="grid grid-cols-3 gap-2">
                        <div class="flex items-center gap-2.5 bg-amber-50 border border-amber-100 rounded-xl px-3 py-2.5">
                            <div class="w-7 h-7 bg-amber-100 rounded-lg flex items-center justify-center shrink-0">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-clock w-3.5 h-3.5 text-amber-600">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                            </div>
                            <div>
                                <p class="text-lg leading-none text-amber-700">{{ $pendingGiftCards }}</p>
                                <p class="text-[10px] text-amber-500 mt-0.5">Menunggu</p>
                            </div>
                        </div>
                        <div
                            class="flex items-center gap-2.5 bg-emerald-50 border border-emerald-100 rounded-xl px-3 py-2.5">
                            <div class="w-7 h-7 bg-emerald-100 rounded-lg flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-shield-check w-3.5 h-3.5 text-emerald-600">
                                    <path
                                        d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z">
                                    </path>
                                    <path d="m9 12 2 2 4-4"></path>
                                </svg></div>
                            <div>
                                <p class="text-lg leading-none text-emerald-700">{{ $activeGiftCards }}</p>
                                <p class="text-[10px] text-emerald-500 mt-0.5">Disetujui</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2.5 bg-red-50 border border-red-100 rounded-xl px-3 py-2.5">
                            <div class="w-7 h-7 bg-red-100 rounded-lg flex items-center justify-center shrink-0"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-shield-x w-3.5 h-3.5 text-red-500">
                                    <path
                                        d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z">
                                    </path>
                                    <path d="m14.5 9.5-5 5"></path>
                                    <path d="m9.5 9.5 5 5"></path>
                                </svg></div>
                            <div>
                                <p class="text-lg leading-none text-red-600">{{ $rejectedGiftCards }}</p>
                                <p class="text-[10px] text-red-400 mt-0.5">Ditolak</p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- CREATE GIFT CARD FORM --}}
                <div x-show="showCreateGift" x-transition
                    class="bg-white border border-gray-200 rounded-2xl p-5 sm:p-6 shadow-sm">
                    <form action="{{ route('vendor.gift-card.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs text-gray-500 mb-1.5 block font-medium">Kode Gift Card *</label>
                                <div class="flex gap-2">
                                    <input name="code" x-model="giftCode" required placeholder="cth. GIFT-ABCDEF"
                                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-amber-400 focus:ring-1 focus:ring-amber-200 outline-none transition bg-white flex-1 font-mono tracking-wider">
                                    <button type="button" @click="generateGift()"
                                        class="shrink-0 text-xs text-amber-600 hover:text-amber-700 font-semibold px-4 py-2 border border-amber-200 rounded-xl hover:bg-amber-50 transition">Auto</button>
                                </div>
                            </div>
                            <div>
                                <label class="text-xs text-gray-500 mb-1.5 block font-medium">Nominal (Rp) *</label>
                                <input name="value" type="number" required placeholder="500000"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-amber-400 focus:ring-1 focus:ring-amber-200 outline-none transition bg-white">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs text-gray-500 mb-1.5 block font-medium">Masa Berlaku *</label>
                                <input name="expires_at" type="date" required
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-amber-400 focus:ring-1 focus:ring-amber-200 outline-none transition bg-white">
                            </div>
                            <div>
                                <label class="text-xs text-gray-500 mb-1.5 block font-medium">Batas Penggunaan
                                    *</label>
                                <input name="max_usages" type="number" required placeholder="1"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-amber-400 focus:ring-1 focus:ring-amber-200 outline-none transition bg-white"
                                    value="1">
                            </div>
                        </div>
                        <div class="flex items-center gap-3 pt-2">
                            <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" checked
                                    class="rounded border-gray-300 text-amber-500 focus:ring-amber-500">
                                Aktifkan gift card langsung setelah disetujui
                            </label>
                        </div>
                        <div class="flex gap-3 pt-4 border-t border-gray-50">
                            <button type="submit"
                                class="bg-amber-500 hover:bg-amber-600 text-white text-sm px-6 py-3 rounded-xl transition flex items-center justify-center gap-2 font-bold flex-1 sm:flex-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                    stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save">
                                    <path
                                        d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z">
                                    </path>
                                    <path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"></path>
                                    <path d="M7 3v4a1 1 0 0 0 1 1h7"></path>
                                </svg> Ajukan Gift Card
                            </button>
                        </div>
                    </form>
                </div>

                {{-- GIFT CARD LIST --}}
                <div class="space-y-3">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @forelse($giftCards as $giftCard)
                        <div x-show="editingGiftId !== {{ $giftCard->id }}" class="bg-white border rounded-xl p-4 transition border-gray-200">
                            <div class="flex items-start justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-purple-50 rounded-lg flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-gift w-4 h-4 text-purple-500"><rect x="3" y="8" width="18" height="4" rx="1"></rect><path d="M12 8v13"></path><path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7"></path><path d="M7.5 8a2.5 2.5 0 0 1 0-5A4.8 8 0 0 1 12 8a4.8 8 0 0 1 4.5-5 2.5 2.5 0 0 1 0 5"></path></svg>
                                    </div>
                                    <div>
                                        <span class="font-mono text-sm text-gray-900 tracking-wider">{{ $giftCard->code }}</span>
                                        <button class="ml-1.5 text-gray-300 hover:text-amber-500 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-copy w-3 h-3 inline">
                                                <rect width="14" height="14" x="8" y="8" rx="2"
                                                    ry="2"></rect>
                                                <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="hidden sm:block">
                                    <div class="flex gap-1 shrink-0">
                                        <button @click="editingGiftId = {{ $giftCard->id }}"
                                            class="p-1.5 hover:bg-gray-100 rounded-lg transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-square-pen w-3.5 h-3.5 text-gray-400">
                                                <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path
                                                    d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z">
                                                </path>
                                            </svg>
                                        </button>
                                        <form action="{{ route('vendor.gift-card.destroy', $giftCard) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus gift card ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 hover:bg-red-50 rounded-lg transition">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-trash2 lucide-trash-2 w-3.5 h-3.5 text-red-400">
                                                    <path d="M3 6h18"></path>
                                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                                    <line x1="10" x2="10" y1="11" y2="17">
                                                    </line>
                                                    <line x1="14" x2="14" y1="11" y2="17">
                                                    </line>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <span class="inline-flex items-center gap-1 text-[10px] {{ $promo->status->badgeClass() }} px-2 py-0.5 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-3 h-3"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                 {{ $promo->status->label() }}
                            </span>
                            <div class="space-y-1.5 text-xs mt-2">
                                <div class="flex justify-between text-gray-500">
                                    <span>Potongan per Pengguna</span>
                                    <span class="text-gray-900">Rp {{ number_format($giftCard->value, 0, ',', '.') }}</span>
                                    </div>
                                <div class="flex justify-between text-gray-500">
                                    <span>Kuota Pengguna</span>
                                    <span class="text-emerald-600">{{ $giftCard->used_count }}/{{ $giftCard->max_usages }} (sisa {{ $giftCard->max_usages - $giftCard->used_count }}x)</span>
                                    </div>
                                <div class="w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-purple-400 rounded-full transition-all" style="width: 0%;"></div>
                                </div>
                                <div class="flex justify-between text-gray-400">
                                    <span></span>
                                    <span>s/d {{ $giftCard->expires_at?->format('d M Y') ?? 'Selamanya' }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- EDIT GIFT CARD FORM --}}
                        <div x-show="editingGiftId === {{ $giftCard->id }}" x-transition
                            class="bg-white border-2 border-amber-200 rounded-2xl p-5 sm:p-6 shadow-md col-span-2">
                            <div class="flex items-center justify-between mb-4 pb-4 border-b border-gray-100">
                                <h4 class="font-bold text-gray-900">Edit Gift Card</h4>
                                <button @click="editingGiftId = null"
                                    class="text-gray-400 hover:text-gray-600 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x">
                                        <path d="M18 6 6 18"></path>
                                        <path d="m6 6 12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            <form action="{{ route('vendor.gift-card.update', $giftCard) }}" method="POST"
                                class="space-y-4">
                                @csrf
                                @method('PUT')
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-xs text-gray-500 mb-1.5 block font-medium">Kode Gift Card
                                            *</label>
                                        <input name="code" value="{{ $giftCard->code }}" required
                                            placeholder="cth. GIFT-ABCDEF"
                                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-amber-400 focus:ring-1 focus:ring-amber-200 outline-none transition bg-white font-mono tracking-wider">
                                    </div>
                                    <div>
                                        <label class="text-xs text-gray-500 mb-1.5 block font-medium">Nominal (Rp)
                                            *</label>
                                        <input name="value" value="{{ (int) $giftCard->value }}" type="number"
                                            required placeholder="500000"
                                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-amber-400 focus:ring-1 focus:ring-amber-200 outline-none transition bg-white">
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-xs text-gray-500 mb-1.5 block font-medium">Masa Berlaku
                                            *</label>
                                        <input name="expires_at" type="date"
                                            value="{{ $giftCard->expires_at?->format('Y-m-d') }}" required
                                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-amber-400 focus:ring-1 focus:ring-amber-200 outline-none transition bg-white">
                                    </div>
                                    <div>
                                        <label class="text-xs text-gray-500 mb-1.5 block font-medium">Batas Penggunaan
                                            *</label>
                                        <input name="max_usages" value="{{ $giftCard->max_usages }}" type="number"
                                            required placeholder="1"
                                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-amber-400 focus:ring-1 focus:ring-amber-200 outline-none transition bg-white">
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 pt-2">
                                    <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                        <input type="checkbox" name="is_active" value="1"
                                            {{ $giftCard->is_active ? 'checked' : '' }}
                                            class="rounded border-gray-300 text-amber-500 focus:ring-amber-500">
                                        Aktifkan gift card langsung setelah disetujui
                                    </label>
                                </div>
                                <div class="flex gap-3 pt-4 border-t border-gray-50">
                                    <button type="submit"
                                        class="bg-amber-500 hover:bg-amber-600 text-white text-sm px-6 py-3 rounded-xl transition flex items-center justify-center gap-2 font-bold flex-1">
                                        Simpan Perubahan
                                    </button>
                                    <button type="button" @click="editingGiftId = null"
                                        class="bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm px-6 py-3 rounded-xl transition font-bold flex-1">
                                        Batal
                                    </button>
                                </div>
                            </form>
                        </div>
                        @empty
                        <div x-show="!showCreateGift"
                            class="bg-white border border-gray-200 rounded-2xl py-16 text-center col-span-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-gift w-8 h-8 text-gray-200 mx-auto mb-3">
                                <rect x="3" y="8" width="18" height="4" rx="1"></rect>
                                <path d="M12 8v13"></path>
                                <path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7"></path>
                                <path d="M7.5 8a2.5 2.5 0 0 1 0-5A4.8 8 0 0 1 12 8a4.8 8 0 0 1 4.5-5 2.5 2.5 0 0 1 0 5">
                                </path>
                            </svg>
                            <p class="text-sm text-gray-400 font-medium">Belum ada gift card</p>
                            <p class="text-xs text-gray-300 mt-1">Buat gift card untuk hadiah spesial pelanggan</p>
                        </div>
                    @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.vendor>
