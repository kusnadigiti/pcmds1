@props([
    'link',
    'image' => null,
    'title',
    'category' => null,
    'author' => null,
    'date' => null,
    'excerpt' => null,
    'aspect' => 'aspect-[600/360]',
    'imageClass' => 'w-full object-cover block hover:scale-[1.04] transition-transform duration-500',
    'badgeClass' => 'cm-cat-badge',
    'readMore' => false,
    'readMoreText' => 'Baca Selengkapnya',
])

<article {{ $attributes->merge(['class' => 'border border-[#eaeaea] cm-card-shadow flex flex-col bg-white overflow-hidden']) }}>
    @if($image)
        <a href="{{ $link }}" class="block overflow-hidden no-underline shrink-0">
            <img src="{{ $image }}"
                alt="{{ $title }}"
                class="{{ $aspect }} {{ $imageClass }}"
                loading="lazy"/>
        </a>
    @endif
    <div class="p-5 pt-3.5 flex flex-col flex-grow">
        @if($category)
            <div class="mb-1.5">
                <span class="{{ $badgeClass }}">{{ $category }}</span>
            </div>
        @endif
        <h3 class="cm-entry-title text-[16px] leading-snug font-semibold m-0">
            <a href="{{ $link }}">{{ $title }}</a>
        </h3>
        @if($author || $date)
            <div class="cm-meta flex flex-row gap-2 mt-1.5 items-center flex-wrap">
                @if($author)
                    <span class="flex gap-1 items-center"><i data-lucide="user" class="w-5 h-5"></i>{{ $author }}</span>
                @endif
                @if($date)
                    <span class="flex gap-1 items-center"><i data-lucide="calendar" class="w-5 h-5"></i>{{ $date }}</span>
                @endif
            </div>
        @endif
        @if($excerpt)
            <p class="text-[13.5px] text-[#444444] leading-relaxed mt-2 mb-0 line-clamp-3">{!! $excerpt !!}</p>
        @endif
        @if($readMore)
            <div class="mt-3 pt-2">
                <a href="{{ $link }}"
                    class="inline-flex items-center gap-1 text-[12px] font-bold uppercase tracking-wide text-[#2e9e5b] no-underline hover:text-[#268a4f] cm-transition">
                    {{ $readMoreText }} <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>
        @endif
    </div>
</article>
