<x-layouts.site :title="'Vendor Registration'">
    <h1 class="text-2xl font-semibold mb-4">Registrasi Vendor</h1>

    <form method="POST" action="{{ route('vendor.register.store') }}" class="rounded border bg-white p-4 grid gap-3">
        @csrf
        <input name="name" value="{{ old('name') }}" placeholder="Nama PIC" class="rounded border px-3 py-2 text-sm" required />
        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="rounded border px-3 py-2 text-sm" required />
        <input type="password" name="password" placeholder="Password" class="rounded border px-3 py-2 text-sm" required />
        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" class="rounded border px-3 py-2 text-sm" required />
        <input name="business_name" value="{{ old('business_name') }}" placeholder="Nama Bisnis" class="rounded border px-3 py-2 text-sm" required />
        <textarea name="business_description" rows="3" placeholder="Deskripsi bisnis" class="rounded border px-3 py-2 text-sm">{{ old('business_description') }}</textarea>
        <input name="phone" value="{{ old('phone') }}" placeholder="No HP" class="rounded border px-3 py-2 text-sm" />
        <input name="address" value="{{ old('address') }}" placeholder="Alamat" class="rounded border px-3 py-2 text-sm" />
        <input name="bank_name" value="{{ old('bank_name') }}" placeholder="Nama Bank" class="rounded border px-3 py-2 text-sm" />
        <input name="bank_account_name" value="{{ old('bank_account_name') }}" placeholder="Nama Rekening" class="rounded border px-3 py-2 text-sm" />
        <input name="bank_account_number" value="{{ old('bank_account_number') }}" placeholder="Nomor Rekening" class="rounded border px-3 py-2 text-sm" />
        <button class="rounded bg-black px-4 py-2 text-sm text-white">Daftar Vendor</button>
    </form>
</x-layouts.site>
