<div class="md:w-96 mx-auto mt-20">
    <x-card  class="p-10" >
        <div class="mb-10">
            <x-app-brand />
        </div>

        <x-form wire:submit="login">
            <x-input placeholder="E-mail" wire:model="email" icon="o-envelope" />
            <x-input placeholder="Password" wire:model="password" type="password" icon="o-key" />

            <x-slot:actions>
                <x-button label="Create an account" class="btn-ghost    " icon="o-user" link="/register" />
                <x-button label="Login" type="submit" icon="o-lock-closed" class="btn-primary" spinner="login" />
            </x-slot:actions>
        </x-form>
    </x-card>
</div>
