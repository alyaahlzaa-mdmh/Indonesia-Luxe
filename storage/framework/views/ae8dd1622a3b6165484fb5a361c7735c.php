<div class="space-y-6">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('status')): ?>
        <div class="rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-[#cca462]/10 rounded-lg shrink-0">
                <svg class="size-6 text-[#cca462]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <div>
                <h1 class="text-xl sm:text-[28px] font-bold text-[#1e1e1e] leading-tight">Manajemen Penarikan Dana</h1>
                <p class="text-[12px] sm:text-[13px] text-gray-400 mt-1">Review dan proses permintaan penarikan dana vendor</p>
            </div>
        </div>
        
        <div class="flex flex-wrap items-center gap-3 w-full lg:w-auto">
            <div class="flex items-center gap-2 bg-white px-3 py-2 rounded-xl border border-gray-100 shadow-sm flex-1 sm:flex-none">
                <select wire:model.live="selectedMonth" class="text-xs font-bold bg-transparent border-none focus:ring-0 cursor-pointer flex-1">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $num => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <option value="<?php echo e($num); ?>"><?php echo e($name); ?></option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </select>
                <div class="w-px h-4 bg-gray-100"></div>
                <select wire:model.live="selectedYear" class="text-xs font-bold bg-transparent border-none focus:ring-0 cursor-pointer">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = range(now()->year, now()->year - 5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <option value="<?php echo e($year); ?>"><?php echo e($year); ?></option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </select>
            </div>

            <button onclick="window.location.href='<?php echo e(route('admin.reports.monthly')); ?>?selectedMonth=' + document.querySelector('[wire\\:model\\.live=selectedMonth]').value + '&selectedYear=' + document.querySelector('[wire\\:model\\.live=selectedYear]').value" 
                    class="flex-1 sm:flex-none justify-center px-5 py-2.5 bg-[#1e1e1e] text-white rounded-xl text-xs font-bold flex items-center gap-2 hover:bg-black transition-all shadow-lg shadow-gray-200">
                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 00-2-2V5a2 2 0 002-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 002 2z" />
                </svg>
                Export
            </button>

            <button wire:click="$refresh" class="p-2.5 sm:px-4 sm:py-2 border border-gray-200 rounded-xl text-xs font-bold text-gray-600 hover:bg-gray-50 transition-all flex items-center gap-2">
                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                <span class="hidden sm:inline">Refresh</span>
            </button>
        </div>
    </div>

    
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">
        <div class="bg-[#fff8ed] border border-[#ffedd5] p-6 rounded-2xl shadow-sm">
            <div class="text-center">
                <div class="text-2xl font-bold text-[#f59e0b]"><?php echo e($pendingCount); ?></div>
                <div class="text-[10px] text-gray-400 font-bold tracking-widest mt-1 uppercase">PENDING</div>
            </div>
        </div>
        <div class="bg-[#e8fff3] border border-[#d1fae5] p-6 rounded-2xl shadow-sm">
            <div class="text-center">
                <div class="text-2xl font-bold text-[#10b981]"><?php echo e($completedCount); ?></div>
                <div class="text-[10px] text-gray-400 font-bold tracking-widest mt-1 uppercase">APPROVED</div>
            </div>
        </div>
        <div class="bg-red-50 border border-red-100 p-6 rounded-2xl shadow-sm">
            <div class="text-center">
                <div class="text-2xl font-bold text-red-500"><?php echo e($rejectedCount); ?></div>
                <div class="text-[10px] text-gray-400 font-bold tracking-widest mt-1 uppercase">REJECTED</div>
            </div>
        </div>
    </div>

    
    <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
        <div class="flex-1 max-w-md">
            <?php if (isset($component)) { $__componentOriginal5cb383ddee3a6dc44b6e82e90e14b261 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5cb383ddee3a6dc44b6e82e90e14b261 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.search-input','data' => ['model' => 'search','value' => $search,'debounce' => 500,'placeholder' => 'Cari nama vendor atau email...']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.search-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['model' => 'search','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($search),'debounce' => 500,'placeholder' => 'Cari nama vendor atau email...']); ?>
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

    
    <div class="space-y-3">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $withdrawals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdrawal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <?php
                $bankDetails = $withdrawal->bank_details ?? [];
                $recentWithdrawals = $withdrawal->wallet->recentWithdrawals
                    ->where('id', '!=', $withdrawal->id)
                    ->take(3);
            ?>
            <div <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('withdrawal-{{ $withdrawal->id }}', get_defined_vars()); ?>wire:key="withdrawal-<?php echo e($withdrawal->id); ?>" class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden transition-all">
                
                <div class="px-4 sm:px-8 py-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 cursor-pointer hover:bg-gray-50/50" 
                     wire:click="toggleExpand(<?php echo e($withdrawal->id); ?>)">
                    <div class="flex items-center gap-3 sm:gap-4">
                        <div class="size-10 rounded-full bg-[#1e293b] flex items-center justify-center text-white text-xs font-bold shrink-0">
                            <?php echo e(strtoupper(substr($withdrawal->wallet->user->name, 0, 1))); ?>

                        </div>
                        <div class="min-w-0">
                            <div class="text-sm font-bold text-gray-800 truncate"><?php echo e($withdrawal->wallet->user->name); ?></div>
                            <div class="text-[11px] text-gray-400 truncate"><?php echo e($withdrawal->wallet->user->email); ?></div>
                            <div class="text-[11px] text-gray-400 sm:hidden"><?php echo e($withdrawal->created_at->format('j M Y, H:i')); ?></div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between sm:justify-end gap-6 sm:gap-10 border-t sm:border-t-0 pt-3 sm:pt-0">
                        <div class="text-left sm:text-right">
                            <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest block mb-0.5">JUMLAH</span>
                            <span class="text-sm font-bold text-[#f97316]">Rp <?php echo e(number_format($withdrawal->amount, 0, ',', '.')); ?></span>
                        </div>

                        <div class="flex items-center gap-3">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider 
                                <?php echo e($withdrawal->status->value === 'pending' ? 'bg-[#fff8ed] text-[#f59e0b]' : 
                                   ($withdrawal->status->value === 'completed' ? 'bg-[#e8fff3] text-[#10b981]' : 'bg-red-50 text-red-500')); ?>">
                                <?php echo e($withdrawal->status->value); ?>

                            </span>
                            
                            <svg class="size-4 text-gray-300 transition-transform <?php echo e($expandedWithdrawalId === $withdrawal->id ? 'rotate-180' : ''); ?>" 
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($expandedWithdrawalId === $withdrawal->id): ?>
                    <div class="px-4 sm:px-8 py-6 sm:py-8 border-t border-gray-50 bg-gray-50/30 grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-10" x-transition>
                        
                        <div>
                            <h3 class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-4">INFO REKENING PENERIMA</h3>
                            <div class="bg-white p-4 rounded-xl border border-gray-100 space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-xs text-gray-400">Bank</span>
                                    <span class="text-xs font-bold text-gray-700"><?php echo e($bankDetails['bank_name'] ?? '-'); ?></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-xs text-gray-400">Nama Rekening</span>
                                    <span class="text-xs font-bold text-gray-700"><?php echo e($bankDetails['bank_account_name'] ?? '-'); ?></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-xs text-gray-400">Nomor Rekening</span>
                                    <span class="text-xs font-bold text-gray-700"><?php echo e($bankDetails['bank_account_number'] ?? '-'); ?></span>
                                </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($withdrawal->notes): ?>
                                    <div class="pt-2 border-t border-gray-50 mt-2">
                                        <span class="text-[10px] text-gray-400 font-bold uppercase block mb-1">CATATAN VENDOR</span>
                                        <p class="text-xs text-gray-600 italic">"<?php echo e($withdrawal->notes); ?>"</p>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($withdrawal->status->value === 'pending'): ?>
                                <div class="mt-8 flex gap-3">
                                    <button wire:click="approve(<?php echo e($withdrawal->id); ?>)" 
                                            class="px-5 py-2.5 bg-[#10b981] text-white rounded-xl text-xs font-bold hover:bg-[#059669] transition-all flex items-center gap-2 shadow-lg shadow-emerald-100">
                                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                                        Approve & Proses
                                    </button>
                                    <button wire:click="confirmReject(<?php echo e($withdrawal->id); ?>)" 
                                            class="px-5 py-2.5 border border-red-200 text-red-500 rounded-xl text-xs font-bold hover:bg-red-50 transition-all flex items-center gap-2">
                                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                                        Reject
                                    </button>
                                </div>
                            <?php elseif($withdrawal->status->value === 'rejected'): ?>
                                <div class="mt-8 p-4 bg-red-50 rounded-xl border border-red-100">
                                    <span class="text-[10px] text-red-400 font-bold uppercase block mb-1">ALASAN PENOLAKAN</span>
                                    <p class="text-xs text-red-600"><?php echo e($withdrawal->rejection_reason); ?></p>
                                    <div class="text-[10px] text-red-300 mt-2">Ditolak oleh <?php echo e($withdrawal->processedBy->name ?? 'Admin'); ?> pada <?php echo e($withdrawal->processed_at->format('j M Y, H:i')); ?></div>
                                </div>
                            <?php elseif($withdrawal->status->value === 'completed'): ?>
                                <div class="mt-8 p-4 bg-emerald-50 rounded-xl border border-emerald-100">
                                    <div class="text-[10px] text-emerald-400 font-bold uppercase block mb-1">STATUS</div>
                                    <p class="text-xs text-emerald-600 font-bold">Telah Berhasil Diproses</p>
                                    <div class="text-[10px] text-emerald-300 mt-2">Disetujui oleh <?php echo e($withdrawal->processedBy->name ?? 'Admin'); ?> pada <?php echo e($withdrawal->processed_at->format('j M Y, H:i')); ?></div>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        
                        <div>
                            <h3 class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-4">INFO WALLET VENDOR</h3>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-xs text-gray-500">Saldo Saat Ini</span>
                                    <span class="text-sm font-bold text-gray-800">Rp <?php echo e(number_format($withdrawal->wallet->balance, 0, ',', '.')); ?></span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-xs text-gray-500">Total Pendapatan</span>
                                    <span class="text-xs font-medium text-gray-700">Rp <?php echo e(number_format($withdrawal->wallet->total_earned, 0, ',', '.')); ?></span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-xs text-gray-500">Total Penarikan</span>
                                    <span class="text-xs font-medium text-gray-700">Rp <?php echo e(number_format($withdrawal->wallet->total_withdrawn, 0, ',', '.')); ?></span>
                                </div>
                            </div>

                            <div class="mt-6 pt-6 border-t border-gray-100">
                                <h3 class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-4">RIWAYAT PENARIKAN (TERKINI)</h3>
                                <div class="space-y-3">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_2 = true; $__currentLoopData = $recentWithdrawals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                        <div <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('recent-withdrawal-{{ $withdrawal->id }}-{{ $recent->id }}', get_defined_vars()); ?>wire:key="recent-withdrawal-<?php echo e($withdrawal->id); ?>-<?php echo e($recent->id); ?>" class="flex justify-between items-center bg-white/50 p-2 rounded-lg">
                                            <div>
                                                <div class="text-[11px] font-bold text-gray-700">Rp <?php echo e(number_format($recent->amount, 0, ',', '.')); ?></div>
                                                <div class="text-[10px] text-gray-400"><?php echo e($recent->created_at->format('j/n/y')); ?></div>
                                            </div>
                                            <span class="text-[9px] font-bold uppercase px-2 py-0.5 rounded-full 
                                                <?php echo e($recent->status->value === 'pending' ? 'bg-[#fff8ed] text-[#f59e0b]' : 
                                                   ($recent->status->value === 'completed' ? 'bg-[#e8fff3] text-[#10b981]' : 'bg-red-50 text-red-500')); ?>">
                                                <?php echo e($recent->status->value); ?>

                                            </span>
                                        </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                        <div class="text-xs text-gray-300 italic">Belum ada riwayat sebelumnya.</div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <div class="py-24 text-center bg-white rounded-3xl border border-dashed border-gray-200">
                <div class="size-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="size-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900">Belum ada permintaan penarikan dana</h3>
                <p class="text-gray-400 text-sm mt-1">Permintaan dari vendor akan muncul di sini untuk diproses.</p>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    
    <div class="mt-8">
        <?php echo e($withdrawals->links()); ?>

    </div>

    
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
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Tolak Penarikan Dana?</h3>
            <p class="text-gray-500 text-sm mb-6 leading-relaxed">
                Berikan alasan penolakan agar vendor dapat melakukan perbaikan. Saldo akan dikembalikan ke wallet vendor secara otomatis.
            </p>
            <textarea wire:model="rejectReason" 
                      class="w-full rounded-2xl border-gray-200 text-sm p-4 h-32 mb-6 focus:ring-red-500 focus:border-red-500"
                      placeholder="Contoh: Nomor rekening tidak valid atau tidak ditemukan..."></textarea>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['rejectReason'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-xs text-red-500 mb-4"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <div class="flex justify-end gap-3">
                <button @click="close()" class="px-6 py-3 bg-gray-100 text-gray-600 rounded-2xl text-sm font-bold hover:bg-gray-200 transition-colors">
                    Batal
                </button>
                <button wire:click="reject" class="px-6 py-3 bg-red-500 text-white rounded-2xl text-sm font-bold hover:bg-red-600 transition-all shadow-lg shadow-red-100">
                    Ya, Tolak & Refund
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
<?php /**PATH /var/www/indonesia-luxe/resources/views/livewire/admin/withdrawal-management.blade.php ENDPATH**/ ?>