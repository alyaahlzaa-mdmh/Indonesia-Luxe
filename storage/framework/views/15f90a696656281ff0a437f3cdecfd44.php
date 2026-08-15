<div class="py-4 font-sans bg-gray-50 min-h-screen">
    <!-- Hero Image Area -->
    <div class="relative w-full h-[300px] md:h-[400px] rounded-2xl overflow-hidden mb-8 shadow-sm group"
        x-data="{
             activeImg: 0,
             images: <?php echo \Illuminate\Support\Js::from($heroImages)->toHtml() ?>,
             progress: 0,
             duration: 5000,
             interval: null,
             start() {
                 this.progress = 0;
                 if (this.interval) clearInterval(this.interval);
                 this.interval = setInterval(() => {
                     this.progress += (100 / (this.duration / 50));
                     if (this.progress >= 100) {
                         this.progress = 0;
                         this.activeImg = (this.activeImg + 1) % this.images.length;
                     }
                 }, 50);
             }
         }"
        x-init="start()">

        <template x-for="(img, index) in images" :key="index">
            <div class="absolute inset-0 w-full h-full transition-opacity duration-1000 ease-in-out"
                :class="activeImg === index ? 'opacity-100 z-0' : 'opacity-0 -z-10'">
                <img :src="img" alt="<?php echo e($tourPackage->title); ?>" class="w-full h-full object-cover transition-transform duration-[5000ms] ease-linear" :class="activeImg === index ? 'scale-105' : 'scale-100'" />
            </div>
        </template>

        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 via-gray-900/20 to-transparent z-10"></div>

        <div class="absolute top-6 left-6 z-20">
            <a href="<?php echo e(route('tours.index')); ?>" class="bg-white/90 backdrop-blur-sm text-slate-800 p-2 rounded-full inline-flex items-center justify-center hover:bg-white transition-colors cursor-pointer shadow-sm">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
        </div>

        <div class="absolute top-6 right-6 z-20">
            <?php
            $isFavorited = auth()->check() ? $tourPackage->isFavoritedBy(auth()->user()) : false;
            ?>
            <button wire:click.prevent="toggleWishlist(<?php echo e($tourPackage->id); ?>)"
                class="bg-white/90 backdrop-blur-sm p-2 rounded-full inline-flex items-center justify-center hover:bg-white transition-all cursor-pointer shadow-sm <?php echo e($isFavorited ? 'text-[#FF7A45]' : 'text-slate-500'); ?>">
                <?php if (isset($component)) { $__componentOriginal3c240a8312226f6d27d0ad9755d1166c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3c240a8312226f6d27d0ad9755d1166c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.guest.icons.heart','data' => ['class' => 'w-5 h-5','fill' => $isFavorited ? 'currentColor' : 'none']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest.icons.heart'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5','fill' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isFavorited ? 'currentColor' : 'none')]); ?>
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

        <div class="absolute bottom-6 left-6 right-6 flex flex-col items-start text-white z-20">
            <span class="bg-amber-500 text-xs font-bold tracking-wider uppercase px-3 py-1 rounded-md mb-3 shadow-sm">
                <?php echo e($tourPackage->category->name); ?> • <?php echo e($typeLabel); ?>

            </span>
            <h1 class="text-3xl md:text-5xl font-bold mb-2"><?php echo e($tourPackage->title); ?></h1>
            <p class="text-white/80 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <?php echo e(__('tour_detail.meeting_point')); ?>: <?php echo e($tourPackage->meeting_point ?? '-'); ?>

            </p>
        </div>

        <!-- Progress Bar at the bottom -->
        <div class="absolute bottom-0 left-0 h-1.5 bg-white/20 w-full z-20 overflow-hidden">
            <div class="h-full bg-amber-500 transition-all duration-75 ease-linear rounded-r-full" :style="`width: ${progress}%`"></div>
        </div>
    </div>

    <div class="grid gap-8 lg:grid-cols-3">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Icon Features -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-wrap gap-6 items-center justify-between md:justify-start md:gap-12">
                <div class="flex items-center gap-3">
                    <div class="bg-amber-50 p-3 rounded-full text-amber-500">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[11px] text-gray-500 uppercase tracking-widest font-semibold"><?php echo e(__('tour_detail.duration')); ?></p>
                        <p class="font-bold text-slate-800"><?php echo e($tourPackage->duration_hours ? __('tour_detail.duration_hours', ['hours' => $tourPackage->duration_hours]) : __('tour_detail.duration_days')); ?></p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="bg-blue-50 p-3 rounded-full text-blue-500">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[11px] text-gray-500 uppercase tracking-widest font-semibold"><?php echo e(__('tour_detail.max_pax')); ?></p>
                        <p class="font-bold text-slate-800"><?php echo e(__('tour_detail.pax_unit', ['count' => $tourPackage->max_participants ?? '-'])); ?></p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="bg-emerald-50 p-3 rounded-full text-emerald-500">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[11px] text-gray-500 uppercase tracking-widest font-semibold"><?php echo e(__('tour_detail.type')); ?></p>
                        <p class="font-bold text-slate-800"><?php echo e($typeLabel); ?></p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="flex items-center gap-1 text-amber-500 bg-amber-50 p-2.5 rounded-lg border border-amber-100">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <span class="font-extrabold text-lg"><?php echo e(number_format((float) ($tourPackage->reviews_avg_rating ?? 0), 1)); ?></span>
                    </div>
                    <div>
                        <a href="#reviews" class="text-sm font-semibold text-slate-800 hover:text-amber-500 underline"><?php echo e(__('tour_detail.reviews_count', ['count' => $tourPackage->reviews_count])); ?></a>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
                <h2 class="text-xl md:text-2xl font-bold mb-4 text-slate-800"><?php echo e(__('tour_detail.about_activity')); ?></h2>
                <div class="prose prose-sm md:prose-base text-gray-600 max-w-none leading-relaxed">
                    <p><?php echo e($tourPackage->description); ?></p>
                </div>

                <h3 class="text-lg font-bold mt-8 mb-4 text-slate-800 border-b pb-2"><?php echo e(__('tour_detail.highlights')); ?></h3>
                <ul class="space-y-3">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [__('tour_detail.highlight_1'), __('tour_detail.highlight_2'), __('tour_detail.highlight_3'), __('tour_detail.highlight_4')]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $highlight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <li class="flex items-start gap-3 text-slate-700">
                        <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span><?php echo e($highlight); ?></span>
                    </li>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </ul>

                <h3 class="text-lg font-bold mt-8 mb-4 text-slate-800 border-b pb-2"><?php echo e(__('tour_detail.whats_included')); ?></h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [__('tour_detail.inclusion_guide'), __('tour_detail.inclusion_ticket'), __('tour_detail.inclusion_transport'), __('tour_detail.inclusion_lunch'), __('tour_detail.inclusion_documentation'), __('tour_detail.inclusion_firstaid')]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <div class="flex items-center gap-2 bg-gray-50 p-2 rounded-lg border border-gray-100">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-sm font-medium text-slate-700"><?php echo e($inc); ?></span>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>

                <!-- Itinerary -->
                <h3 class="text-lg font-bold mt-10 mb-6 text-slate-800 border-b pb-2" id="itinerary"><?php echo e(__('tour_detail.itinerary_title')); ?></h3>
                <?php
                    $itineraries = count($tourPackage->itineraries ?? []) > 0 ? $tourPackage->itineraries : collect([
                        (object)['day_number' => 1, 'time' => '08:00', 'title' => __('tour_detail.itinerary_1_title'), 'description' => __('tour_detail.itinerary_1_desc')],
                        (object)['day_number' => 1, 'time' => '09:00', 'title' => __('tour_detail.itinerary_2_title'), 'description' => __('tour_detail.itinerary_2_desc')],
                        (object)['day_number' => 1, 'time' => '11:00', 'title' => __('tour_detail.itinerary_3_title'), 'description' => __('tour_detail.itinerary_3_desc')],
                        (object)['day_number' => 1, 'time' => '13:00', 'title' => __('tour_detail.itinerary_4_title'), 'description' => __('tour_detail.itinerary_4_desc')],
                        (object)['day_number' => 1, 'time' => '15:00', 'title' => __('tour_detail.itinerary_5_title'), 'description' => __('tour_detail.itinerary_5_desc')],
                        (object)['day_number' => 1, 'time' => '17:00', 'title' => __('tour_detail.itinerary_6_title'), 'description' => __('tour_detail.itinerary_6_desc')],
                    ]);
                    $grouped = collect($itineraries)->groupBy('day_number');
                ?>

                <div class="space-y-8 pl-4 border-l-2 border-amber-500/30 ml-2 md:ml-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $grouped; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day => $dayItineraries): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <div class="relative">
                        <!-- Day Dot -->
                        <div class="absolute -left-[25px] top-[-2px] w-6 h-6 rounded-full bg-amber-500 border-[3.5px] border-white flex items-center justify-center shadow-sm"></div>
                        <h4 class="font-bold text-amber-600 mb-5 text-[17px] leading-none"><?php echo e(__('tour_detail.day', ['number' => $day])); ?></h4>

                        <div class="space-y-5">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $dayItineraries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <div class="relative pl-5">
                                <!-- Time Dot -->
                                <div class="absolute -left-[27px] top-1.5 w-[14px] h-[14px] rounded-full bg-slate-300 border-2 border-white"></div>
                                <div class="bg-gray-50 border border-gray-100 p-3.5 md:p-4 rounded-xl shadow-[0_2px_8px_rgba(0,0,0,0.02)] group hover:border-amber-200 hover:bg-amber-50/30 transition-colors">
                                    <div class="flex flex-col sm:flex-row sm:items-center gap-1.5 sm:gap-3 mb-1.5">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->time): ?>
                                        <span class="bg-amber-100 text-amber-700 text-[11px] font-bold px-2 py-0.5 rounded-md w-fit"><?php echo e($item->time); ?></span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        <h5 class="font-serif font-bold text-slate-800 text-[15px] leading-snug"><?php echo e($item->title); ?></h5>
                                    </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->description): ?>
                                    <p class="text-[13px] text-slate-600 leading-relaxed"><?php echo e($item->description); ?></p>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            </div>

            <!-- Reviews -->
            <div id="reviews" class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex justify-between items-center border-b pb-4 mb-6">
                    <h2 class="text-xl md:text-2xl font-bold text-slate-800"><?php echo e(__('tour_detail.user_reviews')); ?></h2>
                    <div class="flex items-center gap-1 bg-amber-100 text-amber-600 px-3 py-1 rounded-full text-sm font-bold">
                        ★ <?php echo e(number_format((float) ($tourPackage->reviews_avg_rating ?? 0), 1)); ?>

                    </div>
                </div>

                <div class="space-y-6">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $tourPackage->reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <div class="border-b border-gray-50 pb-6 last:border-0 last:pb-0">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex gap-3">
                                <div class="w-10 h-10 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center font-bold text-lg">
                                    <?php echo e(substr($review->user->name, 0, 1)); ?>

                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-800"><?php echo e($review->user->name); ?></p>
                                    <p class="text-[11px] text-gray-500"><?php echo e($review->created_at->format('d M Y')); ?></p>
                                </div>
                            </div>
                            <div class="flex items-center text-amber-500">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i = 0; $i < $review->rating; $i++): ?>
                                    ★
                                    <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i = $review->rating; $i < 5; $i++): ?>
                                        <span class="text-gray-300">★</span>
                                    <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                        <h4 class="font-bold text-slate-800 text-sm mb-1"><?php echo e($review->title ?? __('tour_detail.default_review_title')); ?></h4>
                        <p class="text-sm text-gray-600 bg-gray-50 p-3 rounded-lg border border-gray-100 italic">"<?php echo e($review->comment); ?>"</p>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <p class="text-sm text-gray-500"><?php echo e(__('tour_detail.no_reviews')); ?></p>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Sticky Sidebar for Booking -->
        <div class="relative lg:h-auto"
            x-data="{
                isExpanded: false,
                startY: 0,
                selectedSlotId: '<?php echo e(count($tourPackage->slots) > 0 ? $tourPackage->slots[0]->id : ''); ?>',
                slots: <?php echo e(count($tourPackage->slots) > 0 ? json_encode($tourPackage->slots->map(function($s) { return ['id' => $s->id, 'date' => $s->departure_date->format('d M Y'), 'price' => $s->price_per_person, 'quota' => $s->availableQuota()]; })) : '[]'); ?>,
                quantity: 1,
                selectedPickup: '',
                get currentSlot() { return this.slots.find(s => s.id == this.selectedSlotId); },
                get maxQuota() { return this.currentSlot ? this.currentSlot.quota : 1; },
                get basePrice() { return this.currentSlot && this.currentSlot.price ? this.currentSlot.price : <?php echo e($tourPackage->price_per_person); ?>; },
                get total() { return this.basePrice * this.quantity; },
                get quotaLabel() {
                    if (!this.currentSlot) return '';
                    const q = this.currentSlot.quota;
                    if (q <= 3) return '<?php echo e(__('tour_detail.almost_full')); ?>';
                    if (q <= 10) return '<?php echo e(__('tour_detail.available')); ?>';
                    return '<?php echo e(__('tour_detail.available')); ?>';
                },
                get quotaColor() {
                    if (!this.currentSlot) return '';
                    const q = this.currentSlot.quota;
                    if (q <= 3) return 'text-red-500 bg-red-50';
                    if (q <= 10) return 'text-amber-600 bg-amber-50';
                    return 'text-emerald-600 bg-emerald-50';
                },
                formatRp(val) { return 'Rp ' + Number(val).toLocaleString('id-ID'); },
                onTouchStart(e) {
                    this.startY = e.changedTouches[0].screenY;
                },
                onTouchEnd(e) {
                    const endY = e.changedTouches[0].screenY;
                    const delta = endY - this.startY;
                    if (delta < -30) {
                        this.isExpanded = true;
                    } else if (delta > 30) {
                        this.isExpanded = false;
                    }
                }
             }">

            <!-- Mobile Backdrop -->
            <div
                x-show="isExpanded"
                x-transition.opacity.duration.300ms
                class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm z-40 lg:hidden"
                @click="isExpanded = false"
                style="display: none;"></div>

            <!-- Booking Panel: Bottom Sheet on Mobile, Sticky Sidebar on Desktop -->
            <div
                class="fixed inset-x-0 bottom-0 z-40 lg:z-auto lg:relative bg-white lg:rounded-3xl rounded-t-3xl shadow-[0_-8px_30px_rgb(0,0,0,0.12)] lg:shadow-[0_4px_30px_rgb(0,0,0,0.06)] border border-gray-100/80 flex flex-col transition-transform duration-300 ease-in-out w-full max-w-full overflow-x-hidden overscroll-none touch-pan-y max-h-[calc(100vh-3rem)] lg:max-h-none"
                :class="isExpanded ? 'translate-y-0' : 'translate-y-[calc(100%-80px)] lg:translate-y-0'">

                <!-- Mobile Drag Handle & Header -->
                <div
                    class="h-[80px] lg:hidden flex flex-col items-center pt-2.5 px-5 cursor-pointer touch-none shrink-0"
                    @touchstart="onTouchStart"
                    @touchend="onTouchEnd"
                    @click="isExpanded = !isExpanded">
                    <div class="w-10 h-1 bg-gray-300 rounded-full mb-3 shrink-0"></div>

                    <!-- Mobile Collapsed Info -->
                    <div class="w-full flex justify-between items-center transition-opacity duration-200" :class="isExpanded ? 'opacity-0 pointer-events-none h-0' : 'opacity-100'">
                        <div class="flex flex-col">
                            <span class="text-[10px] text-gray-400 uppercase tracking-widest font-semibold leading-none mb-1"><?php echo e(__('tour_detail.price_per_person')); ?></span>
                            <span class="text-xl font-bold text-[#b48c47] leading-none" x-text="formatRp(basePrice)"></span>
                        </div>
                        <button class="bg-[#ff9e52] text-white px-6 py-3 rounded-xl font-bold text-sm shadow-md shadow-orange-100 active:scale-95 transition-all" @click.stop="isExpanded = true">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z" />
                                </svg>
                                <?php echo e(__('tour_detail.book_button')); ?>

                            </span>
                        </button>
                    </div>

                </div>

                <!-- Main Booking Content (Scrollable on mobile) -->
                <div class="px-5 pb-5 lg:p-0 overflow-y-auto overflow-x-hidden max-h-[80vh] lg:max-h-none custom-scrollbar overscroll-contain"
                    @touchstart.stop="true"
                    @touchmove.stop="true"
                    @touchend.stop="true">

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($tourPackage->slots) > 0): ?>

                    <!-- Price Header -->
                    <div class="p-6 border-b border-gray-100">
                        <p class="text-[11px] uppercase tracking-wider font-semibold text-gray-400 mb-2"><?php echo e(__('tour_detail.price_per_person')); ?></p>
                        <div class="flex items-baseline gap-x-1.5">
                            <span class="text-3xl font-bold text-[#b48c47]" x-text="formatRp(basePrice)"></span>
                            <span class="text-sm text-gray-400"><?php echo e(__('tour_detail.per_person')); ?></span>
                        </div>
                    </div>

                    <form id="add-to-cart-form" action="<?php echo e(route('cart.items.store')); ?>" method="POST" class="p-6 space-y-6">
                        <?php echo csrf_field(); ?>

                        <!-- Tanggal Paket -->
                        <div class="space-y-3">
                            <label class="text-[13px] text-gray-400 font-medium flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <?php echo e(__('tour_detail.package_date')); ?>

                            </label>
                            <div class="relative pl-6">
                                <select name="tour_departure_slot_id" x-model="selectedSlotId" @change="quantity = 1" class="w-full bg-transparent border-none p-0 text-[15px] font-bold text-gray-700 focus:ring-0 cursor-pointer appearance-none">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $tourPackage->slots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <option value="<?php echo e($slot->id); ?>">
                                        <?php echo e($slot->departure_date->format('j M Y')); ?>

                                    </option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Sisa Kuota -->
                        <div class="space-y-1">
                            <label class="text-[13px] text-gray-400 font-medium flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <?php echo e(__('tour_detail.remaining_quota')); ?>

                            </label>
                            <div class="pl-6">
                                <p class="text-[15px] font-bold text-red-500">
                                    <span x-text="maxQuota + ' pax'"></span>
                                    <span class="font-normal" x-text="quotaLabel"></span>
                                </p>
                            </div>
                        </div>

                        <!-- Jumlah Peserta -->
                        <div class="space-y-3">
                            <label class="text-[13px] text-gray-400 font-medium flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <?php echo e(__('tour_detail.participant_count')); ?>

                            </label>
                            <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden h-12">
                                <button type="button" @click="if(quantity > 1) quantity--" class="w-14 h-full flex items-center justify-center text-gray-400 hover:bg-gray-50 transition-colors border-r border-gray-200">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                    </svg>
                                </button>
                                <input type="number" name="quantity" x-model="quantity" readonly class="w-full text-center border-none p-0 focus:ring-0 text-gray-700 font-semibold text-lg" />
                                <button type="button" @click="if(quantity < maxQuota) quantity++" class="w-14 h-full flex items-center justify-center text-gray-400 hover:bg-gray-50 transition-colors border-l border-gray-200">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                </button>
                            </div>
                            <p class="text-[11px] text-gray-400"><?php echo e(__('tour_detail.max_participants', ['count' => $tourPackage->max_participants ?? '-'])); ?></p>
                        </div>

                        <!-- Titik Jemput -->
                        <?php
                            $isAdminPackage = $tourPackage->vendor?->isAdmin();
                        ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isAdminPackage || $tourPackage->pickupPoints->count() > 0): ?>
                        <div class="space-y-3">
                            <label class="text-[13px] text-gray-400 font-medium flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <?php echo e(__('tour_detail.pickup_point')); ?> <span class="text-red-400">*</span>
                            </label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isAdminPackage): ?>
                                <input type="text" name="pickup_point" x-model="selectedPickup" placeholder="<?php echo e(__('tour_detail.pickup_placeholder')); ?>" required class="w-full pl-10 pr-10 py-3 bg-white border border-blue-200 rounded-xl text-gray-700 font-medium text-sm focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all placeholder:text-gray-300" />
                                <?php else: ?>
                                <select name="pickup_point" x-model="selectedPickup" required class="w-full pl-10 pr-10 py-3 bg-white border border-blue-200 rounded-xl text-gray-500 font-medium text-sm focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none appearance-none transition-all">
                                    <option value=""><?php echo e(__('tour_detail.select_pickup')); ?></option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $tourPackage->pickupPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <option value="<?php echo e($point->location_name); ?>"><?php echo e($point->location_name); ?></option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </select>
                                <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-gray-400">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <!-- Kode Promo -->
                        <div class="space-y-3">
                            <label class="text-[13px] text-gray-400 font-medium flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                <?php echo e(__('tour_detail.promo_code')); ?>

                            </label>
                            <div class="flex gap-2">
                                <input type="text" placeholder="<?php echo e(__('tour_detail.promo_placeholder')); ?>" class="flex-1 min-w-0 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-orange-300 focus:ring-2 focus:ring-orange-50 outline-none transition-all" />
                                <button type="button" class="bg-[#ff9e52] hover:bg-[#f98b2f] text-white px-5 rounded-xl text-sm font-semibold transition-colors shrink-0">
                                    <?php echo e(__('tour_detail.apply')); ?>

                                </button>
                            </div>
                        </div>

                        <!-- Summary -->
                        <div class="bg-gray-50/50 rounded-xl p-5 space-y-3 border border-gray-100">
                            <div class="flex justify-between items-center text-sm text-gray-500">
                                <span x-text="formatRp(basePrice) + ' × ' + quantity + ' <?php echo e(__('tour_detail.person_unit')); ?>'"></span>
                                <span x-text="formatRp(total)"></span>
                            </div>
                            <div class="pt-3 border-t border-gray-100 flex justify-between items-center">
                                <span class="font-bold text-gray-700"><?php echo e(__('tour_detail.total')); ?></span>
                                <span class="text-xl font-bold text-[#b48c47]" x-text="formatRp(total)"></span>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="space-y-3 pt-2">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->isCustomer()): ?>
                            <button type="submit" id="add-to-cart-btn" class="w-full bg-[#ff9e52] hover:bg-[#f98b2f] text-white rounded-xl py-4 flex items-center justify-center gap-3 transition-all font-bold shadow-md shadow-orange-100 group relative overflow-hidden">
                                <svg class="w-5 h-5 cart-icon-to-fly" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z" />
                                </svg>
                                <span><?php echo e(__('tour_detail.add_to_cart')); ?></span>
                            </button>
                            <button type="submit" name="redirect_to" value="checkout" class="w-full bg-[#b18a45] hover:bg-[#9d793a] text-white rounded-xl py-4 flex items-center justify-center gap-3 transition-all font-bold shadow-md shadow-amber-100">
                                <svg class="w-5 h-5 rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                                <?php echo e(__('tour_detail.book_now')); ?>

                            </button>
                            <?php else: ?>
                            <button disabled class="w-full bg-gray-200 text-gray-400 rounded-xl py-4 font-bold cursor-not-allowed">
                                <?php echo e(__('tour_detail.buyer_only')); ?>

                            </button>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php else: ?>
                            <a href="<?php echo e(route('login')); ?>" class="w-full bg-[#b18a45] hover:bg-[#9d793a] text-white rounded-xl py-4 flex items-center justify-center gap-3 transition-all font-bold shadow-md shadow-amber-100">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                                <?php echo e(__('tour_detail.login_to_book')); ?>

                            </a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        <!-- Trust Footer -->
                        <div class="text-center pt-2">
                            <p class="text-[11px] text-gray-400 font-medium whitespace-nowrap">
                                <?php echo e(__('tour_detail.trust_footer')); ?>

                            </p>
                        </div>
                    </form>
                    <?php else: ?>
                    <div class="p-8 text-center">
                        <div class="mb-6">
                            <p class="text-[11px] uppercase font-bold text-gray-400 tracking-wider mb-1"><?php echo e(__('tour_detail.offer_price')); ?></p>
                            <p class="text-3xl font-bold text-[#b48c47]">Rp <?php echo e(number_format($tourPackage->price_per_person, 0, ',', '.')); ?><span class="text-sm text-gray-400 font-normal"> <?php echo e(__('tour_detail.per_person')); ?></span></p>
                        </div>
                        <div class="py-10 bg-red-50/50 rounded-2xl border border-red-100">
                            <svg class="w-12 h-12 text-red-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-lg font-bold text-red-600"><?php echo e(__('tour_detail.sold_out')); ?></p>
                            <p class="text-sm text-red-400 mt-1"><?php echo e(__('tour_detail.no_schedule')); ?></p>
                        </div>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div> <!-- /End Main Booking Content -->
            </div> <!-- /End Booking Panel -->
        </div> <!-- /End Alpine Wrapper -->

    </div>

    <!-- Vendor Info -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tourPackage->vendor): ?>
    <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100 mt-8">
        <h2 class="text-xl font-bold text-slate-800 mb-4"><?php echo e(__('tour_detail.about_organizer')); ?></h2>
        <div class="flex items-start gap-4">
            <div class="w-14 h-14 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center font-bold text-xl flex-shrink-0">
                <?php echo e(substr($tourPackage->vendor->vendorProfile->business_name ?? $tourPackage->vendor->name, 0, 1)); ?>

            </div>
            <div class="flex-1">
                <h3 class="font-bold text-lg text-slate-800"><?php echo e($tourPackage->vendor->vendorProfile->business_name ?? $tourPackage->vendor->name); ?></h3>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tourPackage->vendor->vendorProfile?->address): ?>
                <p class="text-sm text-gray-500 flex items-center gap-1 mt-1">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <?php echo e($tourPackage->vendor->vendorProfile->address); ?>

                </p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tourPackage->vendor->vendorProfile?->business_description): ?>
                <p class="text-sm text-gray-600 mt-3 leading-relaxed"><?php echo e($tourPackage->vendor->vendorProfile->business_description); ?></p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <style>
        @keyframes cart-wiggle {
            0% { transform: scale(1); }
            25% { transform: scale(1.2) rotate(10deg); }
            50% { transform: scale(1.2) rotate(-10deg); }
            75% { transform: scale(1.2) rotate(10deg); }
            100% { transform: scale(1); }
        }
        .animate-cart-wiggle {
            animation: cart-wiggle 0.5s ease-in-out;
            color: #f59e0b !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('add-to-cart-form');
            const cartBtn = document.getElementById('add-to-cart-btn');
            const globalCart = document.getElementById('navbar-cart-icon');

            if (!form || !cartBtn || !globalCart) return;

            form.addEventListener('submit', function(e) {
                const submitter = e.submitter || document.activeElement;

                // Only animate if "Tambah ke Keranjang" button (step 1) is clicked
                // "Pesan Sekarang" button should skip animation for faster checkout
                if (!submitter || submitter.id !== 'add-to-cart-btn') return;

                e.preventDefault();

                // 1. Get positions
                const iconToFly = cartBtn.querySelector('.cart-icon-to-fly');
                const startRect = iconToFly.getBoundingClientRect();
                const endRect = globalCart.getBoundingClientRect();

                // 2. Setup button loading state
                cartBtn.disabled = true;
                cartBtn.style.opacity = '0.7';
                cartBtn.style.cursor = 'wait';

                // 3. Create flying clone
                const flyer = iconToFly.cloneNode(true);
                flyer.style.position = 'fixed';
                flyer.style.left = startRect.left + 'px';
                flyer.style.top = startRect.top + 'px';
                flyer.style.width = startRect.width + 'px';
                flyer.style.height = startRect.height + 'px';
                flyer.style.zIndex = '9999';
                flyer.style.color = '#ff9e52';
                flyer.style.pointerEvents = 'none';
                flyer.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';

                document.body.appendChild(flyer);

                // 4. Start flight animation
                requestAnimationFrame(() => {
                    flyer.style.left = endRect.left + 'px';
                    flyer.style.top = endRect.top + 'px';
                    flyer.style.transform = 'scale(0.2) rotate(15deg)';
                    flyer.style.opacity = '0.5';
                });

                    setTimeout(() => {
                        flyer.remove();
                        globalCart.classList.add('animate-cart-wiggle');

                        // Submit via AJAX
                        const formData = new FormData(form);
                        fetch(form.action, {
                            method: form.method,
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                // Update Navbar Badge
                                let badge = globalCart.querySelector('span');
                                if (!badge) {
                                    badge = document.createElement('span');
                                    badge.className = 'absolute -top-1.5 -right-1.5 bg-amber-500 text-white text-[10px] font-bold rounded-full w-4 h-4 flex items-center justify-center';
                                    globalCart.appendChild(badge);
                                }
                                badge.textContent = data.cartCount;

                                // Show success alert if needed (optional)
                                if (window.Toast) {
                                    window.Toast.success(data.message);
                                }
                            }
                        })
                        .catch(err => {
                            console.error('Add to cart failed:', err);
                            // Fallback: reload to the page
                            window.location.reload();
                        })
                        .finally(() => {
                            // Reset button state
                            cartBtn.disabled = false;
                            cartBtn.style.opacity = '1';
                            cartBtn.style.cursor = 'pointer';

                            setTimeout(() => {
                                globalCart.classList.remove('animate-cart-wiggle');
                            }, 500);
                        });
                    }, 800);
                });
            });
        </script>
</div>
<?php /**PATH /var/www/indonesia-luxe/resources/views/livewire/guest/tour-detail.blade.php ENDPATH**/ ?>