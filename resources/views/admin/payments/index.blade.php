<x-layouts.site :title="'Payment Validation'">
    <h1 class="text-2xl font-semibold mb-4">Validasi Pembayaran</h1>

    <div class="space-y-3">
        @foreach ($paymentSubmissions as $paymentSubmission)
            <div class="rounded border bg-white p-4">
                <p class="font-medium">Order {{ $paymentSubmission->order->code }}</p>
                <p class="text-xs text-gray-500">Pengirim: {{ $paymentSubmission->submittedBy->name }} • Status: {{ $paymentSubmission->status->value }}</p>
                <p class="text-sm mt-1">File: {{ $paymentSubmission->proof_path }}</p>
                <div class="mt-3 flex gap-2">
                    <form method="POST" action="{{ route('admin.payments.update', $paymentSubmission) }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="action" value="approve" />
                        <button class="rounded border px-3 py-1 text-sm">Approve</button>
                    </form>
                    <form method="POST" action="{{ route('admin.payments.update', $paymentSubmission) }}" class="flex items-center gap-2">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="action" value="reject" />
                        <input name="reason" placeholder="Alasan reject" class="rounded border px-2 py-1 text-sm" />
                        <button class="rounded border border-red-300 px-3 py-1 text-sm text-red-700">Reject</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-5">{{ $paymentSubmissions->links() }}</div>
</x-layouts.site>
