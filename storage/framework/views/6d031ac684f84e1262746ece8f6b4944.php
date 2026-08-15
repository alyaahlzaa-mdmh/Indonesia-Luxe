<?php if (isset($component)) { $__componentOriginalfefb4fd9b7004fa65f70c415ac76903e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfefb4fd9b7004fa65f70c415ac76903e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.site','data' => ['title' => __('payment_upload.title')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.site'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('payment_upload.title'))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <h1 class="text-2xl font-semibold mb-4"><?php echo e(__('payment_upload.title')); ?></h1>

    <p class="text-sm mb-4"><?php echo e(__('order_detail.order')); ?> <?php echo e($order->code); ?> • <?php echo e(__('payment_upload.total')); ?> Rp <?php echo e(number_format($order->total_amount, 0, ',', '.')); ?></p>

    <form action="<?php echo e(route('payments.store', $order)); ?>" method="POST" enctype="multipart/form-data" class="rounded border bg-white p-4 space-y-3">
        <?php echo csrf_field(); ?>
        <label class="block text-sm"><?php echo e(__('payment_upload.proof_file')); ?>

            <input type="file" name="proof" class="mt-1 w-full rounded border px-3 py-2 text-sm" required />
        </label>
        <label class="block text-sm"><?php echo e(__('payment_upload.sender_name')); ?>

            <input type="text" name="bank_sender_name" class="mt-1 w-full rounded border px-3 py-2 text-sm" />
        </label>
        <label class="block text-sm"><?php echo e(__('payment_upload.sender_account')); ?>

            <input type="text" name="bank_sender_account" class="mt-1 w-full rounded border px-3 py-2 text-sm" />
        </label>
        <label class="block text-sm"><?php echo e(__('payment_upload.notes')); ?>

            <textarea name="notes" rows="3" class="mt-1 w-full rounded border px-3 py-2 text-sm"></textarea>
        </label>
        <button class="rounded bg-black px-4 py-2 text-sm text-white"><?php echo e(__('payment_upload.submit')); ?></button>
    </form>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfefb4fd9b7004fa65f70c415ac76903e)): ?>
<?php $attributes = $__attributesOriginalfefb4fd9b7004fa65f70c415ac76903e; ?>
<?php unset($__attributesOriginalfefb4fd9b7004fa65f70c415ac76903e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfefb4fd9b7004fa65f70c415ac76903e)): ?>
<?php $component = $__componentOriginalfefb4fd9b7004fa65f70c415ac76903e; ?>
<?php unset($__componentOriginalfefb4fd9b7004fa65f70c415ac76903e); ?>
<?php endif; ?>
<?php /**PATH /var/www/indonesia-luxe/resources/views/payments/create.blade.php ENDPATH**/ ?>