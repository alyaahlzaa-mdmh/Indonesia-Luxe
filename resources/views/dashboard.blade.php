<x-layouts.site :title="__('Dashboard')">
    <h1 class="text-2xl font-semibold mb-4">Dashboard</h1>

    <div class="rounded border bg-white p-4 text-sm space-y-2">
        <p>Halo, {{ auth()->user()->name }} ({{ auth()->user()->role->value }}).</p>

        @if (auth()->user()->isCustomer())
            <div class="flex gap-2">
                <a href="{{ route('tours.index') }}" class="rounded border px-3 py-1">Cari Tour</a>
                <a href="{{ route('cart.index') }}" class="rounded border px-3 py-1">Keranjang</a>
                <a href="{{ route('bookings.index') }}" class="rounded border px-3 py-1">Booking Saya</a>
            </div>
        @endif

        @if (auth()->user()->isVendor())
            <div class="flex gap-2">
                <a href="{{ route('vendor.pending') }}" class="rounded border px-3 py-1">Status Vendor</a>
                @if (auth()->user()->isVendorApproved())
                    <a href="{{ route('vendor.dashboard') }}" class="rounded border px-3 py-1">Vendor Dashboard</a>
                @endif
            </div>
        @endif

        @if (auth()->user()->isAdmin())
            <a href="{{ route('admin.dashboard') }}" class="inline-block rounded border px-3 py-1">Admin Dashboard</a>
        @endif
    </div>
</x-layouts.site>
