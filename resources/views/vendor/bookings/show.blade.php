<x-layouts.vendor :title="'Vendor Bookings'">
    <div class="flex items-center justify-between mb-5 lg:hidden">
        <div>
            <p class="text-xs text-gray-400 uppercase tracking-wider">Vendor Dashboard</p>
            <h1 class="text-gray-900">{{ auth()->user()->name }}</h1>
        </div>
        <div class="flex items-center gap-1.5 bg-amber-50 border border-amber-200 text-amber-700 text-xs px-3 py-1.5 rounded-full"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big w-3 h-3">
                <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                <path d="m9 11 3 3L22 4"></path>
            </svg> Vendor Verified</div>
    </div>
    <div class="space-y-4">
        <h2 class="text-gray-800 mb-1">Pesanan Masuk</h2>
        <p class="text-xs text-gray-400">{{ $bookingsCount }} pesanan masuk</p>
        <div class="space-y-4">
            <a href="{{ route('vendor.bookings.index') }}" class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-amber-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left w-4 h-4">
                    <path d="m12 19-7-7 7-7"></path>
                    <path d="M19 12H5"></path>
                </svg>Kembali ke Pesanan
            </a>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase tracking-widest mb-0.5">Kode Pesanan</p>
                        <p class="text-sm text-gray-700 font-mono">{{ $booking->orderItem->order->code }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-[#b8860b] font-bold">Rp {{ number_format($booking->orderItem->line_total, 0, ',', '.') }}</p>
                        <span class="inline-flex items-center gap-1.5 text-xs {{ $booking->status->textColor() }}">
                            <span class="w-1.5 h-1.5 rounded-full shrink-0 {{ $booking->status->backgroundColor() }}"></span>
                            {{ $booking->status->label() }}
                        </span>
                    </div>
                </div>
                <div class="p-5 space-y-5">
                    <div>
                        <p class="text-[11px] text-gray-400 uppercase tracking-wider mb-2">Info Pelanggan</p>
                        <div class="bg-gray-50 rounded-xl px-4 py-3 space-y-1.5">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-full bg-amber-100 flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user w-3.5 h-3.5 text-amber-600">
                                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-800">{{ $booking->user->name }}</p>
                            </div>
                            <p class="text-xs text-gray-500 pl-9">{{ $booking->user->email }}</p>
                            @if($booking->user->phone)
                            <div class="flex items-center gap-2 pl-9">
                                <p class="text-xs text-gray-500">{{ $booking->user->phone }}</p>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $booking->user->phone) }}?text=Halo%20{{ urlencode($booking->user->name) }}%2C%20kami%20dari%20vendor%20mengenai%20pesanan%20{{ $booking->orderItem->order->code }}." target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1 text-[11px] bg-green-50 text-green-600 border border-green-200 px-2 py-0.5 rounded-full hover:bg-green-100 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone w-2.5 h-2.5">
                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                    </svg> WhatsApp
                                </a>
                            </div>
                            @endif
                            <p class="text-[11px] text-gray-400 pl-9">Dipesan pada {{ $booking->created_at->format('d F Y, H:i') }}</p>
                        </div>
                    </div>
                    <div>
                        <p class="text-[11px] text-gray-400 uppercase tracking-wider mb-2">Paket Dipesan</p>
                        <div class="space-y-2">
                            <div class="bg-amber-50 border border-amber-100 rounded-xl px-4 py-3">
                                <p class="text-sm text-gray-800 font-medium">{{ $booking->orderItem->package_title }}</p>
                                <div class="flex items-center justify-between mt-1">
                                    <p class="text-xs text-gray-400">
                                        {{ $booking->orderItem->departure_date->format('d M Y') }} ·
                                        {{ $booking->orderItem->quantity }} peserta
                                    </p>
                                    <p class="text-xs text-amber-700">@ Rp {{ number_format($booking->orderItem->price_per_person, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p class="text-[11px] text-gray-400 uppercase tracking-wider mb-2">Bukti Pembayaran</p>
                        @php
                        $lastSubmission = $booking->orderItem->order->paymentSubmissions->last();
                        @endphp
                        @if($lastSubmission)
                        <div class="border border-gray-200 rounded-xl overflow-hidden bg-gray-50/50">
                            <a href="{{ Storage::url($lastSubmission->proof_path) }}" target="_blank" rel="noopener noreferrer" class="block">
                                <img src="{{ Storage::url($lastSubmission->proof_path) }}" alt="Bukti Transfer" class="w-full max-h-52 object-cover rounded-xl border border-gray-100 hover:opacity-90 transition">
                            </a>
                        </div>
                        @else
                        <div class="border border-dashed border-gray-200 rounded-xl px-4 py-5 flex items-center gap-3 bg-gray-50/50">
                            <div class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-image w-5 h-5 text-gray-300">
                                    <rect width="18" height="18" x="3" y="3" rx="2" ry="2" />
                                    <circle cx="9" cy="9" r="2" />
                                    <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Belum ada bukti transfer</p>
                                <p class="text-xs text-gray-400 mt-0.5">Pelanggan belum mengunggah bukti pembayaran</p>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="grid grid-cols-2 gap-3 bg-gray-50 rounded-xl px-4 py-3 text-xs">
                        <div>
                            <p class="text-gray-400 mb-1">Status Pembayaran</p>
                            <span class="inline-flex items-center gap-1.5 text-xs {{ $booking->orderItem->order->status->textColor() }}">
                                <span class="w-1.5 h-1.5 rounded-full shrink-0 {{ $booking->orderItem->order->status->backgroundColor() }}"></span>
                                {{ $booking->orderItem->order->status->label() }}
                            </span>
                        </div>
                        <div>
                            <p class="text-gray-400 mb-1">Status Item</p>
                            <span class="inline-flex items-center gap-1.5 text-xs {{ $booking->status->textColor() }}">
                                <span class="w-1.5 h-1.5 rounded-full shrink-0 {{ $booking->status->backgroundColor() }}"></span>
                                {{ $booking->status->label() }}
                            </span>
                        </div>
                    </div>

                    @if ($booking->status === \App\Enums\BookingStatus::Confirmed)
                    <div class="pt-2">
                        <form action="{{ route('vendor.bookings.complete', $booking) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menandai pesanan ini selesai? Pelanggan akan diberitahu bahwa layanan telah Anda penuhi.')">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-white py-3 rounded-xl font-medium transition shadow-sm flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle w-4 h-4">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                </svg>
                                Tandai Selesai
                            </button>
                        </form>
                    </div>
                    @elseif ($booking->status === \App\Enums\BookingStatus::Completed)
                    <div class="pt-2">
                        <div class="w-full bg-green-50 text-green-700 py-3 rounded-xl font-medium text-center border border-green-200 flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle w-4 h-4">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                            Pesanan Telah Selesai
                        </div>
                        @if($booking->completed_at)
                        <p class="text-[10px] text-gray-400 text-center mt-2 italic">Diselesaikan pada {{ $booking->completed_at->format('d M Y, H:i') }}</p>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.vendor>