<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen" x-data x-on:set-page-title.window="document.title = $event.detail.title">
    <input type="hidden" name="userId" value="{{ auth()->user()->id ?? '' }}" />

    <x-mary-nav sticky full-width>
        <x-slot:brand>
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-mary-icon name="o-bars-3" class="cursor-pointer" />
            </label>

            <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse"
                wire:navigate>
                <x-app-logo />
            </a>
        </x-slot:brand>

        <x-slot:actions>
            <x-mary-button icon="o-magnifying-glass" class="btn-primary-content btn-dash"
                @click.stop="$dispatch('mary-search-open')">
                Search...
            </x-mary-button>
            <x-mary-menu-separator />
            <x-mary-dropdown>
                <x-mary-menu-item title="Archive" />
                <x-mary-menu-item title="Move" />
                <x-slot:trigger>
                    <x-mary-button icon="o-bell" class="btn-circle" />
                </x-slot:trigger>
            </x-mary-dropdown>
            <x-mary-theme-toggle class="btn btn-circle" />

            <x-mary-dropdown class="btn-ghost btn-sm" responsive right>
                <x-slot:trigger>
                    <x-mary-avatar placeholder="{{ auth()->user()->initials() }}" class="!w-10" />
                </x-slot:trigger>
                <x-mary-avatar placeholder="{{ auth()->user()->initials() }}" title="{{ auth()->user()->name }}"
                    subtitle="{{ auth()->user()->email }}" class="!w-10" />

                <x-mary-menu-separator />

                <x-mary-menu-item icon="o-cog-8-tooth" title="Profile" route="settings.profile"
                    link="{{ route('settings.profile') }}" wire:navigate />

                <x-mary-menu-item icon="o-arrow-right-start-on-rectangle" title="{{ __('Log Out') }}" class="w-full"
                    @click.prevent="document.getElementById('logout').submit();" />
                <form id="logout" method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                </form>
            </x-mary-dropdown>
        </x-slot:actions>
    </x-mary-nav>

    <div class="flex h-screen">
        <!-- Fixed Main Sidebar -->
        <aside class="border-e border-zinc-200 dark:border-[#1E2938] w-16 flex-shrink-0 flex-col items-center py-4 hidden lg:flex">
            <x-mary-menu vertical class="space-y-2">
                <x-mary-popover position="right-start" offset="0">
                    <x-slot:trigger>
                        <x-mary-menu-item
                            icon="o-home"
                            :tooltip="__('Dashboard')"
                            route="dashboard"
                            link="{{ route('dashboard') }}"
                            wire:navigate
                            class="{{ request()->routeIs('dashboard') ? 'bg-primary text-primary-content' : '' }}"
                        />
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
                        <x-mary-menu-item
                            icon="o-building-storefront"
                            :tooltip="__('AHW Store')"
                            route="store.dashboard"
                            link="{{ route('store.dashboard') }}"
                            wire:navigate
                            class="{{ request()->routeIs('store.*') ? 'bg-primary text-primary-content' : '' }}"
                        />
                    </x-slot:trigger>
                    <x-slot:content>
                        <div class="mockup-browser border-base-300 border w-full">
                            <div class="mockup-browser-toolbar">
                                <div class="input">https://ahw.store/</div>
                            </div>
                            <div class="grid place-content-center border-t border-base-300 h-80">
                                <img src="{{ asset('store.png') }}" width="560px" alt="">
                            </div>
                        </div>
                    </x-slot:content>
                </x-mary-popover>

                <x-mary-popover position="right-start" offset="0">
                    <x-slot:trigger>
                        <x-mary-menu-item
                            icon="o-user-group"
                            :tooltip="__('User Management')"
                            route="roles.index"
                            link="{{ route('roles.index') }}"
                            wire:navigate
                            class="{{ request()->routeIs('roles.*') ? 'bg-primary text-primary-content' : '' }}"
                        />
                    </x-slot:trigger>
                    <x-slot:content>
                        {{ __('User Management') }}
                    </x-slot:content>
                </x-mary-popover>

                <x-mary-popover position="right-start" offset="0">
                    <x-slot:trigger>
                        <x-mary-menu-item
                            icon="o-chart-bar"
                            :tooltip="__('App Monitoring')"
                            route="roles.index"
                            link="{{ route('roles.index') }}"
                            wire:navigate
                            class="{{ request()->routeIs('roles.*') ? 'bg-primary text-primary-content' : '' }}"
                        />
                    </x-slot:trigger>
                    <x-slot:content>
                        {{ __('App Monitoring') }}
                    </x-slot:content>
                </x-mary-popover>

                <x-mary-popover position="right-start" offset="0">
                    <x-slot:trigger>
                        <x-mary-menu-item
                            icon="o-briefcase"
                            :tooltip="__('Ads Management')"
                            route="roles.index"
                            link="{{ route('roles.index') }}"
                            wire:navigate
                            class="{{ request()->routeIs('roles.*') ? 'bg-primary text-primary-content' : '' }}"
                        />
                    </x-slot:trigger>
                    <x-slot:content>
                        {{ __('Ads Management') }}
                    </x-slot:content>
                </x-mary-popover>

                <x-mary-popover position="right-start" offset="0">
                    <x-slot:trigger>
                        <x-mary-menu-item
                            icon="o-document-text"
                            :tooltip="__('Editors')"
                            route="roles.index"
                            link="{{ route('roles.index') }}"
                            wire:navigate
                            class="{{ request()->routeIs('roles.*') ? 'bg-primary text-primary-content' : '' }}"
                        />
                    </x-slot:trigger>
                    <x-slot:content>
                        {{ __('Editors') }}
                    </x-slot:content>
                </x-mary-popover>

                <livewire:theme />
            </x-mary-menu>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col">
            {{ $slot }}
        </div>
    </div>

    <livewire:toast-handler />
    <x-mary-toast />
    <x-mary-spotlight search-text="Find docs, app actions or users" no-results-text="Ops! Nothing here." />
    <x-footer />
</body>

</html>
