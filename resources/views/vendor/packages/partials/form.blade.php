<form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="rounded border bg-white p-4 grid gap-3">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <select name="tour_category_id" class="rounded border px-3 py-2 text-sm" required>
        <option value="">Pilih kategori</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(old('tour_category_id', $tourPackage?->tour_category_id) == $category->id)>{{ $category->name }}</option>
        @endforeach
    </select>

    <select name="type" class="rounded border px-3 py-2 text-sm" required>
        @foreach ($packageTypes as $packageType)
            <option value="{{ $packageType->value }}" @selected(old('type', $tourPackage?->type?->value) === $packageType->value)>{{ $packageType->value }}</option>
        @endforeach
    </select>

    <input name="title" value="{{ old('title', $tourPackage?->title) }}" placeholder="Judul" class="rounded border px-3 py-2 text-sm" required />
    <textarea name="description" rows="4" placeholder="Deskripsi" class="rounded border px-3 py-2 text-sm" required>{{ old('description', $tourPackage?->description) }}</textarea>
    <input name="meeting_point" value="{{ old('meeting_point', $tourPackage?->meeting_point) }}" placeholder="Meeting point" class="rounded border px-3 py-2 text-sm" />
    <input type="number" name="duration_hours" min="1" value="{{ old('duration_hours', $tourPackage?->duration_hours) }}" placeholder="Durasi (jam)" class="rounded border px-3 py-2 text-sm" />
    <input type="number" name="max_participants" min="1" value="{{ old('max_participants', $tourPackage?->max_participants) }}" placeholder="Max peserta" class="rounded border px-3 py-2 text-sm" />
    <input type="number" name="price_per_person" min="0" value="{{ old('price_per_person', $tourPackage?->price_per_person) }}" placeholder="Harga per orang" class="rounded border px-3 py-2 text-sm" required />
    <input type="file" name="cover_image" class="rounded border px-3 py-2 text-sm" />

    <button class="rounded bg-black px-4 py-2 text-sm text-white">Simpan</button>
</form>
