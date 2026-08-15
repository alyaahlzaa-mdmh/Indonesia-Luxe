<x-layouts.site :title="__('payment_upload.title')">
    <h1 class="text-2xl font-semibold mb-4">{{ __('payment_upload.title') }}</h1>

    <p class="text-sm mb-4">{{ __('order_detail.order') }} {{ $order->code }} • {{ __('payment_upload.total') }} Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>

    <form action="{{ route('payments.store', $order) }}" method="POST" enctype="multipart/form-data" class="rounded border bg-white p-4 space-y-3">
        @csrf
        <label class="block text-sm">{{ __('payment_upload.proof_file') }}
            <input type="file" name="proof" class="mt-1 w-full rounded border px-3 py-2 text-sm" required />
        </label>
        <label class="block text-sm">{{ __('payment_upload.sender_name') }}
            <input type="text" name="bank_sender_name" class="mt-1 w-full rounded border px-3 py-2 text-sm" />
        </label>
        <label class="block text-sm">{{ __('payment_upload.sender_account') }}
            <input type="text" name="bank_sender_account" class="mt-1 w-full rounded border px-3 py-2 text-sm" />
        </label>
        <label class="block text-sm">{{ __('payment_upload.notes') }}
            <textarea name="notes" rows="3" class="mt-1 w-full rounded border px-3 py-2 text-sm"></textarea>
        </label>
        <button class="rounded bg-black px-4 py-2 text-sm text-white">{{ __('payment_upload.submit') }}</button>
    </form>
</x-layouts.site>
