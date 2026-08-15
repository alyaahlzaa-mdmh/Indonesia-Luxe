@props(['package'])

@php
    $coverUrl = $package->coverImageUrl();
    $statusColor = match($package->status->value) {
        'published' => 'bg-[#e8fff3] text-[#10b981]',
        'pending_approval' => 'bg-[#fff8ed] text-[#f59e0b]',
        'rejected' => 'bg-red-50 text-red-500',
        default => 'bg-gray-50 text-gray-500',
    };

    $statusLabel = match($package->status->value) {
        'published' => 'Live',
        'pending_approval' => 'Pending',
        'rejected' => 'Rejected',
        default => ucfirst($package->status->value),
    };
@endphp

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col group transition-all hover:shadow-md">
    {{-- Card Image --}}
    <div class="relative h-48 bg-gray-200 overflow-hidden">
        <img src="{{ $coverUrl }}"
             alt="{{ $package->title }}"
             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />

        {{-- Top Badges --}}
        <div class="absolute top-3 left-3 flex gap-2">
            <span class="bg-[#3b82f6] text-white text-[10px] font-bold px-2 py-1 rounded-md uppercase tracking-wider">
                {{ $package->vendor->isAdmin() ? 'Internal' : 'Vendor' }}
            </span>
        </div>

        <div class="absolute top-3 right-3">
            <span class="{{ $statusColor }} text-[10px] font-bold px-2 py-1 rounded-md uppercase tracking-wider flex items-center gap-1.5 backdrop-blur-sm bg-opacity-90">
                <span class="size-1.5 rounded-full {{ $package->status->value === 'published' ? 'bg-[#10b981]' : ($package->status->value === 'pending_approval' ? 'bg-[#f59e0b]' : 'bg-red-500') }}"></span>
                {{ $statusLabel }}
            </span>
        </div>
    </div>

    {{-- Card Content --}}
    <div class="p-5 flex flex-col flex-1">
        <h3 class="font-bold text-gray-800 text-sm leading-tight mb-2 line-clamp-2">
            {{ $package->title }}
        </h3>

        <div class="flex items-center gap-1 text-gray-400 text-[11px] mb-4">
            <svg class="size-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span class="truncate">{{ $package->meeting_point ?? 'Indonesia' }}</span>
        </div>

        <div class="mt-auto flex justify-between items-end">
            <div>
                <p class="text-[10px] text-gray-400 font-medium uppercase tracking-widest mb-0.5">Mulai dari</p>
                <p class="text-[#f97316] font-bold text-base leading-none">
                    @if($package->price_per_person >= 1000000)
                        Rp {{ number_format($package->price_per_person / 1000000, 1) }}jt
                    @else
                        Rp {{ number_format($package->price_per_person / 1000, 0) }}rb
                    @endif
                </p>
            </div>
            
            <div class="text-[11px] text-gray-400 font-medium">
                {{ $package->type->label() }}
            </div>
        </div>
    </div>

    {{-- Action Overlay (optional, or just use for buttons) --}}
    <div class="px-5 py-4 bg-gray-50/50 border-t border-gray-50 flex gap-2">
        @if($package->status->value === 'pending_approval')
            <button wire:click="confirmApprove({{ $package->id }})" class="flex-1 bg-[#10b981] text-white text-xs font-bold py-2 rounded-lg hover:bg-[#059669] transition-colors">
                Approve
            </button>
            <button wire:click="confirmReject({{ $package->id }})" class="flex-1 border border-red-200 text-red-500 text-xs font-bold py-2 rounded-lg hover:bg-red-50 transition-colors">
                Reject
            </button>
        @else
            <button wire:click="selectPackage({{ $package->id }})" class="flex-1 border border-gray-200 text-gray-500 text-xs font-bold py-2 rounded-lg hover:bg-gray-50 transition-colors text-center">
                Lihat Detail
            </button>
        @endif
    </div>
</div>
