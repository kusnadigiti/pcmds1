<x-app-layout>
    <x-slot name="header">Manajemen Akun</x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <x-data-table :columns="$columns" :rows="$rows" :addUrl="route('admin.manage-user.create')" editUrl="/admin/manage-user/{id}/edit"
            deleteUrl="/admin/manage-user/{id}" rowKey="id" />
    </div>
</x-app-layout>
