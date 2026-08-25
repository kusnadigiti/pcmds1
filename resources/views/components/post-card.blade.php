@props([
    'link',
    'image',
    'title',
    'category',
    'author' => 'Tim Redaksi',
    'date',
    'excerpt',
])

<article {{ $attributes->merge(['class' => 'border border-[#eaeaea] cm-card-shadow flex flex-col bg-white']) }}>
    <a href="{{ $link }}" class="block overflow-hidden no-underline">
        <img src="{{ $image }}"
            alt="{{ $title }}"
            class="w-full aspect-[600/360] object-cover block hover:scale-[1.04] transition-transform duration-500"
            loading="lazy"/>
    </a>
    <div class="p-5 pt-3.5 flex flex-col flex-grow">
        <div class="mb-1.5">
            <span class="cm-cat-badge">{{ $category }}</span>
        </div>
        <h3 class="cm-entry-title text-[16px] leading-snug font-semibold m-0">
            <a href="{{ $link }}">{{ $title }}</a>
        </h3>
        <div class="cm-meta flex flex-row gap-2 mt-1.5">
            <span class="flex gap-1 items-center"><i data-lucide="user" class="w-5 h-5"></i>{{ $author }}</span>
            <span class="flex gap-1 items-center"><i data-lucide="calendar" class="w-5 h-5"></i>{{ $date }}</span>
        </div>
        <p class="text-[13.5px] text-[#444444] leading-relaxed mt-2 mb-0 line-clamp-3">{!! $excerpt !!}</p>
    </div>
</article>
