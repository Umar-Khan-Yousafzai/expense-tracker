<x-drawer wire:model="drawer" title="Filters" right separator with-close-button class="lg:w-1/3">

    <x-input placeholder="Search..." wire:model.live.debounce="search" icon="o-magnifying-glass" @keydown.enter="$wire.drawer = false" />

    <x-slot:actions>
        <x-button label="Reset" icon="o-x-mark" wire:click="clear" spinner />
        <x-button label="Done" icon="o-check" class="btn-primary" @click="$wire.drawer = false" />
    </x-slot:actions>
</x-drawer>
