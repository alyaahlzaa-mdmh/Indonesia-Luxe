
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'currentType' => '',
    'typeLabels' => [],
    'onlyTypes' => null,
    'size' => 'sm',
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
    'currentType' => '',
    'typeLabels' => [],
    'onlyTypes' => null,
    'size' => 'sm',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $chipClasses = $size === 'md'
        ? 'px-5 py-2.5 rounded-full text-[13px]'
        : 'px-4 py-2 rounded-full text-xs';
?>

<div class="flex overflow-x-auto gap-2 pb-2 -mx-4 px-4 lg:mx-0 lg:px-0 hide-scrollbar">
    <button wire:click="$set('type', '')"
            class="<?php echo e($chipClasses); ?> font-medium transition-colors border shadow-sm flex-shrink-0 <?php echo e($currentType === '' ? 'bg-[#FF7A45] text-white border-[#FF7A45]' : 'bg-white text-slate-600 border-gray-200 hover:bg-gray-50'); ?>">
        Semua
    </button>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $typeLabels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $typeValue => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($onlyTypes === null || in_array($typeValue, $onlyTypes)): ?>
            <button wire:click="$set('type', '<?php echo e($typeValue); ?>')"
                    class="<?php echo e($chipClasses); ?> font-medium transition-colors border shadow-sm flex-shrink-0 <?php echo e($currentType === $typeValue ? 'bg-[#FF7A45] text-white border-[#FF7A45]' : 'bg-white text-slate-600 border-gray-200 hover:bg-gray-50'); ?>">
                <?php echo e($label); ?>

            </button>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
</div>
<?php /**PATH /var/www/indonesia-luxe/resources/views/components/guest/type-filter-chips.blade.php ENDPATH**/ ?>