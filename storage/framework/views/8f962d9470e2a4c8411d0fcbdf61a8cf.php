<?php if (isset($component)) { $__componentOriginalfefb4fd9b7004fa65f70c415ac76903e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfefb4fd9b7004fa65f70c415ac76903e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.site','data' => ['title' => __('cart.title')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.site'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('cart.title'))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <!-- <h1 class="text-2xl font-semibold mb-4">Shopping Cart</h1> -->
    <a href="<?php echo e(route('home')); ?>" class="flex items-center gap-1.5 text-gray-500 hover:text-amber-600 transition mb-4 text-sm font-semibold">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left w-4 h-4">
            <path d="m12 19-7-7 7-7"></path>
            <path d="M19 12H5"></path>
        </svg> <?php echo e(__('cart.home')); ?>

    </a>

    <div class="space-y-3" x-data="{
        selectedIds: <?php echo e($cart->items->pluck('id')->map(fn($id) => (string)$id)->toJson()); ?>,
        items: <?php echo e($cart->items->map(fn($item) => ['id' => (string)$item->id, 'total' => (float)$item->line_total])->toJson()); ?>,
        get subtotal() {
            return this.items
                .filter(i => this.selectedIds.includes(i.id))
                .reduce((sum, i) => sum + i.total, 0);
        },
        get selectedCount() {
            return this.selectedIds.length;
        },
        toggleAll() {
            if (this.selectedIds.length === this.items.length) {
                this.selectedIds = [];
            } else {
                this.selectedIds = this.items.map(i => i.id);
            }
        },
        formatCurrency(value) {
            return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
        },
        get checkoutUrl() {
            let url = '<?php echo e(route('checkout.create')); ?>';
            if (this.selectedIds.length > 0) {
                url += '?' + this.selectedIds.map(id => 'ids[]=' + id).join('&');
            }
            return url;
        }
    }">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cart->items->isNotEmpty()): ?>
        <h1 class="text-2xl text-gray-900 mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart w-6 h-6 inline mr-2 text-amber-500">
                <circle cx="8" cy="21" r="1"></circle>
                <circle cx="19" cy="21" r="1"></circle>
                <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path>
            </svg><?php echo e(__('cart.shopping_cart')); ?> (<?php echo e($cart->items->count()); ?> <?php echo e(__('cart.item')); ?>)
        </h1>

        <div class="grid lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-4">
                <div class="flex items-center justify-between">
                    <button @click="toggleAll()" class="flex items-center gap-2 text-sm text-gray-600 hover:text-amber-600 transition">
                        <template x-if="selectedIds.length === items.length">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-check-big w-4 h-4 text-amber-500">
                                <path d="M21 10.5V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h12.5"></path>
                                <path d="m9 11 3 3L22 4"></path>
                            </svg>
                        </template>
                        <template x-if="selectedIds.length !== items.length">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square w-4 h-4 text-gray-400">
                                <rect width="18" height="18" x="3" y="3" rx="2"></rect>
                            </svg>
                        </template>
                        <span x-text="selectedIds.length === items.length ? '<?php echo e(__('cart.deselect_all')); ?>' : '<?php echo e(__('cart.select_all')); ?>'"></span>
                    </button>
                    <form method="POST" action="<?php echo e(route('cart.clear')); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2 w-4 h-4">
                                <path d="M3 6h18"></path>
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                <line x1="10" x2="10" y1="11" y2="17"></line>
                                <line x1="14" x2="14" y1="11" y2="17"></line>
                            </svg><?php echo e(__('cart.empty_cart')); ?>

                        </button>
                    </form>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $cart->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <div class="bg-white rounded-2xl shadow overflow-hidden transition"
                    :class="selectedIds.includes('<?php echo e($item->id); ?>') ? 'ring-2 ring-amber-400 shadow-md' : 'ring-1 ring-gray-200 hover:ring-2 hover:ring-amber-400'">
                    <div class="p-4 flex gap-4">
                        <label class="shrink-0 mt-1 self-start cursor-pointer">
                            <input type="checkbox" value="<?php echo e($item->id); ?>" x-model="selectedIds" class="hidden">
                            <template x-if="selectedIds.includes('<?php echo e($item->id); ?>')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-check-big w-5 h-5 text-amber-500">
                                    <path d="M21 10.5V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h12.5"></path>
                                    <path d="m9 11 3 3L22 4"></path>
                                </svg>
                            </template>
                            <template x-if="!selectedIds.includes('<?php echo e($item->id); ?>')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square w-5 h-5 text-gray-300">
                                    <rect width="18" height="18" x="3" y="3" rx="2"></rect>
                                </svg>
                            </template>
                        </label>
                        <img src="<?php echo e(Storage::url($item->tourPackage->cover_image_path) ?? 'https://images.unsplash.com/photo-1694271486260-1a1859d4c745?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=1080'); ?>" alt="<?php echo e($item->tourPackage->title); ?>" class="w-28 h-20 object-cover rounded-xl shrink-0">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between">
                                <div class="min-w-0 flex-1">
                                    <span class="text-[10px] font-bold uppercase tracking-wider bg-amber-100 text-amber-700 px-2 py-0.5 rounded-full"><?php echo e($item->tourPackage->category->name); ?></span>
                                    <h3 class="text-gray-900 mt-1 font-semibold line-clamp-1"><?php echo e($item->tourPackage->title); ?></h3>
                                    <p class="text-xs text-gray-500"><?php echo e(__('cart.by')); ?> <?php echo e($item->tourPackage->vendor->name); ?></p>
                                </div>
                                <form method="POST" action="<?php echo e(route('cart.items.destroy', $item)); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-gray-400 hover:text-red-500 p-1 transition shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2 w-5 h-5">
                                            <path d="M3 6h18"></path>
                                            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                            <line x1="10" x2="10" y1="11" y2="17"></line>
                                            <line x1="14" x2="14" y1="11" y2="17"></line>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                            <div class="flex flex-wrap items-center gap-3 mt-2">
                                <div class="flex items-center gap-1 bg-amber-50 text-amber-700 px-2.5 py-1 rounded-full text-xs">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-3 h-3 shrink-0">
                                        <path d="M8 2v4"></path>
                                        <path d="M16 2v4"></path>
                                        <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                        <path d="M3 10h18"></path>
                                    </svg>
                                    <span><?php echo e($item->slot->departure_date->format('d M Y')); ?></span>
                                </div>
                                <div class="flex items-center border rounded-lg bg-white overflow-hidden">
                                    <form method="POST" action="<?php echo e(route('cart.items.update', $item)); ?>">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PATCH'); ?>
                                        <input type="hidden" name="quantity" value="<?php echo e($item->quantity - 1); ?>">
                                        <button type="submit" class="px-2 py-1 hover:bg-amber-50 text-gray-600 transition disabled:opacity-30" <?php echo e($item->quantity <= 1 ? 'disabled' : ''); ?>>-</button>
                                    </form>
                                    <span class="px-2 text-sm font-medium"><?php echo e($item->quantity); ?></span>
                                    <form method="POST" action="<?php echo e(route('cart.items.update', $item)); ?>">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PATCH'); ?>
                                        <input type="hidden" name="quantity" value="<?php echo e($item->quantity + 1); ?>">
                                        <button type="submit" class="px-2 py-1 hover:bg-amber-50 text-gray-600 transition">+</button>
                                    </form>
                                </div>
                            </div>
                            <div class="mt-2 text-right">
                                <span class="text-gray-400 text-xs mr-2"><?php echo e($item->quantity); ?> x Rp <?php echo e(number_format($item->price_per_person, 0, ',', '.')); ?></span>
                                <span class="text-amber-600 font-bold">Rp <?php echo e(number_format($item->line_total, 0, ',', '.')); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>

            <div>
                <div class="bg-white rounded-2xl p-6 shadow-lg shadow-gray-100 sticky top-20 border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-900 mb-4"><?php echo e(__('cart.order_summary')); ?></h2>
                    <div class="space-y-3 text-sm border-b pb-4 mb-4 max-h-[300px] overflow-y-auto">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $cart->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <div class="flex justify-between text-gray-600 gap-4" x-show="selectedIds.includes('<?php echo e($item->id); ?>')">
                            <span class="line-clamp-1 flex-1"><?php echo e($item->tourPackage->title); ?></span>
                            <span class="shrink-0 font-medium whitespace-nowrap">Rp <?php echo e(number_format($item->line_total, 0, ',', '.')); ?></span>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                    <div class="pt-2">
                        <div class="flex justify-between text-lg text-gray-900">
                            <span class="font-medium"><?php echo e(__('cart.total')); ?><span class="text-xs text-gray-400 block font-normal"><span x-text="selectedCount"></span> <?php echo e(__('cart.selected_items')); ?></span></span>
                            <span class="text-amber-600 font-bold" x-text="formatCurrency(subtotal)"></span>
                        </div>
                    </div>
                    <a :href="checkoutUrl"
                        :class="selectedCount === 0 ? 'bg-gray-200 text-gray-400 cursor-not-allowed' : 'bg-amber-500 hover:bg-amber-600 text-white shadow-lg shadow-amber-200'"
                        class="w-full mt-6 py-4 rounded-xl flex items-center justify-center gap-2 transition font-bold"
                        @click="if(selectedCount === 0) $event.preventDefault()">
                        <?php echo e(__('cart.order_now')); ?>

                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right w-4 h-4">
                            <path d="M5 12h14"></path>
                            <path d="m12 5 7 7-7 7"></path>
                        </svg>
                    </a>
                    <a class="block text-center text-gray-500 hover:text-amber-600 text-sm mt-4 transition" href="<?php echo e(route('tours.index')); ?>">
                        <?php echo e(__('cart.continue_shopping')); ?>

                    </a>
                </div>
            </div>
        </div>

        <?php else: ?>
        <div class="flex flex-col items-center justify-center py-24 bg-white rounded-3xl shadow-sm border border-gray-100">
            <div class="w-24 h-24 bg-amber-50 rounded-full flex items-center justify-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag w-12 h-12 text-amber-300">
                    <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path>
                    <path d="M3 6h18"></path>
                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2"><?php echo e(__('cart.cart_empty')); ?></h2>
            <p class="text-gray-500 mb-8 max-w-xs text-center"><?php echo e(__('cart.cart_empty_desc')); ?></p>
            <a href="<?php echo e(route('tours.index')); ?>" class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white px-8 py-3.5 rounded-full transition font-bold shadow-lg shadow-amber-200">
                <?php echo e(__('cart.search_tour_now')); ?>

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right w-5 h-5">
                    <path d="M5 12h14"></path>
                    <path d="m12 5 7 7-7 7"></path>
                </svg>
            </a>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfefb4fd9b7004fa65f70c415ac76903e)): ?>
<?php $attributes = $__attributesOriginalfefb4fd9b7004fa65f70c415ac76903e; ?>
<?php unset($__attributesOriginalfefb4fd9b7004fa65f70c415ac76903e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfefb4fd9b7004fa65f70c415ac76903e)): ?>
<?php $component = $__componentOriginalfefb4fd9b7004fa65f70c415ac76903e; ?>
<?php unset($__componentOriginalfefb4fd9b7004fa65f70c415ac76903e); ?>
<?php endif; ?><?php /**PATH /var/www/indonesia-luxe/resources/views/cart/index.blade.php ENDPATH**/ ?>