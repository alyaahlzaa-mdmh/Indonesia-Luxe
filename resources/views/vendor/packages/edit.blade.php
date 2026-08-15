<x-layouts.vendor :title="'Edit Package'">
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
            </svg> Vendor Verified
        </div>
    </div>
    <div class="hidden lg:flex items-center justify-between mb-6">
        <div>
            <h2 class="text-gray-800 font-semibold text-lg">Paket Tour</h2>
            <p class="text-xs text-gray-400 mt-0.5">{{ $counts['total'] }} paket total · {{ $counts['active'] }} aktif · {{ $counts['pending'] }} pending</p>
        </div>
    </div>
    <div>
        <a href="{{ route('vendor.packages.index') }}"
            class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-amber-700 transition"><svg
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="lucide lucide-arrow-left w-4 h-4">
                <path d="m12 19-7-7 7-7"></path>
                <path d="M19 12H5"></path>
            </svg>Kembali ke Daftar Paket</a>
        <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
            <div class="relative bg-gray-100 aspect-video">
                @if($tourPackage->cover_image_path)
                <img src="{{ asset('storage/' . $tourPackage->cover_image_path) }}"
                    alt="{{ $tourPackage->title }}" class="w-full h-full object-cover">
                @else
                <div class="w-full h-full flex items-center justify-center text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-image">
                        <rect width="18" height="18" x="3" y="3" rx="2" ry="2" />
                        <circle cx="9" cy="9" r="2" />
                        <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21" />
                    </svg>
                </div>
                @endif
                <div class="absolute top-3 right-3">
                    <span class="text-xs px-3 py-1 rounded-full backdrop-blur-sm {{ $tourPackage->status->badgeColor() }}">{{ $tourPackage->status->badgeLabel() }}</span>
                </div>
            </div>
            <div class="p-5 sm:p-6 space-y-5">
                <div>
                    <h3 class="text-lg text-gray-900 font-semibold">{{ $tourPackage->title }}</h3>
                    <div class="flex flex-wrap items-center gap-x-4 gap-y-1.5 mt-2.5"><span
                            class="flex items-center gap-1.5 text-xs text-gray-500"><svg
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-map-pin w-3.5 h-3.5 text-gray-400">
                                <path
                                    d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0">
                                </path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg> {{ $tourPackage->meeting_point }}</span><span
                            class="flex items-center gap-1.5 text-xs text-gray-500"><svg
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-clock w-3.5 h-3.5 text-gray-400">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg> {{ $tourPackage->duration }}</span><span
                            class="flex items-center gap-1.5 text-xs text-gray-500"><svg
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-users w-3.5 h-3.5 text-gray-400">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg> Maks. {{ $tourPackage->max_participants }} peserta</span><span
                            class="flex items-center gap-1.5 text-xs text-gray-500"><svg
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-tag w-3.5 h-3.5 text-gray-400">
                                <path
                                    d="M12.586 2.586A2 2 0 0 0 11.172 2H4a2 2 0 0 0-2 2v7.172a2 2 0 0 0 .586 1.414l8.704 8.704a2.426 2.426 0 0 0 3.42 0l6.58-6.58a2.426 2.426 0 0 0 0-3.42z">
                                </path>
                                <circle cx="7.5" cy="7.5" r=".5" fill="currentColor"></circle>
                            </svg> {{ $tourPackage->category?->name ?? 'Uncategorized' }}</span></div>
                    <div class="flex items-center gap-1.5 text-xs text-gray-500 mt-2"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-calendar w-3.5 h-3.5 text-gray-400">
                            <path d="M8 2v4"></path>
                            <path d="M16 2v4"></path>
                            <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                            <path d="M3 10h18"></path>
                        </svg>{{ $tourPackage->start_date?->format('d M Y') }} — {{ $tourPackage->end_date?->format('d M Y') }}</div>
                </div>
                <div class="flex items-center gap-4 bg-amber-50 border border-amber-100 rounded-xl px-4 py-3">
                    <div class="flex-1">
                        <p class="text-xs text-amber-600">Harga per orang</p>
                        <p class="text-lg text-amber-800 mt-0.5 font-bold">Rp&nbsp;{{ number_format($tourPackage->price_per_person, 0, ',', '.') }}</p>
                    </div>
                    <div class="text-right">
                        <div class="flex items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-star w-4 h-4 text-amber-500 fill-amber-500">
                                <path
                                    d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z">
                                </path>
                            </svg><span class="text-sm text-gray-900">4.6</span></div>
                        <p class="text-[11px] text-gray-400 mt-0.5">25 ulasan</p>
                    </div>
                </div>
                <div>
                    <p class="text-xs text-gray-400 mb-1.5">Deskripsi</p>
                    <p class="text-sm text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $tourPackage->description }}</p>
                </div>
                @if($tourPackage->extra_photos && count($tourPackage->extra_photos) > 0)
                <div>
                    <p class="text-xs text-gray-400 mb-2">Foto Tambahan</p>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                        @foreach($tourPackage->extra_photos as $photo)
                        <div class="aspect-square rounded-lg overflow-hidden border border-gray-100">
                            <img src="{{ asset('storage/' . $photo) }}" class="w-full h-full object-cover" alt="Foto Tambahan">
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                @if($tourPackage->highlights && count($tourPackage->highlights) > 0)
                <div>
                    <p class="text-xs text-gray-400 mb-2">Highlights</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($tourPackage->highlights as $highlight)
                        <span
                            class="inline-flex items-center gap-1.5 text-xs bg-emerald-50 text-emerald-700 px-3 py-1.5 rounded-full border border-emerald-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-circle-check-big w-3.5 h-3.5">
                                <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                                <path d="m9 11 3 3L22 4"></path>
                            </svg> {{ $highlight }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif
                @if($tourPackage->included && count($tourPackage->included) > 0)
                <div>
                    <p class="text-xs text-gray-400 mb-2">Sudah Termasuk</p>
                    <ul class="grid sm:grid-cols-2 gap-x-4 gap-y-1.5">
                        @foreach($tourPackage->included as $item)
                        <li class="flex items-center gap-2 text-sm text-gray-600"><svg
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-circle-check-big w-3.5 h-3.5 text-emerald-500 shrink-0">
                                <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                                <path d="m9 11 3 3L22 4"></path>
                            </svg> {{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if($tourPackage->itineraries->count() > 0)
                <div>
                    <p class="text-xs text-gray-400 mb-2">Itinerary</p>
                    <div class="space-y-2">
                        @foreach($tourPackage->itineraries as $itinerary)
                        <div class="flex gap-3">
                            <div class="flex flex-col items-center">
                                <div
                                    class="w-6 h-6 rounded-full bg-amber-100 flex items-center justify-center text-[10px] text-amber-700 font-bold shrink-0">
                                    {{ $loop->index + 1 }}
                                    <!-- {{ $itinerary->day_number }} -->
                                </div>
                                @if(!$loop->last)
                                <div class="w-px flex-1 bg-amber-200 mt-1"></div>
                                @endif
                            </div>
                            <div class="pb-3 flex-1">
                                <!-- @if($itinerary->title)
                                <p class="text-sm font-semibold text-gray-900">{{ $itinerary->title }}</p>
                                @endif -->
                                <p class="text-sm text-gray-700 whitespace-pre-wrap">{{ $itinerary->time }} {{ $itinerary->description }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($tourPackage->pickupPoints->count() > 0)
                <div>
                    <p class="text-xs text-gray-400 mb-2">Titik Penjemputan</p>
                    <div class="grid gap-2">
                        @foreach($tourPackage->pickupPoints as $point)
                        <div class="flex items-center gap-2 text-sm text-gray-600 bg-gray-50/50 px-3 py-2 rounded-lg border border-gray-100/50">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin text-amber-500">
                                <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                            {{ $point->location_name }}
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                <div class="bg-gray-50 rounded-xl px-4 py-3 space-y-1.5">
                    <div class="flex justify-between text-xs"><span class="text-gray-400">Status</span>
                        <span class="inline-flex items-center gap-1.5 text-xs {{ $tourPackage->status->textColor() }}">
                            <span class="w-1.5 h-1.5 rounded-full shrink-0 {{ $tourPackage->status->backgroundColor() }}"></span>
                            {{ $tourPackage->status->label() }}
                        </span>
                    </div>
                    @if ($tourPackage->rejected_reason)
                    <div class="flex justify-between text-xs">
                        <span class="text-gray-400">Alasan</span>
                        <span class="text-red-700/70">{{ $tourPackage->rejected_reason }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between text-xs">
                        <span class="text-gray-400">Tanggal Dibuat</span>
                        <span class="text-gray-600">{{ $tourPackage->created_at->format('d F Y') }}</span>
                    </div>
                    <div class="flex justify-between text-xs">
                        <span class="text-gray-400">ID Paket</span>
                        <span class="text-gray-400 font-mono">{{ $tourPackage->id }}</span>
                    </div>
                </div>
                @if($tourPackage->status === \App\Enums\PackageStatus::Draft)
                <form action="{{ route('vendor.packages.submit', $tourPackage) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-white py-2.5 rounded-xl text-sm font-bold transition-colors shadow-sm">Kirim untuk Review</button>
                </form>
                @elseif($tourPackage->status === \App\Enums\PackageStatus::PendingApproval)
                <div class="space-y-2">
                    <div class="bg-amber-50 border border-amber-200 rounded-xl px-4 py-3 flex items-start gap-2.5"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info w-4 h-4 text-amber-600 mt-0.5 shrink-0">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M12 16v-4"></path>
                            <path d="M12 8h.01"></path>
                        </svg>
                        <p class="text-xs text-amber-800">Paket ini sedang menunggu persetujuan admin. Setelah disetujui, paket akan tampil di halaman utama dan dapat dipesan oleh user.</p>
                    </div>
                </div>
                @endif
                <a href="{{ route('vendor.packages.index') }}"
                    class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 py-2.5 rounded-xl text-sm transition-colors mt-2">Tutup</a>
            </div>
        </div>
    </div>
    </div>
</x-layouts.vendor>