<div class="space-y-6">
    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-[28px] font-bold text-[#1e1e1e] leading-tight">Validasi Pembayaran</h1>
        <p class="text-[13px] text-gray-400 mt-1">
            {{ $totalCount }} total — {{ $pendingCount }} menunggu validasi
        </p>
    </div>

    {{-- Search --}}
    <div class="flex justify-between items-center bg-white p-4 rounded-2xl border border-gray-100 shadow-sm mb-6">
        <div class="w-full max-w-md">
            <x-admin.search-input model="search" :value="$search" :debounce="500" placeholder="Cari nama pelanggan, email, atau kode order..." />
        </div>
    </div>

    {{-- List --}}
    <div class="space-y-3">
        @forelse($payments as $payment)
            <div wire:key="payment-{{ $payment->id }}" class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden transition-all">
                {{-- Card Header --}}
                <div class="px-4 sm:px-8 py-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 cursor-pointer hover:bg-gray-50/50" 
                     wire:click="toggleExpand({{ $payment->id }})">
                    <div class="flex items-center gap-3 sm:gap-4">
                        <div class="size-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-400 font-bold shrink-0">
                            {{ strtoupper(substr($payment->submittedBy->name, 0, 1)) }}
                        </div>
                        <div class="min-w-0">
                            <div class="text-sm font-bold text-gray-800 truncate">{{ $payment->submittedBy->name }}</div>
                            <div class="text-[11px] text-gray-400 truncate">{{ $payment->order->code }} • {{ $payment->submittedBy->email }}</div>
                            <div class="text-[11px] text-gray-400 sm:hidden">{{ $payment->created_at->format('j/n/Y') }}</div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between sm:justify-end gap-6 sm:gap-10 border-t sm:border-t-0 pt-3 sm:pt-0">
                        <div class="text-left sm:text-right">
                            <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest block mb-0.5">TOTAL</span>
                            <span class="text-sm font-bold text-[#f97316]">Rp {{ number_format($payment->order->total_amount, 0, ',', '.') }}</span>
                        </div>

                        <div class="flex items-center gap-3">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider 
                                {{ $payment->status->value === 'pending' ? 'bg-[#fff8ed] text-[#f59e0b]' : 
                                   ($payment->status->value === 'approved' ? 'bg-[#e8fff3] text-[#10b981]' : 'bg-red-50 text-red-500') }}">
                                {{ $payment->status->value === 'pending' ? 'proof_uploaded' : $payment->status->value }}
                            </span>
                            
                            <svg class="size-4 text-gray-300 transition-transform {{ $expandedPaymentId === $payment->id ? 'rotate-180' : '' }}" 
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Expanded Content --}}
                @if($expandedPaymentId === $payment->id)
                    <div class="px-4 sm:px-8 py-6 sm:py-8 border-t border-gray-50 bg-gray-50/30 grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-10" x-transition>
                        {{-- Info Pelanggan --}}
                        <div>
                            <h3 class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-4">INFO PELANGGAN</h3>
                            <div class="space-y-3">
                                <div>
                                    <div class="text-sm font-bold text-gray-800">{{ $payment->submittedBy->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $payment->submittedBy->email }}</div>
                                    <div class="text-xs text-gray-400">{{ $payment->submittedBy->phone ?? '-' }}</div>
                                </div>
                                
                                <div class="pt-4 border-t border-gray-100">
                                    <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-2">INFO PEMBAYARAN</div>
                                    <div class="text-xs text-gray-600"><span class="font-bold">Bank:</span> {{ $payment->bank_sender_name ?? '-' }}</div>
                                    <div class="text-xs text-gray-600"><span class="font-bold">Rekening:</span> {{ $payment->bank_sender_account ?? '-' }}</div>
                                    @if($payment->notes)
                                        <div class="text-xs text-gray-500 mt-2 italic">"{{ $payment->notes }}"</div>
                                    @endif
                                </div>
 
                                @if($payment->proof_path)
                                    <div class="pt-4 border-t border-gray-100">
                                        <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-3">BUKTI TRANSFER</div>
                                        <img src="{{ Storage::disk('public')->url($payment->proof_path) }}" alt="Bukti transfer {{ $payment->order->code }}" class="w-full max-w-xs rounded-2xl border border-gray-200 object-cover">
                                    </div>
                                @endif
                            </div>
 
                            @if($payment->status === \App\Enums\PaymentValidationStatus::Pending)
                                <div class="relative z-10 mt-8 flex flex-col gap-3 sm:flex-row sm:flex-wrap">
                                    <button type="button"
                                            wire:click.stop="approve({{ $payment->id }})"
                                            wire:loading.attr="disabled"
                                            wire:target="approve({{ $payment->id }})"
                                            class="flex w-full touch-manipulation items-center justify-center gap-2 rounded-xl bg-[#10b981] px-5 py-3 text-xs font-bold text-white transition-all hover:bg-[#059669] disabled:cursor-not-allowed disabled:opacity-60 sm:w-auto sm:py-2.5">
                                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                                        Approve
                                    </button>
                                    <button type="button"
                                            wire:click.stop="confirmReject({{ $payment->id }})"
                                            wire:loading.attr="disabled"
                                            wire:target="confirmReject({{ $payment->id }})"
                                            class="flex w-full touch-manipulation items-center justify-center gap-2 rounded-xl border border-red-200 px-5 py-3 text-xs font-bold text-red-500 transition-all hover:bg-red-50 disabled:cursor-not-allowed disabled:opacity-60 sm:w-auto sm:py-2.5">
                                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                                        Reject
                                    </button>
                                </div>
                            @else
                                <div class="mt-8 rounded-2xl border border-gray-200 bg-white/70 px-4 py-3 text-xs text-gray-500">
                                    @if($payment->status === \App\Enums\PaymentValidationStatus::Approved)
                                        Pembayaran ini sudah disetujui{{ $payment->validated_at ? ' pada '.$payment->validated_at->format('j M Y H:i') : '' }}.
                                    @else
                                        Pembayaran ini sudah ditolak{{ $payment->validated_at ? ' pada '.$payment->validated_at->format('j M Y H:i') : '' }}.
                                        @if($payment->rejection_reason)
                                            <div class="mt-2 text-red-500">Alasan: {{ $payment->rejection_reason }}</div>
                                        @endif
                                    @endif
                                </div>
                            @endif
                        </div>
 
                        {{-- Paket Dipesan --}}
                        <div>
                            <h3 class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-4">PAKET DIPESAN</h3>
                            <div class="space-y-4">
                                @foreach($payment->order->items as $item)
                                    <div wire:key="payment-{{ $payment->id }}-item-{{ $item->id }}" class="flex justify-between items-start gap-4">
                                        <div class="text-xs font-medium text-gray-700 max-w-[200px] leading-tight">
                                            {{ $item->package_title }}
                                        </div>
                                        <div class="text-xs text-gray-400">
                                            {{ $item->quantity }} x Rp {{ number_format($item->price_per_person / 1000, 0) }}rb
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @empty
            <div class="py-24 text-center bg-white rounded-3xl border border-dashed border-gray-200">
                <div class="size-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="size-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900">Belum ada pembayaran</h3>
                <p class="text-gray-400 text-sm mt-1">Pembayaran dari customer akan muncul di sini untuk divalidasi.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-8">
        {{ $payments->links() }}
    </div>

    {{-- Reject Modal --}}
    <x-admin.modal model="confirmingReject">
        <div class="p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-2">Tolak Pembayaran?</h3>
            <p class="text-gray-500 text-sm mb-4">
                Berikan alasan penolakan agar customer dapat melakukan perbaikan.
            </p>
            <textarea wire:model="rejectReason" 
                      class="w-full rounded-xl border-gray-200 text-sm p-4 h-32 mb-6 focus:ring-red-500 focus:border-red-500"
                      placeholder="Contoh: Bukti transfer tidak jelas/blur..."></textarea>
            @error('rejectReason') <p class="text-xs text-red-500 mb-4">{{ $message }}</p> @enderror
            <div class="flex justify-end gap-3">
                <button @click="close()" class="px-5 py-2.5 bg-gray-100 text-gray-600 rounded-xl text-sm font-bold hover:bg-gray-200 transition-colors">
                    Batal
                </button>
                <button wire:click="reject" class="px-5 py-2.5 bg-red-500 text-white rounded-xl text-sm font-bold hover:bg-red-600 transition-all">
                    Ya, Tolak
                </button>
            </div>
        </div>
    </x-admin.modal>
</div>
