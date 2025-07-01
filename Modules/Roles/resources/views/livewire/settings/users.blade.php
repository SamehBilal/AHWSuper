<?php

use Livewire\Volt\Component;
use Mary\Traits\Toast;

new class extends Component {
    use Toast;

    public bool $myModal1 = false;

     /*   protected $listeners = ['show-toast' => 'savet'];

    public function savet($data)
    {
        $type = $data['type'] ?? 'info';
        $title = $data['title'] ?? 'Notification';
        $description = $data['description'] ?? '';
        $position = $data['position'] ?? 'toast-top toast-end';
        $timeout = $data['timeout'] ?? 5000;


         match($type) {
            'success' => $this->success($title, $description, position: $position, timeout: $timeout),
            'error' => $this->error($title, $description, position: $position, timeout: $timeout),
            'warning' => $this->warning($title, $description, position: $position, timeout: $timeout),
            'info' => $this->info($title, $description, position: $position, timeout: $timeout),
            default => $this->info($title, $description, position: $position, timeout: $timeout),
        };
        // Toast
        //$this->success('We are done, check it out', position: 'bottom-end');
    } */

    public function save()
    {
        // Simulate some processing time
        sleep(1);


        // Toast
        $this->success('We are done, check it out',position: 'bottom-end');
    }

    public function save2()
    {
        // Simulate some processing time
        sleep(1);

        // Your stuff here ...

        // Toast
        $this->error('It will last just 1 second ...', timeout: 1000, position: 'bottom-end');
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
<x-mary-header icon="o-bolt" icon-classes="bg-primary rounded-full p-1 w-6 h-6" title="Users" subtitle="This is responsive" separator progress-indicator="save" progress-indicator-class="progress-primary">
    <x-slot:middle class="!justify-end">
        <x-mary-input icon="o-bolt" placeholder="Search..." />
    </x-slot:middle>
    <x-slot:actions>
        <x-mary-button icon="o-funnel" />
        <x-mary-button wire:click="save" icon="o-plus" class="btn-primary" />
    </x-slot:actions>
</x-mary-header>
    <x-mary-button label="Theme" icon="o-swatch" @click="$dispatch('mary-toggle-theme')" />
    <x-mary-button label="Like" wire:click="save4" icon="o-heart" spinner />
    <x-mary-theme-toggle darkTheme="dark" lightTheme="light" />


    <div class="flex flex-wrap gap-4 mb-6">
            <x-mary-button label="Primary Save" class="btn-primary btn-sm" wire:click="save" spinner="save" />
            <x-mary-button label="Success Save" class="btn-success" wire:click="save" spinner="save" />
            <x-mary-button label="Quick Error" class="btn-error" wire:click="save2" spinner="save2" />
            <x-mary-button label="Save and redirect" class="btn-primary" wire:click="save3" spinner="save3" />
            <x-mary-button label="Like" wire:click="save4" icon="o-heart" spinner="save4" />
        </div>

        <div class="flex gap-4 mb-6">
            <x-mary-button label="Theme Toggle" icon="o-swatch" @click="$dispatch('mary-toggle-theme')" />
            <x-mary-theme-toggle darkTheme="aqua" lightTheme="bumblebee" />
        </div>

         <x-mary-button label="Open Modal" @click="$wire.myModal1 = true" class="btn-outline" />

         <select class="select select-bordered" onchange="document.documentElement.setAttribute('data-theme', this.value)">
                <option value="light">Light</option>
                <option value="dark">Dark</option>
                <option value="midnight">Midnight (Custom)</option>
                <option value="cupcake">Cupcake</option>
                <option value="synthwave">Synthwave</option>
                <option value="retro">Retro</option>
                <option value="cyberpunk">Cyberpunk</option>
                <option value="aqua">Aqua</option>
                <option value="dracula">Dracula</option>
                <option value="luxury">Luxury</option>
                <option value="night">Night</option>
                <option value="coffee">Coffee</option>
            </select>

       <x-mary-modal wire:model="myModal1" title="Hey" class="backdrop-blur">
            <div class="py-4">
                Press `ESC`, click outside or click `CANCEL` to close.
            </div>

            <x-slot:actions>
                <x-mary-button label="Cancel" @click="$wire.myModal1 = false" />
            </x-slot:actions>
        </x-mary-modal>
</section>
