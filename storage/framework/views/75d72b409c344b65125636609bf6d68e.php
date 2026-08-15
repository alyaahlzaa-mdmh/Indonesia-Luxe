<div class="space-y-4">
    <!-- Header Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sm:p-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
            <div>
                <h1 class="text-[32px] font-serif text-[#1e1e1e] leading-tight">Manajemen Vendor</h1>
                <p class="text-xs text-gray-400 mt-1"><?php echo e($totalCount); ?> vendor terdaftar</p>
            </div>
            
            <div class="w-full md:w-auto">
                <div class="grid grid-cols-3 gap-4 sm:gap-8 pt-2">
                    <div class="text-center">
                        <div class="text-lg sm:text-xl font-bold text-green-500 leading-none"><?php echo e($approvedCount); ?></div>
                        <div class="text-[9px] sm:text-[10px] text-gray-400 font-bold tracking-widest mt-1 uppercase">APPROVED</div>
                    </div>
                    <div class="text-center">
                        <div class="text-lg sm:text-xl font-bold text-orange-400 leading-none"><?php echo e($pendingCount); ?></div>
                        <div class="text-[9px] sm:text-[10px] text-gray-400 font-bold tracking-widest mt-1 uppercase">PENDING</div>
                    </div>
                    <div class="text-center">
                        <div class="text-lg sm:text-xl font-bold text-red-500 leading-none"><?php echo e($rejectedCount); ?></div>
                        <div class="text-[9px] sm:text-[10px] text-gray-400 font-bold tracking-widest mt-1 uppercase">DITOLAK</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
            <!-- Tabs -->
            <div class="flex items-center gap-6 overflow-x-auto pb-2 lg:pb-0 w-full lg:w-auto">
                <button wire:click="setTab('all')" 
                    class="relative py-2 px-1 text-sm font-medium transition-colors whitespace-nowrap <?php echo e($activeTab === 'all' ? 'text-[#cca462]' : 'text-gray-400 hover:text-gray-600'); ?>">
                    <span>Semua</span>
                    <span class="ml-1 text-[10px] bg-gray-100 text-gray-400 px-1.5 py-0.5 rounded-md"><?php echo e($totalCount); ?></span>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeTab === 'all'): ?>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-[#cca462] rounded-full"></div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </button>
                <button wire:click="setTab('pending')" 
                    class="relative py-2 px-1 text-sm font-medium transition-colors whitespace-nowrap <?php echo e($activeTab === 'pending' ? 'text-[#cca462]' : 'text-gray-400 hover:text-gray-600'); ?>">
                    <span>Pending</span>
                    <span class="ml-1 text-[10px] bg-gray-100 text-gray-400 px-1.5 py-0.5 rounded-md"><?php echo e($pendingCount); ?></span>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeTab === 'pending'): ?>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-[#cca462] rounded-full"></div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </button>
                <button wire:click="setTab('approved')" 
                    class="relative py-2 px-1 text-sm font-medium transition-colors whitespace-nowrap <?php echo e($activeTab === 'approved' ? 'text-[#cca462]' : 'text-gray-400 hover:text-gray-600'); ?>">
                    <span>Disetujui</span>
                    <span class="ml-1 text-[10px] bg-gray-100 text-gray-400 px-1.5 py-0.5 rounded-md"><?php echo e($approvedCount); ?></span>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeTab === 'approved'): ?>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-[#cca462] rounded-full"></div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </button>
                <button wire:click="setTab('rejected')" 
                    class="relative py-2 px-1 text-sm font-medium transition-colors whitespace-nowrap <?php echo e($activeTab === 'rejected' ? 'text-[#cca462]' : 'text-gray-400 hover:text-gray-600'); ?>">
                    <span>Ditolak</span>
                    <span class="ml-1 text-[10px] bg-gray-100 text-gray-400 px-1.5 py-0.5 rounded-md"><?php echo e($rejectedCount); ?></span>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeTab === 'rejected'): ?>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-[#cca462] rounded-full"></div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </button>
            </div>

            <!-- Search -->
            <div class="w-full lg:w-72">
                <?php if (isset($component)) { $__componentOriginal5cb383ddee3a6dc44b6e82e90e14b261 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5cb383ddee3a6dc44b6e82e90e14b261 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.search-input','data' => ['model' => 'search','value' => $search,'debounce' => 500,'placeholder' => 'Cari nama atau email...']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.search-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['model' => 'search','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($search),'debounce' => 500,'placeholder' => 'Cari nama atau email...']); ?>
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
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <tr class="hover:bg-gray-50/30 transition-colors">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="size-10 rounded-full bg-[#1e293b] flex items-center justify-center text-white text-xs font-bold shrink-0">
                                        <?php echo e(strtoupper(substr($vendor->user->name, 0, 1))); ?>

                                    </div>
                                    <div class="min-w-0">
                                        <div class="text-sm font-semibold text-gray-800 leading-tight"><?php echo e($vendor->user->name); ?></div>
                                        <div class="text-[11px] text-gray-400 mt-1"><?php echo e($vendor->user->email); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <span class="text-xs <?php echo e($vendor->business_name ? 'text-gray-600 font-medium' : 'text-gray-300'); ?>">
                                    <?php echo e($vendor->business_name ?? '—'); ?>

                                </span>
                            </td>
                            <td class="px-8 py-5">
                                <?php if (isset($component)) { $__componentOriginal72ffe10338c4ec71bdf1582010227fb9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal72ffe10338c4ec71bdf1582010227fb9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.status-badge','data' => ['status' => $vendor->status->value]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($vendor->status->value)]); ?>
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
                            </td>
                            <td class="px-8 py-5">
                                <span class="text-xs <?php echo e($vendor->rejected_reason ? 'text-gray-600' : 'text-gray-300'); ?>">
                                    <?php echo e($vendor->rejected_reason ?? '—'); ?>

                                </span>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <div class="flex items-center justify-end gap-3 text-xs">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($vendor->status->value === 'approved'): ?>
                                        <button wire:click="confirmRevoke(<?php echo e($vendor->id); ?>)" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#fff8ed] border border-[#ffedd5] text-[#f59e0b] rounded-xl font-bold hover:bg-[#ffedd5] transition-all">
                                            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            Revoke
                                        </button>
                                    <?php elseif($vendor->status->value === 'pending'): ?>
                                        <button wire:click="confirmApprove(<?php echo e($vendor->id); ?>)" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#e8fff3] border border-[#d1fae5] text-[#10b981] rounded-xl font-bold hover:bg-[#d1fae5] transition-all">
                                            Approve
                                        </button>
                                        <button wire:click="confirmReject(<?php echo e($vendor->id); ?>)" class="inline-flex items-center gap-2 px-4 py-2.5 border border-red-200 text-red-500 rounded-xl font-bold hover:bg-red-50 transition-all">
                                            Reject
                                        </button>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    
                                    <button wire:click="confirmDelete(<?php echo e($vendor->id); ?>)" class="size-10 flex items-center justify-center text-[#ff4d4f] hover:bg-red-50 transition-colors rounded-lg group">
                                        <svg class="size-5 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
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
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($vendors->hasPages()): ?>
            <div class="px-8 py-6 border-t border-gray-50 bg-gray-50/20">
                <?php echo e($vendors->links()); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>


    <!-- Modals -->
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

        <div class="p-8">
            <h3 class="text-2xl font-serif text-gray-800 mb-2">Tolak Vendor?</h3>
            <p class="text-gray-500 text-sm leading-relaxed mb-4">
                Berikan alasan penolakan agar vendor tahu data yang harus diperbaiki.
            </p>

            <textarea wire:model="rejectReason" class="w-full rounded-2xl border-gray-200 text-sm p-4 h-32 mb-2 focus:ring-red-500 focus:border-red-500" placeholder="Contoh: data rekening belum lengkap."></textarea>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['rejectReason'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-xs text-red-500 mb-6"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <div class="flex gap-3 justify-end">
                <button @click="close()" class="px-6 py-3 border border-gray-100 text-gray-600 rounded-2xl font-semibold hover:bg-gray-50 transition-colors">
                    Batal
                </button>
                <button wire:click="reject" class="px-6 py-3 bg-red-500 text-white rounded-2xl font-semibold hover:bg-red-600 transition-colors shadow-lg shadow-red-100">
                    Ya, Tolak
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.modal','data' => ['model' => 'confirmingRevoke']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['model' => 'confirmingRevoke']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

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
<?php /**PATH /var/www/indonesia-luxe/resources/views/livewire/admin/vendor-management.blade.php ENDPATH**/ ?>