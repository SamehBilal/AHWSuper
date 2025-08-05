<?php

use Livewire\Volt\Component;

new class extends Component {
    public $user;

    public function mount()
    {
        $this->user = auth()->user();
    }
}; ?>

<div x-data="{ active: 'dashboard' }">

    <x-slot:sidebar drawer="main-drawer" {{-- collapsible --}}
        class="flex bg-base-100 border-base-content/10 border-r-[length:var(--border)] ">


        <div class="flex">

            <livewire:admin.collapsed-sidebar />

            <div class="w-full">

                <x-mary-list-item :item="['title' => 'Create User', 'subtitle' => 'New user']" value="title" sub-value="subtitle" no-separator no-hover
                    class="pt-2 cursor-pointer">
                    <x-slot:avatar>
                        {{-- <x-mary-avatar :image="asset('new2.webp')" class="!w-10 !rounded-lg" alt="My image" /> --}}
                        <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center">
                            <x-mary-icon name="o-plus" class="w-6 h-6 text-white" />
                        </div>
                    </x-slot:avatar>
                    <x-slot:actions>
                        <a href="#">
                            <x-mary-button icon="o-plus" class="btn-circle btn-ghost btn-xs"
                                tooltip-left="Create" />
                        </a>
                    </x-slot:actions>
                </x-mary-list-item>
                <x-mary-menu-separator />


                <x-mary-menu activate-by-route active-bg-color="bg-primary text-white" class="flex-2">
                    <x-mary-menu-item title="Dashboard" icon="o-home" link="{{ route('users.dashboard') }}"
                        route="users.dashboard" />
                    <x-mary-menu-item title="Users" icon="o-user-group"
                        link="#"  />

                    <x-mary-menu-item title="Roles & Permissions" icon="o-shield-exclamation"
                        link="#"  />

                    <x-mary-menu-item title="Settings" icon="o-cog-8-tooth" :active="request()->is('users/admin/settings*')"
                        link="{{ route('users.settings.profile') }}" />
                </x-mary-menu>

            </div>
        </div>

    </x-slot:sidebar>
</div>
