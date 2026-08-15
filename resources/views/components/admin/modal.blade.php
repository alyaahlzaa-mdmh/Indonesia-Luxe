@props(['model'])

<div x-data="adminModal({ state: @entangle($model) })"
     x-show="show"
     x-cloak
     @keydown.escape.window="close()"
     class="fixed inset-0 z-50 flex items-center justify-center p-4">
    <div x-show="show" 
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="close()" 
         class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>
    
    <div x-show="show" 
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="relative bg-white rounded-[32px] shadow-2xl w-full max-w-lg overflow-hidden">
        {{ $slot }}
    </div>
</div>
