<div class="space-y-6">
    
    <div class="mb-8">
        <h1 class="text-[28px] font-bold text-[#1e1e1e] leading-tight">Validasi Pembayaran</h1>
        <p class="text-[13px] text-gray-400 mt-1">
            <?php echo e($totalCount); ?> total — <?php echo e($pendingCount); ?> menunggu validasi
        </p>
    </div>

    
    <div class="flex justify-between items-center bg-white p-4 rounded-2xl border border-gray-100 shadow-sm mb-6">
        <div class="w-full max-w-md">
            <?php if (isset($component)) { $__componentOriginal5cb383ddee3a6dc44b6e82e90e14b261 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5cb383ddee3a6dc44b6e82e90e14b261 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.search-input','data' => ['model' => 'search','value' => $search,'debounce' => 500,'placeholder' => 'Cari nama pelanggan, email, atau kode order...']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.search-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['model' => 'search','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($search),'debounce' => 500,'placeholder' => 'Cari nama pelanggan, email, atau kode order...']); ?>
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
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <div <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('payment-{{ $payment->id }}', get_defined_vars()); ?>wire:key="payment-<?php echo e($payment->id); ?>" class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden transition-all">
                
                <div class="px-4 sm:px-8 py-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 cursor-pointer hover:bg-gray-50/50" 
                     wire:click="toggleExpand(<?php echo e($payment->id); ?>)">
                    <div class="flex items-center gap-3 sm:gap-4">
                        <div class="size-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-400 font-bold shrink-0">
                            <?php echo e(strtoupper(substr($payment->submittedBy->name, 0, 1))); ?>

                        </div>
                        <div class="min-w-0">
                            <div class="text-sm font-bold text-gray-800 truncate"><?php echo e($payment->submittedBy->name); ?></div>
                            <div class="text-[11px] text-gray-400 truncate"><?php echo e($payment->order->code); ?> • <?php echo e($payment->submittedBy->email); ?></div>
                            <div class="text-[11px] text-gray-400 sm:hidden"><?php echo e($payment->created_at->format('j/n/Y')); ?></div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between sm:justify-end gap-6 sm:gap-10 border-t sm:border-t-0 pt-3 sm:pt-0">
                        <div class="text-left sm:text-right">
                            <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest block mb-0.5">TOTAL</span>
                            <span class="text-sm font-bold text-[#f97316]">Rp <?php echo e(number_format($payment->order->total_amount, 0, ',', '.')); ?></span>
                        </div>

                        <div class="flex items-center gap-3">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider 
                                <?php echo e($payment->status->value === 'pending' ? 'bg-[#fff8ed] text-[#f59e0b]' : 
                                   ($payment->status->value === 'approved' ? 'bg-[#e8fff3] text-[#10b981]' : 'bg-red-50 text-red-500')); ?>">
                                <?php echo e($payment->status->value === 'pending' ? 'proof_uploaded' : $payment->status->value); ?>

                            </span>
                            
                            <svg class="size-4 text-gray-300 transition-transform <?php echo e($expandedPaymentId === $payment->id ? 'rotate-180' : ''); ?>" 
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($expandedPaymentId === $payment->id): ?>
                    <div class="px-4 sm:px-8 py-6 sm:py-8 border-t border-gray-50 bg-gray-50/30 grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-10" x-transition>
                        
                        <div>
                            <h3 class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-4">INFO PELANGGAN</h3>
                            <div class="space-y-3">
                                <div>
                                    <div class="text-sm font-bold text-gray-800"><?php echo e($payment->submittedBy->name); ?></div>
                                    <div class="text-xs text-gray-500"><?php echo e($payment->submittedBy->email); ?></div>
                                    <div class="text-xs text-gray-400"><?php echo e($payment->submittedBy->phone ?? '-'); ?></div>
                                </div>
                                
                                <div class="pt-4 border-t border-gray-100">
                                    <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-2">INFO PEMBAYARAN</div>
                                    <div class="text-xs text-gray-600"><span class="font-bold">Bank:</span> <?php echo e($payment->bank_sender_name ?? '-'); ?></div>
                                    <div class="text-xs text-gray-600"><span class="font-bold">Rekening:</span> <?php echo e($payment->bank_sender_account ?? '-'); ?></div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($payment->notes): ?>
                                        <div class="text-xs text-gray-500 mt-2 italic">"<?php echo e($payment->notes); ?>"</div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
 
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($payment->proof_path): ?>
                                    <div class="pt-4 border-t border-gray-100">
                                        <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-3">BUKTI TRANSFER</div>
                                        <img src="<?php echo e(Storage::disk('public')->url($payment->proof_path)); ?>" alt="Bukti transfer <?php echo e($payment->order->code); ?>" class="w-full max-w-xs rounded-2xl border border-gray-200 object-cover">
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
 
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($payment->status === \App\Enums\PaymentValidationStatus::Pending): ?>
                                <div class="relative z-10 mt-8 flex flex-col gap-3 sm:flex-row sm:flex-wrap">
                                    <button type="button"
                                            wire:click.stop="approve(<?php echo e($payment->id); ?>)"
                                            wire:loading.attr="disabled"
                                            wire:target="approve(<?php echo e($payment->id); ?>)"
                                            class="flex w-full touch-manipulation items-center justify-center gap-2 rounded-xl bg-[#10b981] px-5 py-3 text-xs font-bold text-white transition-all hover:bg-[#059669] disabled:cursor-not-allowed disabled:opacity-60 sm:w-auto sm:py-2.5">
                                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                                        Approve
                                    </button>
                                    <button type="button"
                                            wire:click.stop="confirmReject(<?php echo e($payment->id); ?>)"
                                            wire:loading.attr="disabled"
                                            wire:target="confirmReject(<?php echo e($payment->id); ?>)"
                                            class="flex w-full touch-manipulation items-center justify-center gap-2 rounded-xl border border-red-200 px-5 py-3 text-xs font-bold text-red-500 transition-all hover:bg-red-50 disabled:cursor-not-allowed disabled:opacity-60 sm:w-auto sm:py-2.5">
                                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                                        Reject
                                    </button>
                                </div>
                            <?php else: ?>
                                <div class="mt-8 rounded-2xl border border-gray-200 bg-white/70 px-4 py-3 text-xs text-gray-500">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($payment->status === \App\Enums\PaymentValidationStatus::Approved): ?>
                                        Pembayaran ini sudah disetujui<?php echo e($payment->validated_at ? ' pada '.$payment->validated_at->format('j M Y H:i') : ''); ?>.
                                    <?php else: ?>
                                        Pembayaran ini sudah ditolak<?php echo e($payment->validated_at ? ' pada '.$payment->validated_at->format('j M Y H:i') : ''); ?>.
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($payment->rejection_reason): ?>
                                            <div class="mt-2 text-red-500">Alasan: <?php echo e($payment->rejection_reason); ?></div>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
 
                        
                        <div>
                            <h3 class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-4">PAKET DIPESAN</h3>
                            <div class="space-y-4">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $payment->order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <div <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('payment-{{ $payment->id }}-item-{{ $item->id }}', get_defined_vars()); ?>wire:key="payment-<?php echo e($payment->id); ?>-item-<?php echo e($item->id); ?>" class="flex justify-between items-start gap-4">
                                        <div class="text-xs font-medium text-gray-700 max-w-[200px] leading-tight">
                                            <?php echo e($item->package_title); ?>

                                        </div>
                                        <div class="text-xs text-gray-400">
                                            <?php echo e($item->quantity); ?> x Rp <?php echo e(number_format($item->price_per_person / 1000, 0)); ?>rb
                                        </div>
                                    </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
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
                <h3 class="text-lg font-medium text-gray-900">Belum ada pembayaran</h3>
                <p class="text-gray-400 text-sm mt-1">Pembayaran dari customer akan muncul di sini untuk divalidasi.</p>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    
    <div class="mt-8">
        <?php echo e($payments->links()); ?>

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

        <div class="p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-2">Tolak Pembayaran?</h3>
            <p class="text-gray-500 text-sm mb-4">
                Berikan alasan penolakan agar customer dapat melakukan perbaikan.
            </p>
            <textarea wire:model="rejectReason" 
                      class="w-full rounded-xl border-gray-200 text-sm p-4 h-32 mb-6 focus:ring-red-500 focus:border-red-500"
                      placeholder="Contoh: Bukti transfer tidak jelas/blur..."></textarea>
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
</div>
<?php /**PATH C:\Users\fazar\indonesia-luxe-backup\indonesia-luxe\resources\views/livewire/admin/payment-validation.blade.php ENDPATH**/ ?>