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

            <div
                class="flex flex-col justify-between h-[calc(100vh-65px)] w-16 bg-base-100 border-base-content/10 border-r-[length:var(--border)]">
                <x-mary-menu activate-by-route active-bg-color="bg-primary text-white" vertical
                    class="space-y-2 bg-base-100 border-base-content/10 border-r-[length:var(--border)]">

                    <x-mary-popover position="right-start" offset="0">
                        <x-slot:trigger>
                            <x-mary-menu-item icon="o-home" :tooltip="__('Dashboard')" route="dashboard"
                                link="{{ route('dashboard') }}" wire:navigate />
                        </x-slot:trigger>
                        <x-slot:content>
                            <div class="mockup-browser z-[9999] border-base-300 border w-full">
                                <div class="mockup-browser-toolbar">
                                    <div class="input">{{ route('dashboard') }}</div>
                                </div>
                                <div class="grid place-content-center border-t border-base-300 h-80">Hello!</div>
                            </div>
                        </x-slot:content>
                    </x-mary-popover>

                    <x-mary-popover position="right-start" offset="0">
                        <x-slot:trigger>
                            <x-mary-menu-item icon="o-building-storefront" :tooltip="__('AHW Store')" route="store.dashboard"
                                link="{{ route('store.dashboard') }}" wire:navigate />
                        </x-slot:trigger>
                        <x-slot:content>
                            <div class="mockup-browser z-[9999] border-base-300 border w-full">
                                <div class="mockup-browser-toolbar">
                                    <div class="input">https://ahw.store/</div>
                                </div>
                                <div class="grid place-content-center border-t border-base-300 w-50">
                                    <img src="{{ asset('store.png') }}" height="580" alt="">
                                </div>
                            </div>
                        </x-slot:content>
                    </x-mary-popover>

                    <x-mary-popover position="right-start" offset="0">
                        <x-slot:trigger>
                            <x-mary-menu-item icon="o-user-group" :tooltip="__('User Management')" 
                                link="#" wire:navigate />
                        </x-slot:trigger>
                        <x-slot:content>
                            {{ __('User Management') }}
                        </x-slot:content>
                    </x-mary-popover>

                    <x-mary-popover position="right-start" offset="0">
                        <x-slot:trigger>
                            <x-mary-menu-item icon="o-chart-bar" :tooltip="__('App Monitoring')"
                                link="#" wire:navigate />
                        </x-slot:trigger>
                        <x-slot:content>
                            {{ __('App Monitoring') }}
                        </x-slot:content>
                    </x-mary-popover>

                    <x-mary-popover position="right-start" offset="0">
                        <x-slot:trigger>
                            <x-mary-menu-item icon="o-briefcase" :tooltip="__('Ads Management')"
                                link="#" wire:navigate />
                        </x-slot:trigger>
                        <x-slot:content>
                            {{ __('Ads Management') }}
                        </x-slot:content>
                    </x-mary-popover>

                    <x-mary-popover position="right-start" offset="0">
                        <x-slot:trigger>
                            <x-mary-menu-item icon="o-document-text" :tooltip="__('Editors')"
                                link="#" wire:navigate />
                        </x-slot:trigger>
                        <x-slot:content>
                            {{ __('Editors') }}
                        </x-slot:content>
                    </x-mary-popover>
                    <x-mary-popover position="right-start" offset="0">
                        <x-slot:trigger>
                            <x-mary-menu-item icon="o-cloud" :tooltip="__('Developers')"
                                link="{{ route('developers.dashboard') }}" :active="request()->is('developers/admin*')" wire:navigate>
                            </x-mary-menu-item>
                        </x-slot:trigger>
                        <x-slot:content>
                            {{ __('Developers') }}
                        </x-slot:content>
                    </x-mary-popover>

                </x-mary-menu>

                <x-mary-menu activate-by-route vertical
                    class="justify-items-center space-y-2 bg-base-100 border-base-content/10 border-r-[length:var(--border)]">
                    <livewire:theme />
                    <x-mary-popover position="right-start" offset="0">
                        <x-slot:trigger>
                            <x-mary-menu-item icon="o-book-open" link="/api/docs" no-wire-navigate />
                        </x-slot:trigger>
                        <x-slot:content>
                            <div class="grid place-content-center border-t border-base-300">API Documentation!</div>
                            <div class="mockup-browser z-[9999] border-base-300 border w-full">
                                <div class="mockup-browser-toolbar">
                                    <div class="input">{{ route('dashboard') }}</div>
                                </div>
                                <div class="grid place-content-center border-t border-base-300 h-80">Hello!</div>
                            </div>
                        </x-slot:content>
                    </x-mary-popover>
                    <x-mary-dropdown
                        class="justify-content-center justify-items-center justify-center btn-ghost btn-sm cursor-pointer"
                        responsive no-x-anchor top>
                        <x-slot:trigger>
                            <x-mary-avatar placeholder="{{ auth()->user()->initials() }}"
                                class="!w-8 !rounded-lg cursor-pointer" />
                        </x-slot:trigger>

                        <x-mary-avatar placeholder="{{ auth()->user()->initials() }}"
                            title="{{ auth()->user()->name }}" subtitle="{{ auth()->user()->email }}"
                            class="!w-10" />

                        <x-mary-menu-separator />

                        <x-mary-menu-item icon="o-cog-8-tooth" title="Profile" route="settings.profile"
                            link="{{ route('settings.profile') }}" wire:navigate />

                        <x-mary-menu-item icon="o-arrow-right-start-on-rectangle" title="{{ __('Log Out') }}"
                            class="w-full" @click.prevent="document.getElementById('logout').submit();" />
                        <form id="logout" method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                        </form>
                    </x-mary-dropdown>
                </x-mary-menu>
            </div>

            <div class="w-full">

                <x-mary-list-item :item="['title' => 'Create App', 'subtitle' => 'Create new app']" value="title" sub-value="subtitle" no-separator no-hover
                    class="pt-2 cursor-pointer">
                    <x-slot:avatar>
                        {{-- <x-mary-avatar :image="asset('new2.webp')" class="!w-10 !rounded-lg" alt="My image" /> --}}
                        <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center">
                            <x-mary-icon name="o-plus" class="w-6 h-6 text-white" />
                        </div>
                    </x-slot:avatar>
                    <x-slot:actions>
                        <a href="{{ route('developers.apps.create') }}">
                            <x-mary-button icon="o-plus" class="btn-circle btn-ghost btn-xs"
                                tooltip-left="Create" />
                        </a>
                    </x-slot:actions>
                </x-mary-list-item>
                <x-mary-menu-separator />


                <x-mary-menu activate-by-route active-bg-color="bg-primary text-white" class="flex-2">
                    <x-mary-menu-item title="Dashboard" icon="o-home" link="{{ route('developers.dashboard') }}"
                        route="developers.dashboard" />
                    <x-mary-menu-item title="My Apps" icon="o-code-bracket"
                        link="{{ route('developers.apps.index') }}" active-by-url="/developers/admin/apps*" />
                    <x-mary-menu-item title="App Verification" icon="o-check-badge"
                        link="{{ route('developers.app-verification') }}" route="developers.app-verification" />
                    <x-mary-menu-item title="Login Button" icon="o-paper-airplane"
                        link="{{ route('developers.login-button') }}" route="developers.login-button" />
                    <x-mary-menu-item title="OAuth2" icon="o-arrow-right-end-on-rectangle"
                        link="{{ route('developers.oauth2') }}" route="developers.oauth2" />
                    <x-mary-menu-item title="App Testers" icon="o-shield-check"
                        link="{{ route('developers.app-testers') }}" route="developers.app-testers" />
                    <x-mary-menu-item title="My Tickets" icon="o-ticket"
                        link="{{ route('developers.tickets') }}" route="developers.tickets" />
                </x-mary-menu>

            </div>
        </div>

    </x-slot:sidebar>
</div>
