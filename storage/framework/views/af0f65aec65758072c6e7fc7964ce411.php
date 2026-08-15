<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['package']));

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

foreach (array_filter((['package']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $coverUrl = $package->coverImageUrl();
    $statusColor = match($package->status->value) {
        'published' => 'bg-[#e8fff3] text-[#10b981]',
        'pending_approval' => 'bg-[#fff8ed] text-[#f59e0b]',
        'rejected' => 'bg-red-50 text-red-500',
        default => 'bg-gray-50 text-gray-500',
    };

    $statusLabel = match($package->status->value) {
        'published' => 'Live',
        'pending_approval' => 'Pending',
        'rejected' => 'Rejected',
        default => ucfirst($package->status->value),
    };
?>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col group transition-all hover:shadow-md">
    
    <div class="relative h-48 bg-gray-200 overflow-hidden">
        <img src="<?php echo e($coverUrl); ?>"
             alt="<?php echo e($package->title); ?>"
             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />

        
        <div class="absolute top-3 left-3 flex gap-2">
            <span class="bg-[#3b82f6] text-white text-[10px] font-bold px-2 py-1 rounded-md uppercase tracking-wider">
                <?php echo e($package->vendor->isAdmin() ? 'Internal' : 'Vendor'); ?>

            </span>
        </div>

        <div class="absolute top-3 right-3">
            <span class="<?php echo e($statusColor); ?> text-[10px] font-bold px-2 py-1 rounded-md uppercase tracking-wider flex items-center gap-1.5 backdrop-blur-sm bg-opacity-90">
                <span class="size-1.5 rounded-full <?php echo e($package->status->value === 'published' ? 'bg-[#10b981]' : ($package->status->value === 'pending_approval' ? 'bg-[#f59e0b]' : 'bg-red-500')); ?>"></span>
                <?php echo e($statusLabel); ?>

            </span>
        </div>
    </div>

    
    <div class="p-5 flex flex-col flex-1">
        <h3 class="font-bold text-gray-800 text-sm leading-tight mb-2 line-clamp-2">
            <?php echo e($package->title); ?>

        </h3>

        <div class="flex items-center gap-1 text-gray-400 text-[11px] mb-4">
            <svg class="size-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span class="truncate"><?php echo e($package->meeting_point ?? 'Indonesia'); ?></span>
        </div>

        <div class="mt-auto flex justify-between items-end">
            <div>
                <p class="text-[10px] text-gray-400 font-medium uppercase tracking-widest mb-0.5">Mulai dari</p>
                <p class="text-[#f97316] font-bold text-base leading-none">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->price_per_person >= 1000000): ?>
                        Rp <?php echo e(number_format($package->price_per_person / 1000000, 1)); ?>jt
                    <?php else: ?>
                        Rp <?php echo e(number_format($package->price_per_person / 1000, 0)); ?>rb
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </p>
            </div>
            
            <div class="text-[11px] text-gray-400 font-medium">
                <?php echo e($package->type->label()); ?>

            </div>
        </div>
    </div>

    
    <div class="px-5 py-4 bg-gray-50/50 border-t border-gray-50 flex gap-2">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->status->value === 'pending_approval'): ?>
            <button wire:click="confirmApprove(<?php echo e($package->id); ?>)" class="flex-1 bg-[#10b981] text-white text-xs font-bold py-2 rounded-lg hover:bg-[#059669] transition-colors">
                Approve
            </button>
            <button wire:click="confirmReject(<?php echo e($package->id); ?>)" class="flex-1 border border-red-200 text-red-500 text-xs font-bold py-2 rounded-lg hover:bg-red-50 transition-colors">
                Reject
            </button>
        <?php else: ?>
            <button wire:click="selectPackage(<?php echo e($package->id); ?>)" class="flex-1 border border-gray-200 text-gray-500 text-xs font-bold py-2 rounded-lg hover:bg-gray-50 transition-colors text-center">
                Lihat Detail
            </button>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>
<?php /**PATH /var/www/indonesia-luxe/resources/views/components/admin/package-card.blade.php ENDPATH**/ ?>