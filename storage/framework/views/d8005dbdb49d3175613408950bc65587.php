<?php if (isset($component)) { $__componentOriginal82a0c5168088605aac2e71dd1139bf40 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal82a0c5168088605aac2e71dd1139bf40 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.vendor','data' => ['title' => 'Tambah Paket Baru']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.vendor'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Tambah Paket Baru')]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <div class="flex items-center justify-between mb-5 lg:hidden">
        <div>
            <p class="text-xs text-gray-400 uppercase tracking-wider">Vendor Dashboard</p>
            <h1 class="text-gray-900 leading-tight"><?php echo e(auth()->user()->name); ?></h1>
        </div>
        <div class="flex items-center gap-1.5 bg-amber-50 border border-amber-200 text-amber-700 text-[10px] px-2.5 py-1 rounded-full whitespace-nowrap">
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big">
                <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                <path d="m9 11 3 3L22 4"></path>
            </svg> Vendor Verified
        </div>
    </div>

    <div class="hidden lg:flex items-center justify-between mb-6">
        <div>
            <h2 class="text-gray-800 font-semibold text-lg">Tambah Paket Tour</h2>
            <p class="text-xs text-gray-400 mt-0.5">Submit paket baru untuk review admin sebelum dipublikasikan</p>
        </div>
        <a href="<?php echo e(route('vendor.packages.index')); ?>" class="text-sm text-gray-500 hover:text-gray-700 flex items-center gap-1.5 transition-colors group">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left group-hover:-translate-x-0.5 transition-transform">
                <path d="m12 19-7-7 7-7" />
                <path d="M19 12H5" />
            </svg>
            Kembali ke Daftar
        </a>
    </div>

    <div class="bg-white rounded-2xl p-5 sm:p-6 shadow-sm border border-gray-100"
        x-data="{
            categoryId: '<?php echo e(old('tour_category_id')); ?>',
            type: '<?php echo e(old('type')); ?>',
            categoryToType: {
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    '<?php echo e($cat->id); ?>': '<?php echo e(str_replace('-', '_', $cat->slug)); ?>',
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            },
            updateType() {
                this.type = this.categoryToType[this.categoryId] || '';
            },
            highlights: <?php echo \Illuminate\Support\Js::from(old('highlights', ['', '', '']))->toHtml() ?>,
            included: <?php echo \Illuminate\Support\Js::from(old('included', ['', '', '']))->toHtml() ?>,
            itineraries: <?php echo \Illuminate\Support\Js::from(old('itineraries', [['description' => ''], ['description' => ''], ['description' => '']]))->toHtml() ?>,
            pickupPoints: <?php echo \Illuminate\Support\Js::from(old('pickup_points', ['', '', '']))->toHtml() ?>,
            addHighlight() { this.highlights.push('') },
            removeHighlight(index) { this.highlights.splice(index, 1) },
            addIncluded() { this.included.push('') },
            removeIncluded(index) { this.included.splice(index, 1) },
            addItinerary() { this.itineraries.push({ description: '' }) },
            removeItinerary(index) { this.itineraries.splice(index, 1) },
            addPickupPoint() { this.pickupPoints.push('') },
            removePickupPoint(index) { this.pickupPoints.splice(index, 1) }
        }"
        x-init="if(categoryId) updateType()">
        <form action="<?php echo e(route('vendor.packages.store')); ?>" method="POST" enctype="multipart/form-data" class="space-y-8">
            <?php echo csrf_field(); ?>

            <input type="hidden" name="type" x-model="type">

            <div class="grid sm:grid-cols-2 gap-5">
                <div class="space-y-1.5">
                    <label for="title" class="text-xs text-gray-500 font-medium block">Judul Paket <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" placeholder="Contoh: Open Trip Raja Ampat 4D3N"
                        class="w-full border rounded-xl px-4 py-2.5 text-sm outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition <?php echo e($errors->has('title') ? 'border-red-500 bg-red-50/10' : 'border-gray-200'); ?>"
                        required value="<?php echo e(old('title')); ?>">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-[11px] text-red-500 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="space-y-1.5">
                    <label for="meeting_point" class="text-xs text-gray-500 font-medium block">Lokasi <span class="text-red-500">*</span></label>
                    <input type="text" name="meeting_point" id="meeting_point" placeholder="Contoh: Bandara Ngurah Rai, Bali"
                        class="w-full border rounded-xl px-4 py-2.5 text-sm outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition <?php echo e($errors->has('meeting_point') ? 'border-red-500 bg-red-50/10' : 'border-gray-200'); ?>"
                        required value="<?php echo e(old('meeting_point')); ?>">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['meeting_point'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-[11px] text-red-500 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="space-y-1.5">
                    <label for="tour_category_id" class="text-xs text-gray-500 font-medium block">Kategori <span class="text-red-500">*</span></label>
                    <select name="tour_category_id" id="tour_category_id"
                        x-model="categoryId"
                        @change="updateType()"
                        class="w-full border rounded-xl px-4 py-2.5 text-sm outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition bg-white <?php echo e($errors->has('tour_category_id') ? 'border-red-500 bg-red-50/10' : 'border-gray-200'); ?>"
                        required>
                        <option value="">Pilih Kategori</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </select>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['tour_category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-[11px] text-red-500 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="space-y-1.5">
                    <label for="price_per_person" class="text-xs text-gray-500 font-medium block">Harga per Orang (Rp) <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm">Rp</span>
                        <input type="number" name="price_per_person" id="price_per_person" placeholder="750000"
                            class="w-full border rounded-xl pl-12 pr-4 py-2.5 text-sm outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition <?php echo e($errors->has('price_per_person') ? 'border-red-500 bg-red-50/10' : 'border-gray-200'); ?>"
                            required value="<?php echo e(old('price_per_person')); ?>">
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['price_per_person'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-[11px] text-red-500 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="space-y-1.5">
                    <label for="max_participants" class="text-xs text-gray-500 font-medium block">Maksimal Peserta</label>
                    <input type="number" name="max_participants" id="max_participants" placeholder="15"
                        class="w-full border rounded-xl px-4 py-2.5 text-sm outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition <?php echo e($errors->has('max_participants') ? 'border-red-500 bg-red-50/10' : 'border-gray-200'); ?>"
                        value="<?php echo e(old('max_participants')); ?>">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['max_participants'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-[11px] text-red-500 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="space-y-1.5">
                    <label for="start_date" class="text-xs text-gray-500 font-medium block">Tanggal Mulai <span class="text-red-500">*</span></label>
                    <input type="date" name="start_date" id="start_date"
                        class="w-full border rounded-xl px-4 py-2.5 text-sm outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition <?php echo e($errors->has('start_date') ? 'border-red-500 bg-red-50/10' : 'border-gray-200'); ?>"
                        required value="<?php echo e(old('start_date')); ?>">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-[11px] text-red-500 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="space-y-1.5">
                    <label for="end_date" class="text-xs text-gray-500 font-medium block">Tanggal Selesai <span class="text-red-500">*</span></label>
                    <input type="date" name="end_date" id="end_date"
                        class="w-full border rounded-xl px-4 py-2.5 text-sm outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition <?php echo e($errors->has('end_date') ? 'border-red-500 bg-red-50/10' : 'border-gray-200'); ?>"
                        required value="<?php echo e(old('end_date')); ?>">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['end_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-[11px] text-red-500 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>

            <div class="space-y-1.5">
                <label for="description" class="text-xs text-gray-500 font-medium block">Deskripsi Paket <span class="text-red-500">*</span></label>
                <textarea name="description" id="description" rows="4" placeholder="Ceritakan detail menarik tentang paket tour ini..."
                    class="w-full border rounded-xl px-4 py-2.5 text-sm outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition resize-none <?php echo e($errors->has('description') ? 'border-red-500 bg-red-50/10' : 'border-gray-200'); ?>"
                    required><?php echo e(old('description')); ?></textarea>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-[11px] text-red-500 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div class="space-y-1.5">
                <label for="cover_image" class="text-xs text-gray-500 font-medium block">Foto Cover <span class="text-red-500">*</span></label>
                <input type="file" name="cover_image" id="cover_image" accept="image/*"
                    class="w-full border rounded-xl px-4 py-2.5 text-xs outline-none focus:border-amber-400 transition focus:ring-1 focus:ring-amber-400 file:mr-4 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 <?php echo e($errors->has('cover_image') ? 'border-red-500 bg-red-50/10' : 'border-gray-200'); ?>" required>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['cover_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-[11px] text-red-500 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div class="space-y-1.5">
                <label for="extra_photo_1" class="text-xs text-gray-500 font-medium block">Foto Tambahan <span class="text-gray-400 font-normal">(maks. 4 foto)</span></label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <input type="file" name="extra_photos[]" id="extra_photo_1" accept="image/*"
                            class="w-full border rounded-xl px-4 py-2.5 text-xs outline-none focus:border-amber-400 transition focus:ring-1 focus:ring-amber-400 file:mr-4 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 border-gray-200">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['extra_photos.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-[11px] text-red-500 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <div>
                        <input type="file" name="extra_photos[]" id="extra_photo_2" accept="image/*"
                            class="w-full border rounded-xl px-4 py-2.5 text-xs outline-none focus:border-amber-400 transition focus:ring-1 focus:ring-amber-400 file:mr-4 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 border-gray-200">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['extra_photos.1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-[11px] text-red-500 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <div>
                        <input type="file" name="extra_photos[]" id="extra_photo_3" accept="image/*"
                            class="w-full border rounded-xl px-4 py-2.5 text-xs outline-none focus:border-amber-400 transition focus:ring-1 focus:ring-amber-400 file:mr-4 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 border-gray-200">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['extra_photos.2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-[11px] text-red-500 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <div>
                        <input type="file" name="extra_photos[]" id="extra_photo_4" accept="image/*"
                            class="w-full border rounded-xl px-4 py-2.5 text-xs outline-none focus:border-amber-400 transition focus:ring-1 focus:ring-amber-400 file:mr-4 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 border-gray-200">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['extra_photos.3'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-[11px] text-red-500 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['extra_photos'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-[11px] text-red-500 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <hr class="border-gray-50">

            <!-- HIGHLIGHTS -->
            <div>
                <label class="text-xs text-gray-500 mb-3 block">Highlights</label>
                <div class="space-y-2">
                    <template x-for="(highlight, index) in highlights" :key="index">
                        <div class="flex gap-2">
                            <input :name="'highlights[]'" x-model="highlights[index]" placeholder="Contoh: Matahari Terbit di Puncak"
                                class="flex-1 border border-gray-200 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-amber-400 transition">
                            <button type="button" @click="removeHighlight(index)" class="text-red-400 hover:text-red-500 px-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2">
                                    <path d="M3 6h18" />
                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                    <line x1="10" x2="10" y1="11" y2="17" />
                                    <line x1="14" x2="14" y1="11" y2="17" />
                                </svg>
                            </button>
                        </div>
                    </template>
                    <button type="button" @click="addHighlight()" class="text-xs text-amber-600 font-medium hover:text-amber-700 flex items-center gap-1 mt-1 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus">
                            <path d="M5 12h14" />
                            <path d="M12 5v14" />
                        </svg>
                        Tambah Highlight
                    </button>
                </div>
            </div>

            <!-- INCLUDED -->
            <div>
                <label class="text-xs text-gray-500 mb-3 block">Sudah Termasuk (Inclusions)</label>
                <div class="grid sm:grid-cols-2 gap-3">
                    <template x-for="(item, index) in included" :key="index">
                        <div class="flex gap-2">
                            <input :name="'included[]'" x-model="included[index]" placeholder="Contoh: Tiket Masuk, Air Mineral"
                                class="flex-1 border border-gray-200 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-amber-400 transition">
                            <button type="button" @click="removeIncluded(index)" class="text-red-400 hover:text-red-500 px-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x">
                                    <path d="M18 6 6 18" />
                                    <path d="m6 6 12 12" />
                                </svg>
                            </button>
                        </div>
                    </template>
                </div>
                <button type="button" @click="addIncluded()" class="text-xs text-amber-600 font-medium hover:text-amber-700 flex items-center gap-1 mt-3 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus">
                        <path d="M5 12h14" />
                        <path d="M12 5v14" />
                    </svg>
                    Tambah Item
                </button>
            </div>

            <!-- ITINERARIES -->
            <div>
                <label class="text-xs text-gray-500 mb-3 block">Itinerary (per hari)</label>
                <div class="space-y-3">
                    <template x-for="(itinerary, index) in itineraries" :key="index">
                        <div class="flex gap-3 items-start bg-gray-50/50 p-4 rounded-xl border border-gray-100">
                            <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center text-xs font-bold text-amber-700 shrink-0" x-text="index + 1"></div>
                            <div class="flex-1 space-y-2">
                                <textarea :name="'itineraries['+index+'][description]'" x-model="itineraries[index].description" placeholder="Hari ke-n: Deskripsi aktivitas..."
                                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-amber-400 transition resize-none" rows="2"></textarea>
                            </div>
                            <button type="button" @click="removeItinerary(index)" class="text-red-400 hover:text-red-500 pt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2">
                                    <path d="M3 6h18" />
                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                    <line x1="10" x2="10" y1="11" y2="17" />
                                    <line x1="14" x2="14" y1="11" y2="17" />
                                </svg>
                            </button>
                        </div>
                    </template>
                    <button type="button" @click="addItinerary()" class="text-xs text-amber-600 font-medium hover:text-amber-700 flex items-center gap-1 mt-1 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus">
                            <path d="M5 12h14" />
                            <path d="M12 5v14" />
                        </svg>
                        Tambah Hari
                    </button>
                </div>
            </div>

            <!-- PICK UP POINTS -->
            <div class="bg-blue-50 border border-blue-100 rounded-2xl p-5">
                <div class="flex items-center gap-2 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin text-blue-500">
                        <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                        <circle cx="12" cy="10" r="3" />
                    </svg>
                    <label class="text-sm font-semibold text-blue-900">Titik Penjemputan <span class="text-red-500">*</span></label>
                </div>
                <p class="text-xs text-blue-600 mb-4 leading-relaxed">Daftarkan semua titik jemput yang tersedia. Traveler akan memilih satu titik saat memesan. Contoh: <span class="font-mono bg-blue-100 px-1 rounded text-blue-700">Bandara Ngurah Rai - Pintu Kedatangan</span></p>

                <div class="space-y-3">
                    <template x-for="(point, index) in pickupPoints" :key="index">
                        <div class="flex gap-2 items-center">
                            <div class="w-7 h-7 rounded-full bg-blue-200 flex items-center justify-center text-xs font-bold text-blue-700 shrink-0" x-text="index + 1"></div>
                            <input :name="'pickup_points[]'" x-model="pickupPoints[index]" placeholder="Lokasi penjemputan..."
                                class="flex-1 border border-blue-200 bg-white rounded-xl px-4 py-2.5 text-sm outline-none focus:border-blue-400 transition" required>
                            <button type="button" @click="removePickupPoint(index)" class="text-red-400 hover:text-red-500 p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x">
                                    <path d="M18 6 6 18" />
                                    <path d="m6 6 12 12" />
                                </svg>
                            </button>
                        </div>
                    </template>
                    <button type="button" @click="addPickupPoint()" class="text-xs font-semibold text-blue-600 hover:text-blue-700 flex items-center gap-1 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus">
                            <path d="M5 12h14" />
                            <path d="M12 5v14" />
                        </svg>
                        Tambah Titik Jemput
                    </button>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['pickup_points'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-[11px] text-red-500 mt-2"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div class="flex flex-col-reverse sm:flex-row gap-3 pt-6 border-t border-gray-50">
                <a href="<?php echo e(route('vendor.packages.index')); ?>" class="w-full sm:w-auto px-10 py-3.5 bg-gray-50 text-gray-600 rounded-xl text-sm font-medium hover:bg-gray-100 transition text-center">Batal</a>
                <button type="submit" class="w-full sm:flex-1 bg-amber-500 hover:bg-amber-600 text-white py-3.5 px-10 rounded-xl text-sm font-bold flex items-center justify-center gap-2 transition shadow-md shadow-amber-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save">
                        <path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z" />
                        <path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7" />
                        <path d="M7 3v4a1 1 0 0 0 1 1h7" />
                    </svg>
                    Submit untuk Review
                </button>
            </div>
        </form>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal82a0c5168088605aac2e71dd1139bf40)): ?>
<?php $attributes = $__attributesOriginal82a0c5168088605aac2e71dd1139bf40; ?>
<?php unset($__attributesOriginal82a0c5168088605aac2e71dd1139bf40); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal82a0c5168088605aac2e71dd1139bf40)): ?>
<?php $component = $__componentOriginal82a0c5168088605aac2e71dd1139bf40; ?>
<?php unset($__componentOriginal82a0c5168088605aac2e71dd1139bf40); ?>
<?php endif; ?>
<?php /**PATH C:\Users\fazar\indonesia-luxe-backup\indonesia-luxe\resources\views/vendor/packages/create.blade.php ENDPATH**/ ?>