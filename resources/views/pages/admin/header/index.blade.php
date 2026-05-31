<x-app-layout>
    <x-slot name="header">Kelola Banner Utama</x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <x-data-table :columns="$columns" :rows="$rows" :addUrl="route('admin.banner.create')" editUrl="/admin/banner/{id}/edit"
            deleteUrl="/admin/banner/{id}" rowKey="id" />
    </div>
</x-app-layout>
