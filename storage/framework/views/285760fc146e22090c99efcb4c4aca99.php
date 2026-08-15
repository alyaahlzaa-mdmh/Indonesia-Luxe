<div class="bg-[#FDFBF7] min-h-screen w-full flex flex-col">
    <!-- Hero Banner with Curve -->
    <div class="relative w-full mb-12">
        <div class="absolute inset-0 w-full h-[450px] overflow-hidden" style="z-index: 0;">
            <div class="absolute inset-0 bg-gradient-to-r from-[#ce6223] via-[#854524] to-[#211820]"></div>
            <div class="absolute inset-0 opacity-40 bg-[radial-gradient(circle_at_70%_20%,_#ff8c42_0%,_transparent_40%)]"></div>
        </div>
        
        <!-- SVG Wave Divider -->
        <div class="absolute top-[400px] left-0 w-full overflow-hidden leading-none z-10 pointer-events-none text-[#FDFBF7]">
            <svg class="relative block w-full h-[50px] md:h-[100px]" preserveAspectRatio="none" viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,60 C400,0 800,20 1200,80 L1200,120 L0,120 Z" fill="currentColor"></path>
            </svg>
        </div>

        <div class="relative z-20 w-full max-w-5xl mx-auto px-4 pt-10 pb-[100px] text-center">
            <!-- Back Button -->
            <div class="text-left mb-6">
                <a href="<?php echo e(route('home')); ?>" class="inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-full bg-white/10 hover:bg-white/20 text-white/90 text-xs font-semibold backdrop-blur-sm transition-colors border border-white/10">
                    <?php if (isset($component)) { $__componentOriginalec0351b80e4f79e3bd5939885e07019a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalec0351b80e4f79e3bd5939885e07019a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.guest.icons.chevron-left','data' => ['class' => 'w-3.5 h-3.5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest.icons.chevron-left'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-3.5 h-3.5']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalec0351b80e4f79e3bd5939885e07019a)): ?>
<?php $attributes = $__attributesOriginalec0351b80e4f79e3bd5939885e07019a; ?>
<?php unset($__attributesOriginalec0351b80e4f79e3bd5939885e07019a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalec0351b80e4f79e3bd5939885e07019a)): ?>
<?php $component = $__componentOriginalec0351b80e4f79e3bd5939885e07019a; ?>
<?php unset($__componentOriginalec0351b80e4f79e3bd5939885e07019a); ?>
<?php endif; ?>
                    <?php echo e(__('promo.back')); ?>

                </a>
            </div>

            <div class="mx-auto flex flex-col items-center">
                <div class="w-12 h-12 mb-3 bg-white/10 rounded-full flex items-center justify-center border border-white/20 backdrop-blur-sm">
                    <span class="text-2xl pt-1">🎉</span>
                </div>
                <div class="text-white/70 text-[11px] font-bold tracking-[0.2em] mb-4 uppercase">
                    <?php echo e(__('promo.hero_date')); ?>

                </div>
                <h1 class="text-4xl md:text-[56px] font-serif text-white mb-6 text-shadow-sm font-medium"><?php echo e(__('promo.hero_title')); ?></h1>
                <p class="text-white/90 text-sm md:text-[17px] font-light mb-10 max-w-lg"><?php echo e(__('promo.hero_subtitle')); ?></p>
                
                <?php
                    $heroBadges = [
                        ['icon' => 'M19 5L5 19M21 12A9 9 0 0 0 3 12A9 9 0 0 0 21 12Z', 'text' => __('promo.hero_badge_discount')],
                        ['icon' => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z', 'text' => __('promo.hero_badge_code')],
                        ['icon' => 'M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z', 'text' => __('promo.hero_badge_valid')],
                    ];
                ?>

                <div class="flex flex-wrap justify-center gap-3 mb-8">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $heroBadges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $badge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <div class="flex items-center gap-2 bg-black/20 border border-white/20 px-5 py-2.5 rounded-full backdrop-blur-md text-white/90 text-[13px] md:text-sm shadow-inner">
                        <svg class="w-4 h-4 opacity-70" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="<?php echo e($badge['icon']); ?>"/></svg>
                        <span><?php echo $badge['text']; ?></span>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>

                <div class="relative group cursor-pointer inline-block">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-[#f7a35c] to-[#e68031] rounded-full blur opacity-60 group-hover:opacity-100 transition duration-1000 group-hover:duration-200"></div>
                    <button class="relative bg-gradient-to-r from-[#e88840] to-[#cb6219] hover:from-[#db782f] hover:to-[#bd5511] text-white px-8 md:px-10 py-3.5 rounded-full font-bold text-sm transition-transform flex items-center gap-2 group-active:scale-95 border border-orange-400/30">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        <?php echo e(__('promo.hero_copy_code')); ?>

                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Promo Calendar List -->
    <div class="flex items-center justify-center max-w-3xl mx-auto -mt-6 relative z-20 mb-8 px-4">
        <div class="h-px bg-orange-200/50 flex-grow hidden md:block"></div>
        <div class="whitespace-nowrap px-4 w-full md:w-auto">
            <div class="bg-gradient-to-r from-[#ce6223] to-[#e88840] text-white px-5 py-2.5 rounded-full text-[13px] font-semibold shadow-md flex items-center justify-center gap-2 w-full md:w-auto">
                <svg class="w-4 h-4 opacity-90" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <?php echo e(__('promo.calendar_title')); ?>

            </div>
        </div>
        <div class="h-px bg-orange-200/50 flex-grow hidden md:block"></div>
    </div>

    <?php
        $calendarItems = [
            ['date' => __('promo.calendar_item_1_date'), 'title' => __('promo.calendar_item_1_title'), 'code' => 'LUXEFEB29', 'active' => false, 'codeStyle' => 'bg-gray-100/80 text-gray-400 border-gray-300'],
            ['date' => __('promo.calendar_item_2_date'), 'title' => __('promo.calendar_item_2_title'), 'code' => 'LUXEMAR', 'active' => true, 'codeStyle' => 'bg-blue-50/50 text-blue-500 border-blue-200 font-semibold'],
            ['date' => __('promo.calendar_item_3_date'), 'title' => __('promo.calendar_item_3_title'), 'code' => 'LUXEPRIVATE', 'active' => false, 'codeStyle' => 'bg-gray-100/80 text-gray-400 border-gray-300'],
            ['date' => __('promo.calendar_item_4_date'), 'title' => __('promo.calendar_item_4_title'), 'code' => 'LUXEHOTEL', 'active' => true, 'codeStyle' => 'bg-white text-orange-600 border-orange-300 font-semibold shadow-sm'],
        ];
    ?>

    <div class="max-w-3xl mx-auto px-4 mb-24 flex flex-col gap-3">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $calendarItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
        <div class="bg-<?php echo e($item['active'] ? 'gradient-to-r from-orange-50/50 to-amber-50/50' : 'white'); ?> border text-center border-<?php echo e($item['active'] ? 'orange-200' : 'gray-100'); ?> rounded-2xl p-3 md:p-4 flex flex-col md:flex-row md:items-center justify-between shadow-[0_4px_20px_-8px_rgba(<?php echo e($item['active'] ? '206,98,35,0.15' : '0,0,0,0.06'); ?>)] gap-4 <?php echo e(!$item['active'] ? 'hover:border-orange-200 transition-colors' : ''); ?>">
            <div class="flex items-center gap-3 md:gap-4 w-full md:w-auto justify-between md:justify-start">
                <span class="<?php echo e($item['active'] ? 'bg-[#f29150] text-white shadow-sm border-orange-400/50' : 'bg-gray-50 text-gray-500 border-gray-100'); ?> font-bold text-[11px] md:text-xs px-4 py-2 rounded-xl flex-shrink-0 border"><?php echo e($item['date']); ?></span>
                <span class="text-[13px] md:text-sm font-semibold text-slate-700 md:ml-2"><?php echo e($item['title']); ?></span>
            </div>
            <div class="flex items-center justify-between md:justify-end gap-3 w-full md:w-auto <?php echo e(!$item['active'] ? 'bg-gray-50/50' : 'bg-white/50'); ?> md:bg-transparent p-2 md:p-0 rounded-xl">
                <span class="<?php echo e($item['codeStyle']); ?> font-mono text-[11px] md:text-xs px-3 py-1.5 rounded-lg border border-dashed"><?php echo e($item['code']); ?></span>
                <button class="text-[#ce6223] p-1.5 rounded-md hover:bg-orange-50 transition-colors cursor-pointer" title="<?php echo e(__('promo.calendar_copy_tooltip')); ?>">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                </button>
            </div>
        </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
    </div>

    <!-- Voucher Cards Section -->
    <div class="max-w-5xl mx-auto px-4 mb-20">
        <?php if (isset($component)) { $__componentOriginal528d3d2ed13f9644d4a0e4544eaa5449 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal528d3d2ed13f9644d4a0e4544eaa5449 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.guest.section-title','data' => ['title' => __('promo.vouchers_title'),'subtitle' => __('promo.vouchers_subtitle')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest.section-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('promo.vouchers_title')),'subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('promo.vouchers_subtitle'))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal528d3d2ed13f9644d4a0e4544eaa5449)): ?>
<?php $attributes = $__attributesOriginal528d3d2ed13f9644d4a0e4544eaa5449; ?>
<?php unset($__attributesOriginal528d3d2ed13f9644d4a0e4544eaa5449); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal528d3d2ed13f9644d4a0e4544eaa5449)): ?>
<?php $component = $__componentOriginal528d3d2ed13f9644d4a0e4544eaa5449; ?>
<?php unset($__componentOriginal528d3d2ed13f9644d4a0e4544eaa5449); ?>
<?php endif; ?>

        <?php
            $vouchers = [
                ['gradient' => 'from-[#ff9e43] to-[#ff7a2f]', 'shadow' => 'rgba(255,122,47,0.3)', 'label' => __('promo.voucher_label_all'), 'labelColor' => 'text-orange-100', 'discount' => '20%', 'discountType' => 'percent', 'minOrder' => __('promo.voucher_min_order', ['amount' => '500.000']), 'minColor' => 'text-orange-100/90', 'code' => 'LUXENEW20'],
                ['gradient' => 'from-[#ff5e89] to-[#eb3364]', 'shadow' => 'rgba(235,51,100,0.3)', 'label' => __('promo.voucher_label_open'), 'labelColor' => 'text-rose-100', 'discount' => '10%', 'discountType' => 'percent', 'minOrder' => __('promo.voucher_min_order', ['amount' => '250.000']), 'minColor' => 'text-rose-100/90', 'code' => 'LUXEFEB10'],
                ['gradient' => 'from-[#9455f8] to-[#6a31f1]', 'shadow' => 'rgba(106,49,241,0.3)', 'label' => __('promo.voucher_label_private'), 'labelColor' => 'text-purple-100', 'discount' => '150.000', 'discountType' => 'amount', 'minOrder' => __('promo.voucher_min_order', ['amount' => '600.000']), 'minColor' => 'text-purple-100/90', 'code' => 'LUXEFIRST'],
            ];
        ?>

        <div class="grid md:grid-cols-3 gap-5">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $vouchers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $voucher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <div class="bg-gradient-to-br <?php echo e($voucher['gradient']); ?> rounded-[24px] p-6 text-white shadow-[0_10px_25px_-5px_<?php echo e($voucher['shadow']); ?>] relative overflow-hidden group hover:-translate-y-1 transition-transform duration-300">
                <div class="absolute -top-4 -right-4 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                <div class="absolute top-5 right-5 w-10 h-10 flex items-center justify-center bg-white/10 rounded-full backdrop-blur-sm border border-white/20">
                    <svg class="w-5 h-5 text-white/90" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.5 9a2.5 2.5 0 0 0-5 0v6a2.5 2.5 0 0 0 5 0V9z" /><path stroke-linecap="round" stroke-linejoin="round" d="M3 8v8a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2z" /><path stroke-linecap="round" stroke-linejoin="round" d="M3 12h3M18 12h3" /></svg>
                </div>
                
                <p class="<?php echo e($voucher['labelColor']); ?> text-[11px] font-bold uppercase tracking-wider mb-2"><?php echo e($voucher['label']); ?></p>
                <div class="flex items-baseline gap-1 mb-2">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($voucher['discountType'] === 'amount'): ?>
                        <span class="text-xl font-medium font-serif">Rp</span>
                        <h3 class="text-[34px] leading-none font-bold font-serif tracking-tight drop-shadow-sm"><?php echo e($voucher['discount']); ?></h3>
                    <?php else: ?>
                        <h3 class="text-5xl font-bold font-serif tracking-tight drop-shadow-sm"><?php echo e($voucher['discount']); ?></h3>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <p class="<?php echo e($voucher['minColor']); ?> text-[13px] mb-8 font-light"><?php echo e($voucher['minOrder']); ?></p>
                
                <div class="bg-white/15 hover:bg-white/25 border border-white/30 rounded-xl p-3 flex items-center justify-between backdrop-blur-md cursor-pointer transition-colors">
                    <span class="font-mono text-sm font-semibold tracking-wider drop-shadow-sm"><?php echo e($voucher['code']); ?></span>
                    <svg class="w-4 h-4 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                </div>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    </div>

    <!-- Ticker Section -->
    <div class="w-full bg-[#1b1919] text-white/90 overflow-hidden mb-20 py-3.5 border-y border-[#3a3031] shadow-xl relative top-0 flex">
        <div class="absolute inset-y-0 left-0 w-24 bg-gradient-to-r from-[#1b1919] to-transparent z-10 pointer-events-none"></div>
        <div class="absolute inset-y-0 right-0 w-24 bg-gradient-to-l from-[#1b1919] to-transparent z-10 pointer-events-none"></div>
        <div class="animate-marquee whitespace-nowrap flex gap-8 text-[13px] font-medium tracking-wide items-center w-max">
            <?php
                $tickerItems = [
                    ['emoji' => '⚡', 'text' => __('promo.ticker_1')],
                    ['emoji' => '🏝️', 'text' => __('promo.ticker_2')],
                    ['emoji' => '💸', 'text' => __('promo.ticker_3')],
                    ['emoji' => '💳', 'text' => __('promo.ticker_4')],
                    ['emoji' => '🎁', 'text' => __('promo.ticker_5')],
                    ['emoji' => '🎧', 'text' => __('promo.ticker_6')],
                ];
            ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i = 0; $i < 4; $i++): ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $tickerItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticker): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <span class="flex items-center gap-2"><span><?php echo e($ticker['emoji']); ?></span><?php echo e($ticker['text']); ?></span>
                <span class="text-orange-500/60">•</span>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    <!-- Tours Grid Section -->
    <div class="max-w-5xl mx-auto px-4 mb-16">
        <?php if (isset($component)) { $__componentOriginal528d3d2ed13f9644d4a0e4544eaa5449 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal528d3d2ed13f9644d4a0e4544eaa5449 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.guest.section-title','data' => ['title' => __('promo.tours_title'),'subtitle' => __('promo.tours_subtitle')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest.section-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('promo.tours_title')),'subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('promo.tours_subtitle'))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

            <!-- Filter Chips -->
            <div class="mt-6 mb-8">
                <?php if (isset($component)) { $__componentOriginale73a7b1822698de6673281428b75c3a2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale73a7b1822698de6673281428b75c3a2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.guest.type-filter-chips','data' => ['currentType' => $type,'typeLabels' => $typeLabels,'onlyTypes' => ['open_trip', 'private_tour', 'hiking_camping', 'snorkeling_diving'],'size' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest.type-filter-chips'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['currentType' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($type),'typeLabels' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($typeLabels),'onlyTypes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['open_trip', 'private_tour', 'hiking_camping', 'snorkeling_diving']),'size' => 'md']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale73a7b1822698de6673281428b75c3a2)): ?>
<?php $attributes = $__attributesOriginale73a7b1822698de6673281428b75c3a2; ?>
<?php unset($__attributesOriginale73a7b1822698de6673281428b75c3a2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale73a7b1822698de6673281428b75c3a2)): ?>
<?php $component = $__componentOriginale73a7b1822698de6673281428b75c3a2; ?>
<?php unset($__componentOriginale73a7b1822698de6673281428b75c3a2); ?>
<?php endif; ?>
            </div>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal528d3d2ed13f9644d4a0e4544eaa5449)): ?>
<?php $attributes = $__attributesOriginal528d3d2ed13f9644d4a0e4544eaa5449; ?>
<?php unset($__attributesOriginal528d3d2ed13f9644d4a0e4544eaa5449); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal528d3d2ed13f9644d4a0e4544eaa5449)): ?>
<?php $component = $__componentOriginal528d3d2ed13f9644d4a0e4544eaa5449; ?>
<?php unset($__componentOriginal528d3d2ed13f9644d4a0e4544eaa5449); ?>
<?php endif; ?>

        <div class="grid gap-5 md:grid-cols-3 lg:grid-cols-4">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $tourPackages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tourPackage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <?php if (isset($component)) { $__componentOriginal4dedb5c206e93a40e5dec0a39924845e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4dedb5c206e93a40e5dec0a39924845e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.guest.tour-card','data' => ['tourPackage' => $tourPackage,'typeLabels' => $typeLabels,'variant' => 'promo']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest.tour-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['tourPackage' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tourPackage),'typeLabels' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($typeLabels),'variant' => 'promo']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4dedb5c206e93a40e5dec0a39924845e)): ?>
<?php $attributes = $__attributesOriginal4dedb5c206e93a40e5dec0a39924845e; ?>
<?php unset($__attributesOriginal4dedb5c206e93a40e5dec0a39924845e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4dedb5c206e93a40e5dec0a39924845e)): ?>
<?php $component = $__componentOriginal4dedb5c206e93a40e5dec0a39924845e; ?>
<?php unset($__componentOriginal4dedb5c206e93a40e5dec0a39924845e); ?>
<?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <?php if (isset($component)) { $__componentOriginal164f0f9a6a4070e5320b5be0a56c3e06 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal164f0f9a6a4070e5320b5be0a56c3e06 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.guest.empty-state','data' => ['title' => __('promo.tours_empty_title'),'subtitle' => __('promo.tours_empty_subtitle'),'variant' => 'promo','showReset' => false,'showHome' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest.empty-state'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('promo.tours_empty_title')),'subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('promo.tours_empty_subtitle')),'variant' => 'promo','showReset' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'showHome' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal164f0f9a6a4070e5320b5be0a56c3e06)): ?>
<?php $attributes = $__attributesOriginal164f0f9a6a4070e5320b5be0a56c3e06; ?>
<?php unset($__attributesOriginal164f0f9a6a4070e5320b5be0a56c3e06); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal164f0f9a6a4070e5320b5be0a56c3e06)): ?>
<?php $component = $__componentOriginal164f0f9a6a4070e5320b5be0a56c3e06; ?>
<?php unset($__componentOriginal164f0f9a6a4070e5320b5be0a56c3e06); ?>
<?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tourPackages->hasPages()): ?>
        <div class="mt-10">
            <?php echo e($tourPackages->links()); ?>

        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        
        <div class="mt-16 text-center mb-24">
            <a href="<?php echo e(route('tours.index')); ?>" class="inline-flex items-center gap-2 bg-[#FF7A45] hover:bg-[#eb6a35] text-white px-8 md:px-10 py-3.5 rounded-full font-bold text-sm shadow-md shadow-orange-500/20 transition-transform hover:-translate-y-0.5">
                <?php echo e(__('promo.tours_book_now')); ?>

                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
        
        <!-- Exploring Indonesia Section -->
        <div class="mb-20">
            <!-- Banner JELAJAHI Pesona Indonesia -->
            <div class="w-full relative rounded-2xl overflow-hidden bg-[#8C4E2D] py-8 mb-8 flex flex-col items-center justify-center shadow-md">
                <div class="absolute inset-x-0 bottom-0 pointer-events-none text-[#574B54]/40" style="height: 60%">
                    <svg class="block w-full h-full" preserveAspectRatio="none" viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0,80 C400,20 800,0 1200,40 L1200,120 L0,120 Z" fill="currentColor"></path>
                    </svg>
                </div>
                <div class="absolute inset-x-0 bottom-0 pointer-events-none text-[#40373F]/70" style="height: 40%">
                    <svg class="block w-full h-full" preserveAspectRatio="none" viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0,100 C300,50 600,60 1200,20 L1200,120 L0,120 Z" fill="currentColor"></path>
                    </svg>
                </div>
                <div class="relative z-10 text-center">
                    <p class="text-white/80 text-[10px] uppercase tracking-[0.2em] mb-1 font-medium"><?php echo e(__('promo.explore_subtitle')); ?></p>
                    <h2 class="text-3xl md:text-[32px] font-serif text-white font-medium"><?php echo e(__('promo.explore_title')); ?></h2>
                </div>
            </div>

            <!-- Chips Section -->
            <div class="flex flex-col gap-3 mb-8">
                <?php
                    $locationChips = ['Bali', 'Lombok', 'Raja Ampat', 'Yogyakarta'];
                    $activityChips = ['Nature Wonders', 'Outdoor Activities', 'Family Vacation'];
                ?>
                <div class="flex overflow-x-auto gap-2.5 pb-2 hide-scrollbar">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $locationChips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $chip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <button class="px-6 py-2 rounded-full text-[13px] font-medium transition-colors border shadow-sm flex-shrink-0 <?php echo e($i === 0 ? 'bg-[#FF7A45] text-white border-[#FF7A45]' : 'bg-white text-slate-600 border-gray-200 hover:bg-gray-50'); ?>">
                        <?php echo e($chip); ?>

                    </button>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
                <div class="flex overflow-x-auto gap-2 pb-2 hide-scrollbar">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $activityChips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <button class="px-4 py-1.5 rounded-full text-[11px] font-medium transition-colors border border-gray-200 flex-shrink-0 bg-white text-slate-500 hover:bg-gray-50 shadow-sm">
                        <?php echo e($chip); ?>

                    </button>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            </div>

            <!-- Featured Card Grid -->
            <div class="grid gap-5 md:grid-cols-3 lg:grid-cols-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $featuredPackages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tourPackage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal4dedb5c206e93a40e5dec0a39924845e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4dedb5c206e93a40e5dec0a39924845e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.guest.tour-card','data' => ['tourPackage' => $tourPackage,'typeLabels' => $typeLabels,'variant' => 'promo']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest.tour-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['tourPackage' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tourPackage),'typeLabels' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($typeLabels),'variant' => 'promo']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4dedb5c206e93a40e5dec0a39924845e)): ?>
<?php $attributes = $__attributesOriginal4dedb5c206e93a40e5dec0a39924845e; ?>
<?php unset($__attributesOriginal4dedb5c206e93a40e5dec0a39924845e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4dedb5c206e93a40e5dec0a39924845e)): ?>
<?php $component = $__componentOriginal4dedb5c206e93a40e5dec0a39924845e; ?>
<?php unset($__componentOriginal4dedb5c206e93a40e5dec0a39924845e); ?>
<?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        </div>

        <!-- Lengkapi Rencana Perjalananmu Section -->
        <div class="mb-10">
            <!-- Planner Banner -->
            <div class="w-full relative rounded-2xl overflow-hidden bg-[#603B26] py-8 mb-8 flex flex-col items-center justify-center shadow-md">
                <div class="absolute inset-x-0 bottom-0 pointer-events-none text-[#574B54]/40" style="height: 70%">
                    <svg class="block w-full h-full" preserveAspectRatio="none" viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0,90 C400,20 800,10 1200,50 L1200,120 L0,120 Z" fill="currentColor"></path>
                    </svg>
                </div>
                <div class="absolute inset-x-0 bottom-0 pointer-events-none text-[#40373F]" style="height: 50%">
                    <svg class="block w-full h-full" preserveAspectRatio="none" viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0,120 C300,50 600,60 1200,20 L1200,120 L0,120 Z" fill="currentColor"></path>
                    </svg>
                </div>
                <div class="relative z-10 text-center">
                    <p class="text-white/80 text-[10px] font-medium mb-1 tracking-wider uppercase"><?php echo e(__('promo.planner_subtitle')); ?></p>
                    <h2 class="text-2xl md:text-[28px] font-serif text-white font-medium tracking-wide"><?php echo e(__('promo.planner_title')); ?></h2>
                </div>
            </div>

            <!-- Features Cards Grid -->
            <?php
                $plannerFeatures = [
                    ['icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 'title' => __('promo.planner_feature_1'), 'bgColor' => 'bg-orange-50', 'textColor' => 'text-orange-400', 'hoverShadow' => 'rgb(255,122,69,0.1)'],
                    ['icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'title' => __('promo.planner_feature_2'), 'bgColor' => 'bg-blue-50/80', 'textColor' => 'text-blue-500', 'hoverShadow' => 'rgb(59,130,246,0.1)'],
                    ['icon' => 'M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0', 'title' => __('promo.planner_feature_3'), 'bgColor' => 'bg-emerald-50/80', 'textColor' => 'text-emerald-500', 'hoverShadow' => 'rgb(16,185,129,0.1)'],
                    ['icon' => 'M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2', 'title' => __('promo.planner_feature_4'), 'bgColor' => 'bg-rose-50', 'textColor' => 'text-rose-500', 'hoverShadow' => 'rgb(244,63,94,0.1)'],
                ];
            ?>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $plannerFeatures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <a href="#" class="bg-white rounded-[24px] p-6 text-center border border-gray-100/80 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_<?php echo e($feature['hoverShadow']); ?>] transition-all duration-300 hover:-translate-y-1 group">
                    <div class="w-[50px] h-[50px] mx-auto <?php echo e($feature['bgColor']); ?> rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-[22px] h-[22px] <?php echo e($feature['textColor']); ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="<?php echo e($feature['icon']); ?>" />
                        </svg>
                    </div>
                    <span class="text-[13px] font-semibold text-slate-700"><?php echo e($feature['title']); ?></span>
                </a>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        </div>
        
        <!-- Syarat & Ketentuan Section -->
        <div class="mb-20">
            <h2 class="text-[22px] font-serif text-slate-800 font-medium mb-5 flex items-center gap-2">
                <svg class="w-5 h-5 text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                <?php echo e(__('promo.terms_title')); ?>

            </h2>
            
            <div class="bg-amber-50/50 border border-amber-100/60 rounded-[20px] p-6 md:p-8">
                <?php
                    $terms = [
                        __('promo.terms_1'),
                        __('promo.terms_2'),
                        __('promo.terms_3'),
                        __('promo.terms_4'),
                        __('promo.terms_5'),
                    ];
                ?>
                <ul class="space-y-3 mb-6">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <li class="flex items-start gap-3">
                        <div class="w-1.5 h-1.5 rounded-full bg-orange-400 mt-2 flex-shrink-0"></div>
                        <p class="text-[14px] text-slate-600"><?php echo e($term); ?></p>
                    </li>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </ul>
                
                <div class="flex items-center gap-2 text-rose-600 font-medium text-[13px] mb-5">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <?php echo e(__('promo.terms_verified')); ?>

                </div>
                
                <a href="#" class="text-orange-500 hover:text-orange-600 text-[13px] font-medium transition-colors flex items-center gap-1 group">
                    <?php echo e(__('promo.terms_more')); ?> 
                    <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Full Width Footer Banner -->
    <div class="w-full bg-gradient-to-r from-[#b96231] via-[#854121] to-[#3f2b31] py-16 px-4 text-center relative overflow-hidden mt-auto">
        <div class="absolute inset-0 bg-black/10 mix-blend-multiply pointer-events-none"></div>
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-orange-400/10 rounded-full blur-3xl -translate-x-1/2 translate-y-1/2 pointer-events-none"></div>
        
        <div class="relative z-10 max-w-2xl mx-auto flex flex-col items-center">
            <div class="text-3xl mb-3">🎉</div>
            <h2 class="text-2xl md:text-3xl font-serif text-white font-medium mb-3"><?php echo e(__('promo.footer_title')); ?></h2>
            <p class="text-white/80 text-[14px] mb-8"><?php echo e(__('promo.footer_subtitle')); ?></p>
            
            <div class="flex flex-col sm:flex-row items-center gap-3">
                <a href="<?php echo e(route('tours.index')); ?>" class="bg-[#f08535] hover:bg-[#e67e32] text-white px-6 py-3 rounded-full text-[14px] font-semibold shadow-lg shadow-orange-500/20 transition-all hover:shadow-orange-500/40 hover:-translate-y-0.5 w-full sm:w-auto flex items-center justify-center gap-2">
                    <?php echo e(__('promo.footer_btn_search')); ?>

                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
                
                <button class="border border-white/30 hover:border-white/50 bg-white/5 hover:bg-white/10 text-white px-6 py-3 rounded-full text-[14px] font-semibold transition-all backdrop-blur-sm w-full sm:w-auto flex items-center justify-center gap-2">
                    <svg class="w-4 h-4 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 00-2-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                    <?php echo e(__('promo.footer_btn_copy')); ?>

                </button>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/indonesia-luxe/resources/views/livewire/guest/promo-detail.blade.php ENDPATH**/ ?>