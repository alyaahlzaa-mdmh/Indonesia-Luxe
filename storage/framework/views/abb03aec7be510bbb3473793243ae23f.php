<aside 
    class="fixed inset-y-0 left-0 w-64 bg-[#1e1e1e] text-white flex flex-col h-screen overflow-y-auto shrink-0 shadow-lg z-30 transform transition-transform duration-300 ease-in-out lg:relative lg:translate-x-0"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
>
    <!-- Logo area (if any inside sidebar, or it's just links) -->
    <div class="px-6 py-8"></div>

    <nav class="flex-1 space-y-1 px-3">
        <?php
            $navItemClass = "flex items-center gap-3 px-4 py-3 text-sm rounded-lg transition-colors";
            $activeClass = "bg-[#2a2a2a] text-[#cca462] border border-[#cca462]/30";
            $inactiveClass = "text-gray-400 hover:text-white hover:bg-white/5";
        ?>

        <a href="<?php echo e(route('admin.dashboard')); ?>" class="<?php echo e(request()->routeIs('admin.dashboard') ? $activeClass : $inactiveClass); ?> <?php echo e($navItemClass); ?>">
            <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            Overview
        </a>

        <a href="<?php echo e(route('admin.vendors.index')); ?>" class="<?php echo e(request()->routeIs('admin.vendors.*') ? $activeClass : $inactiveClass); ?> <?php echo e($navItemClass); ?>">
            <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            Manajemen Vendor
        </a>

        <?php 
            $pendingPackages = \App\Models\TourPackage::where('status', \App\Enums\PackageStatus::PendingApproval->value)->count(); 
        ?>
        <a href="<?php echo e(route('admin.packages.index')); ?>" class="<?php echo e(request()->routeIs('admin.packages.*') ? $activeClass : $inactiveClass); ?> <?php echo e($navItemClass); ?> justify-between">
            <div class="flex items-center gap-3">
                <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                Paket Tour
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pendingPackages > 0): ?>
                <span class="bg-[#ff3b30] text-white text-[10px] font-bold h-5 min-w-[20px] px-1.5 flex items-center justify-center rounded-full shadow-sm shrink-0">
                    <?php echo e($pendingPackages > 10 ? '10+' : $pendingPackages); ?>

                </span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </a>

        <?php 
            $pendingPayments = \App\Models\PaymentSubmission::where('status', \App\Enums\PaymentValidationStatus::Pending->value)->count(); 
        ?>
        <a href="<?php echo e(route('admin.payments.index')); ?>" class="<?php echo e(request()->routeIs('admin.payments.*') ? $activeClass : $inactiveClass); ?> <?php echo e($navItemClass); ?> justify-between">
            <div class="flex items-center gap-3">
                <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
                Validasi Bayar
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pendingPayments > 0): ?>
                <span class="bg-[#ff3b30] text-white text-[10px] font-bold h-5 min-w-[20px] px-1.5 flex items-center justify-center rounded-full shadow-sm shrink-0">
                    <?php echo e($pendingPayments > 10 ? '10+' : $pendingPayments); ?>

                </span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </a>

        <?php 
            $pendingPromos = \App\Models\Promo::where('status', \App\Enums\PromoStatus::PendingApproval->value)->count(); 
            $pendingGiftCards = \App\Models\GiftCard::where('status', \App\Enums\PromoStatus::PendingApproval->value)->count();
            $totalPendingPromos = $pendingPromos + $pendingGiftCards;
        ?>
        <a href="<?php echo e(route('admin.promos.index')); ?>" class="<?php echo e(request()->routeIs('admin.promos.*') ? $activeClass : $inactiveClass); ?> <?php echo e($navItemClass); ?> justify-between">
            <div class="flex items-center gap-3">
                <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
                Promo & Gift Card
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($totalPendingPromos > 0): ?>
                <span class="bg-[#ff3b30] text-white text-[10px] font-bold h-5 min-w-[20px] px-1.5 flex items-center justify-center rounded-full shadow-sm shrink-0">
                    <?php echo e($totalPendingPromos > 10 ? '10+' : $totalPendingPromos); ?>

                </span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </a>

        <a href="<?php echo e(route('admin.withdrawals.index')); ?>" class="<?php echo e(request()->routeIs('admin.withdrawals.*') ? $activeClass : $inactiveClass); ?> <?php echo e($navItemClass); ?>">
            <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            Penarikan Dana
        </a>

        <a href="<?php echo e(route('admin.reports.monthly')); ?>" class="<?php echo e(request()->routeIs('admin.reports.*') ? $activeClass : $inactiveClass); ?> <?php echo e($navItemClass); ?>">
            <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
            Laporan
        </a>
    </nav>
</aside>
<?php /**PATH C:\Users\fazar\indonesia-luxe-backup\indonesia-luxe\resources\views/components/admin/sidebar.blade.php ENDPATH**/ ?>