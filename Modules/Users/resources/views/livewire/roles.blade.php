<?php

use Livewire\Volt\Component;
use Mary\Traits\Toast;

new class extends Component {
    use Toast;

    public bool $myModal1 = false;


    public function mount()
{
    dd('Livewire component mounted successfully');
}

    public function save()
    {
        // Simulate some processing time
        sleep(1);

        // Your stuff here ...
        dd(1);

        // Toast
        $this->success('We are done, check it out');
    }

    public function save2()
    {
        // Simulate some processing time
        sleep(1);

        // Your stuff here ...

        // Toast
        $this->error('It will last just 1 second ...', timeout: 1000, position: 'toast-bottom toast-start');
    }

    public function save3()
    {
        // Simulate some processing time
        sleep(1);

        // Your stuff here ...

        // Toast
        $this->warning('It is working with redirect', 'You were redirected to another url ...', redirectTo: '/docs/components/form');
    }

    public function save4()
    {
        // Simulate some processing time
        sleep(1);

        // Your stuff here ...

        // Toast
        $this->warning('Wishlist <u>updated</u>', 'You will <strong>love it :)</strong>', position: 'bottom-end', icon: 'o-heart', css: 'bg-pink-500 text-base-100');
    }
}; ?>

<section class="w-full">

    <x-mary-button label="Theme" icon="o-swatch" @click="$dispatch('mary-toggle-theme')" />
    <x-mary-button label="Like" wire:click="save4" icon="o-heart" spinner />
    <x-mary-theme-toggle darkTheme="aqua" lightTheme="retro" />


    <div class="flex flex-wrap gap-4 mb-6">
            <x-mary-button label="Primary Save" class="btn-primary" wire:click="save" spinner="save" />
            <x-mary-button label="Success Save" class="btn-success" wire:click="save" spinner="save" />
            <x-mary-button label="Quick Error" class="btn-error" wire:click="save2" spinner="save2" />
            <x-mary-button label="Save and redirect" class="btn-warning" wire:click="save3" spinner="save3" />
            <x-mary-button label="Like" wire:click="save4" icon="o-heart" spinner="save4" />
        </div>

        <div class="flex gap-4 mb-6">
            <x-mary-button label="Theme Toggle" icon="o-swatch" @click="$dispatch('mary-toggle-theme')" />
            <x-mary-theme-toggle darkTheme="aqua" lightTheme="retro" />
        </div>

        {{-- <x-button label="Open Modal" @click="$wire.myModal1 = true" class="btn-outline" />

        <x-modal wire:model="myModal1" title="Hey" class="backdrop-blur">
            <div class="py-4">
                Press `ESC`, click outside or click `CANCEL` to close.
            </div>

            <x-slot:actions>
                <x-button label="Cancel" @click="$wire.myModal1 = false" />
            </x-slot:actions>
        </x-modal> --}}
</section>
