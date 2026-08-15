<div class="px-6 py-5 border-b border-gray-50 last:border-0 hover:bg-gray-50/50 transition">
  <div class="flex items-start gap-4">
    <div class="w-20 h-20 rounded-xl overflow-hidden shrink-0 border border-gray-100">
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($booking->tourPackage->cover_image_path): ?>
      <img src="<?php echo e(Storage::url($booking->tourPackage->cover_image_path)); ?>" class="w-full h-full object-cover">
      <?php else: ?>
      <div class="w-full h-full bg-amber-50 flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-image w-8 h-8 text-amber-200">
          <rect width="18" height="18" x="3" y="3" rx="2" ry="2" />
          <circle cx="9" cy="9" r="2" />
          <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21" />
        </svg>
      </div>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
    <div class="flex-1 min-w-0">
      <div class="flex items-start justify-between mb-1">
        <h3 class="text-sm font-bold text-gray-900 truncate pr-4"><?php echo e($booking->tourPackage->title); ?></h3>
        <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full <?php echo e($booking->status->color()); ?>">
          <?php echo e($booking->status->label()); ?>

        </span>
      </div>

      <div class="flex flex-col gap-1">
        <div class="flex items-center gap-1.5 text-xs text-gray-500">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-3.5 h-3.5">
            <path d="M8 2v4" />
            <path d="M16 2v4" />
            <rect width="18" height="18" x="3" y="4" rx="2" />
            <path d="M3 10h18" />
          </svg>
          <span><?php echo e($booking->orderItem->departure_date->translatedFormat('d M Y')); ?></span>
        </div>
        <div class="flex items-center gap-1.5 text-xs text-gray-500">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users w-3.5 h-3.5">
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
            <circle cx="9" cy="7" r="4" />
            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
          </svg>
          <span><?php echo e($booking->orderItem->quantity); ?> <?php echo e(__('bookings.participants')); ?></span>
        </div>
      </div>

      <div class="mt-3 flex items-center justify-between">
        <p class="text-sm font-bold text-amber-600">
          Rp <?php echo e(number_format($booking->orderItem->line_total, 0, ',', '.')); ?>

        </p>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($booking->status === \App\Enums\BookingStatus::Confirmed && !$booking->review): ?>
        <button class="text-[11px] font-bold text-amber-500 hover:text-amber-600 transition underline underline-offset-4 cursor-pointer"><?php echo e(__('bookings.give_review')); ?></button>
        <?php elseif($booking->review): ?>
        <div class="flex items-center gap-0.5">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" stroke="none" class="lucide lucide-star w-3 h-3 text-amber-400">
            <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
          </svg>
          <span class="text-[10px] font-bold text-gray-700"><?php echo e($booking->review->rating); ?></span>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </div>
    </div>
  </div>
</div><?php /**PATH /var/www/indonesia-luxe/resources/views/profile/partials/booking-card.blade.php ENDPATH**/ ?>