<div x-show="showLogout" x-transition.opacity class="fixed inset-0 z-200 flex items-center justify-center bg-black/40 backdrop-blur-sm px-4">
  <div class="bg-white rounded-2xl shadow-xl p-6 w-full max-w-sm">
    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out w-6 h-6 text-red-500">
        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
        <polyline points="16 17 21 12 16 7"></polyline>
        <line x1="21" x2="9" y1="12" y2="12"></line>
      </svg>
    </div>
    <h3 class="text-center text-gray-900 mb-1">{{ __('logout_dialog.title') }}?</h3>
    <p class="text-center text-sm text-gray-500 mb-6">{{ __('logout_dialog.desc') }}</p>
    <div class="flex gap-3">
      <button type="button" @click="showLogout = false" class="flex-1 py-2.5 rounded-xl border border-gray-200 text-gray-700 hover:bg-gray-50 transition text-sm">{{ __('logout_dialog.cancel') }}</button>
      <form method="POST" action="{{ route('logout') }}" class="flex-1 w-full">
        @csrf
        <button type="submit" class="py-2.5 w-full rounded-xl bg-red-500 hover:bg-red-600 text-white transition text-sm">{{ __('logout_dialog.submit') }}</button>
      </form>
    </div>
  </div>
</div>