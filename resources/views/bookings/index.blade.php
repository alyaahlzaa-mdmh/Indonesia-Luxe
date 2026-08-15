<x-layouts.site :title="__('bookings.my_bookings')" :fullWidth="true">
    <div class="min-h-screen bg-gray-50">
        <div class="sticky top-16 z-30 bg-white border-b border-gray-100">
            <div class="max-w-4xl mx-auto px-4">
                <div class="flex items-center h-14 gap-3">
                    <a href="{{ route('home') }}" class="p-2 -ml-2 hover:bg-gray-50 rounded-full transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left w-5 h-5 text-gray-700">
                            <path d="m15 18-6-6 6-6"></path>
                        </svg>
                    </a>
                    <h1 class="flex-1 text-gray-900 text-base flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package w-4 h-4 text-amber-500">
                            <path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"></path>
                            <path d="M12 22V12"></path>
                            <polyline points="3.29 7 12 12 20.71 7"></polyline>
                            <path d="m7.5 4.27 9 5.15"></path>
                        </svg>
                        {{ __('bookings.my_bookings') }}
                    </h1>
                    <span class="text-sm text-gray-400">{{ $bookings->total() }} {{ str('booking')->plural($bookings->total()) }}</span>
                </div>
            </div>
        </div>
        <div class="max-w-4xl mx-auto px-4 py-6">
            <div class="space-y-4">
                @forelse($bookings as $booking)
                @php
                /** @var \App\Models\Booking $booking */
                $orderItem = $booking->orderItem;
                $order = $orderItem->order;
                $package = $orderItem->tourPackage;
                $coverImageUrl = $package->cover_image_path
                ? Storage::url($package->cover_image_path)
                : 'https://placehold.co/600x400?text=' . urlencode($package->title);
                @endphp
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden"
                    x-data="{ 
                        expanded: false, 
                        rating: 0, 
                        comment: '', 
                        ratingTexts: {
                            1: '{{ __('bookings.rating_1') }}',
                            2: '{{ __('bookings.rating_2') }}',
                            3: '{{ __('bookings.rating_3') }}',
                            4: '{{ __('bookings.rating_4') }}',
                            5: '{{ __('bookings.rating_5') }}'
                        }
                    }">
                    <div class="px-4 py-3 cursor-pointer hover:bg-gray-50 transition select-none" @click="expanded = !expanded">
                        <div class="flex items-start gap-3">
                            <img src="{{ $coverImageUrl }}" alt="{{ $package->title }}" class="w-12 h-12 object-cover rounded-xl shrink-0 bg-gray-100 shadow-sm">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start gap-2">
                                    <p class="flex-1 text-sm text-gray-900 line-clamp-2 leading-snug">{{ $package->title }}</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-up w-4 h-4 text-gray-400 shrink-0 mt-0.5 transition-transform" :class="expanded ? 'rotate-180' : ''">
                                        <path d="m18 15-6-6-6 6"></path>
                                    </svg>
                                </div>
                                <p class="text-[11px] text-gray-400 mt-0.5">{{ $package->vendor->name }}</p>
                                <div class="flex items-center justify-between gap-2 mt-2">
                                    <span class="text-[11px] text-gray-400 whitespace-nowrap">{{ $order->created_at->translatedFormat('d F Y') }}</span>
                                    <div class="flex items-center gap-1.5 shrink-0">
                                        <span class="text-[11px] px-2 py-0.5 rounded-full whitespace-nowrap {{ $order->status->color() }}">{{ $order->status->label() }}</span>
                                        <span class="hidden sm:inline text-sm text-[#b8860b] whitespace-nowrap">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                                <span class="block sm:hidden text-end text-sm text-[#b8860b] whitespace-nowrap mt-2">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-100 p-4 space-y-4" x-show="expanded" x-collapse x-cloak>
                        <div class="flex flex-wrap gap-x-4 gap-y-1.5 text-xs text-gray-500">
                            <span class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-3 h-3 text-amber-400">
                                    <path d="M8 2v4"></path>
                                    <path d="M16 2v4"></path>
                                    <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                    <path d="M3 10h18"></path>
                                </svg>{{ $orderItem->departure_date->translatedFormat('d F Y') }}
                            </span>
                            <span class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package w-3 h-3 text-amber-400">
                                    <path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"></path>
                                    <path d="M12 22V12"></path>
                                    <polyline points="3.29 7 12 12 20.71 7"></polyline>
                                    <path d="m7.5 4.27 9 5.15"></path>
                                </svg>{{ $orderItem->quantity }} {{ __('tour_card.person') }}
                            </span>
                            <span class="inline-flex items-center bg-amber-50 text-amber-700 px-2 py-0.5 rounded-full">{{ $package->type->label() }}</span>
                        </div>

                        @php
                        $latestPayment = $order->paymentSubmissions->first();
                        @endphp
                        @if($latestPayment)
                        <div>
                            <p class="text-gray-400 text-xs uppercase tracking-wider block mb-2">{{ __('bookings.payment_proof') }}</p>
                            <a href="{{ Storage::url($latestPayment->proof_path) }}" target="_blank" rel="noopener noreferrer" class="block">
                                <img src="{{ Storage::url($latestPayment->proof_path) }}" alt="{{ __('bookings.payment_proof') }}" class="w-full max-h-52 object-cover rounded-xl border border-gray-100 hover:opacity-90 transition">
                                <p class="text-[11px] text-gray-400 mt-1.5 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    {{ __('bookings.tap_to_zoom') }}
                                </p>
                            </a>
                        </div>
                        @else
                        <div class="border border-dashed border-gray-200 rounded-xl px-4 py-3 flex items-center gap-3">
                            <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center shrink-0"><svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg></div>
                            <div>
                                <p class="text-xs text-gray-500">{{ __('bookings.proof_not_uploaded') }}</p>
                                <p class="text-[11px] text-gray-400 mt-0.5">{{ __('bookings.contact_cs_if_questions') }}</p>
                            </div>
                        </div>
                        @endif

                        @if($booking->status === \App\Enums\BookingStatus::Completed)
                        @if($booking->review)
                        <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-100 rounded-xl px-4 py-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big w-4 h-4 text-emerald-500 shrink-0">
                                <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                                <path d="m9 11 3 3L22 4"></path>
                            </svg>
                            <div class="grow">
                                <div class="flex items-start justify-between gap-5">
                                    <p class="text-sm text-emerald-700">{{ $booking->review->comment }}</p>
                                    <div class="flex items-center gap-0.5">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star w-3.5 h-3.5 {{ $i <= $booking->review->rating ? 'fill-amber-400 text-amber-400' : 'text-gray-300' }}">
                                            <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path>
                                            </svg>
                                            @endfor
                                    </div>
                                </div>
                                <p class="text-[11px] text-emerald-500 mt-0.5">{{ __('bookings.review_thanks') }}</p>
                            </div>
                        </div>
                        @else
                        <form action="{{ route('bookings.reviews.store', $booking) }}" method="POST" class="bg-amber-50/60 border border-amber-100 rounded-2xl p-4 space-y-3">
                            @csrf
                            <input type="hidden" name="rating" x-model="rating">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star w-4 h-4 text-amber-500">
                                    <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path>
                                </svg>
                                <p class="text-sm text-gray-700">{{ __('bookings.how_was_experience') }}</p>
                            </div>
                            <div class="flex items-center gap-1.5 flex-wrap">
                                @for($i = 1; $i <= 5; $i++)
                                    <button type="button" @click="rating = {{ $i }}" class="transition-transform hover:scale-110 active:scale-95">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star w-8 h-8 transition" :class="rating >= {{ $i }} ? 'fill-amber-400 text-amber-400' : 'text-gray-300'">
                                        <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path>
                                    </svg>
                                    </button>
                                    @endfor
                                    <span class="text-xs text-amber-600 ml-1" x-text="ratingTexts[rating] || ''"></span>
                            </div>
                            <textarea name="comment" x-model="comment" placeholder="{{ __('bookings.review_placeholder') }}" rows="3" class="w-full border border-amber-200 bg-white rounded-xl px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 outline-none focus:ring-2 focus:ring-amber-300 focus:border-amber-300 resize-none transition"></textarea>
                            <div class="flex items-center justify-end gap-3">
                                <button type="submit" :disabled="!rating || comment.length === 0" class="flex items-center gap-1.5 bg-[#b8860b] hover:bg-[#9a7009] disabled:opacity-50 disabled:cursor-not-allowed text-white text-xs px-4 py-2 rounded-xl transition shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-send w-3.5 h-3.5">
                                        <path d="M14.536 21.686a.5.5 0 0 0 .937-.024l6.5-19a.496.496 0 0 0-.635-.635l-19 6.5a.5.5 0 0 0-.024.937l7.93 3.18a2 2 0 0 1 1.112 1.11z"></path>
                                        <path d="m21.854 2.147-10.94 10.939"></path>
                                    </svg>
                                    {{ __('bookings.send_review') }}
                                </button>
                            </div>
                        </form>
                        @endif
                        @endif

                        <div class="bg-gray-50 rounded-xl p-3 grid grid-cols-2 gap-3 text-xs">
                            <div>
                                <p class="text-gray-400 mb-1">{{ __('bookings.payment_status') }}</p><span class="inline-block px-2 py-0.5 rounded-full {{ $order->status->color() }}">{{ $order->status->label() }}</span>
                            </div>
                            <div>
                                <p class="text-gray-400 mb-1">{{ __('bookings.booking_status') }}</p><span class="inline-block px-2 py-0.5 rounded-full {{ $booking->status->color() }}">{{ $booking->status->label() }}</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-2">
                            <div class="flex gap-2">
                                @php
                                $waText = __('bookings.wa_admin_text', ['order' => $order->code, 'package' => $package->title]);
                                $whatsAppUrl = 'https://wa.me/' . config('contact.whatsapp.admin') . '?text=' . urlencode($waText);
                                @endphp
                                <a href="{{ $whatsAppUrl }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 text-green-700 bg-green-50 hover:bg-green-100 border border-green-100 px-4 py-2 rounded-xl transition font-medium text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle w-4 h-4">
                                        <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"></path>
                                    </svg>
                                    {{ __('bookings.contact_cs') }}
                                </a>

                                <a href="{{ route('orders.show', $order) }}" class="inline-flex items-center gap-2 text-gray-700 bg-gray-50 hover:bg-gray-100 border border-gray-200 px-4 py-2 rounded-xl transition font-medium text-sm">
                                    {{ __('bookings.order_details') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-white rounded-3xl p-12 text-center border border-dashed border-gray-200">
                    <div class="w-16 h-16 bg-gray-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package-open w-8 h-8 text-gray-300">
                            <path d="M12 22v-9"></path>
                            <path d="M15.19 3.05a2.13 2.13 0 0 1 1.83.44l3.66 2.81a2 2 0 0 1 .61 2.27l-1.31 3.52a2 2 0 0 1-1.83 1.34H5.9a2 2 0 0 1-1.83-1.34L2.76 8.57a2 2 0 0 1 .61-2.27l3.66-2.81a2.13 2.13 0 0 1 1.83-.44"></path>
                            <path d="M21 13v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        </svg>
                    </div>
                    <h3 class="text-gray-900 font-semibold">{{ __('bookings.no_bookings') }}</h3>
                    <p class="text-gray-500 mt-1 max-w-xs mx-auto text-sm">{{ __('bookings.no_bookings_desc') }}</p>
                    <a href="{{ route('home') }}" class="mt-6 inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white px-6 py-2.5 rounded-xl font-semibold transition shadow-sm">
                        {{ __('bookings.search_tours') }}
                    </a>
                </div>
                @endforelse

                <div class="mt-8">
                    {{ $bookings->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layouts.site>