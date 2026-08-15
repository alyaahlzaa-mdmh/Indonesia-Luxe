<div class="min-h-screen bg-gray-50"
  x-data="{ 
        showToast: false, 
        showCopyToast: false, 
        toastMessage: '',
        previewSrc: null,
        fileName: '',
        selectFile(event) {
            const file = event.target.files[0];
            if (!file) return;
            this.fileName = file.name;
            const isImage = file.type.startsWith('image/');
            if (isImage) {
                const reader = new FileReader();
                reader.onload = (e) => { this.previewSrc = e.target.result; };
                reader.readAsDataURL(file);
            } else {
                this.previewSrc = null;
            }
        },
        removeFile() {
            this.previewSrc = null;
            this.fileName = '';
            if (this.$refs.proofFileInput) {
                this.$refs.proofFileInput.value = '';
            }
            this.$wire.removeProof();
        },
        init() {
            window.addEventListener('toast', (event) => {
                this.toastMessage = event.detail?.message ?? event.detail ?? '';
                this.showToast = true;
                setTimeout(() => { this.showToast = false; }, 5000);
            });
            window.addEventListener('open-whatsapp', (event) => {
                const url = event.detail?.url ?? event.detail;
                if (url) window.open(url, '_blank');
            });
        }
    }">

  <!-- Hidden File Input for Payment Proof -->
  <input
    type="file"
    wire:model="proof"
    x-ref="proofFileInput"
    accept="image/*,application/pdf"
    class="hidden"
    @change="selectFile($event)">

  <!-- Toast Notification -->
  <div x-show="showToast"
    x-transition:enter="transition ease-out duration-300 transform"
    x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
    x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed top-5 right-5 z-50 max-w-sm w-full bg-white shadow-2xl rounded-2xl border border-green-100 p-4 flex items-start gap-4"
    style="display: none;">
    <div class="w-10 h-10 bg-green-50 rounded-full flex items-center justify-center shrink-0">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check w-5 h-5 text-green-500">
        <path d="M20 6 9 17l-5-5"></path>
      </svg>
    </div>
    <div class="flex-1">
      <p class="text-sm font-semibold text-gray-900">{{ __('checkout.booking_success') }}</p>
      <p class="text-xs text-gray-500 mt-0.5" x-text="toastMessage"></p>
    </div>
    <button @click="showToast = false" class="text-gray-400 hover:text-gray-600">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x w-4 h-4">
        <path d="M18 6 6 18"></path>
        <path d="m6 6 12 12"></path>
      </svg>
    </button>
  </div>

  <div class="max-w-2xl mx-auto lg:px-4 py-8">
    <!-- Progress Steps -->
    <div class="flex items-center justify-center mb-8 gap-0">
      <div class="flex items-center">
        <div class="flex flex-col items-center gap-1">
          <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm transition-all {{ $step == 1 ? 'bg-amber-500 text-white shadow-md' : 'bg-green-500 text-white' }}">
            @if($step > 1)
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check w-4 h-4">
              <path d="M20 6 9 17l-5-5"></path>
            </svg>
            @else
            1
            @endif
          </div>
          <span class="text-xs {{ $step == 1 ? 'text-amber-600' : 'text-gray-400' }} hidden sm:block">{{ __('checkout.step_1') }}</span>
        </div>
        <div class="w-12 md:w-20 h-0.5 mx-1 mb-4 transition-colors {{ $step > 1 ? 'bg-green-500' : 'bg-gray-200' }}"></div>
      </div>
      <div class="flex items-center">
        <div class="flex flex-col items-center gap-1">
          <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm transition-all {{ $step == 2 ? 'bg-amber-500 text-white shadow-md' : ($step > 2 ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-500') }}">
            @if($step > 2)
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check w-4 h-4">
              <path d="M20 6 9 17l-5-5"></path>
            </svg>
            @else
            2
            @endif
          </div>
          <span class="text-xs {{ $step == 2 ? 'text-amber-600' : 'text-gray-400' }} hidden sm:block">{{ __('checkout.step_2') }}</span>
        </div>
        <div class="w-12 md:w-20 h-0.5 mx-1 mb-4 transition-colors {{ $step > 2 ? 'bg-green-500' : 'bg-gray-200' }}"></div>
      </div>
      <div class="flex items-center">
        <div class="flex flex-col items-center gap-1">
          <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm transition-all {{ $step == 3 ? 'bg-amber-500 text-white shadow-md' : 'bg-gray-200 text-gray-500' }}">3</div>
          <span class="text-xs {{ $step == 3 ? 'text-amber-600' : 'text-gray-400' }} hidden sm:block">{{ __('checkout.step_3') }}</span>
        </div>
      </div>
    </div>

    @if($step === 1)
    <!-- STEP 1 -->
    <div class="space-y-4" wire:key="step-1">
      <a href="{{ route('cart.index') }}" class="flex items-center gap-1.5 text-gray-500 hover:text-gray-700 text-sm transition mb-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left w-4 h-4">
          <path d="m12 19-7-7 7-7"></path>
          <path d="M19 12H5"></path>
        </svg>
        {{ __('checkout.back_to_cart') }}
      </a>

      <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <div class="flex items-center gap-2 mb-4">
          <div class="w-8 h-8 bg-amber-50 rounded-lg flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user w-4 h-4 text-amber-500">
              <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
              <circle cx="12" cy="7" r="4"></circle>
            </svg>
          </div>
          <h3 class="text-gray-900">{{ __('checkout.step_1') }}</h3>
        </div>
        <div class="space-y-4">
          <div>
            <label class="text-sm text-gray-600 block mb-1.5">{{ __('checkout.full_name') }} <span class="text-red-400">*</span></label>
            <input type="text" wire:model="name" value="{{ $name }}" placeholder="{{ __('checkout.name_placeholder') }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-100 transition bg-white">
            @error('name') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
          </div>
          <div>
            <label class="text-sm text-gray-600 block mb-1.5">{{ __('checkout.email') }} <span class="text-red-400">*</span></label>
            <input type="email" wire:model="email" value="{{ $email }}" placeholder="{{ __('checkout.email_placeholder') }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-100 transition bg-white">
            @error('email') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
          </div>
          <div>
            <label class="text-sm text-gray-600 block mb-1.5">{{ __('checkout.phone') }} <span class="text-red-400">*</span></label>
            <div class="flex gap-2">
              <span class="flex items-center px-3 border border-gray-200 rounded-xl bg-gray-50 text-sm text-gray-500 shrink-0">+62</span>
              <input type="tel" wire:model="phone" value="{{ $phone }}" placeholder="{{ __('checkout.phone_placeholder') }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-100 transition bg-white">
            </div>
            <p class="text-xs text-gray-400 mt-1">{{ __('checkout.phone_note') }}</p>
            @error('phone') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
          </div>
          <div>
            <label class="text-sm text-gray-600 block mb-1.5">{{ __('checkout.note') }}</label>
            <textarea wire:model="note" placeholder="{{ __('checkout.note_placeholder') }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-100 transition bg-white resize-none" rows="3"></textarea>
            @error('note') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
          </div>
        </div>
      </div>

      <!-- Titik Jemput -->
      @php $anyPickup = false; @endphp
      @foreach($selectedItems as $item)
      @php
      $isAdminPackage = $item->tourPackage->vendor?->isAdmin();
      $hasPickupPoints = $item->tourPackage->pickupPoints->count() > 0;
      if($isAdminPackage || $hasPickupPoints) $anyPickup = true;
      @endphp

      @if($isAdminPackage || $hasPickupPoints)
      <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-sm border border-blue-100 mb-4" wire:key="pickup-{{ $item->id }}">
        <div class="flex items-center gap-3 mb-4">
          <div class="w-8 h-8 sm:w-9 sm:h-9 bg-amber-50 rounded-xl flex items-center justify-center shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin w-4 h-4 sm:w-5 sm:h-5 text-amber-500">
              <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path>
              <circle cx="12" cy="10" r="3"></circle>
            </svg>
          </div>
          <div class="min-w-0 pt-0.5">
            <h3 class="text-gray-900 font-bold text-[13px] sm:text-sm leading-tight">
              {{ __('checkout.pickup_point_prefix') }}
              <span class="font-normal text-gray-500 block mt-0.5 sm:inline sm:mt-0">{{ Str::limit($item->tourPackage->title, 50) }}</span>
            </h3>
          </div>
        </div>

        <div class="space-y-4">
          @if($isAdminPackage)
          <div class="space-y-2">
            <div class="relative group">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-blue-400 pointer-events-none z-10">
                <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path>
                <circle cx="12" cy="10" r="3"></circle>
              </svg>
              <input type="text" wire:model.live="pickupPoints.{{ $item->id }}" placeholder="{{ __('checkout.pickup_placeholder') }}" class="w-full border border-blue-100 rounded-xl pl-10 pr-4 py-3 text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-50 transition bg-gray-50/50 focus:bg-white placeholder:text-gray-400">
            </div>
          </div>
          @else
          <div class="space-y-2">
            <div class="relative group">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-blue-400 pointer-events-none z-10">
                <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path>
                <circle cx="12" cy="10" r="3"></circle>
              </svg>
              <select wire:model.live="pickupPoints.{{ $item->id }}" class="w-full border border-blue-100 rounded-xl pl-10 pr-10 py-3 text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-50 transition bg-gray-50/50 focus:bg-white appearance-none cursor-pointer text-gray-800">
                <option value="">{{ __('checkout.select_pickup') }}</option>
                @foreach ($item->tourPackage->pickupPoints as $point)
                <option value="{{ $point->location_name }}">{{ $point->location_name }}</option>
                @endforeach
              </select>
              <svg class="absolute right-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-blue-300 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </div>
          </div>
          @endif

          @if(isset($pickupPoints[$item->id]) && $pickupPoints[$item->id])
          <div class="flex items-center gap-1.5 pl-1.5 py-1">
            <div class="w-4 h-4 rounded-full bg-blue-100 flex items-center justify-center shrink-0">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check w-2.5 h-2.5 text-blue-600">
                <path d="M20 6 9 17l-5-5"></path>
              </svg>
            </div>
            <p class="text-[11px] text-blue-600 leading-tight">
              {{ __('checkout.selected_pickup_confirm') }} <span class="font-bold">{{ $pickupPoints[$item->id] }}</span>
            </p>
          </div>
          @endif
        </div>
      </div>
      @endif
      @endforeach

      @if($anyPickup)
      <div class="bg-blue-50 border border-blue-100 rounded-2xl p-4 flex items-start gap-3 mb-8">
        <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center shrink-0 shadow-sm border border-blue-100/50 text-base">🚐</div>
        <p class="text-[11px] sm:text-xs text-blue-600 leading-relaxed">
          <span class="font-bold uppercase tracking-wider text-[10px]">{{ __('checkout.pickup_service_title') }}</span> — {{ __('checkout.pickup_service_desc') }}
        </p>
      </div>
      @endif

      <!-- Informasi Transfer -->
      <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <div class="flex items-center gap-2 mb-4">
          <div class="w-8 h-8 bg-amber-50 rounded-lg flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-building2 w-4 h-4 text-amber-500">
              <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path>
              <path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"></path>
              <path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"></path>
              <path d="M10 6h4"></path>
              <path d="M10 10h4"></path>
              <path d="M10 14h4"></path>
              <path d="M10 18h4"></path>
            </svg>
          </div>
          <h3 class="text-gray-900">{{ __('checkout.transfer_info') }}</h3>
        </div>
        <p class="text-xs text-gray-500 mb-4">{{ __('checkout.transfer_desc') }}</p>
        <div class="space-y-3">
          <div class="border rounded-xl p-4 bg-yellow-50 border-yellow-200">
            <div class="flex items-center gap-2 mb-2.5">
              <span class="text-[11px] px-2.5 py-0.5 rounded-full text-white bg-yellow-500">Bank Mandiri</span>
            </div>
            <div class="flex items-center justify-between gap-3">
              <div class="min-w-0">
                <p class="text-xl tracking-widest font-mono text-yellow-800">1310 0074 31390</p>
                <p class="text-xs text-gray-500 mt-0.5">{{ __('checkout.acc_holder') }} <span class="text-gray-700">Alina Saidja Putri</span></p>
              </div>
              <button type="button"
                @click="navigator.clipboard.writeText('1310007431390'); showCopyToast = true; setTimeout(() => showCopyToast = false, 3000)"
                class="shrink-0 flex items-center gap-1.5 text-xs text-yellow-800 bg-white/70 hover:bg-white border border-current/20 rounded-lg px-3 py-1.5 transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-copy w-3.5 h-3.5">
                  <rect width="14" height="14" x="8" y="8" rx="2" ry="2"></rect>
                  <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"></path>
                </svg>
                {{ __('checkout.copy') }}
              </button>
            </div>
          </div>
        </div>
        <div class="mt-3 bg-amber-50 border border-amber-100 rounded-xl px-4 py-3 flex items-start gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-alert w-4 h-4 text-amber-500 shrink-0 mt-0.5">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" x2="12" y1="8" y2="12"></line>
            <line x1="12" x2="12.01" y1="16" y2="16"></line>
          </svg>
          <p class="text-xs text-amber-700 leading-relaxed">{{ __('checkout.transfer_warning') }}</p>
        </div>
      </div>

      <!-- Upload Bukti Transfer -->
      <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">

        <div class="flex items-center gap-2 mb-4">
          <div class="w-8 h-8 bg-amber-50 rounded-lg flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-banknote-icon lucide-banknote w-4 h-4 text-amber-500">
              <rect width="20" height="12" x="2" y="6" rx="2" />
              <circle cx="12" cy="12" r="2" />
              <path d="M6 12h.01M18 12h.01" />
            </svg>
          </div>
          <h3 class="text-gray-900">{{ __('checkout.payment') }}</h3>
        </div>

        <div class="flex flex-col gap-4">
          <!-- PAYMENT PROOF INPUT -->
          <div>
            <label class="text-sm text-gray-600 block mb-1.5">{{ __('checkout.payment_proof') }} <span class="text-red-400">*</span></label>
            <div
              @click="$refs.proofFileInput.click()"
              :class="previewSrc == null ? 'border-2 border-dashed border-gray-200 p-8' : 'border border-green-200 bg-green-50 p-0'" class="rounded-xl text-center cursor-pointer transition hover:border-amber-300 hover:bg-amber-50/30 select-none">

              {{-- Image preview --}}
              <template x-if="previewSrc">
                <div class="relative">
                  <img :src="previewSrc" class="w-full max-h-64 object-contain" alt="Preview">
                  <div class="absolute top-2 right-2 bg-green-500 text-white rounded-full p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check w-4 h-4">
                      <circle cx="12" cy="12" r="10"></circle>
                      <path d="m9 12 2 2 4-4"></path>
                    </svg>
                  </div>
                </div>
              </template>

              {{-- PDF / non-image preview --}}
              <template x-if="!previewSrc && fileName">
                <div>
                  <div class="w-16 h-16 bg-red-50 rounded-xl flex items-center justify-center mx-auto mb-3 border border-red-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-red-400">
                      <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path>
                      <polyline points="14 2 14 8 20 8"></polyline>
                    </svg>
                  </div>
                  <p class="text-sm font-medium text-gray-700 mb-0.5" x-text="fileName"></p>
                  <p class="text-xs text-green-600">✓ {{ __('checkout.file_selected') }}</p>
                </div>
              </template>

              {{-- Empty state --}}
              <template x-if="!fileName">
                <div>
                  {{-- Livewire upload spinner --}}
                  <div wire:loading wire:target="proof" class="flex flex-col items-center mb-2">
                    <div class="w-8 h-8 border-2 border-amber-400 border-t-transparent rounded-full animate-spin mx-auto mb-1"></div>
                    <p class="text-xs text-amber-500">{{ __('checkout.upload_server') }}</p>
                  </div>
                  <div wire:loading.remove wire:target="proof">
                    <div class="w-14 h-14 bg-amber-50 rounded-full flex items-center justify-center mx-auto mb-3">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-image w-7 h-7 text-amber-400">
                        <rect width="18" height="18" x="3" y="3" rx="2" ry="2"></rect>
                        <circle cx="9" cy="9" r="2"></circle>
                        <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path>
                      </svg>
                    </div>
                    <p class="text-sm text-gray-500">{{ __('checkout.upload_placeholder') }}</p>
                    <p class="text-xs text-gray-400 mt-2">{{ __('checkout.upload_formats') }}</p>
                  </div>
                </div>
              </template>

            </div>

            @error('proof') <span class="text-xs text-red-500 text-center block mt-2">{{ $message }}</span> @enderror
            <p x-show="previewSrc == null" class="text-xs text-gray-400 text-center mt-2">{{ __('checkout.proof_required') }}</p>
            <div x-show="previewSrc != null" class="flex items-center justify-end mt-2">
              <button @click="removeFile()" class="text-xs text-red-400 hover:text-red-600 transition flex items-center gap-1 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x w-3.5 h-3.5">
                  <path d="M18 6 6 18"></path>
                  <path d="m6 6 12 12"></path>
                </svg> {{ __('checkout.delete') }}
              </button>
            </div>
          </div>

        </div>
      </div>

      <!-- Ringkasan Pesanan -->
      <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <div class="flex items-center gap-2 mb-4">
          <div class="w-8 h-8 bg-amber-50 rounded-lg flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag w-4 h-4 text-amber-500">
              <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path>
              <path d="M3 6h18"></path>
              <path d="M16 10a4 4 0 0 1-8 0"></path>
            </svg>
          </div>
          <h3 class="text-gray-900">{{ __('checkout.order_summary') }} ({{ $selectedItems->count() }} {{ __('checkout.packages') }})</h3>
        </div>
        <div class="space-y-3">
          @foreach($selectedItems as $item)
          <div class="flex gap-3 p-3 bg-gray-50 rounded-xl">
            <img src="{{ Storage::url($item->tourPackage->cover_image_path) }}" alt="{{ $item->tourPackage->title }}" class="w-16 h-16 object-cover rounded-lg shrink-0">
            <div class="flex-1 min-w-0">
              <p class="text-sm text-gray-900 line-clamp-2 leading-snug mb-1">{{ $item->tourPackage->title }}</p>
              <p class="text-xs text-gray-500">📅 {{ $item->slot->departure_date->format('Y-m-d') }} · 👥 {{ $item->quantity }} {{ __('tour_card.person') }}</p>
              <span class="text-[10px] bg-amber-100 text-amber-700 px-2 py-0.5 rounded-full mt-1 inline-block">
                {{ $item->tourPackage->category->name ?? 'Uncategorized' }}
              </span>
            </div>
            <div class="text-right shrink-0">
              <p class="text-sm text-amber-600">Rp {{ number_format($item->line_total, 0, ',', '.') }}</p>
              <p class="text-xs text-gray-400">Rp {{ number_format($item->price_per_person, 0, ',', '.') }}/org</p>
            </div>
          </div>
          @endforeach
        </div>
      </div>

      <!-- Footer Pembayaran -->
      <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
        <div class="space-y-2 mb-3">
          <div class="flex justify-between text-sm text-gray-600">
            <span>{{ __('checkout.subtotal') }} ({{ $selectedItems->count() }} {{ __('checkout.packages') }})</span>
            <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
          </div>
        </div>
        <div class="border-t border-gray-100 pt-3 flex justify-between items-center">
          <span class="text-gray-900 font-medium">{{ __('checkout.total_payment') }}</span>
          <div class="text-right"><span class="text-amber-600 text-lg font-bold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span></div>
        </div>
      </div>

      <button type="button" wire:click="nextStep" wire:loading.attr="disabled" wire:target="nextStep" class="w-full bg-amber-500 hover:bg-amber-600 active:bg-amber-700 disabled:opacity-60 text-white py-4 rounded-2xl transition flex items-center justify-center gap-2 shadow-md cursor-pointer font-semibold">
        <span wire:loading.remove wire:target="nextStep" class="flex items-center gap-2">
          {{ __('checkout.next_step') }}
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-5 h-5">
            <path d="m9 18 6-6-6-6"></path>
          </svg>
        </span>
        <span wire:loading wire:target="nextStep">{{ __('checkout.validating') }}</span>
      </button>
    </div>
    @endif

    @if($step === 2)
    <!-- STEP 2 -->
    <div class="space-y-4" wire:key="step-2">
      <button wire:click="previousStep" class="flex items-center gap-1.5 text-gray-500 hover:text-gray-700 text-sm transition mb-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left w-4 h-4">
          <path d="m12 19-7-7 7-7"></path>
          <path d="M19 12H5"></path>
        </svg>
        {{ __('checkout.change_data') }}
      </button>

      <div class="bg-green-50 border border-green-200 rounded-2xl px-5 py-4 flex items-start gap-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle w-5 h-5 text-green-500 shrink-0 mt-0.5">
          <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"></path>
        </svg>
        <div>
          <p class="text-sm text-green-800 font-medium">{{ __('checkout.wa_confirm_title') }}</p>
          <p class="text-xs text-green-600 mt-0.5">{{ __('checkout.wa_confirm_desc') }}</p>
        </div>
      </div>

      <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
        <div class="flex items-center gap-2 mb-4">
          <div class="w-8 h-8 bg-amber-50 rounded-lg flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user w-4 h-4 text-amber-500">
              <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
              <circle cx="12" cy="7" r="4"></circle>
            </svg>
          </div>
          <h3 class="text-gray-900">{{ __('checkout.step_1') }}</h3>
        </div>
        <div class="space-y-1.5 text-sm">
          <div class="flex items-start gap-3 py-1.5 border-b border-gray-50 last:border-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user w-4 h-4 text-gray-400 shrink-0 mt-0.5">
              <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
              <circle cx="12" cy="7" r="4"></circle>
            </svg>
            <span class="text-gray-400 w-20 shrink-0 text-xs mt-0.5">{{ __('checkout.name') }}</span>
            <span class="text-gray-900 flex-1 leading-snug font-medium">{{ $name }}</span>
          </div>
          <div class="flex items-start gap-3 py-1.5 border-b border-gray-50 last:border-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail w-4 h-4 text-gray-400 shrink-0 mt-0.5">
              <rect width="20" height="16" x="2" y="4" rx="2"></rect>
              <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
            </svg>
            <span class="text-gray-400 w-20 shrink-0 text-xs mt-0.5">Email</span>
            <span class="text-gray-900 flex-1 leading-snug font-medium">{{ $email }}</span>
          </div>
          <div class="flex items-start gap-3 py-1.5 border-b border-gray-50 last:border-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone w-4 h-4 text-gray-400 shrink-0 mt-0.5">
              <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
            </svg>
            <span class="text-gray-400 w-20 shrink-0 text-xs mt-0.5">WhatsApp</span>
            <span class="text-gray-900 flex-1 leading-snug font-medium">+62 {{ $phone }}</span>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
        <div class="flex items-center gap-2 mb-4">
          <div class="w-8 h-8 bg-amber-50 rounded-lg flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-banknote-icon lucide-banknote w-4 h-4 text-amber-500">
              <rect width="20" height="12" x="2" y="6" rx="2" />
              <circle cx="12" cy="12" r="2" />
              <path d="M6 12h.01M18 12h.01" />
            </svg>
          </div>
          <h3 class="text-gray-900">{{ __('checkout.payment') }}</h3>
        </div>
        <div class="space-y-2">
          @if($proof)
          <img src="{{ $proof->temporaryUrl() }}" alt="{{ __('checkout.payment_proof') }}" class="w-full max-h-64 object-contain rounded-xl border border-gray-100 bg-gray-50">
          <p class="text-xs text-green-600 flex items-center gap-1.5">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check w-3.5 h-3.5">
              <circle cx="12" cy="12" r="10"></circle>
              <path d="m9 12 2 2 4-4"></path>
            </svg>
            {{ __('checkout.proof_ready') }}
          </p>
          @else
          <div class="flex items-center gap-3 bg-amber-50 border border-amber-200 rounded-xl p-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-alert w-5 h-5 text-amber-500 shrink-0">
              <circle cx="12" cy="12" r="10"></circle>
              <line x1="12" x2="12" y1="8" y2="12"></line>
              <line x1="12" x2="12.01" y1="16" y2="16"></line>
            </svg>
            <div class="flex-1 min-w-0">
              <p class="text-sm text-amber-800">{{ __('checkout.proof_not_uploaded') }}</p>
              <p class="text-xs text-amber-600 mt-0.5">{{ __('checkout.proof_not_uploaded_desc') }}</p>
            </div>
            <div class="flex flex-col items-center">
              <button
                type="button"
                @click="$refs.proofFileInput.click()"
                wire:loading.remove
                wire:target="proof"
                class="shrink-0 text-xs bg-amber-500 text-white px-3 py-1.5 rounded-lg hover:bg-amber-600 transition cursor-pointer font-medium">
                {{ __('checkout.upload_btn') }}
              </button>
              <div wire:loading wire:target="proof" class="shrink-0">
                <div class="w-5 h-5 border-2 border-amber-500 border-t-transparent rounded-full animate-spin"></div>
              </div>
            </div>
            @error('proof') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
          </div>
          @endif
        </div>
      </div>

      <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
        <div class="flex items-center gap-2 mb-4">
          <div class="w-8 h-8 bg-amber-50 rounded-lg flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag w-4 h-4 text-amber-500">
              <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path>
              <path d="M3 6h18"></path>
              <path d="M16 10a4 4 0 0 1-8 0"></path>
            </svg>
          </div>
          <h3 class="text-gray-900">{{ __('checkout.order_details') }} ({{ $selectedItems->count() }} {{ __('checkout.packages') }})</h3>
        </div>
        <div class="space-y-3">
          @foreach($selectedItems as $item)
          <div class="border border-gray-100 rounded-xl overflow-hidden">
            <div class="flex gap-3 p-3 bg-gray-50">
              <img src="{{ Storage::url($item->tourPackage->cover_image_path) }}" alt="{{ $item->tourPackage->title }}" class="w-14 h-14 object-cover rounded-lg shrink-0">
              <div class="flex-1 min-w-0">
                <p class="text-sm text-gray-900 leading-snug font-medium">{{ $item->tourPackage->title }}</p>
                <span class="text-[10px] bg-amber-100 text-amber-700 px-2 py-0.5 rounded-full mt-1 inline-block">
                  {{ $item->tourPackage->category->name ?? 'Uncategorized' }}
                </span>
              </div>
            </div>
            <div class="px-3 py-2.5 grid grid-cols-2 gap-y-1 text-xs">
              <span class="text-gray-400">📅 {{ __('checkout.date') }}</span>
              <span class="text-gray-800 text-right font-medium">{{ $item->slot->departure_date->format('Y-m-d') }}</span>
              <span class="text-gray-400">👥 {{ __('checkout.participants') }}</span>
              <span class="text-gray-800 text-right font-medium">{{ $item->quantity }} {{ __('tour_card.person') }}</span>
              <span class="text-gray-400">💵 {{ __('checkout.price_per_person') }}</span>
              <span class="text-gray-800 text-right">Rp {{ number_format($item->price_per_person, 0, ',', '.') }}</span>
              <span class="text-gray-400 font-medium">💰 {{ __('checkout.subtotal') }}</span>
              <span class="text-amber-600 text-right font-bold">Rp {{ number_format($item->line_total, 0, ',', '.') }}</span>
              @if($item->pickup_point)
              <span class="text-gray-400 col-span-2 mt-1 pt-1 border-t border-gray-100 flex items-center gap-1">
                📍 <span class="font-medium text-gray-700">{{ __('checkout.selected_pickup_confirm') }} {{ $item->pickup_point }}</span>
              </span>
              @endif
            </div>
          </div>
          @endforeach
        </div>
      </div>

      <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
        <div class="flex items-center gap-2 mb-4">
          <div class="w-8 h-8 bg-amber-50 rounded-lg flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wallet w-4 h-4 text-amber-500">
              <path d="M19 7V4a1 1 0 0 0-1-1H5a2 2 0 0 0 0 4h15a1 1 0 0 1 1 1v4h-3a2 2 0 0 0 0 4h3a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1"></path>
              <path d="M3 5v14a2 2 0 0 0 2 2h15a1 1 0 0 0 1-1v-4"></path>
            </svg>
          </div>
          <h3 class="text-gray-900 font-medium">{{ __('checkout.transaction_details') }}</h3>
        </div>
        <div class="space-y-2.5">
          <div class="flex justify-between text-sm text-gray-600">
            <span>{{ __('checkout.initial_subtotal') }} ({{ $selectedItems->count() }} {{ __('checkout.packages') }})</span>
            <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
          </div>
          <div class="border-t border-gray-100 pt-3 flex justify-between items-center">
            <span class="text-gray-900 font-medium">{{ __('checkout.total_payment') }}</span>
            <div class="text-right">
              <span class="text-amber-600 text-xl font-bold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
            </div>
          </div>
        </div>
      </div>

      <button wire:click="submitBooking" wire:loading.attr="disabled" class="w-full bg-green-500 hover:bg-green-600 active:bg-green-700 disabled:bg-green-300 text-white py-4 rounded-2xl transition flex items-center justify-center gap-3 shadow-md cursor-pointer font-bold">
        <span wire:loading.remove wire:target="submitBooking" class="flex items-center gap-3">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle w-5 h-5">
            <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"></path>
          </svg>
          {{ __('checkout.confirm_wa') }}
        </span>
        <span wire:loading wire:target="submitBooking">{{ __('checkout.processing') }}</span>
      </button>
      <p class="text-xs text-center text-gray-400 px-4">{{ __('checkout.wa_template_note') }}</p>
    </div>
    @endif

    @if($step === 3)
    <!-- STEP 3 -->
    <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 text-center animate-in fade-in slide-in-from-bottom-4 duration-500" wire:key="step-3">
      <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-5">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check w-12 h-12 text-green-500">
          <path d="M20 6 9 17l-5-5"></path>
        </svg>
      </div>
      <h2 class="text-gray-900 mb-1 text-2xl font-bold">{{ __('checkout.order_sent') }}</h2>
      <p class="text-sm text-gray-500 mb-1">{{ __('checkout.order_number') }}: <span class="text-gray-900 font-mono select-all font-semibold">{{ $order?->code ?? '-' }}</span></p>
      <p class="text-xs text-gray-400 mb-6">{{ __('checkout.wa_cs_opened') }}</p>

      <div class="mb-5 text-left bg-green-50 border border-green-100 rounded-xl p-4 flex items-start gap-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check w-4 h-4 text-green-500 shrink-0 mt-0.5">
          <circle cx="12" cy="12" r="10"></circle>
          <path d="m9 12 2 2 4-4"></path>
        </svg>
        <div>
          <p class="text-sm text-green-800 font-medium">{{ __('checkout.order_recorded') }}</p>
          <p class="text-xs text-green-600 mt-0.5">{{ __('checkout.order_recorded_desc') }}</p>
        </div>
      </div>

      <div class="bg-amber-50 border border-amber-100 rounded-2xl p-4 mb-6 text-left space-y-2">
        <p class="text-xs text-amber-700 mb-1 font-medium">{{ __('checkout.payment_summary') }}</p>
        <div class="flex justify-between text-sm text-gray-600">
          <span>{{ __('checkout.total_payment') }}</span>
          <span class="font-semibold text-gray-900">Rp {{ number_format((float) ($order?->total_amount ?? 0), 0, ',', '.') }}</span>
        </div>
      </div>

      <div class="flex flex-col sm:flex-row gap-3">
        <a href="{{ getWhatsappMeUrl() }}" target="_blank" rel="noopener noreferrer" class="flex-1 inline-flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 text-white px-5 py-3 rounded-xl transition font-semibold">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle w-4 h-4">
            <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"></path>
          </svg>
          {{ __('checkout.open_wa') }}
        </a>
        <a href="{{ route('bookings.index') }}" class="flex-1 inline-flex items-center justify-center gap-2 bg-amber-500 hover:bg-amber-600 text-white px-5 py-3 rounded-xl transition font-semibold">{{ __('checkout.view_booking') }}</a>
      </div>
      <a href="{{ route('home') }}" class="mt-3 text-sm text-gray-400 hover:text-gray-600 transition block mx-auto underline underline-offset-4">{{ __('checkout.back_to_home') }}</a>
    </div>
    @endif
  </div>

  <div x-show="showCopyToast"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 -translate-y-4"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-4"
    class="fixed top-24 left-1/2 -translate-x-1/2 z-50 bg-green-500 text-white text-sm px-5 py-2.5 rounded-full shadow-lg flex items-center gap-2"
    style="display: none;">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check w-4 h-4">
      <path d="M20 6 9 17l-5-5"></path>
    </svg>
    {{ __('checkout.account_copied') }}
  </div>
</div>