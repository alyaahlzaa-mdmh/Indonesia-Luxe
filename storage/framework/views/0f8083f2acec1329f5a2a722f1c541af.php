<div class="space-y-6">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div>
            <h1 class="text-[28px] font-bold text-[#1e1e1e] leading-tight">Approve Paket Tour</h1>
            <p class="text-[13px] text-gray-400 mt-1">
                <?php echo e($totalCount); ?> total — <?php echo e($internalCount); ?> Internal (Indoluxe) — <?php echo e($pendingCount); ?> pending vendor
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <button wire:click="openCreateForm" class="px-5 py-2.5 bg-[#cca462] text-white rounded-full text-xs font-bold hover:bg-[#b89355] transition-all flex items-center gap-2 shadow-sm shadow-[#cca462]/20">
                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" /></svg>
                Buat Paket Internal
            </button>

            <div class="flex bg-white p-1 rounded-full border border-gray-100 shadow-sm overflow-x-auto whitespace-nowrap scrollbar-hide">
                <button wire:click="setTab('semua')"
                    class="px-5 py-2 rounded-full text-xs font-bold transition-all shrink-0 <?php echo e($activeTab === 'semua' ? 'bg-[#cca462] text-white shadow-md' : 'text-gray-400 hover:text-gray-600'); ?>">
                    Semua <span class="ml-1 opacity-70"><?php echo e($totalCount); ?></span>
                </button>
                <button wire:click="setTab('pending')"
                    class="px-5 py-2 rounded-full text-xs font-bold transition-all shrink-0 <?php echo e($activeTab === 'pending' ? 'bg-[#cca462] text-white shadow-md' : 'text-gray-400 hover:text-gray-600'); ?>">
                    Pending <span class="ml-1 opacity-70"><?php echo e($pendingCount); ?></span>
                </button>
                <button wire:click="setTab('approved')"
                    class="px-5 py-2 rounded-full text-xs font-bold transition-all shrink-0 <?php echo e($activeTab === 'approved' ? 'bg-[#cca462] text-white shadow-md' : 'text-gray-400 hover:text-gray-600'); ?>">
                    Disetujui <span class="ml-1 opacity-70"><?php echo e($approvedCount); ?></span>
                </button>
                <button wire:click="setTab('rejected')"
                    class="px-5 py-2 rounded-full text-xs font-bold transition-all shrink-0 <?php echo e($activeTab === 'rejected' ? 'bg-[#cca462] text-white shadow-md' : 'text-gray-400 hover:text-gray-600'); ?>">
                    Ditolak <span class="ml-1 opacity-70"><?php echo e($rejectedCount); ?></span>
                </button>
            </div>
        </div>
    </div>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isCreating): ?>
    <div x-data="{}" x-transition class="bg-white rounded-[32px] border border-gray-100 shadow-xl overflow-hidden mb-10">
        <div class="p-8 border-b border-gray-50 flex justify-between items-start">
            <div>
                <div class="flex items-center gap-3 mb-1">
                    <span class="size-8 bg-orange-100 text-orange-500 rounded-lg flex items-center justify-center">
                        <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    </span>
                    <h2 class="text-xl font-bold text-gray-800">Buat Paket Internal Indoluxe</h2>
                </div>
                <p class="text-xs text-gray-400">Paket ini dikelola langsung oleh Indonesia Luxe Travel (tanpa vendor)</p>
            </div>
            <button wire:click="closeCreateForm" class="text-gray-300 hover:text-gray-500 transition-colors">
                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>

        <div class="p-8 space-y-6">
            
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-gray-400 uppercase tracking-widest">Judul Paket *</label>
                <input wire:model="title" type="text" placeholder="Contoh: Luxury Bali Escape 5D4N" class="w-full px-5 py-3 bg-gray-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-[#cca462]/20 outline-none" />
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-[10px] text-red-500 font-medium"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-widest">Kategori</label>
                    <select wire:model="type" class="w-full px-5 py-3 bg-gray-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-[#cca462]/20 outline-none appearance-none">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = App\Enums\PackageType::cases(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pkgType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <option value="<?php echo e($pkgType->value); ?>"><?php echo e($pkgType->label()); ?></option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </select>
                </div>
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-widest">Lokasi *</label>
                    <input wire:model="meeting_point" type="text" placeholder="Bali, NTT, Yogyakarta..." class="w-full px-5 py-3 bg-gray-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-[#cca462]/20 outline-none" />
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['meeting_point'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-[10px] text-red-500 font-medium"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>

            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-widest">Harga (Rp) *</label>
                    <input wire:model="price" type="number" placeholder="5000000" class="w-full px-5 py-3 bg-gray-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-[#cca462]/20 outline-none" />
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-[10px] text-red-500 font-medium"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-widest">Maks. Peserta</label>
                    <input wire:model="max_participants" type="number" placeholder="10" class="w-full px-5 py-3 bg-gray-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-[#cca462]/20 outline-none" />
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['max_participants'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-[10px] text-red-500 font-medium"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>

            
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-gray-400 uppercase tracking-widest">URL Gambar Utama</label>
                <input wire:model="image_url" type="text" placeholder="https://images.unsplash.com/..." class="w-full px-5 py-3 bg-gray-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-[#cca462]/20 outline-none" />
            </div>

            
             <div class="space-y-1.5">
                <label class="text-xs font-bold text-gray-400 uppercase tracking-widest">Deskripsi *</label>
                <textarea wire:model="description" rows="5" placeholder="Deskripsi paket tour..." class="w-full px-5 py-4 bg-gray-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-[#cca462]/20 outline-none resize-none"></textarea>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-[10px] text-red-500 font-medium"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-widest">Highlights (pisah koma)</label>
                    <input wire:model="highlights" type="text" placeholder="Pantai, Snorkeling, Sunset..." class="w-full px-5 py-3 bg-gray-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-[#cca462]/20 outline-none" />
                </div>
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-widest">Sudah Termasuk (pisah koma)</label>
                    <input wire:model="included" type="text" placeholder="Guide, Makan, Akomodasi..." class="w-full px-5 py-3 bg-gray-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-[#cca462]/20 outline-none" />
                </div>
            </div>

            <div class="flex items-center gap-4 pt-6">
                <button wire:click="savePackage" class="px-8 py-3.5 bg-[#cca462] text-white rounded-xl text-sm font-bold hover:bg-[#b89355] transition-all shadow-lg shadow-[#cca462]/20">
                    Simpan & Langsung Live
                </button>
                <button wire:click="closeCreateForm" class="px-8 py-3.5 bg-white border border-gray-100 text-gray-400 rounded-xl text-sm font-bold hover:bg-gray-50 transition-all">
                    Batal
                </button>
            </div>
        </div>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <div class="flex justify-between items-center bg-white p-4 rounded-2xl border border-gray-100 shadow-sm">
        <div class="w-full max-w-md">
            <?php if (isset($component)) { $__componentOriginal5cb383ddee3a6dc44b6e82e90e14b261 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5cb383ddee3a6dc44b6e82e90e14b261 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.search-input','data' => ['model' => 'search','value' => $search,'debounce' => 500,'placeholder' => 'Cari paket tour berdasarkan judul...']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.search-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['model' => 'search','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($search),'debounce' => 500,'placeholder' => 'Cari paket tour berdasarkan judul...']); ?>
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

        <div class="flex items-center gap-4">
            
        </div>
    </div>

    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <?php if (isset($component)) { $__componentOriginala5887f505b119f84c73ba404d26c1d27 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala5887f505b119f84c73ba404d26c1d27 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.package-card','data' => ['package' => $package]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.package-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['package' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($package)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala5887f505b119f84c73ba404d26c1d27)): ?>
<?php $attributes = $__attributesOriginala5887f505b119f84c73ba404d26c1d27; ?>
<?php unset($__attributesOriginala5887f505b119f84c73ba404d26c1d27); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala5887f505b119f84c73ba404d26c1d27)): ?>
<?php $component = $__componentOriginala5887f505b119f84c73ba404d26c1d27; ?>
<?php unset($__componentOriginala5887f505b119f84c73ba404d26c1d27); ?>
<?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <div class="col-span-full py-24 text-center bg-white rounded-3xl border border-dashed border-gray-200">
                <div class="size-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="size-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900">Tidak ada paket tour</h3>
                <p class="text-gray-400 text-sm mt-1">Coba sesuaikan filter atau kata kunci pencarian Anda.</p>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    
    <div class="mt-8">
        <?php echo e($packages->links()); ?>

    </div>

    
    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedPackage): ?>
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" wire:click="closeDetail"></div>
        <div class="relative bg-white rounded-[32px] shadow-2xl w-full max-w-5xl overflow-hidden flex flex-col md:flex-row h-[90vh]">
            
            <button wire:click="closeDetail" class="absolute top-6 right-6 z-10 size-10 bg-white/10 hover:bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center text-white transition-all">
                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>

            
            <div class="w-full md:w-1/2 h-64 md:h-full relative overflow-hidden bg-gray-200">
                <img src="<?php echo e($selectedPackage->coverImageUrl()); ?>"
                     class="w-full h-full object-cover" />

                <div class="absolute top-8 left-8">
                    <span class="bg-[#1e1e1e]/60 backdrop-blur-md text-white text-[11px] font-bold px-4 py-2 rounded-lg uppercase tracking-widest">
                        <?php echo e($selectedPackage->type->label()); ?>

                    </span>
                </div>
            </div>

            
            <div class="w-full md:w-1/2 p-10 overflow-y-auto">
                <div class="mb-8">
                    <h2 class="text-[32px] font-bold text-[#1e1e1e] leading-tight mb-2"><?php echo e($selectedPackage->title); ?></h2>
                    <div class="flex items-center gap-2 text-gray-400 text-sm">
                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        <?php echo e($selectedPackage->meeting_point ?? 'Indonesia'); ?>

                    </div>
                </div>

                <div class="gap-4 mb-10">
                    <div class="bg-[#fffcf0] p-6 rounded-2xl border border-[#fff5cc]">
                        <p class="text-[10px] text-[#cca462] font-bold uppercase tracking-widest mb-1">HARGA</p>
                        <p class="text-2xl font-bold text-[#1e1e1e]">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedPackage->price_per_person >= 1000000): ?>
                                Rp <?php echo e(number_format($selectedPackage->price_per_person / 1000000, 1)); ?>.000.000,00
                            <?php else: ?>
                                Rp <?php echo e(number_format($selectedPackage->price_per_person / 1000, 0)); ?>.000,00
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </p>
                    </div>

                </div>

                <div class="mb-10">
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-3">DESKRIPSI</p>
                    <div class="text-gray-500 text-[13px] leading-relaxed prose prose-sm max-w-none">
                        <?php echo nl2br(e($selectedPackage->description)); ?>

                    </div>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! empty($selectedPackage->highlights)): ?>
                    <div class="mb-8">
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-3">HIGHLIGHTS</p>
                        <div class="flex flex-wrap gap-2">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $selectedPackage->highlights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $highlight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <span class="px-3 py-1.5 rounded-full bg-[#fffcf0] border border-[#fff5cc] text-xs font-semibold text-[#cca462]"><?php echo e($highlight); ?></span>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! empty($selectedPackage->included)): ?>
                    <div class="mb-8">
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-3">SUDAH TERMASUK</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $selectedPackage->included; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $includedItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <div class="text-sm text-gray-600 flex items-center gap-2">
                                    <span class="size-1.5 rounded-full bg-[#cca462]"></span>
                                    <?php echo e($includedItem); ?>

                                </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <div class="flex gap-4 pt-6 border-t border-gray-100">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedPackage->status->value === 'published'): ?>
                        <button wire:click="togglePublish(<?php echo e($selectedPackage->id); ?>)" class="flex-1 bg-[#ff9f43] text-white py-3 rounded-xl text-sm font-bold hover:bg-orange-500 transition-all flex items-center justify-center gap-2">
                             <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" /></svg>
                            Unpublish
                        </button>
                    <?php else: ?>
                        <button wire:click="togglePublish(<?php echo e($selectedPackage->id); ?>)" class="flex-1 bg-[#10b981] text-white py-3 rounded-xl text-sm font-bold hover:bg-[#059669] transition-all flex items-center justify-center gap-2">
                            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            Publish
                        </button>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <button wire:click="confirmDeleteDetail(<?php echo e($selectedPackage->id); ?>)" class="flex-1 bg-[#fff0f0] text-[#ff4d4f] py-3 rounded-xl text-sm font-bold hover:bg-red-50 transition-all flex items-center justify-center gap-2">
                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if (isset($component)) { $__componentOriginal883972b03e56cea0994a1aaccc5761f0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal883972b03e56cea0994a1aaccc5761f0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.modal','data' => ['model' => 'confirmingApprove']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['model' => 'confirmingApprove']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

        <div class="p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-2">Setujui Paket Tour?</h3>
            <p class="text-gray-500 text-sm mb-6">
                Paket tour ini akan segera tayang dan dapat dipesan oleh customer.
            </p>
            <div class="flex justify-end gap-3">
                <button @click="close()" class="px-5 py-2.5 bg-gray-100 text-gray-600 rounded-xl text-sm font-bold hover:bg-gray-200 transition-colors">
                    Batal
                </button>
                <button wire:click="approve" class="px-5 py-2.5 bg-[#10b981] text-white rounded-xl text-sm font-bold hover:bg-[#059669] transition-all">
                    Ya, Setujui
                </button>
            </div>
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal883972b03e56cea0994a1aaccc5761f0)): ?>
<?php $attributes = $__attributesOriginal883972b03e56cea0994a1aaccc5761f0; ?>
<?php unset($__attributesOriginal883972b03e56cea0994a1aaccc5761f0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal883972b03e56cea0994a1aaccc5761f0)): ?>
<?php $component = $__componentOriginal883972b03e56cea0994a1aaccc5761f0; ?>
<?php unset($__componentOriginal883972b03e56cea0994a1aaccc5761f0); ?>
<?php endif; ?>

    
    <?php if (isset($component)) { $__componentOriginal883972b03e56cea0994a1aaccc5761f0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal883972b03e56cea0994a1aaccc5761f0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.modal','data' => ['model' => 'confirmingReject']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['model' => 'confirmingReject']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

        <div class="p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-2">Tolak Paket Tour?</h3>
            <p class="text-gray-500 text-sm mb-4">
                Berikan alasan penolakan agar vendor dapat melakukan perbaikan.
            </p>
            <textarea wire:model="rejectReason"
                      class="w-full rounded-xl border-gray-200 text-sm p-4 h-32 mb-6 focus:ring-red-500 focus:border-red-500"
                      placeholder="Contoh: Deskripsi kurang lengkap, gambar pecah..."></textarea>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['rejectReason'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-xs text-red-500 mb-4"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <div class="flex justify-end gap-3">
                <button @click="close()" class="px-5 py-2.5 bg-gray-100 text-gray-600 rounded-xl text-sm font-bold hover:bg-gray-200 transition-colors">
                    Batal
                </button>
                <button wire:click="reject" class="px-5 py-2.5 bg-red-500 text-white rounded-xl text-sm font-bold hover:bg-red-600 transition-all">
                    Ya, Tolak Paket
                </button>
            </div>
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal883972b03e56cea0994a1aaccc5761f0)): ?>
<?php $attributes = $__attributesOriginal883972b03e56cea0994a1aaccc5761f0; ?>
<?php unset($__attributesOriginal883972b03e56cea0994a1aaccc5761f0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal883972b03e56cea0994a1aaccc5761f0)): ?>
<?php $component = $__componentOriginal883972b03e56cea0994a1aaccc5761f0; ?>
<?php unset($__componentOriginal883972b03e56cea0994a1aaccc5761f0); ?>
<?php endif; ?>

    
    <?php if (isset($component)) { $__componentOriginal883972b03e56cea0994a1aaccc5761f0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal883972b03e56cea0994a1aaccc5761f0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.modal','data' => ['model' => 'confirmingDelete']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['model' => 'confirmingDelete']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

        <div class="p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-2">Hapus Paket Tour?</h3>
            <p class="text-gray-500 text-sm mb-6">
                Tindakan ini tidak dapat dibatalkan. Paket tour akan dihapus secara permanen.
            </p>
            <div class="flex justify-end gap-3">
                <button @click="close()" class="px-5 py-2.5 bg-gray-100 text-gray-600 rounded-xl text-sm font-bold hover:bg-gray-200 transition-colors">
                    Batal
                </button>
                <button wire:click="deletePackage" class="px-5 py-2.5 bg-red-500 text-white rounded-xl text-sm font-bold hover:bg-red-600 transition-all">
                    Ya, Hapus
                </button>
            </div>
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal883972b03e56cea0994a1aaccc5761f0)): ?>
<?php $attributes = $__attributesOriginal883972b03e56cea0994a1aaccc5761f0; ?>
<?php unset($__attributesOriginal883972b03e56cea0994a1aaccc5761f0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal883972b03e56cea0994a1aaccc5761f0)): ?>
<?php $component = $__componentOriginal883972b03e56cea0994a1aaccc5761f0; ?>
<?php unset($__componentOriginal883972b03e56cea0994a1aaccc5761f0); ?>
<?php endif; ?>
</div>
<?php /**PATH C:\Users\fazar\indonesia-luxe-backup\indonesia-luxe\resources\views/livewire/admin/package-management.blade.php ENDPATH**/ ?>