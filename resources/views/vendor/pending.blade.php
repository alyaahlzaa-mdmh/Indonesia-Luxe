<x-layouts.site :title="'Indonesia Luxe'" :fullWidth="true" :clean="true">
    <div class="min-h-screen relative flex items-center justify-center p-4 overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url(&quot;https://images.unsplash.com/photo-1711660559927-c7fe61f31534?crop=entropy&amp;cs=tinysrgb&amp;fit=max&amp;fm=jpg&amp;ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxCYWxpJTIwdHJvcGljYWwlMjBsdXh1cnklMjB0cmF2ZWwlMjBJbmRvbmVzaWElMjBuYXR1cmV8ZW58MXx8fHwxNzcyMTgwMDQ2fDA&amp;ixlib=rb-4.1.0&amp;q=80&amp;w=1080&quot;);"></div>
        <div class="absolute inset-0 bg-linear-to-br from-black/70 via-black/50 to-[#b8860b]/30"></div>
        <div class="relative z-10 w-full max-w-lg">
            <div class="text-center mb-6">
                <img src="{{ asset('/images/logo.png') }}" alt="Indonesia Luxe" class="h-14 mx-auto mb-2 drop-shadow-xl">
            </div>
            <div class="bg-white/10 backdrop-blur-2xl rounded-3xl border border-white/20 shadow-2xl overflow-hidden">
                <div class="bg-linear-to-r from-amber-600/80 to-amber-400/80 px-8 py-5 flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-6 h-6 text-white">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-white text-lg">Menunggu Persetujuan</h1>
                        <p class="text-amber-100/80 text-xs mt-0.5">Akun vendor Anda sedang dalam proses verifikasi</p>
                    </div>
                </div>
                <div class="px-8 py-7 space-y-7">
                    <div class="text-center">
                        <p class="text-white/90 text-sm">Halo, <span class="text-amber-300">{{ auth()->user()->name }}</span>! 👋</p>
                        <p class="text-white/60 text-xs mt-1">{{ auth()->user()->email }}</p>
                    </div>
                    <div class="flex items-center">
                        <div class="flex items-center flex-1">
                            <div class="flex flex-col items-center gap-2 flex-none mx-auto">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center border-2 transition-all bg-amber-500 border-amber-400 shadow-lg shadow-amber-500/30">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big w-5 h-5 text-white">
                                        <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                                        <path d="m9 11 3 3L22 4"></path>
                                    </svg>
                                </div>
                                <span class="text-center text-[10px] leading-tight text-amber-300">Pendaftaran Selesai</span>
                            </div>
                            <div class="h-px flex-1 mb-5 bg-amber-400/60"></div>
                        </div>
                        <div class="flex items-center flex-1">
                            <div class="flex flex-col items-center gap-2 flex-none mx-auto">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center border-2 transition-all bg-white/10 border-amber-400/60 animate-pulse">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield w-5 h-5 text-amber-300">
                                        <path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path>
                                    </svg>
                                </div>
                                <span class="text-center text-[10px] leading-tight text-white/80">Verifikasi Admin</span>
                            </div>
                            <div class="h-px flex-1 mb-5 bg-white/15"></div>
                        </div>
                        <div class="flex items-center flex-1">
                            <div class="flex flex-col items-center gap-2 flex-none mx-auto">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center border-2 transition-all bg-white/5 border-white/20">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles w-5 h-5 text-white/30">
                                        <path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path>
                                        <path d="M20 3v4"></path>
                                        <path d="M22 5h-4"></path>
                                        <path d="M4 17v2"></path>
                                        <path d="M5 18H3"></path>
                                    </svg>
                                </div>
                                <span class="text-center text-[10px] leading-tight text-white/30">Akun Aktif</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white/8 rounded-2xl border border-white/15 p-4 space-y-2">
                        <div class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-refresh-cw w-4 h-4 text-amber-400 mt-0.5 shrink-0 animate-spin" style="animation-duration: 3s;">
                                <path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"></path>
                                <path d="M21 3v5h-5"></path>
                                <path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"></path>
                                <path d="M8 16H3v5"></path>
                            </svg>
                            <p class="text-white/80 text-xs leading-relaxed">Tim admin kami sedang memverifikasi akun vendor Anda. Proses ini biasanya membutuhkan <span class="text-amber-300">1x24 jam</span>. Anda akan mendapat notifikasi via email setelah disetujui.</p>
                        </div>
                        <div class="flex items-center gap-3 pt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail w-4 h-4 text-amber-400 shrink-0">
                                <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                            </svg>
                            <p class="text-white/60 text-xs">Notifikasi dikirim ke: <span class="text-white/90">{{ auth()->user()->email }}</span>
                            </p>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <p class="text-center text-white/60 text-xs">Ingin proses lebih cepat? Hubungi CS kami langsung</p>
                        <a href="{{ $waUrl }}" target="_blank" class="w-full flex items-center justify-center gap-3 bg-green-500 hover:bg-green-600 active:scale-95 text-white py-3.5 rounded-2xl transition-all shadow-lg shadow-green-500/30 group">
                            <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"></path>
                                <path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.122 1.532 5.852L.054 23.5a.5.5 0 0 0 .614.614l5.78-1.515A11.944 11.944 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.931a9.908 9.908 0 0 1-5.034-1.372l-.361-.214-3.733.979.995-3.636-.235-.374A9.904 9.904 0 0 1 2.069 12C2.069 6.509 6.509 2.069 12 2.069S21.931 6.509 21.931 12 17.491 21.931 12 21.931z"></path>
                            </svg>
                            <span class="text-sm">Chat CS — {{ getAdminWhatsapp() }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right w-4 h-4 opacity-70 group-hover:translate-x-1 transition-transform">
                                <path d="M5 12h14"></path>
                                <path d="m12 5 7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="text-center pt-1">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-white/40 hover:text-white/70 text-xs transition underline underline-offset-2">Keluar dari akun ini</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4 flex items-center justify-center gap-2 text-white/40 text-xs">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone w-3.5 h-3.5">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">

                    </path>
                </svg>CS tersedia Senin-Sabtu, 08.00-20.00 WIB
            </div>
        </div>
    </div>
</x-layouts.site>