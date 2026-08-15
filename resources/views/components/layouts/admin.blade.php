<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head', ['title' => $title ?? 'Admin Indonesia Luxe'])
    @include('partials.guest-styles')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @php
        app('livewire')->forceAssetInjection();
    @endphp
</head>

<body class="bg-[#fcfaf8] text-gray-900 min-h-screen flex font-sans" x-data="{ sidebarOpen: false }">
    
    <!-- Mobile Sidebar Backdrop -->
    <div x-show="sidebarOpen" 
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black/50 z-20 lg:hidden"
         @click="sidebarOpen = false">
    </div>

    <!-- Sidebar -->
    <x-admin.sidebar />

    <!-- Main Content -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        <!-- Topbar -->
        <x-admin.topbar />
        
        <main class="flex-1 overflow-y-auto px-4 md:px-6 py-4 bg-gray-50/50">
            {{ $slot }}
        </main>
    </div>
    
    @livewireScripts
</body>

</html>
