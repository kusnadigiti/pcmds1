<x-app-layout>
    <x-slot name="header">Kelola Artikel</x-slot>

    @php
        $prefix = auth()->user()->role === 'penulis' ? '/penulis' : '/admin';
    @endphp
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <x-data-table :columns="$columns" :rows="$rows" title="Kelola Artikel" :per-page="10"
            add-url="{{ $prefix . '/articles/create' }}" edit-url="{{ $prefix . '/articles/{id}/edit' }}"
            delete-url="{{ $prefix . '/articles/{id}' }}" />
    </div>
</x-app-layout>
