<div class="space-y-4">
    <!-- Header Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sm:p-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
            <div>
                <h1 class="text-[32px] font-serif text-[#1e1e1e] leading-tight">Manajemen Vendor</h1>
                <p class="text-xs text-gray-400 mt-1">{{ $totalCount }} vendor terdaftar</p>
            </div>
            
            <div class="w-full md:w-auto">
                <div class="grid grid-cols-3 gap-4 sm:gap-8 pt-2">
                    <div class="text-center">
                        <div class="text-lg sm:text-xl font-bold text-green-500 leading-none">{{ $approvedCount }}</div>
                        <div class="text-[9px] sm:text-[10px] text-gray-400 font-bold tracking-widest mt-1 uppercase">APPROVED</div>
                    </div>
                    <div class="text-center">
                        <div class="text-lg sm:text-xl font-bold text-orange-400 leading-none">{{ $pendingCount }}</div>
                        <div class="text-[9px] sm:text-[10px] text-gray-400 font-bold tracking-widest mt-1 uppercase">PENDING</div>
                    </div>
                    <div class="text-center">
                        <div class="text-lg sm:text-xl font-bold text-red-500 leading-none">{{ $rejectedCount }}</div>
                        <div class="text-[9px] sm:text-[10px] text-gray-400 font-bold tracking-widest mt-1 uppercase">DITOLAK</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
            <!-- Tabs -->
            <div class="flex items-center gap-6 overflow-x-auto pb-2 lg:pb-0 w-full lg:w-auto">
                <button wire:click="setTab('all')" 
                    class="relative py-2 px-1 text-sm font-medium transition-colors whitespace-nowrap {{ $activeTab === 'all' ? 'text-[#cca462]' : 'text-gray-400 hover:text-gray-600' }}">
                    <span>Semua</span>
                    <span class="ml-1 text-[10px] bg-gray-100 text-gray-400 px-1.5 py-0.5 rounded-md">{{ $totalCount }}</span>
                    @if($activeTab === 'all')
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-[#cca462] rounded-full"></div>
                    @endif
                </button>
                <button wire:click="setTab('pending')" 
                    class="relative py-2 px-1 text-sm font-medium transition-colors whitespace-nowrap {{ $activeTab === 'pending' ? 'text-[#cca462]' : 'text-gray-400 hover:text-gray-600' }}">
                    <span>Pending</span>
                    <span class="ml-1 text-[10px] bg-gray-100 text-gray-400 px-1.5 py-0.5 rounded-md">{{ $pendingCount }}</span>
                    @if($activeTab === 'pending')
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-[#cca462] rounded-full"></div>
                    @endif
                </button>
                <button wire:click="setTab('approved')" 
                    class="relative py-2 px-1 text-sm font-medium transition-colors whitespace-nowrap {{ $activeTab === 'approved' ? 'text-[#cca462]' : 'text-gray-400 hover:text-gray-600' }}">
                    <span>Disetujui</span>
                    <span class="ml-1 text-[10px] bg-gray-100 text-gray-400 px-1.5 py-0.5 rounded-md">{{ $approvedCount }}</span>
                    @if($activeTab === 'approved')
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-[#cca462] rounded-full"></div>
                    @endif
                </button>
                <button wire:click="setTab('rejected')" 
                    class="relative py-2 px-1 text-sm font-medium transition-colors whitespace-nowrap {{ $activeTab === 'rejected' ? 'text-[#cca462]' : 'text-gray-400 hover:text-gray-600' }}">
                    <span>Ditolak</span>
                    <span class="ml-1 text-[10px] bg-gray-100 text-gray-400 px-1.5 py-0.5 rounded-md">{{ $rejectedCount }}</span>
                    @if($activeTab === 'rejected')
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-[#cca462] rounded-full"></div>
                    @endif
                </button>
            </div>

            <!-- Search -->
            <div class="w-full lg:w-72">
                <x-admin.search-input model="search" :value="$search" :debounce="500" placeholder="Cari nama atau email..." />
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="text-[10px] text-gray-400 uppercase tracking-wider">
                        <th class="px-8 py-6 font-semibold">VENDOR</th>
                        <th class="px-8 py-6 font-semibold">NAMA USAHA</th>
                        <th class="px-8 py-6 font-semibold">STATUS</th>
                        <th class="px-8 py-6 font-semibold">KETERANGAN</th>
                        <th class="px-8 py-6 font-semibold text-right">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($vendors as $vendor)
                        <tr class="hover:bg-gray-50/30 transition-colors">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="size-10 rounded-full bg-[#1e293b] flex items-center justify-center text-white text-xs font-bold shrink-0">
                                        {{ strtoupper(substr($vendor->user->name, 0, 1)) }}
                                    </div>
                                    <div class="min-w-0">
                                        <div class="text-sm font-semibold text-gray-800 leading-tight">{{ $vendor->user->name }}</div>
                                        <div class="text-[11px] text-gray-400 mt-1">{{ $vendor->user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <span class="text-xs {{ $vendor->business_name ? 'text-gray-600 font-medium' : 'text-gray-300' }}">
                                    {{ $vendor->business_name ?? '—' }}
                                </span>
                            </td>
                            <td class="px-8 py-5">
                                <x-admin.status-badge :status="$vendor->status->value" />
                            </td>
                            <td class="px-8 py-5">
                                <span class="text-xs {{ $vendor->rejected_reason ? 'text-gray-600' : 'text-gray-300' }}">
                                    {{ $vendor->rejected_reason ?? '—' }}
                                </span>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <div class="flex items-center justify-end gap-3 text-xs">
                                    @if($vendor->status->value === 'approved')
                                        <button wire:click="confirmRevoke({{ $vendor->id }})" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#fff8ed] border border-[#ffedd5] text-[#f59e0b] rounded-xl font-bold hover:bg-[#ffedd5] transition-all">
                                            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            Revoke
                                        </button>
                                    @elseif($vendor->status->value === 'pending')
                                        <button wire:click="confirmApprove({{ $vendor->id }})" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#e8fff3] border border-[#d1fae5] text-[#10b981] rounded-xl font-bold hover:bg-[#d1fae5] transition-all">
                                            Approve
                                        </button>
                                        <button wire:click="confirmReject({{ $vendor->id }})" class="inline-flex items-center gap-2 px-4 py-2.5 border border-red-200 text-red-500 rounded-xl font-bold hover:bg-red-50 transition-all">
                                            Reject
                                        </button>
                                    @endif
                                    
                                    <button wire:click="confirmDelete({{ $vendor->id }})" class="size-10 flex items-center justify-center text-[#ff4d4f] hover:bg-red-50 transition-colors rounded-lg group">
                                        <svg class="size-5 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-24 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="size-16 bg-gray-50 rounded-2xl flex items-center justify-center mb-4">
                                        <svg class="size-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-gray-900 font-medium">Tidak ada vendor ditemukan</h3>
                                    <p class="text-gray-400 text-sm mt-1">Coba ubah kata kunci atau filter pencarian Anda.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($vendors->hasPages())
            <div class="px-8 py-6 border-t border-gray-50 bg-gray-50/20">
                {{ $vendors->links() }}
            </div>
        @endif
    </div>


    <!-- Modals -->
    <x-admin.modal model="confirmingApprove">
        <div class="p-8">
            <h3 class="text-2xl font-serif text-gray-800 mb-2">Setujui Vendor?</h3>
            <p class="text-gray-500 text-sm leading-relaxed mb-8">
                Vendor akan langsung mendapatkan akses ke dashboard dan pengelolaan paket tour.
            </p>

            <div class="flex gap-3 justify-end">
                <button @click="close()" class="px-6 py-3 border border-gray-100 text-gray-600 rounded-2xl font-semibold hover:bg-gray-50 transition-colors">
                    Batal
                </button>
                <button wire:click="approve" class="px-6 py-3 bg-[#10b981] text-white rounded-2xl font-semibold hover:bg-[#059669] transition-colors shadow-lg shadow-emerald-100">
                    Ya, Setujui
                </button>
            </div>
        </div>
    </x-admin.modal>

    <x-admin.modal model="confirmingReject">
        <div class="p-8">
            <h3 class="text-2xl font-serif text-gray-800 mb-2">Tolak Vendor?</h3>
            <p class="text-gray-500 text-sm leading-relaxed mb-4">
                Berikan alasan penolakan agar vendor tahu data yang harus diperbaiki.
            </p>

            <textarea wire:model="rejectReason" class="w-full rounded-2xl border-gray-200 text-sm p-4 h-32 mb-2 focus:ring-red-500 focus:border-red-500" placeholder="Contoh: data rekening belum lengkap."></textarea>
            @error('rejectReason') <p class="text-xs text-red-500 mb-6">{{ $message }}</p> @enderror

            <div class="flex gap-3 justify-end">
                <button @click="close()" class="px-6 py-3 border border-gray-100 text-gray-600 rounded-2xl font-semibold hover:bg-gray-50 transition-colors">
                    Batal
                </button>
                <button wire:click="reject" class="px-6 py-3 bg-red-500 text-white rounded-2xl font-semibold hover:bg-red-600 transition-colors shadow-lg shadow-red-100">
                    Ya, Tolak
                </button>
            </div>
        </div>
    </x-admin.modal>

    <x-admin.modal model="confirmingRevoke">
        <div class="p-8">
            <h3 class="text-2xl font-serif text-gray-800 mb-2">Revoke Akses Vendor?</h3>
            <p class="text-gray-500 text-sm leading-relaxed mb-8">
                Akses vendor akan dicabut. Vendor tidak bisa mengelola paket tour.
            </p>
            
            <div class="flex gap-3 justify-end">
                <button @click="close()" class="px-6 py-3 border border-gray-100 text-gray-600 rounded-2xl font-semibold hover:bg-gray-50 transition-colors">
                    Batal
                </button>
                <button wire:click="revoke" class="px-6 py-3 bg-[#FF9F43] text-white rounded-2xl font-semibold hover:bg-orange-500 transition-colors shadow-lg shadow-orange-200">
                    Ya, Revoke
                </button>
            </div>
        </div>
    </x-admin.modal>

    <x-admin.modal model="confirmingDelete">
        <div class="p-8">
            <h3 class="text-2xl font-serif text-gray-800 mb-2">Hapus Akun?</h3>
            <p class="text-gray-500 text-sm leading-relaxed mb-8">
                Akun vendor akan dihapus permanen. Seluruh data vendor dan paket tournya akan ikut terhapus.
            </p>
            
            <div class="flex gap-3 justify-end">
                <button @click="close()" class="px-6 py-3 border border-gray-100 text-gray-600 rounded-2xl font-semibold hover:bg-gray-50 transition-colors">
                    Batal
                </button>
                <button wire:click="delete" class="px-6 py-3 bg-red-500 text-white rounded-2xl font-semibold hover:bg-red-600 transition-colors shadow-lg shadow-red-200">
                    Ya, Hapus Permanen
                </button>
            </div>
        </div>
    </x-admin.modal>
</div>
