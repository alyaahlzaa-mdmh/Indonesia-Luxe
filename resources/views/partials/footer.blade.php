<footer class="bg-gray-900 text-white">
  <div class="max-w-7xl mx-auto px-4 py-12">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div>
        <div class="flex items-center gap-3 mb-4"><img src="{{ asset('/images/logo.png') }}" alt="Indonesia Luxe" class="h-16 w-auto brightness-200 font-serif"><span class="text-amber-400 font-serif text-lg tracking-[0.15em]">INDONESIA LUXE</span></div>
        <p class="text-gray-400 text-sm">{{ __('footer.description') }}</p>
      </div>
      <div>
        <h3 class="text-amber-400 mb-4">{{ __('footer.information') }}</h3>
        <div class="space-y-2"><a class="block text-gray-400 hover:text-amber-400 text-sm transition" href="/search" data-discover="true">{{ __('footer.search_tour') }}</a><a class="block text-gray-400 hover:text-amber-400 text-sm transition" href="/login" data-discover="true">{{ __('footer.login') }}</a><a class="block text-gray-400 hover:text-amber-400 text-sm transition" href="/register" data-discover="true">{{ __('footer.register_vendor') }}</a><a class="block text-gray-400 hover:text-amber-400 text-sm transition" href="#visa-information" data-discover="true">{{ __('footer.visa_info') }}</a></div>
      </div>
      <div>
        <h3 class="text-amber-400 mb-4">{{ __('footer.contact_us') }}</h3>
        <div class="space-y-3">
          <a href="{{ getWhatsappMeUrl() }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-gray-400 hover:text-green-400 text-sm transition">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle w-4 h-4">
              <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"></path>
            </svg> (+62) 81122823000
          </a>
          <a href="mailto:Hello@indonesialuxetavel.com" class="flex items-center gap-2 text-gray-400 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail w-4 h-4">
              <rect width="20" height="16" x="2" y="4" rx="2"></rect>
              <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
            </svg> Hello@indonesialuxetavel.com
          </a>
          <div class="flex items-center gap-2 text-gray-400 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin w-4 h-4">
              <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path>
              <circle cx="12" cy="10" r="3"></circle>
            </svg> Jakarta, Indonesia
          </div>
        </div>
        <div class="flex gap-3 mt-4">
          <a href="#" class="text-gray-400 hover:text-amber-400 transition">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram w-5 h-5">
              <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
              <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
              <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
            </svg>
          </a>
          <a href="#" class="text-gray-400 hover:text-amber-400 transition">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook w-5 h-5">
              <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
            </svg>
          </a>
          <a href="{{ getWhatsappMeUrl() }}" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-green-400 transition">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle w-5 h-5">
              <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"></path>
            </svg>
          </a>
        </div>
      </div>
    </div>
    <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-500 text-sm">© 2026 Indonesia Luxe Travel. All rights reserved.</div>
  </div>
</footer>
