<?php
$user = auth()->user();
$roleLabel = $user?->role?->name;
?>
<nav class="bg-white shadow-md sticky top-0 z-50"
  x-data="{ 
    isMobileMenuOpen: false,
  }">
  <div class="max-w-7xl mx-auto px-4">
    <div class="flex items-center justify-between h-16">
      <div class="flex items-center gap-1">
        <!-- Menu Toggle Button -->
        <button @click="<?php echo e(request()->is('vendor*') ? 'showVendorSidebar = true' : 'isMobileMenuOpen = true'); ?>" x-show="<?php echo e(request()->is('vendor*') ? '!showVendorSidebar' : '!isMobileMenuOpen'); ?>" class="md:hidden p-2">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu w-6 h-6">
            <line x1="4" x2="20" y1="12" y2="12"></line>
            <line x1="4" x2="20" y1="6" y2="6"></line>
            <line x1="4" x2="20" y1="18" y2="18"></line>
          </svg>
        </button>
        <button @click="<?php echo e(request()->is('vendor*') ? 'showVendorSidebar = false' : 'isMobileMenuOpen = false'); ?>" x-show="<?php echo e(request()->is('vendor*') ? 'showVendorSidebar' : 'isMobileMenuOpen'); ?>" class="md:hidden p-1.5 border border-gray-800 rounded-lg hover:bg-gray-50 transition" style="display: none;">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-[22px] h-[22px]">
            <path d="M18 6 6 18" />
            <path d="m6 6 12 12" />
          </svg>
        </button>
        <a class="flex items-center gap-3" href="<?php echo e(route('home')); ?>" data-discover="true"><img src="<?php echo e(asset('/images/logo.png')); ?>" alt="Indonesia Luxe" class="h-14 w-auto"><span class="hidden sm:block text-[#b8860b] font-serif text-lg tracking-[0.15em]">INDONESIA LUXE</span></a>
      </div>
      <div x-data="{showProfile: false}" class="flex items-center gap-4">
        
        <div x-data="{ showLang: false }" class="relative">
          <button @click="showLang = !showLang" class="flex items-center gap-1.5 px-2 md:px-3 py-1.5 hover:bg-gray-50 rounded-lg transition text-sm text-gray-600 border border-gray-200">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(app()->getLocale() == 'id'): ?>
            <svg viewBox="0 0 20 14" class="w-5 h-3.5 rounded-[2px] shadow-sm" aria-label="Indonesia">
              <rect width="20" height="7" fill="#CE1126" rx="1"></rect>
              <rect y="7" width="20" height="7" fill="#FFFFFF" rx="1"></rect>
              <rect width="20" height="14" rx="1.5" fill="none" stroke="#e5e7eb" stroke-width="0.5"></rect>
            </svg>
            <span class="hidden md:inline text-gray-500 text-xs">ID</span>
            <span class="hidden md:inline">Indonesia</span>
            <?php else: ?>
            <svg viewBox="0 0 60 30" width="60" height="30" class="w-5 h-3.5 rounded-[2px] shadow-sm" preserveAspectRatio="none">
              <clipPath id="ukp1">
                <path d="M0,0 v30 h60 v-30 z" />
              </clipPath>
              <clipPath id="ukp2">
                <path d="M30,15 h30 v15 z v15 h-30 z h-30 v-15 z v-15 h30 z" />
              </clipPath>
              <g clip-path="url(#ukp1)">
                <path d="M0,0 v30 h60 v-30 z" fill="#012169" />
                <path d="M0,0 L60,30 M60,0 L0,30" stroke="#fff" stroke-width="6" />
                <path d="M0,0 L60,30 M60,0 L0,30" clip-path="url(#ukp2)" stroke="#C8102E" stroke-width="4" />
                <path d="M30,0 v30 M0,15 h60" stroke="#fff" stroke-width="10" />
                <path d="M30,0 v30 M0,15 h60" stroke="#C8102E" stroke-width="6" />
              </g>
              <rect width="60" height="30" rx="4" fill="none" stroke="#e5e7eb" stroke-width="1"></rect>
            </svg>
            <span class="hidden md:inline text-gray-500 text-xs">EN</span>
            <span class="hidden md:inline">English</span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down w-3 h-3">
              <path d="m6 9 6 6 6-6"></path>
            </svg>
          </button>

          <!-- Language Dropdown Panel -->
          <div
            x-show="showLang"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95 translate-y-2"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-2"
            @click.outside="showLang = false"
            class="absolute right-0 top-full mt-2 bg-white shadow-lg rounded-2xl min-w-[200px] z-50 border border-gray-100 overflow-hidden"
            style="display: none;">
            <!-- ID -->
            <a href="<?php echo e(route('language.switch', ['locale' => 'id'])); ?>" class="w-full flex items-center justify-between px-4 py-3 <?php echo e(app()->getLocale() == 'id' ? 'bg-[#fefce8] hover:bg-[#fefce8] border-b border-gray-50' : 'hover:bg-gray-50'); ?> transition cursor-pointer">
              <div class="flex items-center gap-3">
                <div class="w-6 h-4 rounded-[2px] overflow-hidden flex shadow-sm shrink-0 relative">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 3 2" class="w-full h-full" preserveAspectRatio="none">
                    <rect width="3" height="1" fill="#ce1126" />
                    <rect y="1" width="3" height="1" fill="#ffffff" />
                  </svg>
                  <div class="absolute inset-0 border border-black/5 rounded-[2px]"></div>
                </div>
                <div class="flex items-center gap-2">
                  <span class="text-[13px] font-semibold <?php echo e(app()->getLocale() == 'id' ? 'text-[#9ca3af]' : 'text-gray-400'); ?>">ID</span>
                  <span class="text-sm font-medium <?php echo e(app()->getLocale() == 'id' ? 'text-[#c4532c]' : 'text-gray-700'); ?>">Indonesia</span>
                </div>
              </div>
              <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(app()->getLocale() == 'id'): ?>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="w-[18px] h-[18px] text-[#eaa633]">
                <path d="M20 6 9 17l-5-5" />
              </svg>
              <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </a>

            <!-- EN -->
            <a href="<?php echo e(route('language.switch', ['locale' => 'en'])); ?>" class="w-full flex items-center justify-between px-4 py-3 <?php echo e(app()->getLocale() == 'en' ? 'bg-[#fefce8] hover:bg-[#fefce8] border-t border-gray-50' : 'hover:bg-gray-50'); ?> transition cursor-pointer">
              <div class="flex items-center gap-3">
                <div class="w-6 h-4 rounded-[2px] overflow-hidden flex shadow-sm shrink-0 relative">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 30" width="60" height="30" class="w-full h-full" preserveAspectRatio="none">
                    <clipPath id="ukp1">
                      <path d="M0,0 v30 h60 v-30 z" />
                    </clipPath>
                    <clipPath id="ukp2">
                      <path d="M30,15 h30 v15 z v15 h-30 z h-30 v-15 z v-15 h30 z" />
                    </clipPath>
                    <g clip-path="url(#ukp1)">
                      <path d="M0,0 v30 h60 v-30 z" fill="#012169" />
                      <path d="M0,0 L60,30 M60,0 L0,30" stroke="#fff" stroke-width="6" />
                      <path d="M0,0 L60,30 M60,0 L0,30" clip-path="url(#ukp2)" stroke="#C8102E" stroke-width="4" />
                      <path d="M30,0 v30 M0,15 h60" stroke="#fff" stroke-width="10" />
                      <path d="M30,0 v30 M0,15 h60" stroke="#C8102E" stroke-width="6" />
                    </g>
                  </svg>
                  <div class="absolute inset-0 border border-black/5 rounded-[2px]"></div>
                </div>
                <div class="flex items-center gap-2">
                  <span class="text-[13px] font-semibold <?php echo e(app()->getLocale() == 'en' ? 'text-[#9ca3af]' : 'text-gray-400'); ?>">EN</span>
                  <span class="text-sm font-medium <?php echo e(app()->getLocale() == 'en' ? 'text-[#c4532c]' : 'text-gray-700'); ?>">English</span>
                </div>
              </div>
              <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(app()->getLocale() == 'en'): ?>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="w-[18px] h-[18px] text-[#eaa633]">
                <path d="M20 6 9 17l-5-5" />
              </svg>
              <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </a>
          </div>
        </div>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$user || $user->isCustomer()): ?>
        <a id="navbar-cart-icon" class="relative hover:text-amber-600 transition text-gray-700" href="<?php echo e(route('cart.index')); ?>" data-discover="true">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart w-[22px] h-[22px]">
            <circle cx="8" cy="21" r="1"></circle>
            <circle cx="19" cy="21" r="1"></circle>
            <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path>
          </svg>
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cartCount > 0): ?>
          <span class="absolute -top-1.5 -right-1.5 bg-amber-500 text-white text-[10px] font-bold rounded-full w-4 h-4 flex items-center justify-center"><?php echo e($cartCount); ?></span>
          <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </a>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
        <div class="relative md:hidden">
          <button
            @click="showProfile = !showProfile"
            type="button"
            class="flex items-center justify-center rounded-full border bg-white p-1 shadow-sm transition"
            data-test="mobile-profile-trigger">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->hasAvatar()): ?>
            <img src="<?php echo e($user->getAvatarUrl()); ?>" alt="" class="w-8 h-8 rounded-full object-cover">
            <?php else: ?>
            <div class="w-8 h-8 rounded-full bg-[#f59e0b] flex items-center justify-center text-sm font-semibold text-white"><?php echo e($user->initials()); ?></div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          </button>
          <div
            x-show="showProfile"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95 translate-y-2"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-2"
            @click.outside="showProfile = false"
            class="absolute right-0 top-full mt-3 w-[216px] overflow-hidden rounded-[18px] border border-stone-200 bg-white py-2 shadow-[0_18px_45px_rgba(15,23,42,0.16)] z-50"
            style="display: none;"
            data-test="mobile-profile-menu">
            <div class="px-4 pb-3 pt-2">
              <p class="text-sm text-gray-900 truncate"><?php echo e($user->name); ?></p>
              <p class="mt-1 text-xs text-stone-500"><?php echo e($user->email); ?></p>
              <span class="mt-3 inline-flex items-center rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-medium text-amber-700"><?php echo e($roleLabel); ?></span>
            </div>

            <div class="border-t border-stone-200 py-1">
              <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->isCustomer()): ?>
              <a class="flex items-center gap-3 px-4 py-3 text-sm text-stone-700 transition hover:bg-amber-50" href="<?php echo e(route('profile.index')); ?>" data-discover="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                  <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                  <circle cx="12" cy="7" r="4"></circle>
                </svg> <?php echo e(__('navbar.my_profile')); ?>

              </a>
              <a class="flex items-center gap-3 px-4 py-3 text-sm text-stone-700 transition hover:bg-amber-50" href="<?php echo e(route('bookings.index')); ?>" data-discover="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                  <path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"></path>
                  <path d="M12 22V12"></path>
                  <polyline points="3.29 7 12 12 20.71 7"></polyline>
                  <path d="m7.5 4.27 9 5.15"></path>
                </svg> <?php echo e(__('navbar.my_bookings')); ?>

              </a>
              <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

              <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->isVendor()): ?>
              <a class="flex items-center gap-3 px-4 py-3 text-sm text-stone-700 transition hover:bg-amber-50" href="<?php echo e(route('vendor.dashboard')); ?>" data-discover="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                  <rect width="7" height="9" x="3" y="3" rx="1"></rect>
                  <rect width="7" height="5" x="14" y="3" rx="1"></rect>
                  <rect width="7" height="9" x="14" y="12" rx="1"></rect>
                  <rect width="7" height="5" x="3" y="16" rx="1"></rect>
                </svg> <?php echo e(__('navbar.vendor_dashboard')); ?>

              </a>
              <a href="<?php echo e(route('vendor.profile.edit')); ?>" class="flex items-center gap-3 px-4 py-3 text-sm text-stone-700 transition hover:bg-amber-50" data-discover="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                  <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                  <circle cx="12" cy="7" r="4"></circle>
                </svg> <?php echo e(__('navbar.vendor_profile')); ?>

              </a>
              <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

              <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->isAdmin()): ?>
              <a class="flex items-center gap-3 px-4 py-3 text-sm text-stone-700 transition hover:bg-amber-50" href="<?php echo e(route('admin.dashboard')); ?>" data-discover="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                  <rect width="7" height="7" x="3" y="3" rx="1"></rect>
                  <rect width="7" height="7" x="14" y="3" rx="1"></rect>
                  <rect width="7" height="7" x="3" y="14" rx="1"></rect>
                  <rect width="7" height="7" x="14" y="14" rx="1"></rect>
                </svg> <?php echo e(__('navbar.admin_dashboard')); ?>

              </a>
              <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div class="border-t border-stone-200 pt-1">
              <button @click="showLogout = true" type="button" class="flex w-full items-center gap-3 px-4 py-3 text-left text-sm text-red-600 transition hover:bg-red-50">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                  <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                  <polyline points="16 17 21 12 16 7"></polyline>
                  <line x1="21" x2="9" y1="12" y2="12"></line>
                </svg> <?php echo e(__('navbar.logout')); ?>

              </button>
            </div>
          </div>
        </div>

        <div class="relative hidden md:block">
          <button @click="showProfile = !showProfile" class="flex items-center gap-2 p-2 hover:bg-amber-50 rounded-full transition">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->hasAvatar()): ?>
            <img src="<?php echo e($user->getAvatarUrl()); ?>" alt="" class="w-8 h-8 rounded-full object-cover">
            <?php else: ?>
            <div class="w-8 h-8 rounded-full bg-[#f59e0b] flex items-center justify-center text-sm font-semibold text-white"><?php echo e($user->initials()); ?></div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          </button>
          <div
            x-show="showProfile"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95 translate-y-2"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-2"
            @click.outside="showProfile = false"
            class="absolute right-0 top-full mt-3 w-[216px] overflow-hidden rounded-[18px] border border-stone-200 bg-white py-2 shadow-[0_18px_45px_rgba(15,23,42,0.16)]"
            style="display: none;">
            <div class="px-4 pb-3 pt-2">
              <p class="text-sm text-gray-900 truncate"><?php echo e($user->name); ?></p>
              <p class="mt-1 text-xs text-stone-500"><?php echo e($user->email); ?></p>
              <span class="mt-3 inline-flex items-center rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-medium text-amber-700"><?php echo e($roleLabel); ?></span>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->isCustomer() || $user->isVendor() || $user->isAdmin()): ?>
            <div class="border-t border-stone-200 py-1">
              <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->isCustomer()): ?>
              <a class="flex items-center gap-3 px-4 py-3 text-sm text-stone-700 transition hover:bg-amber-50" href="<?php echo e(route('profile.index')); ?>" data-discover="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                  <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                  <circle cx="12" cy="7" r="4"></circle>
                </svg> <?php echo e(__('navbar.my_profile')); ?>

              </a>
              <a class="flex items-center gap-3 px-4 py-3 text-sm text-stone-700 transition hover:bg-amber-50" href="<?php echo e(route('bookings.index')); ?>" data-discover="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                  <path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"></path>
                  <path d="M12 22V12"></path>
                  <polyline points="3.29 7 12 12 20.71 7"></polyline>
                  <path d="m7.5 4.27 9 5.15"></path>
                </svg> <?php echo e(__('navbar.my_bookings')); ?>

              </a>
              <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

              <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->isVendor()): ?>
              <a class="flex items-center gap-3 px-4 py-3 text-sm text-stone-700 transition hover:bg-amber-50" href="<?php echo e(route('vendor.dashboard')); ?>" data-discover="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                  <rect width="7" height="9" x="3" y="3" rx="1"></rect>
                  <rect width="7" height="5" x="14" y="3" rx="1"></rect>
                  <rect width="7" height="9" x="14" y="12" rx="1"></rect>
                  <rect width="7" height="5" x="3" y="16" rx="1"></rect>
                </svg> <?php echo e(__('navbar.vendor_dashboard')); ?>

              </a>
              <a href="<?php echo e(route('vendor.profile.edit')); ?>" class="flex items-center gap-3 px-4 py-3 text-sm text-stone-700 transition hover:bg-amber-50" data-discover="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                  <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                  <circle cx="12" cy="7" r="4"></circle>
                </svg> <?php echo e(__('navbar.vendor_profile')); ?>

              </a>
              <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

              <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->isAdmin()): ?>
              <a class="flex items-center gap-3 px-4 py-3 text-sm text-stone-700 transition hover:bg-amber-50" href="<?php echo e(route('admin.dashboard')); ?>" data-discover="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                  <rect width="7" height="7" x="3" y="3" rx="1"></rect>
                  <rect width="7" height="7" x="14" y="3" rx="1"></rect>
                  <rect width="7" height="7" x="3" y="14" rx="1"></rect>
                  <rect width="7" height="7" x="14" y="14" rx="1"></rect>
                </svg> <?php echo e(__('navbar.admin_dashboard')); ?>

              </a>
              <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <div class="border-t border-stone-200 pt-1">
              <button @click="showLogout = true" type="button" class="flex w-full items-center gap-3 px-4 py-3 text-left text-sm text-red-600 transition hover:bg-red-50"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                  <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                  <polyline points="16 17 21 12 16 7"></polyline>
                  <line x1="21" x2="9" y1="12" y2="12"></line>
                </svg> <?php echo e(__('navbar.logout')); ?>

              </button>
            </div>
          </div>
        </div>
        <?php else: ?>
        <a class="md:hidden p-2 hover:bg-amber-50 rounded-full transition" href="<?php echo e(route('login')); ?>" data-discover="true">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user w-5 h-5 text-gray-700">
            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
            <circle cx="12" cy="7" r="4"></circle>
          </svg>
        </a>
        <div class="hidden md:flex items-center gap-2">
          <a class="text-sm px-4 py-2 text-amber-600 border border-amber-600 rounded-lg hover:bg-amber-50 transition" href="<?php echo e(route('login')); ?>" data-discover="true"><?php echo e(__('navbar.login')); ?></a>
          <a class="text-sm px-4 py-2 bg-amber-500 text-white rounded-lg hover:bg-amber-600 transition" href="<?php echo e(route('register')); ?>" data-discover="true"><?php echo e(__('navbar.register')); ?></a>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </div>
    </div>
  </div>

  <!-- Mobile Menu Overlay -->
  <div
    x-show="isMobileMenuOpen"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 -translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-2"
    class="fixed inset-0 top-16 bg-white z-40 md:hidden overflow-y-auto"
    style="display: none;">
    <div class="flex flex-col px-6 py-6 gap-6 text-[#4b5563]">
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
      <div class="border-b pb-4 mb-3">
        <div class="flex items-center gap-3">
          <div class="w-11 h-11 bg-amber-500 rounded-full flex items-center justify-center text-white shrink-0"><?php echo e($user->initials()); ?></div>
          <div class="min-w-0">
            <p class="text-gray-900 truncate"><?php echo e($user->name); ?></p>
            <p class="text-xs text-gray-500 truncate"><?php echo e($user->email); ?></p><span class="inline-block mt-0.5 text-xs bg-amber-100 text-amber-700 px-2 py-0.5 rounded-full capitalize"><?php echo e($roleLabel); ?></span>
          </div>
        </div>
      </div>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      <a href="<?php echo e(route('home')); ?>" class="text-[16px] hover:text-amber-600 transition"><?php echo e(__('navbar.home')); ?></a>
      <?php
      $categories = \App\Models\TourCategory::query()->orderBy('name')->get();
      ?>
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
      <a href="<?php echo e(route('tours.index')); ?>?category=<?php echo e($category->slug); ?>" class="text-[15px] pl-4 hover:text-amber-600 transition"><?php echo e($category->name); ?></a>
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->guest()): ?>
      <hr class="border-gray-200 mt-2 mb-1">
      <div class="flex flex-col gap-3">
        <a href="<?php echo e(route('login')); ?>" class="w-full py-2.5 text-sm text-center text-[#e9792e] border border-[#e9792e] bg-white rounded-[10px] font-medium hover:bg-orange-50 transition"><?php echo e(__('navbar.login')); ?></a>
        <a href="<?php echo e(route('register')); ?>" class="w-full py-2.5 text-sm text-center bg-[#faa056] text-white rounded-[10px] font-medium hover:bg-[#eb8c3f] transition shadow-sm"><?php echo e(__('navbar.register')); ?></a>
      </div>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    </div>
  </div>

  <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$user || $user->isCustomer()): ?>
  <div x-show="showVendorSidebar" class="md:hidden fixed inset-0 top-16 bg-white z-50 overflow-y-auto">
    <div class="px-4 py-3 space-y-2">
      <a class="block py-2 text-gray-700" href="<?php echo e(route('home')); ?>" data-discover="true"><?php echo e(__('navbar.home')); ?></a>
      <a class="block py-2 text-gray-600 pl-4" href="<?php echo e(route('tours.index')); ?>?type=open_trip" data-discover="true">Open Trip</a>
      <a class="block py-2 text-gray-600 pl-4" href="<?php echo e(route('tours.index')); ?>?type=private_tour" data-discover="true">Private Tour</a>
      <a class="block py-2 text-gray-600 pl-4" href="<?php echo e(route('tours.index')); ?>?type=hiking_camping" data-discover="true">Hiking / Camping</a>
      <a class="block py-2 text-gray-600 pl-4" href="<?php echo e(route('tours.index')); ?>?type=rafting" data-discover="true">Rafting</a>
      <a class="block py-2 text-gray-600 pl-4" href="<?php echo e(route('tours.index')); ?>?type=snorkeling_diving" data-discover="true">Snorkeling / Diving</a>
      <a class="block py-2 text-gray-600 pl-4" href="<?php echo e(route('tours.index')); ?>?type=jeep_adventure" data-discover="true">Jeep Adventure</a>
      <a class="block py-2 text-gray-600 pl-4" href="<?php echo e(route('tours.index')); ?>?type=local_experience" data-discover="true">Local Experience</a>
      <div class="border-t pt-3 mt-3 space-y-2">
        <a class="block w-full text-center py-2.5 text-amber-600 border border-amber-600 rounded-lg hover:bg-amber-50 transition" href="<?php echo e(route('login')); ?>" data-discover="true"><?php echo e(__('navbar.login')); ?></a>
        <a class="block w-full text-center py-2.5 bg-amber-500 text-white rounded-lg hover:bg-amber-600 transition" href="<?php echo e(route('register')); ?>" data-discover="true"><?php echo e(__('navbar.register')); ?></a>
      </div>
    </div>
  </div>
  <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

  <?php echo $__env->make('partials.logout-dialog', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</nav><?php /**PATH /var/www/indonesia-luxe/resources/views/partials/navbar.blade.php ENDPATH**/ ?>