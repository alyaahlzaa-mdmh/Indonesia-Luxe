@props([
    'debounce' => 500,
    'model' => null,
    'placeholder' => 'Cari...',
    'value' => '',
])

<div
    @if ($model)
        x-data="adminDebouncedModel({ state: @entangle($model).live, delay: {{ $debounce }} })"
    @endif
    {{ $attributes->class(['relative group']) }}
>
    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
        <svg class="size-4 text-gray-400 group-focus-within:text-[#cca462] transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
    </div>
    <input 
        type="text" 
        placeholder="{{ $placeholder }}"
        @if ($model)
            x-model="value"
        @else
            value="{{ $value }}"
        @endif
        class="block w-full pl-10 pr-4 py-2.5 bg-gray-50 border-none rounded-xl text-sm placeholder-gray-400 focus:ring-2 focus:ring-[#cca462]/20 focus:bg-white transition-all outline-none"
    >
</div>
