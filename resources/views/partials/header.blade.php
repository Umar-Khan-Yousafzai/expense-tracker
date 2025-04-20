<x-header :title="$title" separator progress-indicator>

    <x-slot:middle class="!justify-end">
        <x-input placeholder="Search..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
    </x-slot:middle>
    <x-slot:actions>
        <x-theme-toggle />
        {{-- <x-button label="Filters" @click="$wire.drawer = true" responsive icon="o-funnel" class="btn-primary" /> --}}
    </x-slot:actions>
</x-header>
