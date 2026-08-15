<x-layouts.vendor :title="'Vendor Profile'">
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

    <div class="space-y-4" x-data="{
        editMode: false,
        avatarPreview: null,
        showAvatarPreview(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.avatarPreview = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    }">
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="flex items-start gap-3 bg-green-50 border border-green-200 rounded-xl px-4 py-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle w-5 h-5 text-green-600 shrink-0 mt-0.5">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <path d="m9 11 3 3L22 4"></path>
                </svg>
                <p class="text-sm text-green-700">{{ session('success') }}</p>
            </div>
        @endif

        @if($errors->any())
            <div class="flex items-start gap-3 bg-red-50 border border-red-200 rounded-xl px-4 py-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-alert-circle w-5 h-5 text-red-600 shrink-0 mt-0.5">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" x2="12" y1="8" y2="12"></line>
                    <line x1="12" x2="12.01" y1="16" y2="16"></line>
                </svg>
                <div>
                    @foreach($errors->all() as $error)
                        <p class="text-sm text-red-700">{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        @endif

        <div>
            <h2 class="text-gray-800">Profil Vendor</h2>
            <p x-text="editMode ? 'Mode edit aktif — simpan perubahan Anda' : 'Informasi akun dan identitas vendor'"
                class="text-xs text-gray-400 mt-0.5"></p>
        </div>

        <!-- View Mode -->
        <div x-show="!editMode" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="relative px-6 pt-6 pb-5 border-b border-gray-100 bg-linear-to-br from-amber-50/60 to-white">
                <div class="flex items-start gap-5">
                    <div class="relative shrink-0">
                        <div class="w-20 h-20 rounded-2xl overflow-hidden border-2 border-amber-200 shadow-md">
                            @if($user->hasAvatar())
                                <img src="{{ $user->getAvatarUrl() }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-linear-to-br from-[#b8860b] to-amber-400 flex items-center justify-center text-white text-3xl">
                                    {{ $user->initials() }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="flex-1 min-w-0 pt-1">
                        <p class="text-gray-900 truncate">{{ $user->name }}</p>
                        <p class="text-xs text-gray-400 mt-0.5 truncate">{{ $user->email }}</p>
                        <div
                            class="flex items-center gap-1.5 mt-2 bg-amber-50 border border-amber-200 text-amber-700 text-[11px] px-2.5 py-0.5 rounded-full w-fit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-circle-check-big w-3 h-3">
                                <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                                <path d="m9 11 3 3L22 4"></path>
                            </svg> Verified Vendor
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-6 grid sm:grid-cols-2 gap-6">
                <div>
                    <label class="text-[10px] text-gray-400 uppercase tracking-wider flex items-center gap-1.5 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone w-3 h-3"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                         Nomor Telepon
                    </label>
                    <p class="text-sm text-gray-500 bg-gray-50 rounded-xl px-3 py-2.5">{{ $user->phone ?? 'Belum diisi' }}</p>
                </div>
                <div><label
                        class="text-[10px] text-gray-400 uppercase tracking-wider flex items-center gap-1.5 mb-2"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-user w-3 h-3">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg> Email</label>
                    <p class="text-sm text-gray-500 bg-gray-50 rounded-xl px-3 py-2.5 truncate">{{ $user->email }}</p>
                </div>
                <div class="sm:col-span-2"><label
                        class="text-[10px] text-gray-400 uppercase tracking-wider flex items-center gap-1.5 mb-2"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-building2 lucide-building-2 w-3 h-3">
                            <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path>
                            <path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"></path>
                            <path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"></path>
                            <path d="M10 6h4"></path>
                            <path d="M10 10h4"></path>
                            <path d="M10 14h4"></path>
                            <path d="M10 18h4"></path>
                        </svg> Deskripsi Vendor</label>
                    <p class="text-sm text-gray-500 bg-gray-50 rounded-xl px-3 py-2.5 min-h-[80px] leading-relaxed whitespace-pre-wrap">{{ $vendorProfile->business_description ?? 'Belum diisi' }}</p>
                </div>
            </div>
            <div class="flex items-center justify-between px-6 pb-5">
                <p class="text-xs text-gray-400">Klik "Edit Profil" untuk mengubah informasi akun Anda.</p>
                <button x-show="!editMode" @click="editMode = true"
                class="flex items-center gap-2 px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm rounded-xl transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-pen w-3.5 h-3.5">
                    <path
                        d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z">
                    </path>
                </svg>
                Edit Profil
            </button>
            </div>
        </div>

        <!-- Edit Mode -->
        <form x-show="editMode" action="{{ route('vendor.profile.update') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            @csrf
            @method('PUT')
            
            <div class="relative px-6 pt-6 pb-5 border-b border-gray-100 bg-linear-to-br from-amber-50/60 to-white">
                <div class="flex items-start gap-5">
                    <div class="relative shrink-0">
                        <div x-show="!avatarPreview" class="w-20 h-20 rounded-2xl overflow-hidden border-2 border-amber-200 shadow-md">
                            <div class="w-full h-full bg-linear-to-br from-[#b8860b] to-amber-400 flex items-center justify-center text-white text-3xl">
                                {{ $user->initials() }}
                            </div>
                        </div>
                        <div x-show="avatarPreview" class="w-20 h-20 rounded-2xl overflow-hidden border-2 border-amber-200 shadow-md">
                            <img :src="avatarPreview" alt="Preview" class="w-full h-full object-cover">
                        </div>
                        <button type="button" onclick="document.getElementById('avatar-input').click()" class="absolute -bottom-2 -right-2 w-8 h-8 bg-amber-500 hover:bg-amber-600 text-white rounded-full flex items-center justify-center shadow-lg transition" title="Ganti foto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-camera w-3.5 h-3.5"><path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"></path><circle cx="12" cy="13" r="3"></circle></svg>
                        </button>
                        <input type="file" id="avatar-input" name="avatar" accept="image/*" class="hidden" @change="showAvatarPreview($event)">
                    </div>
                    <div class="flex-1 min-w-0 pt-1">
                        <div class="space-y-2">
                            <div>
                                <label class="text-[10px] text-gray-400 uppercase tracking-wider">Nama Tampilan</label>
                                <input name="name" placeholder="Nama lengkap" class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm outline-none focus:border-amber-400 transition mt-1" value="{{ old('name', $user->name) }}" required>
                            </div>
                            <div>
                                <label class="text-[10px] text-gray-400 uppercase tracking-wider">Nama Vendor / Bisnis</label>
                                <input name="business_name" placeholder="Nama bisnis/agen travel" class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm outline-none focus:border-amber-400 transition mt-1" value="{{ old('business_name', $vendorProfile->business_name) }}" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-6 grid sm:grid-cols-2 gap-6">
                <div><label
                        class="text-[10px] text-gray-400 uppercase tracking-wider flex items-center gap-1.5 mb-2"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-phone w-3 h-3">
                            <path
                                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                            </path>
                        </svg> Nomor Telepon</label>
                        <input name="phone" placeholder="+62 812 3456 7890" type="tel" class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm outline-none focus:border-amber-400 transition" value="{{ old('phone', $user->phone) }}" required>
                    </div>
                <div>
                    <label class="text-[10px] text-gray-400 uppercase tracking-wider flex items-center gap-1.5 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user w-3 h-3"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                         Email
                    </label>
                    <p class="text-sm text-gray-500 bg-gray-50 rounded-xl px-3 py-2.5 truncate">{{ $user->email }}</p>
                </div>
                <div class="sm:col-span-2">
                    <label class="text-[10px] text-gray-400 uppercase tracking-wider flex items-center gap-1.5 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-building2 lucide-building-2 w-3 h-3"><path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"></path><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"></path><path d="M10 6h4"></path><path d="M10 10h4"></path><path d="M10 14h4"></path><path d="M10 18h4"></path></svg>
                         Deskripsi Vendor
                    </label>
                    <textarea name="business_description" rows="4" placeholder="Ceritakan tentang bisnis/layanan Anda..." class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm outline-none focus:border-amber-400 transition resize-none" required>{{ old('business_description', $vendorProfile->business_description) }}</textarea>
                </div>
            </div>
            
            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-3 px-6 py-4 border-t border-gray-100 bg-gray-50">
                <button type="button" @click="editMode = false; avatarPreview = null"
                    class="px-4 py-2 border bg-white border-gray-200 text-gray-600 text-sm rounded-xl hover:bg-gray-50 transition">
                    Batal
                </button>
                <button type="submit"
                    class="flex items-center gap-2 px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm rounded-xl transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-check w-4 h-4">
                        <path d="M20 6 9 17l-5-5"></path>
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-layouts.vendor>