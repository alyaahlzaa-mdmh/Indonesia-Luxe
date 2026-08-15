<x-layouts.site :title="__('Dashboard')" :fullWidth="true" :session="false">
    <div class="bg-gray-50 pb-20"
        x-data="{
            editMode: {{ $errors->any() ? 'true' : 'false' }},
            avatarPreview: '{{ $user->avatar ? Storage::url($user->avatar) : '' }}',
            handleAvatarChange(event) {
                const file = event.target.files[0];
                if (file) {
                    this.avatarPreview = URL.createObjectURL(file);
                }
            }
        }">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @if(session('status'))
            <div class="fixed top-24 left-1/2 -translate-x-1/2 z-50 bg-green-500 text-white text-sm px-5 py-2.5 rounded-full shadow-lg flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check w-4 h-4">
                    <path d="M20 6 9 17l-5-5"></path>
                </svg>
                {{ session('status') }}
            </div>
            @endif

            <div class="sticky top-16 z-30 bg-white border-b border-gray-100">
                <div class="max-w-2xl mx-auto px-4">
                    <div class="flex items-center justify-between h-14">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('profile.index') }}" class="p-2 -ml-2 hover:bg-gray-50 rounded-full transition">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left w-5 h-5 text-gray-700">
                                    <path d="m15 18-6-6 6-6"></path>
                                </svg>
                            </a>
                            <h1 class="text-gray-900 text-base font-semibold">{{ __('profile.my_profile') }}</h1>
                        </div>
                        <button type="button" @click="editMode = !editMode" class="flex items-center gap-1.5 text-sm text-amber-500 hover:text-amber-600 bg-amber-50 hover:bg-amber-100 px-3 py-1.5 rounded-full transition cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil w-3.5 h-3.5" x-show="!editMode">
                                <path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"></path>
                                <path d="m15 5 4 4"></path>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-icon lucide-x w-3.5 h-3.5" x-show="editMode">
                                <path d="M18 6 6 18" />
                                <path d="m6 6 12 12" />
                            </svg>
                            <span x-text="editMode ? '{{ __('profile.cancel') }}' : '{{ __('profile.edit') }}'">{{ __('profile.edit') }}</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="max-w-2xl mx-auto py-6 px-4">
                <div class="flex flex-col items-center mb-8">
                    <div class="relative group">
                        <div class="w-24 h-24 rounded-full overflow-hidden bg-amber-100 border-4 border-white shadow-md flex items-center justify-center relative">
                            <template x-if="avatarPreview">
                                <img :src="avatarPreview" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!avatarPreview">
                                <span class="text-amber-500 text-3xl font-bold uppercase">{{ $user->initials() }}</span>
                            </template>

                            <div x-show="editMode" class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-camera w-6 h-6 text-white">
                                    <path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"></path>
                                    <circle cx="12" cy="13" r="3"></circle>
                                </svg>
                            </div>
                        </div>
                        <button type="button" x-show="editMode" @click="$refs.avatarInput.click()" class="absolute -bottom-1 -right-1 bg-amber-500 text-white p-2 rounded-full shadow-lg hover:bg-amber-600 transition cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil w-3.5 h-3.5">
                                <path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"></path>
                                <path d="m15 5 4 4"></path>
                            </svg>
                        </button>
                    </div>
                    <input type="file" x-ref="avatarInput" name="avatar" accept="image/*" class="hidden" @change="handleAvatarChange">
                    @error('avatar') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                </div>

                <div x-show="!editMode" class="bg-white rounded-2xl shadow-sm border border-gray-100 px-5 pt-2 pb-1 space-y-1" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-0" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95">
                    <div class="flex items-center gap-4 py-4 border-b border-gray-50 last:border-0">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user w-5 h-5 text-amber-500">
                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[11px] font-medium text-gray-400 uppercase tracking-wider mb-1">{{ __('profile.full_name') }}</p>
                            <p class="text-sm text-gray-900 font-light">{{ $user->title }}. <span class="font-semibold">{{ $user->name }}</span></p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 py-4 border-b border-gray-50 last:border-0">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-5 h-5 text-amber-500">
                                <path d="M8 2v4" />
                                <path d="M16 2v4" />
                                <rect width="18" height="18" x="3" y="4" rx="2" />
                                <path d="M3 10h18" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[11px] font-medium text-gray-400 uppercase tracking-wider mb-1">{{ __('profile.date_of_birth') }}</p>
                            <p class="text-sm font-semibold text-gray-900">
                                @if($user->date_of_birth)
                                {{ $user->date_of_birth->translatedFormat('d F Y') }}
                                @else
                                <span class="text-gray-300 italic">{{ __('profile.not_filled') }}</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 py-4 border-b border-gray-50 last:border-0">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-globe w-5 h-5 text-amber-500">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"></path>
                                <path d="M2 12h20"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[11px] font-medium text-gray-400 uppercase tracking-wider mb-1">{{ __('profile.country') }}</p>
                            @if($user->country)
                            <p class="text-sm font-semibold text-gray-900">{{ $user->country }}</p>
                            @else
                            <span class="text-sm text-gray-300 italic">{{ __('profile.not_filled') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div x-show="editMode" class="bg-white rounded-2xl shadow-sm border border-orange-100 p-6 flex flex-col gap-6" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-0" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="md:col-span-1">
                            <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1.5 block">{{ __('profile.title') }}</label>
                            <div class="relative">
                                <select name="title" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-400 appearance-none bg-white transition">
                                    <option value="">{{ __('profile.select') }}</option>
                                    <option value="Mr" {{ old('title', $user->title) == 'Mr' ? 'selected' : '' }}>Mr</option>
                                    <option value="Mrs" {{ old('title', $user->title) == 'Mrs' ? 'selected' : '' }}>Mrs</option>
                                    <option value="Ms" {{ old('title', $user->title) == 'Ms' ? 'selected' : '' }}>Ms</option>
                                    <option value="Mx" {{ old('title', $user->title) == 'Mx' ? 'selected' : '' }}>Mx</option>
                                    <option value="Dr" {{ old('title', $user->title) == 'Dr' ? 'selected' : '' }}>Dr</option>
                                </select>
                                <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down w-4 h-4">
                                        <path d="m6 9 6 6 6-6" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="md:col-span-3">
                            <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1.5 block">{{ __('profile.full_name') }}</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-400 bg-white transition" placeholder="Contoh: John Doe">
                            @error('name') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1.5 block">{{ __('profile.date_of_birth') }}</label>
                        <div class="grid grid-cols-3 gap-3">
                            <div class="relative">
                                <select name="dob_day" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-400 appearance-none bg-white transition">
                                    <option value="">{{ __('profile.day') }}</option>
                                    @for($i = 1; $i <= 31; $i++)
                                        @php $day=sprintf('%02d', $i); @endphp
                                        <option value="{{ $day }}" {{ old('dob_day', $user->date_of_birth?->format('d')) == $day ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                </select>
                                <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down w-3.5 h-3.5">
                                        <path d="m6 9 6 6 6-6" />
                                    </svg>
                                </div>
                            </div>
                            <div class="relative">
                                <select name="dob_month" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-400 appearance-none bg-white transition">
                                    <option value="">{{ __('profile.month') }}</option>
                                    @php
                                    $months = [
                                    '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
                                    '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
                                    '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                                    ];
                                    @endphp
                                    @foreach($months as $num => $name)
                                    <option value="{{ $num }}" {{ old('dob_month', $user->date_of_birth?->format('m')) == $num ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down w-3.5 h-3.5">
                                        <path d="m6 9 6 6 6-6" />
                                    </svg>
                                </div>
                            </div>
                            <div class="relative">
                                <select name="dob_year" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-400 appearance-none bg-white transition">
                                    <option value="">{{ __('profile.year') }}</option>
                                    @for($i = date('Y'); $i >= 1930; $i--)
                                    <option value="{{ $i }}" {{ old('dob_year', $user->date_of_birth?->format('Y')) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down w-3.5 h-3.5">
                                        <path d="m6 9 6 6 6-6" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1.5 block">{{ __('profile.country') }}</label>
                        <div class="relative">
                            <select name="country" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-400 appearance-none bg-white transition">
                                <option value="">{{ __('profile.select_country') }}</option>
                                @php
                                $countries = ['Australia', 'France', 'Germany', 'India', 'Indonesia', 'Japan', 'Malaysia', 'Netherlands', 'Philippines', 'Singapore', 'South Korea', 'Thailand', 'United Kingdom', 'United States', 'Vietnam'];
                                @endphp
                                @foreach($countries as $country)
                                <option value="{{ $country }}" {{ old('country', $user->country) == $country ? 'selected' : '' }}>{{ $country }}</option>
                                @endforeach
                            </select>
                            <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down w-4 h-4">
                                    <path d="m6 9 6 6 6-6"></path>
                                </svg>
                            </div>
                        </div>
                        @error('country') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>

                </div>
            </div>

            <div class="max-w-2xl mx-auto mt-8 px-4">
                <button type="button" x-show="!editMode" @click="editMode = true" class="w-full bg-white flex items-center justify-center gap-3 border-2 border-amber-400 text-amber-500 font-bold hover:bg-amber-50 rounded-2xl py-4 text-sm transition active:scale-[0.98] shadow-sm cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil w-4 h-4">
                        <path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"></path>
                        <path d="m15 5 4 4"></path>
                    </svg>
                    {{ __('profile.edit_profile') }}
                </button>
                <div x-show="editMode" class="flex flex-col sm:flex-row gap-4" x-transition>
                    <button type="button" @click="editMode = false" class="flex-1 bg-white border border-gray-200 text-gray-600 font-semibold hover:bg-gray-50 rounded-2xl py-4 text-sm transition active:scale-[0.98] cursor-pointer">{{ __('profile.cancel') }}</button>
                    <button type="submit" class="flex-2 flex items-center justify-center gap-2 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-2xl py-4 text-sm transition active:scale-[0.98] shadow-md shadow-amber-200 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/center" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save w-4 h-4">
                            <path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"></path>
                            <path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"></path>
                            <path d="M7 3v4a1 1 0 0 0 1 1h7"></path>
                        </svg>
                        {{ __('profile.save_changes') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-layouts.site>