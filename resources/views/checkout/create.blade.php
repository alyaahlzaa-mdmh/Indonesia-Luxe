<x-layouts.site :title="'Checkout'">
    <livewire:checkout :cartItems="$cart->items" :selectedIds="$selectedIds ?? []" />
</x-layouts.site>