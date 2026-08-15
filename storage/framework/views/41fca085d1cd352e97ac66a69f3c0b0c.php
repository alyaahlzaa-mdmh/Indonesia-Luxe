<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>ILT_Laporan_<?php echo e($report['month_name']); ?>_<?php echo e($report['year']); ?></title>
    <style>
        @page { margin: 0; }
        body { font-family: 'Helvetica', sans-serif; color: #333; margin: 0; padding: 0; line-height: 1.4; }
        
        /* Header */
        .header { background-color: #1e1e1e; color: white; padding: 40px 50px; position: relative; }
        .header .logo { width: 45px; vertical-align: middle; }
        .header .brand { display: inline-block; vertical-align: middle; margin-left: 15px; }
        .header .brand h1 { margin: 0; font-size: 22px; letter-spacing: 2px; color: #cca462; }
        .header .brand p { margin: 2px 0 0; font-size: 10px; color: #999; text-transform: uppercase; letter-spacing: 1px; }
        .header .subtitle { margin-top: 15px; font-size: 11px; color: #888; }
        
        .header-info { position: absolute; right: 50px; top: 40px; text-align: right; }
        .header-info h2 { margin: 0; color: #cca462; font-size: 16px; text-transform: uppercase; letter-spacing: 1px; }
        .header-info .month { margin-top: 8px; font-size: 12px; color: #eee; font-weight: bold; }
        .header-info .printed { margin-top: 5px; font-size: 10px; color: #999; }

        .content { padding: 40px 50px; }
        
        .section-title { background-color: #f8f9fa; padding: 10px 15px; border-radius: 8px; margin-bottom: 20px; }
        .section-title h3 { margin: 0; color: #cca462; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; }
        
        /* Summary Cards */
        .stats-grid { width: 100%; border-collapse: separate; border-spacing: 15px 0; margin: 0 -15px 30px; }
        .stat-card { background: white; border: 1px solid #eee; border-radius: 10px; padding: 20px; width: 48%; }
        .stat-card.with-border { border-left: 5px solid #cca462; }
        .stat-card .label { font-size: 9px; color: #999; text-transform: uppercase; font-weight: bold; letter-spacing: 0.5px; margin-bottom: 8px; }
        .stat-card .value { font-size: 20px; font-weight: bold; color: #333; }
        .stat-card .desc { font-size: 9px; color: #aaa; margin-top: 5px; }

        /* Platform Stats Table */
        .platform-stats { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .platform-stats td { width: 50%; padding: 12px 15px; border-bottom: 1px solid #f0f0f0; }
        .platform-stats .label { font-size: 11px; color: #666; }
        .platform-stats .value { font-size: 11px; font-weight: bold; text-align: right; }

        /* Distribution Chart Simulation */
        .dist-item { margin-bottom: 12px; }
        .dist-info { font-size: 10px; margin-bottom: 4px; color: #555; overflow: hidden; }
        .dist-info span { float: right; font-weight: bold; }
        .progress-bg { background-color: #f0f0f0; height: 12px; border-radius: 6px; position: relative; }
        .progress-bar { background-color: #cca462; height: 12px; border-radius: 6px; }

        /* Details Table */
        .table-title { margin: 40px 0 15px; font-size: 13px; color: #cca462; font-weight: bold; text-transform: uppercase; border-bottom: 2px solid #f0f0f0; padding-bottom: 5px; }
        .details-table { width: 100%; border-collapse: collapse; }
        .details-table th { background-color: #1e1e1e; color: white; text-align: left; padding: 12px 10px; font-size: 10px; text-transform: uppercase; }
        .details-table td { padding: 12px 10px; border-bottom: 1px solid #eee; font-size: 10px; color: #444; }
        .details-table .status-confirmed { color: #10b981; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <div class="brand">
            <h1>INDONESIA LUXE</h1>
            <p>TRAVEL · Luxury Travel Marketplace</p>
        </div>
        <div class="subtitle">Admin Management System</div>
        
        <div class="header-info">
            <h2>Laporan Bulanan</h2>
            <div class="month"><?php echo e(strtoupper($report['month'])); ?></div>
            <div class="printed">Dicetak: <?php echo e(now()->translatedFormat('d F Y')); ?></div>
        </div>
    </div>

    <div class="content">
        <div class="section-title">
            <h3>Ringkasan Eksekutif</h3>
        </div>
        
        <table class="stats-grid">
            <tr>
                <td class="stat-card with-border">
                    <div class="label">Total Transaksi</div>
                    <div class="value"><?php echo e($report['total_transactions']); ?></div>
                    <div class="desc">bulan <?php echo e($report['month_name']); ?></div>
                </td>
                <td class="stat-card with-border">
                    <div class="label">Total Revenue</div>
                    <div class="value">Rp <?php echo e(number_format($report['total_revenue'], 0, ',', '.')); ?></div>
                    <div class="desc">pembayaran terkonfirmasi</div>
                </td>
            </tr>
            <tr>
                <td class="stat-card with-border">
                    <div class="label">Transaksi Sukses</div>
                    <div class="value"><?php echo e($report['confirmed_count']); ?></div>
                    <div class="desc">status confirmed</div>
                </td>
                <td class="stat-card with-border">
                    <div class="label">Transaksi Pending</div>
                    <div class="value"><?php echo e($report['pending_count']); ?></div>
                    <div class="desc">menunggu pembayaran / verifikasi</div>
                </td>
            </tr>
        </table>

        <div class="section-title">
            <h3>Statistik Platform (Keseluruhan)</h3>
        </div>
        
        <table class="platform-stats">
            <tr>
                <td class="label">Total User</td>
                <td class="value"><?php echo e($report['total_users']); ?></td>
                <td class="label">Total Vendor</td>
                <td class="value"><?php echo e($report['total_vendors']); ?></td>
            </tr>
            <tr>
                <td class="label">Paket Tour</td>
                <td class="value"><?php echo e($report['total_tours']); ?></td>
                <td class="label">Tour Approved</td>
                <td class="value"><?php echo e($report['approved_tours']); ?></td>
            </tr>
            <tr>
                <td class="label" style="border-bottom: none;">Total Revenue</td>
                <td class="value" style="border-bottom: none;">Rp <?php echo e(number_format($report['global_total_revenue'], 0, ',', '.')); ?></td>
                <td class="label" style="border-bottom: none;">Total Orders</td>
                <td class="value" style="border-bottom: none;"><?php echo e($report['global_total_orders']); ?></td>
            </tr>
        </table>

        <div class="section-title">
            <h3>Distribusi Paket Tour Per Kategori</h3>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $report['category_distribution']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <div class="dist-item">
                <div class="dist-info"><?php echo e($dist['name']); ?> <span><?php echo e($dist['count']); ?></span></div>
                <div class="progress-bg">
                    <div class="progress-bar" style="width: <?php echo e($report['total_tours'] > 0 ? ($dist['count'] / $report['total_tours'] * 100) : 0); ?>%"></div>
                </div>
            </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

        <div style="page-break-before: always;"></div>

        <div class="table-title">Detail Transaksi — <?php echo e($report['month']); ?></div>
        
        <table class="details-table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Customer</th>
                    <th>Tour</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $report['orders']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <tr>
                    <td><?php echo e($order->created_at->format('j/n/Y')); ?></td>
                    <td style="font-weight: bold;"><?php echo e($order->user->name); ?></td>
                    <td><?php echo e($order->items->first()->package_title ?? '-'); ?></td>
                    <td style="font-weight: bold;">Rp <?php echo e(number_format($order->total_amount, 0, ',', '.')); ?></td>
                    <td class="status-confirmed"><?php echo e($order->status->label()); ?></td>
                </tr>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <tr>
                    <td colspan="5" style="text-align: center; color: #999;">Tidak ada transaksi pada periode ini.</td>
                </tr>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php /**PATH /var/www/indonesia-luxe/resources/views/admin/reports/pdf/monthly.blade.php ENDPATH**/ ?>