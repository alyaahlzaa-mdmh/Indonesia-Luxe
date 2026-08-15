
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'tourPackage',
    'variant' => 'default',
    'typeLabels' => [],
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
    'tourPackage',
    'variant' => 'default',
    'typeLabels' => [],
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $rating = number_format((float) ($tourPackage->reviews_avg_rating ?? 0), 1);
    $typeLabel = $typeLabels[$tourPackage->type->value] ?? $tourPackage->type->value;
    $price = 'Rp ' . number_format($tourPackage->price_per_person, 0, ',', '.');
    $location = $tourPackage->meeting_point ?? 'Indonesia';

    $isPromo = $variant === 'promo';
    $isSearch = $variant === 'search';
    $isDefault = $variant === 'default';

    $cardBg = $isPromo ? 'bg-[#FDFBF7]' : 'bg-white';
    $imgHeight = match($variant) {
        'default' => 'h-36 sm:h-44 md:h-52',
        'search' => 'h-52',
        'promo' => 'h-[180px]',
    };
?>

<?php
    $isFavorited = auth()->check() ? $tourPackage->isFavoritedBy(auth()->user()) : false;
?>

<a href="<?php echo e(route('tours.show', $tourPackage)); ?>"
   class="<?php echo e($cardBg); ?> rounded-[16px] <?php echo e($isSearch ? 'shadow-sm' : 'shadow-[0_2px_8px_rgba(0,0,0,0.04)]'); ?> border border-gray-100 overflow-hidden hover:shadow-lg transition-all hover:-translate-y-1 flex flex-col group cursor-pointer no-underline h-full"
   <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('tour-card-{{ $tourPackage->id }}', get_defined_vars()); ?>wire:key="tour-card-<?php echo e($tourPackage->id); ?>"
>
    
    <div class="relative <?php echo e($imgHeight); ?> bg-gray-200 overflow-hidden">
        <img src="<?php echo e($tourPackage->coverImageUrl()); ?>"
             alt="<?php echo e($tourPackage->title); ?>"
             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out"
             loading="lazy" />

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isPromo): ?>
            <div class="absolute top-3 left-3 bg-[#b48c47] px-3 py-1.5 rounded-full text-[10px] font-bold text-white shadow-sm z-10 tracking-wide">
                -15%
            </div>
        <?php else: ?>
            <div class="absolute top-2 left-2 sm:top-3 sm:left-3 bg-[#ff9e52]/90 backdrop-blur-sm px-2.5 py-1 rounded-full text-[10px] sm:text-[11px] font-medium text-white shadow-sm flex items-center gap-1 z-10 tracking-wide">
                <?php echo e($typeLabel); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <button wire:click.prevent="toggleWishlist(<?php echo e($tourPackage->id); ?>)"
                class="absolute top-2 right-2 sm:top-3 sm:right-3 bg-white/80 backdrop-blur-md p-1.5 sm:p-2 rounded-full <?php echo e($isFavorited ? 'text-[#FF7A45]' : 'text-slate-500'); ?> hover:text-[#FF7A45] shadow-sm transition z-20 flex items-center justify-center">
            <?php if (isset($component)) { $__componentOriginal3c240a8312226f6d27d0ad9755d1166c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3c240a8312226f6d27d0ad9755d1166c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.guest.icons.heart','data' => ['class' => 'w-4 h-4','fill' => $isFavorited ? 'currentColor' : 'none']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest.icons.heart'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4','fill' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isFavorited ? 'currentColor' : 'none')]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3c240a8312226f6d27d0ad9755d1166c)): ?>
<?php $attributes = $__attributesOriginal3c240a8312226f6d27d0ad9755d1166c; ?>
<?php unset($__attributesOriginal3c240a8312226f6d27d0ad9755d1166c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3c240a8312226f6d27d0ad9755d1166c)): ?>
<?php $component = $__componentOriginal3c240a8312226f6d27d0ad9755d1166c; ?>
<?php unset($__componentOriginal3c240a8312226f6d27d0ad9755d1166c); ?>
<?php endif; ?>
        </button>
    </div>

    
    <div class="p-3 sm:p-4 flex flex-col flex-1 <?php echo e($isPromo ? 'bg-white' : ''); ?>">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isPromo): ?>
            
            <p class="text-[11px] text-gray-400 mb-1 truncate">
                <?php echo e($typeLabel); ?> · <?php echo e($location); ?>

            </p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$isPromo): ?>
            
            <div class="flex items-center gap-1 text-[#ff9e52] mb-1.5">
                <?php if (isset($component)) { $__componentOriginal16f3d6ca143282d18b11a93ab3ac3b95 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal16f3d6ca143282d18b11a93ab3ac3b95 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.guest.icons.star','data' => ['class' => 'w-3.5 h-3.5 sm:w-4 sm:h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest.icons.star'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-3.5 h-3.5 sm:w-4 sm:h-4']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal16f3d6ca143282d18b11a93ab3ac3b95)): ?>
<?php $attributes = $__attributesOriginal16f3d6ca143282d18b11a93ab3ac3b95; ?>
<?php unset($__attributesOriginal16f3d6ca143282d18b11a93ab3ac3b95); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal16f3d6ca143282d18b11a93ab3ac3b95)): ?>
<?php $component = $__componentOriginal16f3d6ca143282d18b11a93ab3ac3b95; ?>
<?php unset($__componentOriginal16f3d6ca143282d18b11a93ab3ac3b95); ?>
<?php endif; ?>
                <span class="text-[12px] sm:text-[13px] font-medium"><?php echo e($rating); ?></span>
                <span class="text-[11px] sm:text-[12px] text-slate-400">(<?php echo e($tourPackage->reviews_count); ?>)</span>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <h3 class="font-serif font-medium text-[13px] sm:text-[15px] text-slate-800 leading-snug mb-1 line-clamp-2">
            <?php echo e($tourPackage->title); ?>

        </h3>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isPromo): ?>
            
            <div class="flex items-center gap-1 text-[#ff9e52] mb-3">
                <?php if (isset($component)) { $__componentOriginal16f3d6ca143282d18b11a93ab3ac3b95 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal16f3d6ca143282d18b11a93ab3ac3b95 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.guest.icons.star','data' => ['class' => 'w-3.5 h-3.5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest.icons.star'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-3.5 h-3.5']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal16f3d6ca143282d18b11a93ab3ac3b95)): ?>
<?php $attributes = $__attributesOriginal16f3d6ca143282d18b11a93ab3ac3b95; ?>
<?php unset($__attributesOriginal16f3d6ca143282d18b11a93ab3ac3b95); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal16f3d6ca143282d18b11a93ab3ac3b95)): ?>
<?php $component = $__componentOriginal16f3d6ca143282d18b11a93ab3ac3b95; ?>
<?php unset($__componentOriginal16f3d6ca143282d18b11a93ab3ac3b95); ?>
<?php endif; ?>
                <span class="text-xs font-bold text-slate-700"><?php echo e($rating); ?></span>
                <span class="text-xs text-gray-400">(<?php echo e($tourPackage->reviews_count); ?>)</span>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$isPromo): ?>
            
            <p class="text-[10px] sm:text-[11px] text-slate-500 flex items-center gap-1">
                <?php if (isset($component)) { $__componentOriginal9081f2de3bef88eb3ac2fd91a4b65e1d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9081f2de3bef88eb3ac2fd91a4b65e1d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.guest.icons.location','data' => ['class' => 'w-3 h-3 sm:w-3.5 sm:h-3.5 text-slate-400 shrink-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest.icons.location'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-3 h-3 sm:w-3.5 sm:h-3.5 text-slate-400 shrink-0']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9081f2de3bef88eb3ac2fd91a4b65e1d)): ?>
<?php $attributes = $__attributesOriginal9081f2de3bef88eb3ac2fd91a4b65e1d; ?>
<?php unset($__attributesOriginal9081f2de3bef88eb3ac2fd91a4b65e1d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9081f2de3bef88eb3ac2fd91a4b65e1d)): ?>
<?php $component = $__componentOriginal9081f2de3bef88eb3ac2fd91a4b65e1d; ?>
<?php unset($__componentOriginal9081f2de3bef88eb3ac2fd91a4b65e1d); ?>
<?php endif; ?>
                <span class="truncate"><?php echo e($location); ?></span>
            </p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isSearch): ?>
            
            <p class="text-xs text-gray-500 leading-relaxed line-clamp-2 mt-1.5">
                <?php echo e(Str::limit(strip_tags($tourPackage->description), 100)); ?>

            </p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <div class="mt-auto pt-2 <?php echo e($isSearch ? 'pt-4 flex justify-between items-center border-t border-gray-100' : ''); ?>">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isPromo): ?>
                <p class="text-[14px] font-semibold text-[#b48c47]"><?php echo e(__('tour_card.starts_from')); ?> <?php echo e($price); ?></p>
            <?php elseif($isSearch): ?>
                <p class="text-base font-bold text-[#b48c47]"><?php echo e($price); ?><span class="text-[10px] text-gray-400 font-normal">/<?php echo e(__('tour_card.person')); ?></span></p>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tourPackage->duration_hours): ?>
                    <div class="bg-gray-50 border border-gray-100 px-3 py-1.5 rounded-lg text-xs font-medium text-gray-600 shadow-sm">
                        <?php echo e(ceil($tourPackage->duration_hours / 24)); ?> <?php echo e(__('tour_card.days')); ?>

                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php else: ?>
                <p class="text-[12px] sm:text-[14px] font-medium text-[#b48c47]"><?php echo e($price); ?> <span class="text-[9px] sm:text-[10px] text-slate-400 font-normal">/<?php echo e(__('tour_card.person')); ?></span></p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</a>
<?php /**PATH /var/www/indonesia-luxe/resources/views/components/guest/tour-card.blade.php ENDPATH**/ ?>