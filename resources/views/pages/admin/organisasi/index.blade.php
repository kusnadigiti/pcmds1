<x-app-layout>
    <x-slot name="header">Organisasi Otonom</x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <x-data-table :columns="$columns" :rows="$rows" :addUrl="route('admin.organisasi-otonom.create')" editUrl="/admin/organisasi-otonom/{id}/edit"
            deleteUrl="/admin/organisasi-otonom/{id}" />
    </div>
</x-app-layout>
