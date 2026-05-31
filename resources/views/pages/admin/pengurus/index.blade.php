<x-app-layout>
    <x-slot name="header">Kelola Pengurus</x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <x-data-table :columns="$columns" :rows="$rows" :addUrl="route('admin.pengurus.create')" editUrl="/admin/pengurus/{id}/edit"
            deleteUrl="/admin/pengurus/{id}" />
    </div>
</x-app-layout>
