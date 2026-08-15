<x-layouts.site :title="'Transactions'">
    <h1 class="text-2xl font-semibold mb-4">Monitoring Transaksi</h1>

    <div class="space-y-3">
        @foreach ($orders as $order)
            <div class="rounded border bg-white p-4">
                <p class="font-medium">{{ $order->code }} • {{ $order->user->name }}</p>
                <p class="text-xs text-gray-500">Status: {{ $order->status->value }} • Total Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                <p class="text-xs text-gray-500">Items: {{ $order->items->count() }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-5">{{ $orders->links() }}</div>
</x-layouts.site>
