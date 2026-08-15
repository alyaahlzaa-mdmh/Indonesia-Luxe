<x-layouts.site :title="__('order_detail.order') . ' ' . $order->code">
    <div x-data="{ showModal: false, modalImage: '' }">
        <h1 class="text-2xl font-semibold mb-2">{{ __('order_detail.order') }} {{ $order->code }}</h1>
        <p class="text-sm text-gray-600 mb-4">{{ __('order_detail.status') }}: {{ $order->status->label() }}</p>

        <div class="space-y-2">
            @foreach ($order->items as $item)
            <div class="flex items-center gap-4 rounded-xl border bg-white p-3 text-sm">
                <img src="{{ Storage::url($item->tourPackage->cover_image_path) ?? 'https://images.unsplash.com/photo-1694271486260-1a1859d4c745?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=1080' }}" alt="{{ $item->tourPackage->title }}" class="w-28 h-20 object-cover rounded-xl shrink-0">
                <div class="flex flex-col">
                    <div class="flex items-center gap-2 ps-1">
                        <h3 class="text-gray-900 font-semibold line-clamp-1">{{ $item->package_title }}</h3>
                        <span class="text-gray-500">• {{ $item->quantity }} {{ __('tour_card.person') }}</span>
                    </div>
                    <span class="text-lg text-amber-600 font-bold ps-1">Rp {{ number_format($item->line_total, 0, ',', '.') }}</span>
                    <div class="flex items-center gap-1 bg-amber-50 text-amber-700 px-2.5 py-1 rounded-full text-xs w-fit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-3 h-3 shrink-0">
                            <path d="M8 2v4"></path>
                            <path d="M16 2v4"></path>
                            <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                            <path d="M3 10h18"></path>
                        </svg>
                        <span class="mt-1">{{ $item->departure_date->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-5 rounded-xl border bg-white p-4 shadow-sm border-gray-100">
            <p class="font-bold">{{ __('order_detail.total') }}: Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
            @if($order->status == \App\Enums\OrderStatus::PendingPayment)
            <a href="{{ route('payments.create', $order) }}" class="inline-block mt-3 rounded-xl bg-amber-500 hover:bg-amber-600 px-5 py-2.5 text-sm font-semibold text-white transition shadow-sm">{{ __('order_detail.upload_payment_proof') }}</a>
            @endif
        </div>

        <div class="mt-8">
            <h2 class="font-semibold text-gray-900 mb-3">{{ __('order_detail.payment_history') }}</h2>
            <div class="space-y-3">
                @forelse ($order->paymentSubmissions as $payment)
                <div class="rounded-xl border border-gray-100 bg-white p-4 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div class="space-y-1">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $payment->status->color() }}">
                                    {{ ucfirst($payment->status->value) }}
                                </span>
                                <span class="text-[10px] text-gray-400 font-medium uppercase tracking-wider">{{ __('order_detail.sent') }} {{ $payment->created_at->diffForHumans() }}</span>
                            </div>
                            @if ($payment->rejection_reason)
                            <div class="text-xs text-red-600 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-alert w-3.5 h-3.5">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" x2="12" y1="8" y2="12"></line>
                                    <line x1="12" x2="12.01" y1="16" y2="16"></line>
                                </svg>
                                {{ __('order_detail.reject_reason') }}: {{ $payment->rejection_reason }}
                            </div>
                            @endif
                        </div>
                        @if($payment->proof_path)
                        <button type="button" @click="showModal = true; modalImage = '{{ Storage::url($payment->proof_path) }}'" class="text-amber-600 text-sm font-medium hover:text-amber-700 transition flex items-center gap-1.5 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye w-4 h-4">
                                <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0Z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            {{ __('order_detail.view_proof') }}
                        </button>
                        @endif
                    </div>
                </div>
                @empty
                <div class="p-8 text-center bg-gray-50 rounded-xl border border-dashed border-gray-200">
                    <p class="text-sm text-gray-500">{{ __('order_detail.no_history') }}</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Modal Viewer -->
        <div x-show="showModal" class="fixed inset-0 z-100 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" x-cloak @keydown.escape.window="showModal = false">
            <div class="relative max-w-4xl w-full bg-transparent rounded-3xl overflow-hidden" @click.away="showModal = false" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="scale-95 opacity-0" x-transition:enter-end="scale-100 opacity-100">
                <div class="bg-transparent">
                    <img :src="modalImage" alt="{{ __('order_detail.payment_proof') }}" class="w-full h-auto max-h-[80vh] object-contain rounded-xl mx-auto">
                </div>
                <div class="p-4 flex gap-3 justify-center">
                    <a :href="modalImage" download class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white px-5 py-2 rounded-xl text-sm font-semibold transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download-icon lucide-download w-4 h-4">
                            <path d="M12 15V3" />
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                            <path d="m7 10 5 5 5-5" />
                        </svg>
                        {{ __('order_detail.download_image') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.site>