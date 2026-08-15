{{--
Type Filter Chips — Reusable horizontal scrollable filter chips for tour type filtering.

Props:
  - $currentType: string — current active type filter value
  - $typeLabels: array — type => label mappings
  - $onlyTypes: array|null — if set, only show these types
  - $size: 'sm' | 'md' — controls chip size
--}}
@props([
    'currentType' => '',
    'typeLabels' => [],
    'onlyTypes' => null,
    'size' => 'sm',
])

@php
    $chipClasses = $size === 'md'
        ? 'px-5 py-2.5 rounded-full text-[13px]'
        : 'px-4 py-2 rounded-full text-xs';
@endphp

<div class="flex overflow-x-auto gap-2 pb-2 -mx-4 px-4 lg:mx-0 lg:px-0 hide-scrollbar">
    <button wire:click="$set('type', '')"
            class="{{ $chipClasses }} font-medium transition-colors border shadow-sm flex-shrink-0 {{ $currentType === '' ? 'bg-[#FF7A45] text-white border-[#FF7A45]' : 'bg-white text-slate-600 border-gray-200 hover:bg-gray-50' }}">
        Semua
    </button>
    @foreach($typeLabels as $typeValue => $label)
        @if($onlyTypes === null || in_array($typeValue, $onlyTypes))
            <button wire:click="$set('type', '{{ $typeValue }}')"
                    class="{{ $chipClasses }} font-medium transition-colors border shadow-sm flex-shrink-0 {{ $currentType === $typeValue ? 'bg-[#FF7A45] text-white border-[#FF7A45]' : 'bg-white text-slate-600 border-gray-200 hover:bg-gray-50' }}">
                {{ $label }}
            </button>
        @endif
    @endforeach
</div>
