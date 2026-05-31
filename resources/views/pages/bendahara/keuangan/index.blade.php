<x-app-layout>
    <x-slot name="header">Keuangan</x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <x-data-table :columns="$columns" :rows="$rows" :addUrl="route('bendahara.keuangan.create')" editUrl="/bendahara/keuangan/{id}/edit"
            deleteUrl="/bendahara/keuangan/{id}" />
    </div>
</x-app-layout>
