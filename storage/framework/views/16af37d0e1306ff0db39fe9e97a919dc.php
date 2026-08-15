<div class="space-y-6">
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div>
            <h1 class="text-[28px] font-bold leading-tight text-[#1e1e1e]">Manajemen Promo & Gift Card</h1>
            <p class="mt-1 text-[13px] text-gray-400">
                Review pengajuan vendor dan buat promo internal Indonesia Luxe dari satu halaman.
            </p>
        </div>
        <button wire:click="refresh" class="inline-flex items-center gap-2 self-start rounded-xl border border-gray-200 bg-white px-4 py-2 text-xs font-bold text-gray-600 transition-all hover:bg-gray-50">
            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
            Refresh
        </button>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('status')): ?>
        <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="flex w-full max-w-2xl gap-1 rounded-2xl border border-gray-100 bg-white p-1.5 shadow-sm">
        <button wire:click="setType('promo')" class="flex flex-1 items-center justify-center gap-2 rounded-xl py-3 text-sm font-bold transition-all <?php echo e($activeType === 'promo' ? 'border border-[#ffedd5] bg-[#fff8ed] text-[#f59e0b]' : 'text-gray-400 hover:bg-gray-50'); ?>">
            <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
            Kode Promo
        </button>
        <button wire:click="setType('gift_card')" class="flex flex-1 items-center justify-center gap-2 rounded-xl py-3 text-sm font-bold transition-all <?php echo e($activeType === 'gift_card' ? 'border border-[#ede9fe] bg-[#f5f3ff] text-[#7c3aed]' : 'text-gray-400 hover:bg-gray-50'); ?>">
            <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" /></svg>
            Gift Cards
        </button>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! $isCreating): ?>
        <div class="flex flex-col justify-between gap-5 rounded-3xl border p-5 shadow-sm md:flex-row md:items-center <?php echo e($activeType === 'promo' ? 'border-[#fef3c7] bg-[#fffbeb]' : 'border-[#ede9fe] bg-[#f5f3ff]'); ?>">
            <div class="flex items-center gap-4">
                <div class="flex size-12 items-center justify-center rounded-xl <?php echo e($activeType === 'promo' ? 'bg-[#fef3c7] text-[#d97706]' : 'bg-[#ede9fe] text-[#7c3aed]'); ?>">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeType === 'promo'): ?>
                        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                    <?php else: ?>
                        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" /></svg>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <div>
                    <h3 class="text-base font-bold text-gray-800">
                        <?php echo e($activeType === 'promo' ? 'Buat Promo Indonesia Luxe' : 'Buat Gift Card Indonesia Luxe'); ?>

                    </h3>
                    <p class="text-xs text-gray-500">
                        <?php echo e($activeType === 'promo' ? 'Promo internal langsung aktif setelah disimpan.' : 'Gift card internal langsung aktif untuk traveler.'); ?>

                    </p>
                </div>
            </div>
            <button wire:click="openCreateForm" class="inline-flex items-center justify-center gap-2 rounded-xl px-5 py-2.5 text-xs font-bold text-white transition-all <?php echo e($activeType === 'promo' ? 'bg-[#d97706] hover:bg-[#b45309]' : 'bg-[#7c3aed] hover:bg-[#6d28d9]'); ?>">
                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                <?php echo e($activeType === 'promo' ? 'Buat Promo' : 'Buat Gift Card'); ?>

            </button>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isCreating): ?>
        <div class="overflow-hidden rounded-3xl border shadow-sm <?php echo e($activeType === 'promo' ? 'border-[#ffecd5] bg-[#fffcf0]' : 'border-[#f3e8ff] bg-[#faf5ff]'); ?>">
            <div class="flex flex-col justify-between gap-4 border-b p-6 md:flex-row md:items-start <?php echo e($activeType === 'promo' ? 'border-[#ffedd5]' : 'border-[#f3e8ff]'); ?>">
                <div>
                    <h3 class="text-base font-bold text-gray-800">
                        <?php echo e($activeType === 'promo' ? 'Promo Internal Indonesia Luxe' : 'Gift Card Internal Indonesia Luxe'); ?>

                    </h3>
                    <p class="text-[11px] italic text-gray-500">
                        <?php echo e($activeType === 'promo' ? 'Gunakan kontrak data yang sama dengan form vendor.' : 'Gift card akan disimpan sebagai item internal milik akun admin.'); ?>

                    </p>
                </div>
                <button wire:click="closeCreateForm" class="inline-flex items-center gap-2 rounded-lg border border-gray-100 bg-white px-3 py-1.5 text-[10px] font-bold text-gray-400 transition-all hover:text-gray-600">
                    <svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    Tutup
                </button>
            </div>

            <div class="space-y-5 p-6">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeType === 'promo'): ?>
                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <div class="space-y-1.5">
                            <label class="text-[9px] font-bold uppercase tracking-widest text-gray-400">KODE PROMO *</label>
                            <div class="flex gap-2">
                                <input wire:model.live="code" type="text" placeholder="LUXE2026" class="flex-1 rounded-xl border border-gray-100 bg-white px-4 py-2 text-xs outline-none focus:ring-2 focus:ring-[#f59e0b]/20" />
                                <button wire:click="generateCode" class="rounded-xl border border-gray-100 bg-white p-2 text-gray-400 transition-all hover:text-[#f59e0b]">
                                    <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                                </button>
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-[10px] font-medium text-red-500"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[9px] font-bold uppercase tracking-widest text-gray-400">TIPE DISKON *</label>
                            <select wire:model.live="discount_type" class="w-full rounded-xl border border-gray-100 bg-white px-4 py-2 text-xs outline-none focus:ring-2 focus:ring-[#f59e0b]/20">
                                <option value="percent">Persen (%)</option>
                                <option value="flat">Nominal (Rp)</option>
                            </select>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['discount_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-[10px] font-medium text-red-500"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[9px] font-bold uppercase tracking-widest text-gray-400">DESKRIPSI *</label>
                        <input wire:model.live="description" type="text" placeholder="Diskon 20% semua tour - Spesial Lebaran" class="w-full rounded-xl border border-gray-100 bg-white px-4 py-2 text-xs outline-none focus:ring-2 focus:ring-[#f59e0b]/20" />
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-[10px] font-medium text-red-500"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <div class="space-y-1.5">
                            <label class="text-[9px] font-bold uppercase tracking-widest text-gray-400">NILAI DISKON *</label>
                            <input wire:model.live="discount_value" type="number" step="0.01" placeholder="<?php echo e($discount_type === 'percent' ? '20' : '500000'); ?>" class="w-full rounded-xl border border-gray-100 bg-white px-4 py-2 text-xs outline-none focus:ring-2 focus:ring-[#f59e0b]/20" />
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['discount_value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-[10px] font-medium text-red-500"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[9px] font-bold uppercase tracking-widest text-gray-400">MIN. PEMBELIAN</label>
                            <input wire:model.live="min_purchase" type="number" step="0.01" placeholder="500000" class="w-full rounded-xl border border-gray-100 bg-white px-4 py-2 text-xs outline-none focus:ring-2 focus:ring-[#f59e0b]/20" />
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['min_purchase'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-[10px] font-medium text-red-500"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <div class="space-y-1.5">
                            <label class="text-[9px] font-bold uppercase tracking-widest text-gray-400">KATEGORI TOUR</label>
                            <select wire:model.live="category_restriction" class="w-full rounded-xl border border-gray-100 bg-white px-4 py-2 text-xs outline-none focus:ring-2 focus:ring-[#f59e0b]/20">
                                <option value="">Semua Kategori</option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <option value="<?php echo e($category->name); ?>"><?php echo e($category->name); ?></option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </select>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['category_restriction'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-[10px] font-medium text-red-500"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[9px] font-bold uppercase tracking-widest text-gray-400">NAMA GRUP</label>
                            <input wire:model.live="group" type="text" placeholder="Indonesia Luxe" class="w-full rounded-xl border border-gray-100 bg-white px-4 py-2 text-xs outline-none focus:ring-2 focus:ring-[#f59e0b]/20" />
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['group'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-[10px] font-medium text-red-500"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <div class="space-y-1.5">
                            <label class="text-[9px] font-bold uppercase tracking-widest text-gray-400">BERLAKU DARI</label>
                            <input wire:model.live="valid_from" type="date" class="w-full rounded-xl border border-gray-100 bg-white px-4 py-2 text-xs outline-none focus:ring-2 focus:ring-[#f59e0b]/20" />
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['valid_from'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-[10px] font-medium text-red-500"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[9px] font-bold uppercase tracking-widest text-gray-400">BERLAKU SAMPAI</label>
                            <input wire:model.live="valid_until" type="date" class="w-full rounded-xl border border-gray-100 bg-white px-4 py-2 text-xs outline-none focus:ring-2 focus:ring-[#f59e0b]/20" />
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['valid_until'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-[10px] font-medium text-red-500"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 pt-4">
                        <button wire:click="savePromo" class="flex flex-1 items-center justify-center gap-2 rounded-xl bg-[#d97706] py-3 text-xs font-bold text-white transition-all hover:bg-[#b45309]">
                            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg>
                            Simpan & Aktifkan
                        </button>
                        <button wire:click="closeCreateForm" class="flex-1 rounded-xl border border-gray-100 bg-white py-3 text-xs font-bold text-gray-400 transition-all hover:bg-gray-50">
                            Batal
                        </button>
                    </div>
                <?php else: ?>
                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <div class="space-y-1.5">
                            <label class="text-[9px] font-bold uppercase tracking-widest text-gray-400">KODE GIFT CARD *</label>
                            <div class="flex gap-2">
                                <input wire:model.live="gift_code" type="text" placeholder="GIFT-LUXE2026" class="flex-1 rounded-xl border border-gray-100 bg-white px-4 py-2 text-xs outline-none focus:ring-2 focus:ring-[#7c3aed]/20" />
                                <button wire:click="generateCode" class="rounded-xl border border-gray-100 bg-white p-2 text-gray-400 transition-all hover:text-[#7c3aed]">
                                    <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                                </button>
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['gift_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-[10px] font-medium text-red-500"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[9px] font-bold uppercase tracking-widest text-gray-400">NILAI *</label>
                            <input wire:model.live="gift_value" type="number" step="0.01" placeholder="200000" class="w-full rounded-xl border border-gray-100 bg-white px-4 py-2 text-xs outline-none focus:ring-2 focus:ring-[#7c3aed]/20" />
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['gift_value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-[10px] font-medium text-red-500"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <div class="space-y-1.5">
                            <label class="text-[9px] font-bold uppercase tracking-widest text-gray-400">MAKS. PENGGUNA</label>
                            <input wire:model.live="max_usages" type="number" placeholder="100" class="w-full rounded-xl border border-gray-100 bg-white px-4 py-2 text-xs outline-none focus:ring-2 focus:ring-[#7c3aed]/20" />
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['max_usages'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-[10px] font-medium text-red-500"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[9px] font-bold uppercase tracking-widest text-gray-400">KADALUARSA *</label>
                            <input wire:model.live="expires_at" type="date" class="w-full rounded-xl border border-gray-100 bg-white px-4 py-2 text-xs outline-none focus:ring-2 focus:ring-[#7c3aed]/20" />
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['expires_at'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-[10px] font-medium text-red-500"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 pt-4">
                        <button wire:click="saveGiftCard" class="flex flex-1 items-center justify-center gap-2 rounded-xl bg-[#7c3aed] py-3 text-xs font-bold text-white transition-all hover:bg-[#6d28d9]">
                            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg>
                            Simpan & Aktifkan
                        </button>
                        <button wire:click="closeCreateForm" class="flex-1 rounded-xl border border-gray-100 bg-white py-3 text-xs font-bold text-gray-400 transition-all hover:bg-gray-50">
                            Batal
                        </button>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="grid grid-cols-1 gap-4 sm:gap-6 sm:grid-cols-3">
        <button wire:click="setStatus('pending_approval')" class="relative overflow-hidden rounded-3xl border bg-white p-6 text-center transition-all hover:shadow-md <?php echo e($statusFilter === 'pending_approval' ? 'border-[#f59e0b] ring-1 ring-[#f59e0b]' : 'border-gray-100 shadow-sm'); ?>">
            <div class="absolute left-0 top-0 h-1 w-full bg-[#fef3c7]"></div>
            <div class="mb-1 text-[28px] font-bold text-gray-800"><?php echo e($pendingCount); ?></div>
            <div class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Pending</div>
        </button>
        <button wire:click="setStatus('active')" class="relative overflow-hidden rounded-3xl border bg-white p-6 text-center transition-all hover:shadow-md <?php echo e($statusFilter === 'active' ? 'border-[#10b981] ring-1 ring-[#10b981]' : 'border-gray-100 shadow-sm'); ?>">
            <div class="absolute left-0 top-0 h-1 w-full bg-[#e8fff3]"></div>
            <div class="mb-1 text-[28px] font-bold text-gray-800"><?php echo e($approvedCount); ?></div>
            <div class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Approved</div>
        </button>
        <button wire:click="setStatus('rejected')" class="relative overflow-hidden rounded-3xl border bg-white p-6 text-center transition-all hover:shadow-md <?php echo e($statusFilter === 'rejected' ? 'border-[#ef4444] ring-1 ring-[#ef4444]' : 'border-gray-100 shadow-sm'); ?>">
            <div class="absolute left-0 top-0 h-1 w-full bg-[#fee2e2]"></div>
            <div class="mb-1 text-[28px] font-bold text-gray-800"><?php echo e($rejectedCount); ?></div>
            <div class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Rejected</div>
        </button>
    </div>

    <div class="flex items-center justify-between rounded-3xl border border-gray-100 bg-white p-4 shadow-sm">
        <div class="w-full max-w-md">
            <?php if (isset($component)) { $__componentOriginal5cb383ddee3a6dc44b6e82e90e14b261 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5cb383ddee3a6dc44b6e82e90e14b261 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.search-input','data' => ['model' => 'search','value' => $search,'debounce' => 500,'placeholder' => 'Cari kode, deskripsi, grup, atau nama vendor...']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.search-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['model' => 'search','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($search),'debounce' => 500,'placeholder' => 'Cari kode, deskripsi, grup, atau nama vendor...']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5cb383ddee3a6dc44b6e82e90e14b261)): ?>
<?php $attributes = $__attributesOriginal5cb383ddee3a6dc44b6e82e90e14b261; ?>
<?php unset($__attributesOriginal5cb383ddee3a6dc44b6e82e90e14b261); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5cb383ddee3a6dc44b6e82e90e14b261)): ?>
<?php $component = $__componentOriginal5cb383ddee3a6dc44b6e82e90e14b261; ?>
<?php unset($__componentOriginal5cb383ddee3a6dc44b6e82e90e14b261); ?>
<?php endif; ?>
        </div>
    </div>

    <div class="space-y-4">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <?php
                $isSelected = $selectedItemId === $item->id;
                $isPending = $item->status === \App\Enums\PromoStatus::PendingApproval;
                $issuerName = $item->isInternal() ? 'Indonesia Luxe' : ($item->vendor?->name ?? 'Tanpa vendor');
            ?>

            <div <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('{{ $activeType }}-{{ $item->id }}', get_defined_vars()); ?>wire:key="<?php echo e($activeType); ?>-<?php echo e($item->id); ?>" class="overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-sm transition-all hover:border-[#f59e0b]/30">
                <div class="flex flex-col gap-4 p-4 sm:p-6 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-start gap-3 sm:gap-5">
                        <div class="flex size-12 sm:size-14 shrink-0 items-center justify-center rounded-2xl bg-gray-50 text-gray-400">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeType === 'promo'): ?>
                                <svg class="size-6 sm:size-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                            <?php else: ?>
                                <svg class="size-6 sm:size-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" /></svg>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="space-y-1">
                            <div class="text-sm font-bold text-gray-900"><?php echo e($item->code); ?></div>
                            <div class="text-[11px] sm:text-xs text-gray-500">
                                <?php echo e($issuerName); ?> •
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeType === 'promo'): ?>
                                    <?php echo e($item->discount_type === \App\Enums\PromoDiscountType::Percent ? rtrim(rtrim(number_format((float) $item->discount_value, 2, ',', '.'), '0'), ','). '%' : 'Rp '.number_format((float) $item->discount_value, 0, ',', '.')); ?>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->category_restriction): ?>
                                        • <?php echo e($item->category_restriction); ?>

                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php else: ?>
                                    Nilai Rp <?php echo e(number_format((float) $item->value, 0, ',', '.')); ?>

                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <span class="hidden sm:inline"> • <?php echo e($item->created_at->format('j M Y')); ?></span>
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeType === 'promo'): ?>
                                <p class="text-xs sm:text-sm text-gray-700"><?php echo e($item->description); ?></p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>

                    <div class="flex items-center justify-between sm:justify-end gap-3 border-t sm:border-t-0 pt-3 sm:pt-0">
                        <?php if (isset($component)) { $__componentOriginal72ffe10338c4ec71bdf1582010227fb9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal72ffe10338c4ec71bdf1582010227fb9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.status-badge','data' => ['status' => match($item->status->value) {
                            'pending_approval' => 'pending',
                            'active' => 'approved',
                            'rejected' => 'rejected',
                            default => $item->status->value,
                        }]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(match($item->status->value) {
                            'pending_approval' => 'pending',
                            'active' => 'approved',
                            'rejected' => 'rejected',
                            default => $item->status->value,
                        })]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal72ffe10338c4ec71bdf1582010227fb9)): ?>
<?php $attributes = $__attributesOriginal72ffe10338c4ec71bdf1582010227fb9; ?>
<?php unset($__attributesOriginal72ffe10338c4ec71bdf1582010227fb9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal72ffe10338c4ec71bdf1582010227fb9)): ?>
<?php $component = $__componentOriginal72ffe10338c4ec71bdf1582010227fb9; ?>
<?php unset($__componentOriginal72ffe10338c4ec71bdf1582010227fb9); ?>
<?php endif; ?>

                        <div class="flex items-center gap-1 sm:gap-2">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isPending): ?>
                                <button wire:click="approve(<?php echo e($item->id); ?>)" class="rounded-xl p-2 text-[#10b981] transition-all hover:bg-[#e8fff3]" title="Approve">
                                    <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                                </button>
                                <button wire:click="confirmReject(<?php echo e($item->id); ?>)" class="rounded-xl p-2 text-[#ef4444] transition-all hover:bg-[#fee2e2]" title="Reject">
                                    <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                                </button>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <button wire:click="toggleSelection(<?php echo e($item->id); ?>)" class="rounded-xl p-2 text-gray-400 transition-all hover:bg-gray-50" title="Detail">
                                <svg class="size-5 transition-transform <?php echo e($isSelected ? 'rotate-90' : ''); ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isSelected): ?>
                    <div class="border-t border-gray-100 bg-gray-50/70 px-6 py-5">
                        <div class="grid grid-cols-1 gap-4 text-sm text-gray-600 md:grid-cols-2 xl:grid-cols-4">
                            <div>
                                <div class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Pemilik</div>
                                <div class="mt-1 font-medium text-gray-800"><?php echo e($issuerName); ?></div>
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeType === 'promo'): ?>
                                <div>
                                    <div class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Grup Promo</div>
                                    <div class="mt-1 font-medium text-gray-800"><?php echo e($item->group ?: 'Indonesia Luxe'); ?></div>
                                </div>
                                <div>
                                    <div class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Periode</div>
                                    <div class="mt-1 font-medium text-gray-800">
                                        <?php echo e($item->valid_from?->format('d M Y') ?? 'Tidak dibatasi'); ?>

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->valid_until): ?>
                                            - <?php echo e($item->valid_until->format('d M Y')); ?>

                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Minimum Order</div>
                                    <div class="mt-1 font-medium text-gray-800">Rp <?php echo e(number_format((float) $item->min_purchase, 0, ',', '.')); ?></div>
                                </div>
                            <?php else: ?>
                                <div>
                                    <div class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Kadaluarsa</div>
                                    <div class="mt-1 font-medium text-gray-800"><?php echo e($item->expires_at?->format('d M Y') ?? 'Tanpa batas'); ?></div>
                                </div>
                                <div>
                                    <div class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Penggunaan</div>
                                    <div class="mt-1 font-medium text-gray-800"><?php echo e($item->used_count); ?> dari <?php echo e($item->max_usages); ?></div>
                                </div>
                                <div>
                                    <div class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Aktif</div>
                                    <div class="mt-1 font-medium text-gray-800"><?php echo e($item->is_active ? 'Ya' : 'Tidak'); ?></div>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->status === \App\Enums\PromoStatus::Rejected && $item->rejected_reason): ?>
                            <div class="mt-4 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                                <span class="font-semibold">Alasan penolakan:</span> <?php echo e($item->rejected_reason); ?>

                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showRejectForm && $selectedItemId === $item->id): ?>
                            <div class="mt-4 rounded-2xl border border-red-200 bg-white p-4">
                                <label class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Alasan Penolakan</label>
                                <textarea wire:model.live="rejectReason" rows="3" class="mt-2 w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-red-200" placeholder="Tuliskan alasan agar vendor bisa melakukan perbaikan."></textarea>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['rejectReason'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="mt-2 block text-[10px] font-medium text-red-500"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <div class="mt-3 flex flex-wrap gap-3">
                                    <button wire:click="rejectSelected" class="rounded-xl bg-red-500 px-4 py-2 text-xs font-bold text-white transition-all hover:bg-red-600">
                                        Tolak Pengajuan
                                    </button>
                                    <button wire:click="cancelReject" class="rounded-xl border border-gray-200 bg-white px-4 py-2 text-xs font-bold text-gray-500 transition-all hover:bg-gray-50">
                                        Batal
                                    </button>
                                </div>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <div class="rounded-3xl border border-gray-100 bg-white py-24 text-center shadow-sm">
                <div class="mx-auto mb-4 flex size-20 items-center justify-center rounded-full bg-gray-50">
                    <svg class="size-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="<?php echo e($activeType === 'promo' ? 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z' : 'M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7'); ?>" />
                    </svg>
                </div>
                <h3 class="text-sm font-bold text-gray-800">Belum ada data <?php echo e($activeType === 'promo' ? 'promo' : 'gift card'); ?> untuk filter ini</h3>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <div class="mt-8">
        <?php echo e($items->links()); ?>

    </div>
</div>
<?php /**PATH /var/www/indonesia-luxe/resources/views/livewire/admin/promo-gift-management.blade.php ENDPATH**/ ?>