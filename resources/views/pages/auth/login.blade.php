<x-layouts::auth>
    <a class="absolute top-6 left-6 z-20 hidden md:flex items-center gap-2 text-white/90 hover:text-white bg-white/10 hover:bg-white/20 backdrop-blur-md px-4 py-2 rounded-full transition" href="/" data-discover="true">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left w-4 h-4">
            <path d="m12 19-7-7 7-7"></path>
            <path d="M19 12H5"></path>
        </svg>
        {{ __('auth.back_to_home') }}
    </a>
    <div class="relative z-10 bg-white/20 backdrop-blur-xl rounded-3xl shadow-2xl max-w-md w-full p-8 border border-white/30">
        <a class="absolute top-3 left-3 z-20 flex md:hidden items-center gap-2 text-white/90 hover:text-white text-sm bg-white/10 hover:bg-white/20 backdrop-blur-md px-4 py-2 rounded-full transition" href="/" data-discover="true">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left w-4 h-4">
                <path d="m12 19-7-7 7-7"></path>
                <path d="M19 12H5"></path>
            </svg>
            {{ __('auth.back_to_home') }}
        </a>
        <div class="text-center mb-8"><img src="{{ asset('images/logo.png') }}" alt="Indonesia Luxe" class="h-20 mx-auto mb-4">
            <h1 class="text-2xl text-white mb-1">{{ __('auth.welcome') }}</h1>
            <p class="text-white/70 text-sm">{{ __('auth.desc') }}</p>
        </div>
        <form method="POST" action="{{ route('login.store') }}" class="space-y-4" x-data="{ showPassword: false, loading: false }" @submit="loading = true">
            @csrf

            <!-- General Error Message -->
            @if ($errors->any())
            <div class="bg-red-500/20 border border-red-500/50 text-red-200 p-3 rounded-xl text-sm mb-4">
                @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif

            <div>
                <label class="text-sm text-white/80 block mb-1">{{ __('auth.email') }}</label>
                <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-white/50">
                        <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                    </svg>
                    <input required type="email" name="email" value="{{ old('email') }}" autofocus placeholder="email@example.com" class="w-full bg-white/15 border rounded-xl pl-10 pr-4 py-3 outline-none focus:ring-2 focus:ring-amber-400 text-white placeholder-white/40 @error('email') border-red-500 @else border-white/30 @enderror">
                </div>
                @error('email')
                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <div class="flex items-center justify-between mb-1">
                    <label class="text-sm text-white/80">{{ __('auth.password') }}</label>
                </div>
                <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lock absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-white/50">
                        <rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    <input required :type="showPassword ? 'text' : 'password'" name="password" placeholder="Masukkan password" class="w-full bg-white/15 border rounded-xl pl-10 pr-12 py-3 outline-none focus:ring-2 focus:ring-amber-400 text-white placeholder-white/40 @error('password') border-red-500 @else border-white/30 @enderror">
                    <button type="button" @click="showPassword = !showPassword" class="absolute right-3 top-1/2 -translate-y-1/2 text-white/50 hover:text-white/80 transition-colors">
                        <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye w-5 h-5">
                            <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                        <svg x-show="showPassword" x-cloak xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-off w-5 h-5">
                            <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
                            <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"></path>
                            <path d="M6.61 6.61A13.52 13.52 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"></path>
                            <line x1="2" x2="22" y1="2" y2="22"></line>
                        </svg>
                    </button>
                </div>
                @error('password')
                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
                <div class="flex items-center justify-end mt-1.5">
                    <a href="{{ route('password.request') }}" class="text-xs text-amber-300 hover:text-amber-200 transition">{{ __('auth.forgot_password') }}</a>
                </div>
            </div>

            <button type="submit" :disabled="loading" class="w-full bg-amber-500 hover:bg-amber-600 disabled:bg-amber-500/50 disabled:cursor-not-allowed text-white py-3 rounded-xl flex items-center justify-center gap-2 transition border border-amber-400 mt-6 min-h-[50px]">
                <template x-if="!loading">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-in w-5 h-5">
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                            <polyline points="10 17 15 12 10 7"></polyline>
                            <line x1="15" x2="3" y1="12" y2="12"></line>
                        </svg>
                        <span>{{ __('auth.login') }}</span>
                    </div>
                </template>
                <template x-if="loading">
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </template>
            </button>
        </form>
        <div class="mt-6 text-center">
            <p class="text-white/70 text-sm">{{ __('auth.no_account') }} <a class="text-amber-400 hover:text-amber-300" href="/register" data-discover="true">{{ __('auth.register_now') }}</a></p>
        </div>
    </div>
</x-layouts::auth>