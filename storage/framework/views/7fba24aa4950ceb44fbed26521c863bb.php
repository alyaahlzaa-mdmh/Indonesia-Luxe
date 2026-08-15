<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['status']));

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

foreach (array_filter((['status']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $styles = match($status) {
        'approved' => 'bg-[#e8fff3] text-[#10b981] border-[#d1fae5]',
        'pending' => 'bg-orange-50 text-orange-500 border-orange-100',
        'rejected' => 'bg-red-50 text-red-500 border-red-100',
        default => 'bg-gray-50 text-gray-500 border-gray-100',
    };

    $dotColors = match($status) {
        'approved' => 'bg-[#10b981]',
        'pending' => 'bg-orange-500',
        'rejected' => 'bg-red-500',
        default => 'bg-gray-400',
    };

    $label = match($status) {
        'approved' => 'Approved',
        'pending' => 'Pending',
        'rejected' => 'Rejected',
        default => ucfirst($status),
    };
?>

<div <?php echo e($attributes->merge(['class' => "inline-flex items-center gap-1.5 px-3 py-1 rounded-md text-[10px] font-bold border $styles"])); ?>>
    <span class="size-1 rounded-full <?php echo e($dotColors); ?>"></span>
    <?php echo e($label); ?>

</div>
<?php /**PATH /var/www/indonesia-luxe/resources/views/components/admin/status-badge.blade.php ENDPATH**/ ?>