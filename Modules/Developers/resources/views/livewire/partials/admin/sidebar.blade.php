<?php

use Livewire\Volt\Component;

new class extends Component {
    public $user;

    public function mount()
    {
        $this->user = auth()->user();
    }

}; ?>

<div>
<x-slot:sidebar drawer="main-drawer" collapsible
    class="border-r bg-base-100 border-base-content/10 border-b-[length:var(--border)] ">
    <x-mary-list-item :item="['title' => 'Create App', 'subtitle' => 'Create new app']" value="title" sub-value="subtitle" no-separator no-hover class="pt-2 cursor-pointer" >
        <x-slot:avatar>
            {{-- <x-mary-avatar :image="asset('new2.webp')" class="!w-10 !rounded-lg" alt="My image" /> --}}
            <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center">
                <x-mary-icon name="o-plus" class="w-6 h-6 text-white" />
            </div>
        </x-slot:avatar>
        <x-slot:actions>
            <x-mary-button icon="o-plus" class="btn-circle btn-ghost btn-xs" tooltip-left="Create" />
        </x-slot:actions>
    </x-mary-list-item>
    <x-mary-menu-separator />
    {{-- Activates the menu item when a route matches the `link` property --}}
    <x-mary-menu activate-by-route active-bg-color="bg-primary text-white">
        <x-mary-menu-item title="Dashboard" icon="o-home" link="{{ route('developers.dashboard') }}" route="developers.dashboard" />
        <x-mary-menu-item title="General information" icon="o-home" link="###" />
        <x-mary-menu-item title="OAuth2" icon="o-envelope" link="###" />
        <x-mary-menu-sub title="App Verification" icon="o-cog-6-tooth">
            <x-mary-menu-item title="Wifi" icon="o-wifi" link="####" />
            <x-mary-menu-item title="Archives" icon="o-archive-box" link="####" />
        </x-mary-menu-sub>
        <x-mary-menu-item title="Login Button" icon="o-envelope" link="{{ route('developers.login-button') }}" route="developers.login-button" />
    </x-mary-menu>
</x-slot:sidebar>
</div>
