@props(['title' => null, 'fullWidth' => false, 'session' => true, 'clean' => false])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head', ['title' => $title ?? config('app.name')])
    @include('partials.guest-styles')
</head>

<body class="bg-gray-50 text-gray-900 min-h-screen" x-data="{showLogout: false }">
    @if (!$clean)
    @include('partials.navbar')
    @endif

    @if ($session && session('status'))
    <div class="max-w-7xl mx-auto mt-4 px-4">
        <div class="rounded-xl border border-green-300 bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('status') }}</div>
    </div>
    @endif

    @if ($session && $errors->any())
    <div class="max-w-7xl mx-auto mt-4 px-4">
        <div class="rounded-xl border border-red-300 bg-red-50 px-4 py-3 text-sm text-red-700">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <main class="{{ $fullWidth ? 'w-full' : 'max-w-7xl mx-auto px-4 py-8' }} min-h-screen">
        {{ $slot }}
    </main>
    @if (!$clean)
    @include('partials.footer')
    @endif
    @livewireScripts
    <x-guest.toast />
</body>

</html>