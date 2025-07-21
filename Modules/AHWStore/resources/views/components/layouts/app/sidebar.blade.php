<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen flex flex-col" x-data x-on:set-page-title.window="document.title = $event.detail.title">

    <x-mary-nav sticky full-width>

        <x-slot:brand>
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-mary-icon name="o-bars-3" class="cursor-pointer" />
            </label>

            <a href="{{ route('ahwstore.dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse"
                wire:navigate>
                <x-app-logo />
            </a>
        </x-slot:brand>

        <x-slot:actions>

            <x-mary-button icon="o-magnifying-glass" class="btn-primary-content btn-dash"
                @click.stop="$dispatch('mary-search-open')">
                Search  <x-mary-kbd>Ctrl</x-mary-kbd> <x-mary-kbd>K</x-mary-kbd>
            </x-mary-button>
            <x-mary-menu-separator />
            <x-mary-dropdown>

                <x-mary-menu-item title="Archive" />
                <x-mary-menu-item title="Move" />

                <x-slot:trigger>
                    <x-mary-button icon="o-bell" class="btn btn-circle btn-ghost !w-10 !rounded-lg" />
                </x-slot:trigger>
            </x-mary-dropdown>
            <x-mary-theme-toggle class="btn btn-circle btn-ghost !w-10 !rounded-lg" />

            <x-mary-dropdown
                class="btn-ghost btn-sm cursor-pointer" responsive right>
                <x-slot:trigger>
                    <x-mary-avatar placeholder="{{ auth()->user()->initials() }}" class="!w-10 !rounded-lg cursor-pointer" />
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

    <aside
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
                        {{-- <div class="mockup-browser border-base-300 border w-full">
                            <div class="mockup-browser-toolbar">
                                <div class="input">{{ route('dashboard') }}</div>
                            </div>
                            <div class="grid place-content-center border-t border-base-300 h-80">Hello!</div>
                        </div> --}}
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
    </aside>

    <div class="flex-1 flex flex-col lg:ml-16">
        <x-mary-main with-nav full-width>

            <x-slot:sidebar drawer="main-drawer" collapsible class=" border-e border-zinc-200 dark:border-[#1E2938]">
                <div class="flex flex-row lg:hidden">
                    <div
                        class="w-16 flex-shrink-0 flex flex-col items-center py-2  border-e border-zinc-200 dark:border-[#1E2938]">
                        <x-mary-menu activate-by-route vertical class="space-y-2">
                            <x-mary-menu-item icon="o-home" :tooltip="__('Dashboard')" route="ahwstore.dashboard"
                                link="{{ route('ahwstore.dashboard') }}" wire:navigate />
                            <x-mary-menu-item icon="o-shopping-cart" :tooltip="__('Items')" route="ahwstore.items.index"
                                link="{{ route('ahwstore.items.index') }}" wire:navigate />
                            <x-mary-menu-item icon="o-document-currency-dollar" :tooltip="__('Invoices')"
                                route="ahwstore.invoices.index" link="{{ route('ahwstore.invoices.index') }}"
                                wire:navigate />
                            <x-mary-menu-item icon="o-user-group" :tooltip="__('Customers')"
                                route="ahwstore.customers.index" link="{{ route('ahwstore.customers.index') }}"
                                wire:navigate />
                            <x-mary-menu-item icon="o-users" :tooltip="__('Vendors')" route="ahwstore.vendors.index"
                                link="{{ route('ahwstore.vendors.index') }}" wire:navigate />
                            <x-mary-menu-item icon="o-document-plus" :tooltip="__('Purchase orders')"
                                route="ahwstore.purchase-orders.index"
                                link="{{ route('ahwstore.purchase-orders.index') }}" wire:navigate />
                            <x-mary-menu-item title="{{ __('Monitoring') }}" icon="o-clipboard-document-list"
                                route="ahwstore.sales-orders.index" link="{{ route('ahwstore.sales-orders.index') }}"
                                wire:navigate />
                        </x-mary-menu>
                    </div>
                    <div class="flex-1">
                        @if ($user = auth()->user())
                            <x-mary-list-item :item="$user" value="name" sub-value="email" no-separator no-hover
                                class="pt-2">
                                <x-slot:avatar>
                                    <x-mary-avatar :image="'https://avatar.iran.liara.run/public'" placeholder="{{ $user->initials() }}"
                                        alt="My image" />
                                </x-slot:avatar>
                                <x-slot:actions>
                                    <x-mary-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="logoff"
                                        no-wire-navigate link="/logout" />
                                </x-slot:actions>
                            </x-mary-list-item>
                            <x-mary-menu-separator />
                        @endif
                        <x-mary-menu activate-by-route active-bg-color="bg-primary text-white" :collapsed="false">
                            <x-mary-menu-item title="{{ __('Dashboard') }}" icon="o-home" route="ahwstore.dashboard"
                                link="{{ route('ahwstore.dashboard') }}" wire:navigate />
                            <x-mary-menu-item title="{{ __('Items') }}" icon="o-shopping-cart"
                                route="ahwstore.items.index" link="{{ route('ahwstore.items.index') }}" wire:navigate />
                            <x-mary-menu-item title="{{ __('Invoices') }}" icon="o-document-currency-dollar"
                                route="ahwstore.invoices.index" link="{{ route('ahwstore.invoices.index') }}"
                                wire:navigate />
                            <x-mary-menu-item title="{{ __('Customers') }}" icon="o-user-group"
                                route="ahwstore.customers.index" link="{{ route('ahwstore.customers.index') }}"
                                wire:navigate />
                            <x-mary-menu-item title="{{ __('Vendors') }}" icon="o-users" route="ahwstore.vendors.index"
                                link="{{ route('ahwstore.vendors.index') }}" wire:navigate />
                            <x-mary-menu-item title="{{ __('Purchase orders') }}" icon="o-document-plus"
                                route="ahwstore.purchase-orders.index"
                                link="{{ route('ahwstore.purchase-orders.index') }}" wire:navigate />
                            <x-mary-menu-item title="{{ __('Monitoring') }}" icon="o-clipboard-document-list"
                                route="ahwstore.sales-orders.index" link="{{ route('ahwstore.sales-orders.index') }}"
                                wire:navigate />

                        </x-mary-menu>
                    </div>
                </div>
                <div class="hidden lg:block">
                    @if ($user = auth()->user())
                        <x-mary-list-item :item="$user" value="name" sub-value="email" no-separator no-hover class="pt-2">
                            <x-slot:avatar>
                                <x-mary-avatar :image="'https://avatar.iran.liara.run/public'" placeholder="{{ $user->initials() }}"
                                    alt="My image" />
                            </x-slot:avatar>
                            <x-slot:actions>
                                <x-mary-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="logoff"
                                    @click.prevent="document.getElementById('logout').submit();" />
                            </x-slot:actions>
                        </x-mary-list-item>
                        <x-mary-menu-separator />
                    @endif
                    <x-mary-menu activate-by-route active-bg-color="bg-primary text-white" :collapsed="false">
                        <x-mary-menu-item title="{{ __('Dashboard') }}" icon="o-home" route="ahwstore.dashboard"
                            link="{{ route('ahwstore.dashboard') }}" wire:navigate />
                        <x-mary-menu-item title="{{ __('Items') }}" icon="o-shopping-cart" route="ahwstore.items.index"
                            link="{{ route('ahwstore.items.index') }}" wire:navigate />
                        <x-mary-menu-item title="{{ __('Invoices') }}" icon="o-document-currency-dollar"
                            route="ahwstore.invoices.index" link="{{ route('ahwstore.invoices.index') }}"
                            wire:navigate />
                        <x-mary-menu-item title="{{ __('Customers') }}" icon="o-user-group"
                            route="ahwstore.customers.index" link="{{ route('ahwstore.customers.index') }}"
                            wire:navigate />
                        <x-mary-menu-item title="{{ __('Vendors') }}" icon="o-users" route="ahwstore.vendors.index"
                            link="{{ route('ahwstore.vendors.index') }}" wire:navigate />
                        <x-mary-menu-item title="{{ __('Purchase orders') }}" icon="o-document-plus"
                            route="ahwstore.purchase-orders.index" link="{{ route('ahwstore.purchase-orders.index') }}"
                            wire:navigate />
                        <x-mary-menu-item title="{{ __('Sales orders') }}" icon="o-clipboard-document-list"
                            route="ahwstore.sales-orders.index" link="{{ route('ahwstore.sales-orders.index') }}"
                            wire:navigate />

                    </x-mary-menu>
                </div>
            </x-slot:sidebar>

            <!-- Content Area -->
            <x-slot:content>
                {{ $slot }}
                <x-footer />
            </x-slot:content>
        </x-mary-main>
    </div>
    </div>

    <livewire:toast-handler />
    <x-mary-toast />
    <x-mary-spotlight shortcut="{{ str_contains(request()->header('User-Agent'), 'Mac') ? 'meta.k' : 'ctrl.k' }}" search-text="Find docs, app actions or users" no-results-text="Ops! Nothing here." />
    <x-cookies />
</body>

</html>
