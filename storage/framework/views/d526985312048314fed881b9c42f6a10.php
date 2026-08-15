<div>
    <!-- Hero Banner with Curve -->
    <div class="relative w-full mb-12 bg-gray-50">
        <div class="absolute inset-0 w-full h-[400px] overflow-hidden" style="z-index: 0;">
            <img src="<?php echo e(asset('images/hero1.jpg')); ?>" alt="Hero Background" class="absolute inset-0 w-full h-full object-cover object-center" />
            <div class="absolute inset-0 bg-[#d95c2b]/80 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-gradient-to-br from-[#c6491a]/90 to-[#e97a3a]/80"></div>
        </div>
        
        <!-- SVG Wave Divider -->
        <div class="absolute bottom-[-1px] left-0 w-full overflow-hidden leading-none z-10 pointer-events-none">
            <svg class="relative block w-full h-[40px] md:h-[70px] text-gray-50" preserveAspectRatio="none" viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,120 C400,10 800,10 1200,90 L1200,120 L0,120 Z" fill="currentColor"></path>
            </svg>
        </div>

        <div class="relative z-20 w-full max-w-6xl mx-auto px-4 pt-10 pb-[90px]">
            <!-- Breadcrumb & Header -->
            <div class="mb-8 mt-4">
                <a href="<?php echo e(route('home')); ?>" class="text-[13px] font-medium text-white/90 hover:text-white flex items-center gap-1.5 transition-colors w-max">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <?php echo e(__('tour_search.back_to_home')); ?>

                </a>
                <h1 class="text-3xl md:text-5xl font-serif font-medium mt-6 text-white tracking-tight"><?php echo e(__('tour_search.title')); ?></h1>
                <p class="text-white/90 mt-2 text-sm md:text-base font-light"><?php echo e(__('tour_search.subtitle')); ?></p>
            </div>

            <!-- Search Input with Debounce -->
            <div class="relative max-w-[700px] mb-6">
                <div class="flex items-center rounded-full overflow-hidden shadow-lg border border-white/20 bg-black/20 backdrop-blur-sm focus-within:ring-2 focus-within:ring-white/50 transition-all">
                    <div class="pl-6 pr-2 flex items-center pointer-events-none text-white/80">
                        <?php if (isset($component)) { $__componentOriginal2d493d77273092f8b706a4c4b5e5b002 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2d493d77273092f8b706a4c4b5e5b002 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.guest.icons.search','data' => ['class' => 'h-4 w-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest.icons.search'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'h-4 w-4']); ?>
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
                    </div>
                    <input 
                        id="tour-search-input"
                        wire:model.live.debounce.500ms="q" 
                        type="text" 
                        placeholder="Labuan Bajo..." 
                        class="w-full py-3.5 md:py-4 bg-transparent text-white placeholder-white/80 focus:outline-none focus:ring-0 border-none text-[14px] md:text-[15px] font-medium" 
                    />
                    <button class="bg-[#FF7A45] hover:bg-[#ff692a] text-white font-medium px-8 md:px-10 py-3.5 md:py-4 h-full transition-colors flex items-center gap-2 whitespace-nowrap text-[14px] md:text-[15px]">
                        <?php if (isset($component)) { $__componentOriginal2d493d77273092f8b706a4c4b5e5b002 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2d493d77273092f8b706a4c4b5e5b002 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.guest.icons.search','data' => ['class' => 'h-4 w-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest.icons.search'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'h-4 w-4']); ?>
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
                        <?php echo e(__('tour_search.search_button')); ?>

                    </button>
                </div>
            </div>

            <!-- Metadata underneath Search -->
            <div class="flex flex-wrap items-center gap-4 md:gap-8 text-[12px] md:text-[13px] text-white/90 font-medium ml-2 md:ml-4">
                <div class="flex items-center gap-2">
                    <svg class="w-3.5 h-3.5 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <?php echo e($totalResults); ?> <?php echo e(__('tour_search.tours_found')); ?>

                </div>
                <div class="flex items-center gap-2">
                    <?php if (isset($component)) { $__componentOriginal9081f2de3bef88eb3ac2fd91a4b65e1d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9081f2de3bef88eb3ac2fd91a4b65e1d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.guest.icons.location','data' => ['class' => 'w-3.5 h-3.5 opacity-80']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest.icons.location'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-3.5 h-3.5 opacity-80']); ?>
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
                    <?php echo e(__('tour_search.destinations_available')); ?>

                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Results Section -->
    <div class="w-full max-w-6xl mx-auto px-4 pb-16">
        
        <?php
            $filterCount = $this->getActiveFilterCount();
        ?>
        <div class="mb-8" x-data="{ open: <?php if ((object) ('showFilterPanel') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showFilterPanel'->value()); ?>')<?php echo e('showFilterPanel'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showFilterPanel'); ?>')<?php endif; ?> }">
            <div class="flex items-center justify-between gap-2 pb-3 pt-1">
                <!-- Filter Toggle Button -->
                <button 
                    wire:click="toggleFilterPanel"
                    class="relative px-5 py-2.5 rounded-xl text-[14px] font-bold transition-all border flex items-center gap-2.5 flex-shrink-0 shadow-sm"
                    :class="(open || <?php echo e($filterCount); ?> > 0) ? 'bg-[#FF7A45] text-white border-[#FF7A45]' : 'bg-white text-slate-700 border-gray-200 hover:bg-gray-50'"
                >
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                    <span><?php echo e(__('tour_search.filter')); ?></span>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($filterCount > 0): ?>
                    <span class="absolute -top-1.5 -right-1.5 bg-[#EF4444] text-white text-[10px] font-bold rounded-full min-w-[20px] h-5 px-1 flex items-center justify-center border-2 border-white shadow-sm transition-transform scale-110">
                        <?php echo e($filterCount); ?>

                    </span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </button>

                <!-- Sorting Dropdown & Count -->
                <div class="flex items-center gap-3">
                    <span class="hidden md:block text-xs font-medium text-gray-500"><?php echo e($totalResults); ?> <?php echo e(__('tour_search.tours_found')); ?></span>
                    <select wire:model.live="sortBy" class="pl-3 pr-8 py-2.5 rounded-xl border border-gray-200 text-xs font-medium text-slate-700 bg-white focus:outline-none focus:ring-2 focus:ring-[#FF7A45] cursor-pointer shadow-sm min-w-[120px]">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $sortOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sortValue => $sortLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <option value="<?php echo e($sortValue); ?>"><?php echo e(__('tour_search.' . $sortValue)); ?></option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </select>
                </div>
            </div>

            <!-- Filter Panel (Collapsible) -->
            <div 
                x-show="open"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-2"
                x-cloak
                class="mt-4 bg-white rounded-2xl border border-gray-100 shadow-lg overflow-hidden"
            >
                <div class="p-5 md:p-6">
                    <!-- Panel Header -->
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-2 text-slate-800">
                            <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                            <span class="text-sm font-semibold"><?php echo e(__('tour_search.filter')); ?></span>
                        </div>
                        <div class="flex items-center gap-2">
                            <button wire:click="resetFilters" class="flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-[#FF7A45] hover:bg-orange-50 rounded-full transition-colors border border-transparent hover:border-orange-100">
                                <?php if (isset($component)) { $__componentOriginale04a79530b0799cb71046b51690c8ac9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale04a79530b0799cb71046b51690c8ac9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.guest.icons.reset','data' => ['class' => 'w-3.5 h-3.5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest.icons.reset'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-3.5 h-3.5']); ?>
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
                                <?php echo e(__('tour_search.reset')); ?>

                            </button>
                            <button wire:click="closeFilterPanel" class="text-gray-400 hover:text-gray-600 transition-colors p-1">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- KATEGORI -->
                    <div class="mb-6">
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-3"><?php echo e(__('tour_search.category')); ?></label>
                        <div class="flex flex-wrap gap-2">
                            <button wire:click="$set('category', '')" class="px-4 py-2 rounded-full text-xs font-medium transition-colors border <?php echo e($category === '' ? 'bg-[#FF7A45] text-white border-[#FF7A45]' : 'bg-white text-slate-600 border-gray-200 hover:bg-gray-50'); ?>">
                                <?php echo e(__('tour_search.all')); ?>

                            </button>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <button wire:click="$set('category', '<?php echo e($cat->slug); ?>')" class="px-4 py-2 rounded-full text-xs font-medium transition-colors border <?php echo e($category === $cat->slug ? 'bg-[#FF7A45] text-white border-[#FF7A45]' : 'bg-white text-slate-600 border-gray-200 hover:bg-gray-50'); ?>">
                                    <?php echo e($cat->name); ?>

                                </button>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>

                    <!-- HARGA MAKS -->
                    <div class="mb-6" 
                        x-data="{ price: <?php echo e($maxPrice); ?>, upperBound: <?php echo e($maxPriceUpperBound); ?> }"
                    >
                        <div class="flex items-center justify-between mb-3">
                            <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wider"><?php echo e(__('tour_search.max_price')); ?></label>
                            <span class="text-sm font-semibold text-[#FF7A45]" x-text="'Rp ' + Number(price).toLocaleString('id-ID')"></span>
                        </div>
                        <div class="relative">
                            <input 
                                type="range" 
                                wire:model.live.debounce.500ms="maxPrice"
                                x-on:input="price = Number($event.target.value)"
                                min="0" 
                                x-bind:max="upperBound" 
                                step="1000"
                                x-bind:value="price"
                                class="w-full h-2 rounded-full appearance-none cursor-pointer"
                                x-bind:style="`background: linear-gradient(to right, #FF7A45 0%, #FF7A45 ${upperBound > 0 ? (price / upperBound) * 100 : 100}%, #e5e7eb ${upperBound > 0 ? (price / upperBound) * 100 : 100}%, #e5e7eb 100%);`"
                            />
                            <div class="flex justify-between text-[10px] text-gray-400 mt-1.5">
                                <span>Rp 0</span>
                                <span x-text="'Rp ' + Number(upperBound).toLocaleString('id-ID')"></span>
                            </div>
                        </div>
                    </div>

                    <!-- RATING MINIMUM -->
                    <div class="mb-6">
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-3"><?php echo e(__('tour_search.min_rating')); ?></label>
                        <div class="flex flex-wrap gap-2">
                            <button wire:click="$set('minRating', '')" class="px-4 py-2 rounded-full text-xs font-medium transition-colors border <?php echo e($minRating === '' ? 'bg-[#FF7A45] text-white border-[#FF7A45]' : 'bg-white text-slate-600 border-gray-200 hover:bg-gray-50'); ?>">
                                <?php echo e(__('tour_search.all')); ?>

                            </button>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $ratingOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ratingValue => $ratingLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <button wire:click="$set('minRating', '<?php echo e($ratingValue); ?>')" class="px-4 py-2 rounded-full text-xs font-medium transition-colors border flex items-center gap-1 <?php echo e($minRating === (string) $ratingValue ? 'bg-[#FF7A45] text-white border-[#FF7A45]' : 'bg-white text-slate-600 border-gray-200 hover:bg-gray-50'); ?>">
                                    <?php if (isset($component)) { $__componentOriginal16f3d6ca143282d18b11a93ab3ac3b95 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal16f3d6ca143282d18b11a93ab3ac3b95 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.guest.icons.star','data' => ['class' => 'w-3 h-3 '.e($minRating === (string) $ratingValue ? 'text-white' : 'text-amber-400').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest.icons.star'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-3 h-3 '.e($minRating === (string) $ratingValue ? 'text-white' : 'text-amber-400').'']); ?>
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
                                    <?php echo e($ratingLabel); ?>

                                </button>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>

                    <!-- URUTKAN -->
                    <div class="mb-2">
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-3"><?php echo e(__('tour_search.sort_by')); ?></label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $sortOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sortValue => $sortLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <button 
                                    wire:click="$set('sortBy', '<?php echo e($sortValue); ?>')"
                                    class="px-4 py-2.5 rounded-xl text-xs font-medium transition-all border text-left <?php echo e($sortBy === $sortValue ? 'bg-[#FF7A45] text-white border-[#FF7A45] shadow-sm' : 'bg-white text-slate-600 border-gray-200 hover:bg-gray-50'); ?>"
                                >
                                    <?php echo e(__('tour_search.' . $sortValue)); ?>

                                </button>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Panel Footer -->
                <div class="flex items-center justify-between px-5 md:px-6 py-4 bg-gray-50/80 border-t border-gray-100">
                    <span class="text-xs font-medium text-[#FF7A45]"><?php echo e($totalResults); ?> <span class="text-gray-500"><?php echo e(__('tour_search.tours_found')); ?></span></span>
                    <div class="flex items-center gap-3">
                        <button wire:click="resetFilters" class="px-4 py-2 text-xs font-medium text-gray-500 hover:text-gray-700 transition-colors">
                            <?php echo e(__('tour_search.reset')); ?>

                        </button>
                        <button wire:click="applyFilters" class="px-6 py-2 rounded-full text-xs font-semibold bg-[#FF7A45] hover:bg-[#ff692a] text-white transition-colors shadow-sm">
                            <?php echo e(__('tour_search.see_results')); ?>

                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Results Grid -->
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $tourPackages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tourPackage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <?php if (isset($component)) { $__componentOriginal4dedb5c206e93a40e5dec0a39924845e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4dedb5c206e93a40e5dec0a39924845e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.guest.tour-card','data' => ['tourPackage' => $tourPackage,'typeLabels' => $typeLabels,'variant' => 'search']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest.tour-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['tourPackage' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tourPackage),'typeLabels' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($typeLabels),'variant' => 'search']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.guest.empty-state','data' => ['title' => ''.e(__('tour_search.no_tours_found')).'','subtitle' => ''.e(__('tour_search.try_change_filter')).'','variant' => 'search']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest.empty-state'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('tour_search.no_tours_found')).'','subtitle' => ''.e(__('tour_search.try_change_filter')).'','variant' => 'search']); ?>
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

        <div class="mt-12 mb-4">
            <?php echo e($tourPackages->links()); ?>

        </div>
    </div>
</div>

<script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
<script>
    function initTourSearchTyped() {
        if (typeof Typed === 'undefined' || !document.getElementById('tour-search-input')) {
            setTimeout(initTourSearchTyped, 100);
            return;
        }
        
        let inputEl = document.getElementById('tour-search-input');
        if (inputEl.value.trim() !== '') return;
        
        if(window.tourSearchTypedInstance) window.tourSearchTypedInstance.destroy();
        
        window.tourSearchTypedInstance = new Typed('#tour-search-input', {
            strings: ['Labuan Bajo', 'Bali Cultural Experience', 'Gunung Bromo Sunrise', 'Raja Ampat', 'Nusa Penida'],
            typeSpeed: 60,
            backSpeed: 30,
            backDelay: 1500,
            loop: true,
            attr: 'placeholder',
            bindInputFocusEvents: true
        });
    }

    document.addEventListener('livewire:navigated', initTourSearchTyped);
    document.addEventListener('DOMContentLoaded', initTourSearchTyped);
    if(document.readyState === 'complete' || document.readyState === 'interactive') {
        initTourSearchTyped();
    }
</script>
<?php /**PATH /var/www/indonesia-luxe/resources/views/livewire/guest/tour-search.blade.php ENDPATH**/ ?>