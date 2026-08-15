<x-layouts.site :title="__('Wishlist')" :fullWidth="true" :session="false">
  <div class="sticky top-16 z-30 bg-white border-b border-gray-100">
    <div class="max-w-2xl mx-auto px-4">
      <div class="flex items-center h-14 gap-3">
        <a href="{{ route('profile.index') }}" class="p-2 -ml-2 hover:bg-gray-50 rounded-full transition">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left w-5 h-5 text-gray-700">
            <path d="m15 18-6-6 6-6"></path>
          </svg>
        </a>
        <h1 class="flex-1 text-gray-900 text-base">Wishlist</h1>
        <span class="text-sm text-gray-400">{{ $wishlist->count() }} paket</span>
      </div>
    </div>
  </div>

  <div class="max-w-2xl mx-auto px-4 py-5" wire:loading.class="opacity-50">
    <div class="flex flex-col gap-3">
      @forelse($wishlist as $tour)
      <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex" wire:key="wishlist-item-{{ $tour->id }}">
        <a class="w-28 h-28 shrink-0 block" href="{{ route('tours.show', $tour) }}">
          <img src="{{ $tour->coverImageUrl() }}" alt="{{ $tour->title }}" class="w-full h-full object-cover">
        </a>
        <div class="flex-1 p-3 min-w-0">
          <div class="flex items-start justify-between gap-2">
            <a class="flex-1 min-w-0" href="{{ route('tours.show', $tour) }}">
              <span class="text-[10px] bg-amber-100 text-amber-700 px-2 py-0.5 rounded-full">{{ $tour->category->name }}</span>
              <p class="text-sm text-gray-900 mt-1 line-clamp-2 leading-snug">{{ $tour->title }}</p>
            </a>
            <form action="{{ route('profile.wishlist.destroy', $tour->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <button
                type="submit"
                class="shrink-0 p-1.5 hover:bg-red-50 rounded-full transition text-red-400 hover:text-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2 w-4 h-4">
                  <path d="M3 6h18"></path>
                  <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                  <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                  <line x1="10" x2="10" y1="11" y2="17"></line>
                  <line x1="14" x2="14" y1="11" y2="17"></line>
                </svg>
              </button>
            </form>
          </div>
          <div class="flex items-center gap-1 mt-1 text-amber-400">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star w-3 h-3 fill-amber-400">
              <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path>
            </svg>
            <span class="text-xs text-gray-600">{{ number_format($tour->reviews_avg_rating ?? 0, 1) }} ({{ $tour->reviews_count }})</span>
          </div>
          <div class="flex items-center gap-1 mt-0.5 text-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin w-3 h-3">
              <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path>
              <circle cx="12" cy="10" r="3"></circle>
            </svg>
            <span class="text-xs truncate">{{ $tour->meeting_point }}</span>
          </div>
          <p class="text-amber-600 font-bold text-sm mt-1">Rp {{ number_format($tour->price_per_person, 0, ',', '.') }}</p>
        </div>
      </div>
      @empty
      <div class="flex flex-col items-center justify-center py-20 gap-5">
        <div class="w-24 h-24 bg-red-50 rounded-full flex items-center justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart-off w-12 h-12 text-red-300">
            <line x1="2" y1="2" x2="22" y2="22"></line>
            <path d="M16.5 16.5 12 21l-7-7c-1.5-1.45-3-3.2-3-5.5a5.5 5.5 0 0 1 2.14-4.35"></path>
            <path d="M8.76 3.1c1.15.22 2.13.78 3.24 1.9 1.5-1.5 2.74-2 4.5-2A5.5 5.5 0 0 1 22 8.5c0 2.12-1.3 3.78-2.67 5.17"></path>
          </svg>
        </div>
        <div class="text-center">
          <p class="text-gray-900 mb-1">Wishlist masih kosong</p>
          <p class="text-sm text-gray-500">Simpan paket wisata favoritmu di sini</p>
        </div>
        <a href="{{ route('tours.index') }}" data-discover="true" class="flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white px-6 py-2.5 rounded-full text-sm transition">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search w-4 h-4">
            <circle cx="11" cy="11" r="8"></circle>
            <path d="m21 21-4.3-4.3"></path>
          </svg>
          Jelajahi Paket
        </a>
      </div>
      @endforelse
    </div>
  </div>
</x-layouts.site>