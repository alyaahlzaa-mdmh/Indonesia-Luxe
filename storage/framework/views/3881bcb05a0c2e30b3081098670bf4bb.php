<div class="py-16 flex flex-col items-center gap-4">
  <div class="w-20 h-20 bg-amber-50 rounded-full flex items-center justify-center">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package w-10 h-10 text-amber-300">
      <path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"></path>
      <path d="M12 22V12"></path>
      <polyline points="3.29 7 12 12 20.71 7"></polyline>
      <path d="m7.5 4.27 9 5.15"></path>
    </svg>
  </div>
  <div class="text-center">
    <p class="text-gray-900 mb-1 font-medium"><?php echo e(__('bookings.nothing_here')); ?></p>
    <p class="text-sm text-gray-500"><?php echo e(__('bookings.nothing_here_desc')); ?></p>
  </div>
  <a class="bg-amber-500 hover:bg-amber-600 text-white px-6 py-2.5 rounded-full text-sm transition font-semibold" href="<?php echo e(route('tours.index')); ?>" data-discover="true"><?php echo e(__('bookings.start_exploring')); ?></a>
</div><?php /**PATH /var/www/indonesia-luxe/resources/views/profile/partials/empty-bookings.blade.php ENDPATH**/ ?>