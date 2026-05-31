<x-app-layout>
    <x-slot name="header">Profile Organisasi</x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <x-data-table :columns="$columns" :rows="$rows" :addUrl="route('admin.profile-organisasi.create')" editUrl="/admin/profile-organisasi/{id}/edit"
            deleteUrl="/admin/profile-organisasi/{id}" />
    </div>
</x-app-layout>
