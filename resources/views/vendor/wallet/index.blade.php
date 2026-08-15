<x-layouts.vendor :title="'Vendor Dashboard'">
  <div class="flex items-center justify-between mb-5 lg:hidden">
    <div>
      <p class="text-xs text-gray-400 uppercase tracking-wider">Vendor Dashboard</p>
      <h1 class="text-gray-900">{{ auth()->user()->name }}</h1>
    </div>
    <div class="flex items-center gap-1.5 bg-amber-50 border border-amber-200 text-amber-700 text-xs px-3 py-1.5 rounded-full"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big w-3 h-3">
        <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
        <path d="m9 11 3 3L22 4"></path>
      </svg> Vendor Verified</div>
  </div>
  <div class="hidden lg:flex items-center justify-between mb-6">
    <div>
      <h2 class="text-gray-800">Wallet</h2>
      <p class="text-xs text-gray-400 mt-0.5">Saldo Rp {{ number_format($wallet->balance, 0, ',', '.') }} · Earning &amp; penarikan dana</p>
    </div>
  </div>
  <div class="space-y-5">
    <!-- Success/Error Messages -->
    @if(session('success'))
      <div class="flex items-start gap-3 bg-green-50 border border-green-200 rounded-xl px-4 py-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle w-5 h-5 text-green-600 shrink-0 mt-0.5">
          <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
          <path d="m9 11 3 3L22 4"></path>
        </svg>
        <p class="text-sm text-green-700">{{ session('success') }}</p>
      </div>
    @endif

    @if($errors->any())
      <div class="flex items-start gap-3 bg-red-50 border border-red-200 rounded-xl px-4 py-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-alert-circle w-5 h-5 text-red-600 shrink-0 mt-0.5">
          <circle cx="12" cy="12" r="10"></circle>
          <line x1="12" x2="12" y1="8" y2="12"></line>
          <line x1="12" x2="12.01" y1="16" y2="16"></line>
        </svg>
        <div>
          @foreach($errors->all() as $error)
            <p class="text-sm text-red-700">{{ $error }}</p>
          @endforeach
        </div>
      </div>
    @endif

    <div class="flex items-start gap-3 bg-blue-50 border border-blue-200 rounded-xl px-4 py-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-up w-4 h-4 text-blue-500 shrink-0 mt-0.5">
        <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline>
        <polyline points="16 7 22 7 22 13"></polyline>
      </svg>
      <p class="text-xs text-blue-700">Setiap booking yang dikonfirmasi, Anda menerima 80% dari total transaksi. Platform Indonesia Luxe mengambil 20% sebagai biaya layanan.</p>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
      <div class="bg-linear-to-br from-[#b8860b] to-amber-600 rounded-2xl p-5 text-white col-span-1 sm:col-span-1">
        <div class="flex items-center justify-between mb-3">
          <div class="w-9 h-9 bg-white/20 rounded-xl flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wallet w-5 h-5">
              <path d="M19 7V4a1 1 0 0 0-1-1H5a2 2 0 0 0 0 4h15a1 1 0 0 1 1 1v4h-3a2 2 0 0 0 0 4h3a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1"></path>
              <path d="M3 5v14a2 2 0 0 0 2 2h15a1 1 0 0 0 1-1v-4"></path>
            </svg>
          </div>
          <button class="w-7 h-7 bg-white/10 rounded-lg flex items-center justify-center hover:bg-white/20 transition">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-refresh-cw w-3.5 h-3.5">
              <path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"></path>
              <path d="M21 3v5h-5"></path>
              <path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"></path>
              <path d="M8 16H3v5"></path>
            </svg>
          </button>
        </div>
        <p class="text-white/70 text-xs mb-0.5">Saldo Tersedia</p>
        <p class="text-2xl text-white">Rp&nbsp;{{ number_format($wallet->balance, 0, ',', '.') }}</p>
        <p class="text-white/60 text-[11px] mt-2">Bisa ditarik kapan saja</p>
      </div>
      <div class="bg-white border border-gray-200 rounded-2xl p-5">
        <div class="w-8 h-8 bg-emerald-50 rounded-xl flex items-center justify-center mb-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-arrow-down w-4 h-4 text-emerald-600">
            <circle cx="12" cy="12" r="10"></circle>
            <path d="M12 8v8"></path>
            <path d="m8 12 4 4 4-4"></path>
          </svg></div>
        <p class="text-xs text-gray-400 mb-0.5">Total Penghasilan</p>
        <p class="text-emerald-700">Rp&nbsp;{{ number_format($wallet->total_earned, 0, ',', '.') }}</p>
        <p class="text-[11px] text-gray-400 mt-1">{{ $earningsCount }} transaksi</p>
      </div>
      <div class="bg-white border border-gray-200 rounded-2xl p-5">
        <div class="w-8 h-8 bg-purple-50 rounded-xl flex items-center justify-center mb-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-arrow-up w-4 h-4 text-purple-500">
            <circle cx="12" cy="12" r="10"></circle>
            <path d="m16 12-4-4-4 4"></path>
            <path d="M12 16V8"></path>
          </svg></div>
        <p class="text-xs text-gray-400 mb-0.5">Total Ditarik</p>
        <p class="text-purple-700">Rp&nbsp;{{ number_format($wallet->total_withdrawn, 0, ',', '.') }}</p>
        <p class="text-[11px] text-gray-400 mt-1">{{ $withdrawalsCount }} kali penarikan</p>
      </div>
    </div>
    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
      <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
        <div>
          <h3 class="text-gray-900">Penarikan Dana</h3>
          <p class="text-xs text-gray-400 mt-0.5">Min. penarikan Rp 50.000 · Diproses 1-3 hari kerja</p>
        </div><button 
          {{ $wallet->balance < 50000 ? 'disabled' : '' }} 
          onclick="openWithdrawModal()" 
          class="flex items-center gap-2 bg-[#b8860b] hover:bg-[#9a7209] disabled:bg-gray-200 disabled:text-gray-400 text-white text-sm px-4 py-2 rounded-xl transition">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-banknote w-4 h-4">
            <rect width="20" height="12" x="2" y="6" rx="2"></rect>
            <circle cx="12" cy="12" r="2"></circle>
            <path d="M6 12h.01M18 12h.01"></path>
          </svg>Tarik Dana</button>
      </div>
    </div>
    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
      <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
        <h3 class="text-gray-900">Riwayat Transaksi</h3>
        <div class="flex gap-1">
          <a href="{{ route('vendor.wallet.index', ['filter' => 'all']) }}" 
             class="text-xs px-2.5 py-1 rounded-lg transition {{ $filter === 'all' ? 'bg-amber-100 text-amber-700' : 'text-gray-400 hover:text-gray-700' }}">
            Semua
          </a>
          <a href="{{ route('vendor.wallet.index', ['filter' => 'earning']) }}" 
             class="text-xs px-2.5 py-1 rounded-lg transition {{ $filter === 'earning' ? 'bg-emerald-100 text-emerald-700' : 'text-gray-400 hover:text-gray-700' }}">
            Masuk
          </a>
          <a href="{{ route('vendor.wallet.index', ['filter' => 'withdrawal']) }}" 
             class="text-xs px-2.5 py-1 rounded-lg transition {{ $filter === 'withdrawal' ? 'bg-red-100 text-red-700' : 'text-gray-400 hover:text-gray-700' }}">
            Keluar
          </a>
        </div>
      </div>
      
      @if($transactions->count() > 0)
        <div class="divide-y divide-gray-100">
          @foreach($transactions as $transaction)
            <div class="px-5 py-4 flex items-center justify-between">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center {{ $transaction->type->value === 'earning' ? 'bg-emerald-50' : 'bg-red-50' }}">
                  @if($transaction->type->value === 'earning')
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-down-right w-5 h-5 text-emerald-600">
                      <path d="m7 7 10 10"></path>
                      <path d="M17 7v10H7"></path>
                    </svg>
                  @else
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-right w-5 h-5 text-red-600">
                      <path d="m7 17 10-10"></path>
                      <path d="M7 7h10v10"></path>
                    </svg>
                  @endif
                </div>
                <div>
                  <p class="text-sm text-gray-900">
                    @if($transaction->type->value === 'earning')
                      Penghasilan dari booking
                      @if($transaction->booking?->tourPackage)
                        - {{ $transaction->booking->tourPackage->title }}
                      @endif
                    @else
                      Penarikan dana
                    @endif
                  </p>
                  <p class="text-xs text-gray-400">{{ $transaction->created_at->format('d M Y, H:i') }}</p>
                  @if($transaction->description)
                    <p class="text-xs text-gray-500 mt-1">{{ $transaction->description }}</p>
                  @endif
                </div>
              </div>
              <div class="text-right">
                <p class="text-sm font-medium {{ $transaction->type->value === 'earning' ? 'text-emerald-600' : 'text-red-600' }}">
                  {{ $transaction->type->value === 'earning' ? '+' : '-' }}Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                </p>
              </div>
            </div>
          @endforeach
        </div>
        
        @if($transactions->hasPages())
          <div class="px-5 py-4 border-t border-gray-100">
            {{ $transactions->links() }}
          </div>
        @endif
      @else
        <div class="py-16 text-center">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wallet w-8 h-8 text-gray-200 mx-auto mb-3">
            <path d="M19 7V4a1 1 0 0 0-1-1H5a2 2 0 0 0 0 4h15a1 1 0 0 1 1 1v4h-3a2 2 0 0 0 0 4h3a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1"></path>
            <path d="M3 5v14a2 2 0 0 0 2 2h15a1 1 0 0 0 1-1v-4"></path>
          </svg>
          <p class="text-sm text-gray-400">
            @if($filter === 'earning')
              Belum ada penghasilan
            @elseif($filter === 'withdrawal')
              Belum ada penarikan
            @else
              Belum ada transaksi
            @endif
          </p>
          <p class="text-xs text-gray-300 mt-1">Penghasilan akan muncul setelah admin mengkonfirmasi pembayaran</p>
        </div>
      @endif
    </div>
    <div class="bg-white border border-gray-200 rounded-2xl p-5">
      <h4 class="text-sm text-gray-700 mb-3">Ilustrasi Pembagian Margin</h4>
      <div class="space-y-2">
        <div>
          <div class="flex justify-between text-xs mb-1"><span class="text-gray-500">Pendapatan Anda (80%)</span><span class="text-emerald-600">Rp&nbsp;800.000/Rp 1jt</span></div>
          <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
            <div class="h-full bg-emerald-400 rounded-full" style="width: 80%;"></div>
          </div>
        </div>
        <div>
          <div class="flex justify-between text-xs mb-1"><span class="text-gray-500">Platform Fee (20%)</span><span class="text-[#b8860b]">Rp&nbsp;200.000/Rp 1jt</span></div>
          <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
            <div class="h-full bg-amber-400 rounded-full" style="width: 20%;"></div>
          </div>
        </div>
      </div>
      <p class="text-[11px] text-gray-400 mt-3">Margin dihitung otomatis saat admin mengkonfirmasi pembayaran dari traveler.</p>
    </div>
  </div>

  <!-- Withdrawal Modal -->
  <div id="withdrawModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full max-h-[90vh] overflow-y-auto">
      <form action="{{ route('vendor.wallet.withdraw') }}" method="POST" id="withdrawForm">
        @csrf
        
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
          <h3 class="text-lg font-semibold text-gray-900">Penarikan Dana</h3>
          <button type="button" onclick="closeWithdrawModal()" class="text-gray-400 hover:text-gray-600 transition">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x w-5 h-5">
              <path d="M18 6 6 18"></path>
              <path d="m6 6 12 12"></path>
            </svg>
          </button>
        </div>

        <!-- Modal Body -->
        <div class="p-6 space-y-4">
          <!-- Available Balance Info -->
          <div class="bg-amber-50 border border-amber-200 rounded-xl p-4">
            <div class="flex items-center gap-2 mb-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info w-4 h-4 text-amber-600">
                <circle cx="12" cy="12" r="10"></circle>
                <path d="M12 16v-4"></path>
                <path d="M12 8h.01"></path>
              </svg>
              <span class="text-sm font-medium text-amber-800">Saldo Tersedia</span>
            </div>
            <p class="text-2xl font-bold text-amber-900">Rp {{ number_format($wallet->balance, 0, ',', '.') }}</p>
            <p class="text-xs text-amber-700 mt-1">Minimum penarikan Rp 50.000</p>
          </div>

          <!-- Amount Input -->
          <div>
            <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Jumlah Penarikan</label>
            <div class="relative">
              <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">Rp</span>
              <input 
                type="number" 
                id="amount" 
                name="amount" 
                min="50000" 
                max="{{ $wallet->balance }}"
                step="1000"
                class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition"
                placeholder="50.000"
                required>
            </div>
            @error('amount')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Bank Details -->
          <div class="space-y-4">
            <h4 class="text-sm font-medium text-gray-700">Informasi Rekening</h4>
            
            <!-- Bank Name -->
            <div>
              <label for="bank_name" class="block text-sm text-gray-600 mb-1">Nama Bank</label>
              <select 
                id="bank_name" 
                name="bank_name" 
                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition"
                required>
                <option value="">Pilih Bank</option>
                <option value="Bank Central Asia (BCA)">Bank Central Asia (BCA)</option>
                <option value="Bank Mandiri">Bank Mandiri</option>
                <option value="Bank Negara Indonesia (BNI)">Bank Negara Indonesia (BNI)</option>
                <option value="Bank Rakyat Indonesia (BRI)">Bank Rakyat Indonesia (BRI)</option>
                <option value="Bank CIMB Niaga">Bank CIMB Niaga</option>
                <option value="Bank Danamon">Bank Danamon</option>
                <option value="Bank Permata">Bank Permata</option>
                <option value="Bank OCBC NISP">Bank OCBC NISP</option>
                <option value="Bank Maybank">Bank Maybank</option>
                <option value="Bank Panin">Bank Panin</option>
              </select>
              @error('bank_name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>

            <!-- Account Name -->
            <div>
              <label for="bank_account_name" class="block text-sm text-gray-600 mb-1">Nama Pemilik Rekening</label>
              <input 
                type="text" 
                id="bank_account_name" 
                name="bank_account_name" 
                value="{{ $user->vendorProfile->bank_account_name ?? $user->name }}"
                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition"
                placeholder="Nama sesuai rekening bank"
                required>
              @error('bank_account_name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>

            <!-- Account Number -->
            <div>
              <label for="bank_account_number" class="block text-sm text-gray-600 mb-1">Nomor Rekening</label>
              <input 
                type="text" 
                id="bank_account_number" 
                name="bank_account_number" 
                value="{{ $user->vendorProfile->bank_account_number ?? '' }}"
                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition"
                placeholder="1234567890"
                required>
              @error('bank_account_number')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <!-- Notes -->
          <div>
            <label for="notes" class="block text-sm text-gray-600 mb-1">Catatan (Opsional)</label>
            <textarea 
              id="notes" 
              name="notes" 
              rows="3"
              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition resize-none"
              placeholder="Tambahkan catatan jika diperlukan..."></textarea>
            @error('notes')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Warning -->
          <div class="bg-red-50 border border-red-200 rounded-xl p-4">
            <div class="flex items-start gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-alert-triangle w-4 h-4 text-red-600 mt-0.5 shrink-0">
                <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"></path>
                <path d="M12 9v4"></path>
                <path d="M12 17h.01"></path>
              </svg>
              <div>
                <p class="text-sm font-medium text-red-800">Perhatian</p>
                <p class="text-xs text-red-700 mt-1">Pastikan informasi rekening sudah benar. Dana yang sudah ditransfer tidak dapat dibatalkan.</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal Footer -->
        <div class="flex items-center justify-end gap-3 p-6 border-t border-gray-100">
          <button 
            type="button" 
            onclick="closeWithdrawModal()"
            class="px-4 py-2 text-gray-600 hover:text-gray-800 transition">
            Batal
          </button>
          <button 
            type="submit"
            class="flex items-center gap-2 bg-[#b8860b] hover:bg-[#9a7209] text-white px-6 py-2 rounded-xl transition">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-send w-4 h-4">
              <path d="M14.536 21.686a.5.5 0 0 0 .937-.024l6.5-19a.496.496 0 0 0-.635-.635l-19 6.5a.5.5 0 0 0-.024.937l7.93 3.18a2 2 0 0 1 1.112 1.11z"></path>
              <path d="m21.854 2.147-10.94 10.939"></path>
            </svg>
            Ajukan Penarikan
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function openWithdrawModal() {
      document.getElementById('withdrawModal').classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    }

    function closeWithdrawModal() {
      document.getElementById('withdrawModal').classList.add('hidden');
      document.body.style.overflow = 'auto';
    }

    // Close modal when clicking outside
    document.getElementById('withdrawModal').addEventListener('click', function(e) {
      if (e.target === this) {
        closeWithdrawModal();
      }
    });

    // Format number input
    document.getElementById('amount').addEventListener('input', function(e) {
      let value = e.target.value.replace(/\D/g, '');
      if (value) {
        e.target.value = parseInt(value);
      }
    });

    // Auto-fill bank details if vendor profile exists
    @if($user->vendorProfile && $user->vendorProfile->bank_name)
      document.getElementById('bank_name').value = "{{ $user->vendorProfile->bank_name }}";
    @endif
  </script>
</x-layouts.vendor>