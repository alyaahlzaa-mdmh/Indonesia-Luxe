@props(['title' => null, 'session' => true])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">

<head>
  @include('partials.head', ['title' => $title ?? config('app.name')])
</head>

<body class="bg-gray-50 text-gray-900 min-h-screen" x-data="{ showVendorSidebar: false, showLogout: false }">
  @include('partials.navbar')

  <main class="flex-1">
    <div class="min-h-screen bg-gray-50">
      @include('vendor.partials.sidebar-mobile')
      @include('vendor.partials.sidebar')
      <div class="lg:ml-56">
        <div class="max-w-5xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">
          @if ($session && session('status'))
          <div class="rounded border border-green-300 bg-green-50 px-4 mb-4 py-3 text-sm text-green-700">{{ session('status') }}</div>
          @endif

          @if ($session && $errors->any())
          <div class="rounded border border-red-300 bg-red-50 px-4 mb-4 py-3 text-sm text-red-700">
            <ul class="list-disc list-inside">
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
          {{ $slot }}
        </div>
        <!-- @include('partials.footer') -->
      </div>
    </div>
  </main>
  @livewireScripts
</body>

</html>