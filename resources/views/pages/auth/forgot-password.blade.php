<x-layouts::auth>
    <a class="absolute top-6 left-6 z-20 flex items-center gap-2 text-white/90 hover:text-white bg-white/10 hover:bg-white/20 backdrop-blur-md px-4 py-2 rounded-full transition" href="/" data-discover="true">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left w-4 h-4">
            <path d="m12 19-7-7 7-7"></path>
            <path d="M19 12H5"></path>
        </svg>
        Kembali ke Beranda
    </a>
    <div class="relative z-10 bg-white/20 backdrop-blur-xl rounded-3xl shadow-2xl max-w-md w-full p-8 border border-white/30">
        <div class="text-center mb-8">
            <img src="{{ asset('images/logo.png') }}" alt="Indonesia Luxe" class="h-20 mx-auto mb-4">
            <h1 class="text-2xl text-white mb-1">Reset Password</h1>
            <p class="text-white/70 text-sm">Masukkan email akunmu, kami akan kirim link reset password.</p>
        </div>

        @if (session('status'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-500/20 border border-emerald-500/30 text-emerald-200 text-sm flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle w-5 h-5 shrink-0">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="text-sm text-white/80 block mb-1">Email</label>
                <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-white/50">
                        <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                    </svg>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="email@example.com" class="w-full bg-white/10 border @error('email') border-red-400 @else border-white/20 @enderror rounded-xl pl-10 pr-4 py-3 outline-none focus:ring-2 focus:ring-amber-400 text-white placeholder-white/40 transition-all duration-200">
                </div>
                @error('email')
                <p class="mt-1.5 text-xs text-red-300">{{ $message }}</p>
                @enderror
            </div>
            
            <button type="submit" class="w-full bg-linear-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white py-3 rounded-xl flex items-center justify-center gap-2 transition-all shadow-lg active:scale-[0.98] font-medium border border-amber-400/30">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-send w-4 h-4">
                    <path d="M14.536 21.686a.5.5 0 0 0 .937-.024l6.5-19a.496.496 0 0 0-.635-.635l-19 6.5a.5.5 0 0 0-.024.937l7.93 3.18a2 2 0 0 1 1.112 1.11z"></path>
                    <path d="m21.854 2.147-10.94 10.939"></path>
                </svg> Kirim Link Reset
            </button>
        </form>
        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" class="text-sm text-white/60 hover:text-white flex items-center justify-center gap-1.5 mx-auto transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left w-4 h-4">
                    <path d="m12 19-7-7 7-7"></path>
                    <path d="M19 12H5"></path>
                </svg> Kembali ke Login
            </a>
        </div>
    </div>
</x-layouts::auth>