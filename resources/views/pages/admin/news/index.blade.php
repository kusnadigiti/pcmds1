<x-app-layout>
    <x-slot name="header">Kelola Berita</x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">

        @php
            $prefix = auth()->user()->role === 'penulis' ? '/penulis' : '/admin';
        @endphp

        <x-data-table :columns="$columns" :rows="$rows" title="Kelola Berita" :per-page="10"
            add-url="{{ $prefix . '/berita/create' }}" edit-url="{{ $prefix . '/berita/{id}/edit' }}"
            delete-url="{{ $prefix . '/berita/{id}' }}" />
    </div>
</x-app-layout>
