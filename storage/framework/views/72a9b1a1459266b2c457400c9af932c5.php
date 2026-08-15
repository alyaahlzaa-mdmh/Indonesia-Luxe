
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => 'Tidak ada tour ditemukan',
    'subtitle' => 'Coba ubah filter atau kata kunci pencarian',
    'showReset' => true,
    'showHome' => true,
    'variant' => 'search',
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'title' => 'Tidak ada tour ditemukan',
    'subtitle' => 'Coba ubah filter atau kata kunci pencarian',
    'showReset' => true,
    'showHome' => true,
    'variant' => 'search',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="col-span-full py-<?php echo e($variant === 'promo' ? '16' : '20'); ?> text-center <?php echo e($variant === 'promo' ? 'bg-white rounded-[24px] border border-gray-100 shadow-sm' : ''); ?>">
    <div class="max-w-sm mx-auto">
        
        <div class="w-16 h-16 rounded-full <?php echo e($variant === 'promo' ? 'bg-orange-50' : 'bg-gray-100'); ?> flex items-center justify-center mx-auto mb-5">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($variant === 'promo'): ?>
                <svg class="w-8 h-8 text-orange-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            <?php else: ?>
                <?php if (isset($component)) { $__componentOriginal2d493d77273092f8b706a4c4b5e5b002 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2d493d77273092f8b706a4c4b5e5b002 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.guest.icons.search','data' => ['class' => 'w-8 h-8 text-gray-300']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest.icons.search'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-8 h-8 text-gray-300']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2d493d77273092f8b706a4c4b5e5b002)): ?>
<?php $attributes = $__attributesOriginal2d493d77273092f8b706a4c4b5e5b002; ?>
<?php unset($__attributesOriginal2d493d77273092f8b706a4c4b5e5b002); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2d493d77273092f8b706a4c4b5e5b002)): ?>
<?php $component = $__componentOriginal2d493d77273092f8b706a4c4b5e5b002; ?>
<?php unset($__componentOriginal2d493d77273092f8b706a4c4b5e5b002); ?>
<?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <h3 class="text-lg font-bold text-slate-700 mb-2"><?php echo e($title); ?></h3>
        <p class="text-sm text-gray-400 mb-6"><?php echo e($subtitle); ?></p>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showReset || $showHome): ?>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showReset): ?>
                    <button wire:click="resetFilters"
                            class="flex items-center gap-2 px-6 py-2.5 rounded-full text-sm font-medium text-slate-600 border border-gray-200 bg-white hover:bg-gray-50 transition-colors shadow-sm">
                        <?php if (isset($component)) { $__componentOriginale04a79530b0799cb71046b51690c8ac9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale04a79530b0799cb71046b51690c8ac9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.guest.icons.reset','data' => ['class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest.icons.reset'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale04a79530b0799cb71046b51690c8ac9)): ?>
<?php $attributes = $__attributesOriginale04a79530b0799cb71046b51690c8ac9; ?>
<?php unset($__attributesOriginale04a79530b0799cb71046b51690c8ac9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale04a79530b0799cb71046b51690c8ac9)): ?>
<?php $component = $__componentOriginale04a79530b0799cb71046b51690c8ac9; ?>
<?php unset($__componentOriginale04a79530b0799cb71046b51690c8ac9); ?>
<?php endif; ?>
                        Reset Filter
                    </button>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showHome): ?>
                    <a href="<?php echo e(route('home')); ?>"
                       class="px-6 py-2.5 rounded-full text-sm font-semibold text-white bg-[#FF7A45] hover:bg-[#ff692a] transition-colors shadow-sm">
                        Kembali ke Beranda
                    </a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>
<?php /**PATH /var/www/indonesia-luxe/resources/views/components/guest/empty-state.blade.php ENDPATH**/ ?>