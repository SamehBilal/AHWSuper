<?php

use Livewire\Volt\Component;

new class extends Component {
    public $user;

    public function mount()
    {
        $this->user = auth()->user();
    }

}; ?>

<div x-data="{ active: 'dashboard' }" class="flex h-full">
   {{--  <aside
        class="fixed top-16 left-0 h-screen border-e border-zinc-200 dark:border-[#1E2938] w-16 flex-shrink-0 flex flex-col items-center py-4 hidden lg:flex z-30">
        <x-mary-menu activate-by-route vertical class="space-y-2">

            <x-mary-popover position="right-start" offset="0">
                <x-slot:trigger>
                    <x-mary-menu-item icon="o-home" :tooltip="__('Dashboard')" route="dashboard"
                        link="{{ route('dashboard') }}" wire:navigate />
                </x-slot:trigger>
                <x-slot:content>
                    <div class="mockup-browser border-base-300 border w-full">
                        <div class="mockup-browser-toolbar">
                            <div class="input">{{ route('dashboard') }}</div>
                        </div>
                        <div class="grid place-content-center border-t border-base-300 h-80">Hello!</div>
                    </div>
                </x-slot:content>
            </x-mary-popover>

            <x-mary-popover position="right-start" offset="0">
                <x-slot:trigger>
                    <x-mary-menu-item icon="o-building-storefront" :tooltip="__('AHW Store')" route="ahwstore.dashboard"
                        link="{{ route('ahwstore.dashboard') }}" wire:navigate />
                </x-slot:trigger>
                <x-slot:content>
                    <div class="mockup-browser border-base-300 border w-full">
                        <div class="mockup-browser-toolbar">
                            <div class="input">https://ahw.store/</div>
                        </div>
                        <div class="grid place-content-center border-t border-base-300 w-50">
                            <img src="{{ asset('ahwstores.png') }}" height="580" alt="">
                        </div>
                    </div>
                </x-slot:content>
            </x-mary-popover>

            <x-mary-popover position="right-start" offset="0">
                <x-slot:trigger>
                    <x-mary-menu-item icon="o-user-group" :tooltip="__('User Management')" route="roles.index"
                        link="{{ route('roles.index') }}" wire:navigate />
                </x-slot:trigger>
                <x-slot:content>
                    {{ __('User Management') }}
                </x-slot:content>
            </x-mary-popover>

            <x-mary-popover position="right-start" offset="0">
                <x-slot:trigger>
                    <x-mary-menu-item icon="o-chart-bar" :tooltip="__('App Monitoring')" route="roles.index"
                        link="{{ route('roles.index') }}" wire:navigate />
                </x-slot:trigger>
                <x-slot:content>
                    {{ __('App Monitoring') }}
                </x-slot:content>
            </x-mary-popover>

            <x-mary-popover position="right-start" offset="0">
                <x-slot:trigger>
                    <x-mary-menu-item icon="o-briefcase" :tooltip="__('Ads Management')" route="roles.index"
                        link="{{ route('roles.index') }}" wire:navigate />
                </x-slot:trigger>
                <x-slot:content>
                    {{ __('Ads Management') }}
                </x-slot:content>
            </x-mary-popover>

            <x-mary-popover position="right-start" offset="0">
                <x-slot:trigger>
                    <x-mary-menu-item icon="o-document-text" :tooltip="__('Editors')" route="roles.index"
                        link="{{ route('roles.index') }}" wire:navigate />
                </x-slot:trigger>
                <x-slot:content>
                    {{ __('Editors') }}
                </x-slot:content>
            </x-mary-popover>

        </x-mary-menu>

        <div class="mt-auto w-full flex flex-col items-center">
            <x-mary-menu activate-by-route vertical class="space-y-2">
                <livewire:theme />
                <x-mary-popover position="right-start" offset="0">
                    <x-slot:trigger>
                        <x-mary-menu-item icon="o-book-open"
                            link="/api/docs" no-wire-navigate />
                    </x-slot:trigger>
                    <x-slot:content>
                        <div class="grid place-content-center border-t border-base-300">API Documentation!</div>
                        <div class="mockup-browser border-base-300 border w-full">
                            <div class="mockup-browser-toolbar">
                                <div class="input">{{ route('dashboard') }}</div>
                            </div>
                            <div class="grid place-content-center border-t border-base-300 h-80">Hello!</div>
                        </div>
                    </x-slot:content>
                </x-mary-popover>

                <x-mary-popover position="right-start" offset="0">
                    <x-slot:trigger>
                        <div class="mary-menu-item flex items-center justify-center !w-10 !h-10 cursor-pointer">
                            <x-mary-avatar placeholder="{{ auth()->user()->initials() }}" class="!w-8 !h-8" />
                        </div>
                    </x-slot:trigger>
                    <x-slot:content>
                        <div class="grid place-content-center border-t border-base-300">Profile</div>
                    </x-slot:content>
                </x-mary-popover>
                <x-mary-popover position="right-start" offset="0">
                    <x-slot:trigger>
                        <div class="mary-menu-item flex items-center justify-center !w-10 !h-10 cursor-pointer">
                            <x-mary-avatar placeholder="{{ auth()->user()->initials() }}" class="!w-8 !h-8" />
                        </div>
                    </x-slot:trigger>
                    <x-slot:content>
                        <div class="grid place-content-center border-t border-base-300">Profile</div>
                    </x-slot:content>
                </x-mary-popover>
            </x-mary-menu >
        </div>
    </aside> --}}
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
