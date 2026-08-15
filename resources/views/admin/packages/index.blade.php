<x-layouts.site :title="'Package Approvals'">
    <h1 class="text-2xl font-semibold mb-4">Approve Paket Tour</h1>

    <div class="space-y-3">
        @foreach ($tourPackages as $tourPackage)
            <div class="rounded border bg-white p-4">
                <p class="font-medium">{{ $tourPackage->title }}</p>
                <p class="text-xs text-gray-500">Vendor: {{ $tourPackage->vendor->name }} • Status: {{ $tourPackage->status->value }}</p>
                <div class="mt-3 flex gap-2">
                    <form method="POST" action="{{ route('admin.packages.update', $tourPackage) }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="action" value="approve" />
                        <button class="rounded border px-3 py-1 text-sm">Approve</button>
                    </form>
                    <form method="POST" action="{{ route('admin.packages.update', $tourPackage) }}" class="flex items-center gap-2">
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

    <div class="mt-5">{{ $tourPackages->links() }}</div>
</x-layouts.site>
