@props(['status'])

@php
    $styles = match($status) {
        'approved' => 'bg-[#e8fff3] text-[#10b981] border-[#d1fae5]',
        'pending' => 'bg-orange-50 text-orange-500 border-orange-100',
        'rejected' => 'bg-red-50 text-red-500 border-red-100',
        default => 'bg-gray-50 text-gray-500 border-gray-100',
    };

    $dotColors = match($status) {
        'approved' => 'bg-[#10b981]',
        'pending' => 'bg-orange-500',
        'rejected' => 'bg-red-500',
        default => 'bg-gray-400',
    };

    $label = match($status) {
        'approved' => 'Approved',
        'pending' => 'Pending',
        'rejected' => 'Rejected',
        default => ucfirst($status),
    };
@endphp

<div {{ $attributes->merge(['class' => "inline-flex items-center gap-1.5 px-3 py-1 rounded-md text-[10px] font-bold border $styles"]) }}>
    <span class="size-1 rounded-full {{ $dotColors }}"></span>
    {{ $label }}
</div>
