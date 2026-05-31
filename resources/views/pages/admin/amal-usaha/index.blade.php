<x-app-layout>
    <x-slot name="header">Amal Usaha</x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <x-data-table :columns="$columns" :rows="$rows" :addUrl="route('admin.amal-usaha.create')" editUrl="/admin/amal-usaha/{id}/edit"
            deleteUrl="/admin/amal-usaha/{id}" />
    </div>
</x-app-layout>
