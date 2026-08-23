<?php if (isset($component)) { $__componentOriginal82a0c5168088605aac2e71dd1139bf40 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal82a0c5168088605aac2e71dd1139bf40 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.vendor','data' => ['title' => 'Vendor Sales Report']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.vendor'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Vendor Sales Report')]); ?>
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
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-gray-900">Laporan Keuangan</h2>
                <p class="text-xs text-gray-400 mt-0.5">Ringkasan pendapatan &amp; transaksi vendor Anda</p>
            </div>
            <a href="<?php echo e(route('vendor.reports.sales.export')); ?>" target="_blank" class="flex items-center gap-2 bg-gray-900 hover:bg-gray-800 text-white text-xs px-4 py-2.5 rounded-xl transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-down w-3.5 h-3.5">
                    <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path>
                    <path d="M14 2v4a2 2 0 0 0 2 2h4"></path>
                    <path d="M12 18v-6"></path>
                    <path d="m9 15 3 3 3-3"></path>
                </svg>
                Export PDF
            </a>
        </div>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
            <div class="col-span-2 bg-white border border-gray-100 rounded-2xl p-5 shadow-sm flex items-center gap-4">
                <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-up w-5 h-5 text-[#b8860b]">
                        <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline>
                        <polyline points="16 7 22 7 22 13"></polyline>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs text-gray-400 uppercase tracking-wider">Total Pendapatan</p>
                    <p class="text-gray-900 mt-0.5 truncate font-medium">Rp <?php echo e(number_format($report->total_revenue, 0, ',', '.')); ?></p>
                    <p class="text-[10px] text-gray-400 mt-0.5">Dari <?php echo e($report->confirmed_count); ?> transaksi confirmed</p>
                </div>
            </div>
            <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm">
                <div class="flex items-start justify-between">
                    <div class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag w-4 h-4 text-gray-500">
                            <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path>
                            <path d="M3 6h18"></path>
                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                        </svg>
                    </div>
                    <span class="text-[10px] text-gray-300 uppercase tracking-wider">Total</span>
                </div>
                <p class="text-2xl text-gray-900 mt-3 font-semibold"><?php echo e($report->total_transactions); ?></p>
                <p class="text-xs text-gray-400 mt-0.5">Transaksi</p>
            </div>
            <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm">
                <div class="flex items-start justify-between">
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big w-4 h-4 text-emerald-500">
                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                            <path d="m9 11 3 3L22 4"></path>
                        </svg>
                    </div>
                    <span class="text-[10px] text-gray-300 uppercase tracking-wider">Rate</span>
                </div>
                <p class="text-2xl text-gray-900 mt-3 font-semibold"><?php echo e(number_format($report->conversion_rate, 0)); ?>%</p>
                <p class="text-xs text-gray-400 mt-0.5">Conversion</p>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-3">
            <div class="border rounded-xl px-4 py-3 bg-emerald-50 border-emerald-100 flex items-center gap-3">
                <span class="w-2 h-2 rounded-full shrink-0 bg-emerald-400"></span>
                <div>
                    <p class="text-xs text-emerald-700 font-medium">Confirmed</p>
                    <p class="text-lg text-emerald-700 font-bold"><?php echo e($report->confirmed_count); ?></p>
                </div>
            </div>
            <div class="border rounded-xl px-4 py-3 bg-amber-50 border-amber-100 flex items-center gap-3">
                <span class="w-2 h-2 rounded-full shrink-0 bg-amber-400"></span>
                <div>
                    <p class="text-xs text-amber-700 font-medium">Pending</p>
                    <p class="text-lg text-amber-700 font-bold"><?php echo e($report->pending_count); ?></p>
                </div>
            </div>
            <div class="border rounded-xl px-4 py-3 bg-blue-50 border-blue-100 flex items-center gap-3">
                <span class="w-2 h-2 rounded-full shrink-0 bg-blue-400"></span>
                <div>
                    <p class="text-xs text-blue-700 font-medium">Bukti Dikirim</p>
                    <p class="text-lg text-blue-700 font-bold"><?php echo e($report->awaiting_validation_count); ?></p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                <p class="text-sm text-gray-700 font-medium">Detail Transaksi</p>
                <span class="text-xs text-gray-400"><?php echo e($report->total_transactions); ?> transaksi</span>
            </div>
            <div class="overflow-x-auto scrollbar-none">
                <table class="w-full text-sm min-w-[600px]">
                    <thead>
                        <tr class="bg-gray-50 text-left text-xs text-gray-400 uppercase tracking-wider">
                            <th class="px-5 py-3 font-semibold">Tanggal</th>
                            <th class="px-5 py-3 font-semibold">Customer</th>
                            <th class="px-5 py-3 font-semibold">Tour</th>
                            <th class="px-5 py-3 font-semibold">Peserta</th>
                            <th class="px-5 py-3 font-semibold">Total</th>
                            <th class="px-5 py-3 font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $report->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <tr class="hover:bg-gray-50/80 transition">
                            <td class="px-5 py-3.5 text-xs text-gray-500 whitespace-nowrap"><?php echo e($item->order->created_at->format('d/m/Y')); ?></td>
                            <td class="px-5 py-3.5 text-gray-800 font-medium"><?php echo e($item->order->user->name); ?></td>
                            <td class="px-5 py-3.5 text-xs text-gray-500 max-w-[180px] truncate"><?php echo e($item->package_title); ?></td>
                            <td class="px-5 py-3.5 text-xs text-gray-500"><?php echo e($item->quantity); ?></td>
                            <td class="px-5 py-3.5 text-[#b8860b] whitespace-nowrap font-medium">Rp <?php echo e(number_format($item->line_total, 0, ',', '.')); ?></td>
                            <td class="px-5 py-3.5">
                                <span class="inline-flex items-center gap-1.5 text-xs <?php echo e($item->order->status->colorVendor()); ?> px-2 py-0.5 rounded-lg lg:rounded-full">
                                    <?php echo e($item->order->status->labelVendor()); ?>

                                </span>
                            </td>
                        </tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <tr>
                            <td colspan="6" class="px-5 py-8 text-center text-gray-400">
                                <p>Belum ada transaksi</p>
                            </td>
                        </tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </tbody>
                </table>
            </div>
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
<?php endif; ?><?php /**PATH C:\Users\fazar\indonesia-luxe-backup\indonesia-luxe\resources\views/vendor/reports/sales.blade.php ENDPATH**/ ?>