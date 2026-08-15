<div class="space-y-6">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-[28px] font-bold text-[#1e1e1e] leading-tight flex items-center gap-3">
                <svg class="size-8 text-[#cca462]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Laporan Bulanan
            </h1>
            <p class="text-[13px] text-gray-400 mt-1">Analitik & performa platform</p>
        </div>

        <div class="flex items-center gap-3">
            <div class="flex items-center gap-2 bg-white px-3 py-2 rounded-xl border border-gray-100 shadow-sm">
                <select wire:model.live="selectedMonth" class="text-xs font-bold bg-transparent border-none focus:ring-0 cursor-pointer">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $num => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <option value="<?php echo e($num); ?>"><?php echo e($name); ?></option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </select>
                <div class="w-px h-4 bg-gray-100"></div>
                <select wire:model.live="selectedYear" class="text-xs font-bold bg-transparent border-none focus:ring-0 cursor-pointer">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <option value="<?php echo e($year); ?>"><?php echo e($year); ?></option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </select>
            </div>

            <button wire:click="exportPdf" class="px-5 py-2.5 bg-[#1e1e1e] text-white rounded-xl text-xs font-bold flex items-center gap-2 hover:bg-black transition-all shadow-lg shadow-gray-200">
                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Export PDF
            </button>
        </div>
    </div>

    
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-3">
            <div class="size-2 rounded-full bg-amber-400"></div>
            <div>
                <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest">Total Transaksi</p>
                <div class="flex items-baseline gap-2">
                    <span class="text-sm font-bold text-gray-800"><?php echo e($report['total_transactions']); ?></span>
                    <span class="text-[9px] text-gray-400"><?php echo e($report['month']); ?></span>
                </div>
            </div>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-3">
            <div class="size-2 rounded-full bg-blue-500"></div>
            <div>
                <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest">Total Revenue</p>
                <div class="flex items-baseline gap-2">
                    <span class="text-sm font-bold text-gray-800">Rp <?php echo e(number_format($report['total_revenue'], 0, ',', '.')); ?></span>
                    <span class="text-[9px] text-gray-400">confirmed</span>
                </div>
            </div>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-3">
            <div class="size-2 rounded-full bg-emerald-500"></div>
            <div>
                <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest">Confirmed</p>
                <div class="flex items-baseline gap-2">
                    <span class="text-sm font-bold text-gray-800"><?php echo e($report['confirmed_count']); ?></span>
                    <span class="text-[9px] text-gray-400">transaksi sukses</span>
                </div>
            </div>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-3">
            <div class="size-2 rounded-full bg-sky-400"></div>
            <div>
                <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest">Pending</p>
                <div class="flex items-baseline gap-2">
                    <span class="text-sm font-bold text-gray-800"><?php echo e($report['pending_count']); ?></span>
                    <span class="text-[9px] text-gray-400">perlu verifikasi</span>
                </div>
            </div>
        </div>
    </div>

    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-2 bg-white rounded-3xl border border-gray-100 shadow-sm p-8">
            <div class="flex justify-between items-start mb-8">
                <div>
                    <h3 class="font-bold text-gray-800 text-base">Tren Harian <?php echo e($report['month_name']); ?></h3>
                    <p class="text-[11px] text-gray-400 uppercase tracking-widest font-bold mt-1">Revenue & Jumlah transaksi per hari</p>
                </div>
                <div class="flex items-center gap-4 text-[10px] font-bold">
                    <div class="flex items-center gap-1.5">
                        <span class="size-2 rounded-full bg-amber-400"></span>
                        <span class="text-gray-400 uppercase">Revenue</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="size-2 rounded-full bg-emerald-500"></span>
                        <span class="text-gray-400 uppercase">Transaksi</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4 mb-8">
                <div class="bg-[#fffbeb] p-4 rounded-2xl border border-amber-50">
                    <p class="text-[9px] text-amber-600 font-bold uppercase tracking-widest mb-1">Total Revenue</p>
                    <p class="text-lg font-black text-amber-900 leading-none">Rp <?php echo e(number_format($report['total_revenue'], 0, ',', '.')); ?></p>
                </div>
                <div class="bg-[#f0fdf4] p-4 rounded-2xl border border-emerald-50">
                    <p class="text-[9px] text-emerald-600 font-bold uppercase tracking-widest mb-1">Total Transaksi</p>
                    <p class="text-lg font-black text-emerald-900 leading-none"><?php echo e($report['total_transactions']); ?> order</p>
                </div>
                <div class="bg-[#eff6ff] p-4 rounded-2xl border border-blue-50">
                    <p class="text-[9px] text-blue-600 font-bold uppercase tracking-widest mb-1">Hari Aktif</p>
                    <p class="text-lg font-black text-blue-900 leading-none"><?php echo e($report['active_days']); ?> hari</p>
                </div>
            </div>

            <div class="h-[300px] w-full relative">
                <canvas id="dailyTrendChart"></canvas>
            </div>
        </div>

        
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8 flex flex-col">
            <h3 class="font-bold text-gray-800 text-base mb-1">Distribusi Status Order</h3>
            <p class="text-[11px] text-gray-400 font-medium mb-12">Performance conversion status</p>
            
            <div class="relative size-48 mx-auto mb-12">
                <canvas id="statusChart"></canvas>
                <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                    <span class="text-3xl font-black text-gray-800"><?php echo e($report['status_distribution']['approved']['percentage']); ?>%</span>
                    <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Success Rate</span>
                </div>
            </div>

            <div class="space-y-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['approved' => ['label' => 'Approved', 'color' => '#10b981'], 'pending' => ['label' => 'Pending', 'color' => '#f59e0b'], 'rejected' => ['label' => 'Ditolak', 'color' => '#ef4444']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $meta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="size-2.5 rounded-full" style="background-color: <?php echo e($meta['color']); ?>"></span>
                            <span class="text-xs font-bold text-gray-500 uppercase tracking-widest"><?php echo e($meta['label']); ?></span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-32 bg-gray-50 h-1 rounded-full overflow-hidden">
                                <div class="h-full rounded-full" style="background-color: <?php echo e($meta['color']); ?>; width: <?php echo e($report['status_distribution'][$key]['percentage']); ?>%"></div>
                            </div>
                            <span class="text-[11px] font-black text-gray-800 w-12 text-right"><?php echo e($report['status_distribution'][$key]['count']); ?> (<?php echo e($report['status_distribution'][$key]['percentage']); ?>%)</span>
                        </div>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        </div>
    </div>

    
    <div class="grid grid-cols-1 gap-6">
        
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8">
            <div class="flex justify-between items-center mb-10">
                <div>
                     <h3 class="font-bold text-gray-800 text-base">Distribusi Kategori Tour</h3>
                     <p class="text-[11px] text-gray-400 font-medium mt-1">Jumlah paket per kategori</p>
                </div>
                <span class="px-4 py-1.5 bg-amber-50 text-amber-600 text-[10px] font-bold rounded-full border border-amber-100 uppercase tracking-widest">Kategori Tersimpan</span>
            </div>
            
            <div class="h-[400px]">
                <canvas id="categoryChart"></canvas>
            </div>

            <p class="text-[10px] text-center text-gray-300 mt-6 tracking-widest uppercase">Jumlah paket mengikuti relasi kategori yang tersimpan</p>
        </div>
    </div>

    
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-50 flex justify-between items-center bg-gray-50/10">
            <h3 class="font-bold text-gray-800 text-sm">Statistik Platform (Keseluruhan)</h3>
            <span class="px-3 py-1 bg-amber-50 text-amber-600 text-[10px] font-bold rounded-full border border-amber-100 uppercase tracking-wider">All Time Analytics</span>
        </div>
        <div class="p-8 grid grid-cols-2 md:grid-cols-6 gap-8">
            <div class="space-y-1">
                <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest">Total User</p>
                <p class="text-xl font-bold text-gray-800"><?php echo e($report['total_users']); ?></p>
            </div>
            <div class="space-y-1">
                <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest">Total Vendor</p>
                <p class="text-xl font-bold text-gray-800"><?php echo e($report['total_vendors']); ?></p>
            </div>
            <div class="space-y-1">
                <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest">Paket Tour</p>
                <p class="text-xl font-bold text-gray-800"><?php echo e($report['total_tours']); ?></p>
            </div>
            <div class="space-y-1">
                <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest">Tour Approved</p>
                <p class="text-xl font-bold text-gray-800"><?php echo e($report['approved_tours']); ?></p>
            </div>
            <div class="space-y-1">
                <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest">Total Revenue</p>
                <p class="text-xl font-bold text-[#cca462]">Rp <?php echo e(number_format($report['global_total_revenue'], 0, ',', '.')); ?></p>
            </div>
            <div class="space-y-1">
                <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest">Total Orders</p>
                <p class="text-xl font-bold text-gray-800"><?php echo e($report['global_total_orders']); ?></p>
            </div>
        </div>
    </div>

    
    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center gap-4">
        <div class="flex-1 max-w-md">
            <?php if (isset($component)) { $__componentOriginal5cb383ddee3a6dc44b6e82e90e14b261 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5cb383ddee3a6dc44b6e82e90e14b261 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.search-input','data' => ['model' => 'search','value' => $search,'debounce' => 500,'placeholder' => 'Cari nama customer atau paket tour...']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.search-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['model' => 'search','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($search),'debounce' => 500,'placeholder' => 'Cari nama customer atau paket tour...']); ?>
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

    
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-50 flex justify-between items-center bg-gray-50/10">
            <h3 class="font-bold text-gray-800 text-sm italic uppercase tracking-wider">Detail Transaksi — <?php echo e($report['month']); ?></h3>
            <span class="text-[11px] text-gray-400 font-medium"><?php echo e($orders->total()); ?> transaksi</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50/30 text-[10px] text-gray-400 uppercase tracking-widest font-bold">
                    <tr>
                        <th class="px-8 py-5">Tanggal</th>
                        <th class="px-8 py-5">Customer</th>
                        <th class="px-8 py-5">Tour</th>
                        <th class="px-8 py-5">Total</th>
                        <th class="px-8 py-5">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <tr <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('monthly-report-order-{{ $order->id }}', get_defined_vars()); ?>wire:key="monthly-report-order-<?php echo e($order->id); ?>" class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-8 py-6 text-gray-500 whitespace-nowrap"><?php echo e($order->created_at->format('j/n/Y')); ?></td>
                            <td class="px-8 py-6 font-bold text-gray-800"><?php echo e($order->user->name); ?></td>
                            <td class="px-8 py-6 text-gray-600 max-w-xs truncate">
                                <?php echo e($order->items->first()->package_title ?? '-'); ?>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->items->count() > 1): ?>
                                    <span class="text-[10px] bg-gray-100 px-1 rounded ml-1">+<?php echo e($order->items->count() - 1); ?></span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td class="px-8 py-6 font-bold text-[#cca462]">Rp <?php echo e(number_format($order->total_amount, 0, ',', '.')); ?></td>
                            <td class="px-8 py-6">
                                <span class="px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider <?php echo e($order->status->colorAdmin()); ?>">
                                    <?php echo e($order->status->label()); ?>

                                </span>
                            </td>
                        </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <tr>
                            <td colspan="5" class="px-8 py-20 text-center text-gray-300 italic">Tidak ada transaksi pada periode ini.</td>
                        </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    
    <div class="mt-4">
        <?php echo e($orders->links()); ?>

    </div>

    <script id="monthly-report-chart-data" type="application/json"><?php echo json_encode($report['chart_payload'], 15, 512) ?></script>

        <?php
        $__scriptKey = '4001347082-0';
        ob_start();
    ?>
    <script>
        document.addEventListener('livewire:initialized', () => {
            let dailyTrendChart = null;
            let statusChart = null;
            let categoryChart = null;

            const getChartPayload = () => {
                const payloadElement = document.getElementById('monthly-report-chart-data');

                if (! payloadElement) {
                    return null;
                }

                try {
                    return JSON.parse(payloadElement.textContent);
                } catch (error) {
                    console.error('Unable to parse monthly report chart payload.', error);

                    return null;
                }
            };

            const initCharts = () => {
                const dailyTrendCtx = document.getElementById('dailyTrendChart');
                const statusCtx = document.getElementById('statusChart');
                const categoryCtx = document.getElementById('categoryChart');
                const payload = getChartPayload();

                if (! dailyTrendCtx || ! statusCtx || ! categoryCtx || ! payload || typeof Chart === 'undefined') {
                    return;
                }

                if (dailyTrendChart) {
                    dailyTrendChart.destroy();
                }

                if (statusChart) {
                    statusChart.destroy();
                }

                if (categoryChart) {
                    categoryChart.destroy();
                }

                const trends = payload.daily_trends ?? [];
                const labels = trends.map(t => t.day);
                const transactionData = trends.map(t => t.transactions);
                const revenueData = trends.map(t => t.revenue);

                dailyTrendChart = new Chart(dailyTrendCtx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: 'Revenue',
                                data: revenueData,
                                borderColor: '#f59e0b',
                                backgroundColor: 'rgba(245, 158, 11, 0.05)',
                                fill: true,
                                tension: 0.4,
                                borderWidth: 2,
                                pointRadius: 0,
                                yAxisID: 'y1',
                            },
                            {
                                label: 'Transaksi',
                                data: transactionData,
                                borderColor: '#10b981',
                                backgroundColor: 'transparent',
                                tension: 0.4,
                                borderWidth: 2,
                                pointRadius: 0,
                                yAxisID: 'y',
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: {
                            mode: 'index',
                            intersect: false,
                        },
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: 'white',
                                titleColor: '#1e1e1e',
                                bodyColor: '#6b7280',
                                borderColor: '#f3f4f6',
                                borderWidth: 1,
                                padding: 12,
                                boxPadding: 6,
                                usePointStyle: true,
                                callbacks: {
                                    label: function(context) {
                                        let label = context.dataset.label || '';
                                        if (label) label += ': ';
                                        if (context.dataset.label === 'Revenue') {
                                            label += new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(context.parsed.y);
                                        } else {
                                            label += context.parsed.y;
                                        }
                                        return label;
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                type: 'linear',
                                display: true,
                                position: 'right',
                                grid: { display: false },
                                ticks: { font: { size: 10 }, color: '#9ca3af' }
                            },
                            y1: {
                                type: 'linear',
                                display: false,
                                position: 'left',
                            },
                            x: {
                                grid: { display: false },
                                ticks: { font: { size: 10 }, color: '#9ca3af' }
                            }
                        }
                    }
                });

                const statusData = payload.status_distribution ?? {
                    approved: { count: 0 },
                    pending: { count: 0 },
                    rejected: { count: 0 },
                };

                statusChart = new Chart(statusCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Approved', 'Pending', 'Rejected'],
                        datasets: [{
                            data: [statusData.approved.count, statusData.pending.count, statusData.rejected.count],
                            backgroundColor: ['#10b981', '#f59e0b', '#ef4444'],
                            borderWidth: 0,
                            cutout: '85%'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false }
                        }
                    }
                });

                const categories = payload.category_distribution ?? [];
                const categoryLabels = categories.map(c => c.name);
                const categoryData = categories.map(c => c.count);
                const colors = ['#b8860b', '#cca462', '#6366f1', '#10b981', '#f43f5e', '#0ea5e9', '#8b5cf6'];

                categoryChart = new Chart(categoryCtx, {
                    type: 'bar',
                    data: {
                        labels: categoryLabels,
                        datasets: [{
                            data: categoryData,
                            backgroundColor: categoryLabels.map((_, index) => colors[index % colors.length]),
                            borderRadius: 6,
                            barThickness: 15
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            x: {
                                grid: { display: false },
                                ticks: { font: { size: 10 }, color: '#9ca3af' }
                            },
                            y: {
                                grid: { display: false },
                                ticks: { font: { size: 10 }, color: '#6b7280' }
                            }
                        }
                    }
                });
            };

            initCharts();

            Livewire.on('refreshCharts', () => {
                requestAnimationFrame(() => {
                    requestAnimationFrame(initCharts);
                });
            });
        });
    </script>
        <?php
        $__output = ob_get_clean();

        \Livewire\store($this)->push('scripts', $__output, $__scriptKey)
    ?>
</div>
<?php /**PATH /var/www/indonesia-luxe/resources/views/livewire/admin/monthly-report.blade.php ENDPATH**/ ?>