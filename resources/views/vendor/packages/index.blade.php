<x-layouts.vendor :title="'Vendor Packages'">
    <div class="flex items-center justify-between mb-5 lg:hidden">
        <div>
            <p class="text-xs text-gray-400 uppercase tracking-wider">Vendor Dashboard</p>
            <h1 class="text-gray-900">{{ auth()->user()->name }}</h1>
        </div>
        <div
            class="flex items-center gap-1.5 bg-amber-50 border border-amber-200 text-amber-700 text-xs px-3 py-1.5 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-circle-check-big w-3 h-3">
                <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                <path d="m9 11 3 3L22 4"></path>
            </svg> Vendor Verified
        </div>
    </div>
    <div>
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-gray-800">Paket Tour Saya</h2>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $counts['total'] }} paket total · {{ $counts['active'] }} aktif · {{ $counts['pending'] }} pending</p>
                </div>
                <a href="{{ route('vendor.packages.create') }}"
                    class="bg-amber-500 hover:bg-amber-600 text-white text-sm px-4 py-2 rounded-xl flex items-center gap-2 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-circle-plus w-4 h-4">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M8 12h8"></path>
                        <path d="M12 8v8"></path>
                    </svg> Tambah Paket
                </a>
            </div>
            <div class="sm:hidden space-y-2">
                @forelse($tourPackages as $package)
                <a href="{{ route('vendor.packages.edit', $package) }}"
                    class="bg-white border border-gray-200 rounded-xl p-4 flex items-center gap-3 cursor-pointer hover:border-amber-200 hover:shadow-sm transition-all">
                    @if($package->cover_image_path)
                    <img src="{{ asset('storage/' . $package->cover_image_path) }}"
                        alt="{{ $package->title }}" class="w-14 h-14 object-cover rounded-lg border border-gray-100 shrink-0">
                    @else
                    <div class="w-14 h-14 bg-gray-100 rounded-lg border border-gray-100 shrink-0 flex items-center justify-center text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-image w-6 h-6">
                            <rect width="18" height="18" x="3" y="3" rx="2" ry="2" />
                            <circle cx="9" cy="9" r="2" />
                            <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21" />
                        </svg>
                    </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <p class="text-sm text-gray-900 truncate font-medium">{{ $package->title }}</p>
                        <p class="text-xs text-gray-400 mt-0.5 truncate">{{ $package->meeting_point }} · {{ $package->duration_hours }} Jam</p>
                        <div class="flex items-center gap-2 mt-1.5">
                            <span class="inline-flex items-center gap-1.5 text-xs {{ $package->status->textColor() }}">
                                <span class="w-1.5 h-1.5 rounded-full shrink-0 {{ $package->status->backgroundColor() }}"></span>
                                {{ $package->status->label() }}
                            </span>
                            <span class="text-xs text-gray-700 font-medium">Rp&nbsp;{{ number_format($package->price_per_person, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-chevron-right w-4 h-4 text-gray-300 shrink-0">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </a>
                @empty
                <div class="bg-white border border-gray-100 rounded-xl p-8 text-center">
                    <p class="text-gray-400 text-sm">Belum ada paket tour.</p>
                </div>
                @endforelse
            </div>
            <div class="hidden sm:block bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 text-left text-xs text-gray-400 uppercase tracking-wider">
                                <th class="px-5 py-3">Paket Tour</th>
                                <th class="px-5 py-3 hidden md:table-cell">Lokasi</th>
                                <th class="px-5 py-3 hidden lg:table-cell">Kategori</th>
                                <th class="px-5 py-3">Harga</th>
                                <th class="px-5 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($tourPackages as $package)
                            <tr onclick="window.location='{{ route('vendor.packages.edit', $package) }}'" class="hover:bg-amber-50/40 transition-colors cursor-pointer">
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center gap-3">
                                        @if($package->cover_image_path)
                                        <img src="{{ asset('storage/' . $package->cover_image_path) }}"
                                            alt="{{ $package->title }}"
                                            class="w-9 h-9 object-cover rounded-md border border-gray-100 shrink-0">
                                        @else
                                        <div class="w-9 h-9 bg-gray-100 rounded-md border border-gray-100 shrink-0 flex items-center justify-center text-gray-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-image">
                                                <rect width="18" height="18" x="3" y="3" rx="2" ry="2" />
                                                <circle cx="9" cy="9" r="2" />
                                                <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21" />
                                            </svg>
                                        </div>
                                        @endif
                                        <div class="min-w-0">
                                            <p class="text-sm text-gray-900 truncate max-w-[200px] font-medium">{{ $package->title }}</p>
                                            <p class="text-xs text-gray-400 mt-0.5">{{ $package->duration }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-3.5 text-xs text-gray-500 hidden md:table-cell">{{ $package->meeting_point }}</td>
                                <td class="px-5 py-3.5 hidden lg:table-cell">
                                    <span class="text-[11px] text-gray-500 bg-gray-100 px-2 py-0.5 rounded">{{ $package->category?->name ?? 'Uncategorized' }}</span>
                                </td>
                                <td class="px-5 py-3.5 text-sm text-gray-900 whitespace-nowrap font-medium">Rp&nbsp;{{ number_format($package->price_per_person, 0, ',', '.') }}
                                </td>
                                <td class="px-5 py-3.5">
                                    <span class="inline-flex items-center gap-1.5 text-xs {{ $package->status->textColor() }}">
                                        <span class="w-1.5 h-1.5 rounded-full shrink-0 {{ $package->status->backgroundColor() }}"></span>
                                        {{ $package->status->label() }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-5 py-8 text-center text-gray-400">
                                    <p>Belum ada paket tour.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($tourPackages->hasPages())
                <div class="px-5 py-4 border-t border-gray-100">
                    {{ $tourPackages->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.vendor>