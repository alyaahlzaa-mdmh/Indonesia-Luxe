<?php if (isset($component)) { $__componentOriginal82a0c5168088605aac2e71dd1139bf40 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal82a0c5168088605aac2e71dd1139bf40 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.vendor','data' => ['title' => 'Vendor Bookings']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.vendor'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Vendor Bookings')]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <div class="flex items-center justify-between mb-5 lg:hidden">
        <div>
            <p class="text-xs text-gray-400 uppercase tracking-wider">Vendor Dashboard</p>
            <h1 class="text-gray-900"><?php echo e(auth()->user()->name); ?></h1>
        </div>
        <div class="flex items-center gap-1.5 bg-amber-50 border border-amber-200 text-amber-700 text-xs px-3 py-1.5 rounded-full"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big w-3 h-3">
                <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                <path d="m9 11 3 3L22 4"></path>
            </svg> Vendor Verified</div>
    </div>
    <div class="space-y-4">
        <h2 class="text-gray-800 mb-1">Pesanan Masuk</h2>
        <p class="text-xs text-gray-400"><?php echo e($bookings->total()); ?> pesanan masuk</p>
        <div class="space-y-3">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <div class="w-full bg-white rounded-2xl shadow-sm border border-gray-100 transition-all overflow-hidden group">
                <a href="<?php echo e(route('vendor.bookings.show', $booking)); ?>" class="flex hover:bg-gray-50 transition-colors">
                    <div class="w-20 shrink-0 bg-gray-50 flex items-center justify-center min-h-[96px] border-r border-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package w-6 h-6 text-gray-200">
                            <path d="M16.5 9.4 7.5 4.21" />
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z" />
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96" />
                            <line x1="12" y1="22.08" x2="12" y2="12" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0 p-4">
                        <div class="flex justify-between items-start mb-1.5">
                            <div class="min-w-0">
                                <p class="text-sm text-gray-800 truncate font-medium group-hover:text-amber-700 transition-colors"><?php echo e($booking->user->name); ?></p>
                                <p class="text-[11px] text-gray-400 truncate"><?php echo e($booking->user->email); ?> · <?php echo e($booking->orderItem->order->code); ?></p>
                                <p class="text-[11px] text-gray-400"><?php echo e($booking->created_at->format('d/m/Y')); ?></p>
                            </div>
                            <div class="text-right shrink-0 ml-2">
                                <p class="text-sm text-amber-600 font-bold">Rp <?php echo e(number_format($booking->orderItem->line_total, 0, ',', '.')); ?></p>
                                <span class="inline-flex items-center gap-1.5 text-xs <?php echo e($booking->status->textColor()); ?>">
                                    <span class="w-1.5 h-1.5 rounded-full shrink-0 <?php echo e($booking->status->backgroundColor()); ?>"></span>
                                    <?php echo e($booking->status->label()); ?>

                                </span>
                            </div>
                        </div>
                        <div class="space-y-1">
                            <div class="bg-gray-50 rounded-lg px-3 py-1.5 text-xs">
                                <p class="text-gray-700 truncate font-medium"><?php echo e($booking->orderItem->package_title); ?></p>
                                <p class="text-gray-400"><?php echo e($booking->orderItem->departure_date->format('Y-m-d')); ?> · <?php echo e($booking->orderItem->quantity); ?> peserta · Rp <?php echo e(number_format($booking->orderItem->price_per_person, 0, ',', '.')); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center pr-3 shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-4 h-4 text-gray-300">
                            <path d="m9 18 6-6-6-6"></path>
                        </svg>
                    </div>
                </a>
                <?php
                $isPaid = $booking->orderItem->order->paymentSubmissions->isNotEmpty();
                ?>
                <div class="border-t border-gray-50 px-4 py-2 flex items-center justify-between bg-gray-50/60">
                    <div class="flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full <?php echo e($isPaid ? 'bg-emerald-500' : 'bg-gray-300'); ?> shrink-0"></span>
                        <p class="text-[11px] text-gray-400">
                            <?php echo e($isPaid ? 'Sudah unggah bukti pembayaran' : 'Belum ada bukti pembayaran'); ?>

                        </p>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($booking->status === \App\Enums\BookingStatus::Confirmed): ?>
                    <form action="<?php echo e(route('vendor.bookings.complete', $booking)); ?>" method="POST" onsubmit="return confirm('Tandai pesanan ini selesai?')">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>
                        <button type="submit" class="text-[11px] bg-amber-500 hover:bg-amber-600 text-white px-3 py-1 rounded-lg font-medium transition shadow-sm">
                            Tandai Selesai
                        </button>
                    </form>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <div class="bg-white rounded-2xl p-12 text-center shadow-sm border border-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag w-10 h-10 text-gray-200 mx-auto mb-3">
                    <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path>
                    <path d="M3 6h18"></path>
                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                </svg>
                <p class="text-gray-400 text-sm">Belum ada pesanan masuk</p>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>


        <div class="mt-6">
            <?php echo e($bookings->links()); ?>

        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal82a0c5168088605aac2e71dd1139bf40)): ?>
<?php $attributes = $__attributesOriginal82a0c5168088605aac2e71dd1139bf40; ?>
<?php unset($__attributesOriginal82a0c5168088605aac2e71dd1139bf40); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal82a0c5168088605aac2e71dd1139bf40)): ?>
<?php $component = $__componentOriginal82a0c5168088605aac2e71dd1139bf40; ?>
<?php unset($__componentOriginal82a0c5168088605aac2e71dd1139bf40); ?>
<?php endif; ?><?php /**PATH C:\Users\fazar\indonesia-luxe-backup\indonesia-luxe\resources\views/vendor/bookings/index.blade.php ENDPATH**/ ?>