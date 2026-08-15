{{--
Section Title — Reusable section heading with optional subtitle.

Props:
  - $title: string — section title
  - $subtitle: string|null — optional subtitle
  - $align: 'left' | 'center' — text alignment
--}}
@props([
    'title',
    'subtitle' => null,
    'align' => 'left',
])

<div class="mb-6 {{ $align === 'center' ? 'text-center' : '' }}">
    <h2 class="text-2xl md:text-[28px] font-serif text-[#1e293b] font-medium mb-1.5">{{ $title }}</h2>
    @if($subtitle)
        <p class="text-slate-500 text-sm md:text-[15px] font-light">{{ $subtitle }}</p>
    @endif
    {{ $slot }}
</div>
