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

            <x-mary-dropdown {{-- label="{{ auth()->user()->name }}" --}} {{-- icon="o-bell" --}}
                class="btn-ghost btn-sm" responsive right>
                <x-slot:trigger>
                    <x-mary-avatar placeholder="{{ auth()->user()->initials() }}" class="!w-10" />
                </x-slot:trigger>
                <x-mary-avatar placeholder="{{ auth()->user()->initials() }}" title="{{ auth()->user()->name }}"
                    subtitle="{{ auth()->user()->email }}" class="!w-10" />


                <x-mary-menu-separator />

                <x-mary-menu-item icon="o-cog-8-tooth" title="Profile" route="users.settings.profile"
                    link="{{ route('users.settings.profile') }}" wire:navigate />

                <x-mary-menu-item icon="o-arrow-right-start-on-rectangle" title="{{ __('Log Out') }}" class="w-full"
                    @click.prevent="document.getElementById('logout').submit();" />
                <form id="logout" method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                </form>
            </x-mary-dropdown>

        </x-slot:actions>
    </x-mary-nav>

    <div class="flex h-screen">
        <aside
            class="border-e border-zinc-200 dark:border-[#1E2938] w-16 flex-shrink-0 flex-col items-center py-4 hidden lg:flex">
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
                        <x-mary-menu-item icon="o-building-storefront" :tooltip="__('AHW Store')"
                            route="store.dashboard" link="{{ route('store.dashboard') }}" wire:navigate />
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
                        <x-mary-menu-item icon="o-user-group" :tooltip="__('User Management')" route="users.index"
                            link="{{ route('users.index') }}" wire:navigate />
                    </x-slot:trigger>
                    <x-slot:content>
                        {{ __('User Management') }}
                    </x-slot:content>
                </x-mary-popover>

                <x-mary-popover position="right-start" offset="0">
                    <x-slot:trigger>
                        <x-mary-menu-item icon="o-chart-bar" :tooltip="__('App Monitoring')" route="users.index"
                            link="{{ route('users.index') }}" wire:navigate />
                    </x-slot:trigger>
                    <x-slot:content>
                        {{ __('App Monitoring') }}
                    </x-slot:content>
                </x-mary-popover>

                <x-mary-popover position="right-start" offset="0">
                    <x-slot:trigger>
                        <x-mary-menu-item icon="o-briefcase" :tooltip="__('Ads Management')" route="users.index"
                            link="{{ route('users.index') }}" wire:navigate />
                    </x-slot:trigger>
                    <x-slot:content>
                        {{ __('Ads Management') }}
                    </x-slot:content>
                </x-mary-popover>


                <x-mary-popover position="right-start" offset="0">
                    <x-slot:trigger>
                        <x-mary-menu-item icon="o-document-text" :tooltip="__('Editors')" route="users.index"
                            link="{{ route('users.index') }}" wire:navigate />
                    </x-slot:trigger>
                    <x-slot:content>
                        {{ __('Editors') }}
                    </x-slot:content>
                </x-mary-popover>

                <livewire:theme />
                {{-- <x-mary-popover position="right-start" offset="0">
                    <x-slot:trigger>
                        <x-mary-menu-item icon="o-document-text" @click="$wire.myModal1 = true" />
                    </x-slot:trigger>
                    <x-slot:content>
                        {{ __('Theme') }}
                    </x-slot:content>
                </x-mary-popover>



                <livewire:settings.delete-user-form /> --}}

            </x-mary-menu>
        </aside>

        <div class="flex-1 flex flex-col">
            <x-mary-main with-nav full-width>

                <x-slot:sidebar drawer="main-drawer" collapsible
                    class=" border-e border-zinc-200 dark:border-[#1E2938]">
                    <div class="flex flex-row lg:hidden">
                        <div
                            class="w-16 flex-shrink-0 flex flex-col items-center py-2  border-e border-zinc-200 dark:border-[#1E2938]">
                            <x-mary-menu activate-by-route vertical class="space-y-2">
                                <x-mary-menu-item icon="o-home" :tooltip="__('Dashboard')" route="store.dashboard"
                                    link="{{ route('store.dashboard') }}" wire:navigate />
                                <x-mary-menu-item icon="o-shopping-cart" :tooltip="__('Items')"
                                    route="store.items.index" link="{{ route('store.items.index') }}"
                                    wire:navigate />
                                <x-mary-menu-item icon="o-document-currency-dollar" :tooltip="__('Invoices')"
                                    route="store.invoices.index" link="{{ route('store.invoices.index') }}"
                                    wire:navigate />
                                <x-mary-menu-item icon="o-user-group" :tooltip="__('Customers')"
                                    route="store.customers.index" link="{{ route('store.customers.index') }}"
                                    wire:navigate />
                                <x-mary-menu-item icon="o-users" :tooltip="__('Vendors')" route="store.vendors.index"
                                    link="{{ route('store.vendors.index') }}" wire:navigate />
                                <x-mary-menu-item icon="o-document-plus" :tooltip="__('Purchase orders')"
                                    route="store.purchase-orders.index"
                                    link="{{ route('store.purchase-orders.index') }}" wire:navigate />
                                <x-mary-menu-item title="{{ __('Monitoring') }}" icon="o-clipboard-document-list"
                                    route="store.sales-orders.index"
                                    link="{{ route('store.sales-orders.index') }}" wire:navigate />
                            </x-mary-menu>
                        </div>
                        <div class="flex-1">
                            @if ($user = auth()->user())
                                <x-mary-list-item :item="$user" value="name" sub-value="email" no-separator no-hover
                                    class="pt-2">
                                    <x-slot:avatar>
                                        <x-avatar {{-- :image="'https://avatar.iran.liara.run/public'" --}} placeholder="RT"
                                            alt="My image" />
                                    </x-slot:avatar>
                                    <x-slot:actions>
                                        <x-mary-button icon="o-power" class="btn-circle btn-ghost btn-xs"
                                            tooltip-left="logoff" no-wire-navigate link="/logout" />
                                    </x-slot:actions>
                                </x-mary-list-item>
                                <x-mary-menu-separator />
                            @endif
                            <x-mary-menu activate-by-route active-bg-color="bg-primary text-white" :collapsed="false">
                                <x-mary-menu-item title="{{ __('Dashboard') }}" icon="o-home" route="store.dashboard"
                                    link="{{ route('store.dashboard') }}" wire:navigate />
                                <x-mary-menu-item title="{{ __('Items') }}" icon="o-shopping-cart"
                                    route="store.items.index" link="{{ route('store.items.index') }}"
                                    wire:navigate />
                                <x-mary-menu-item title="{{ __('Invoices') }}" icon="o-document-currency-dollar"
                                    route="store.invoices.index" link="{{ route('store.invoices.index') }}"
                                    wire:navigate />
                                <x-mary-menu-item title="{{ __('Customers') }}" icon="o-user-group"
                                    route="store.customers.index" link="{{ route('store.customers.index') }}"
                                    wire:navigate />
                                <x-mary-menu-item title="{{ __('Vendors') }}" icon="o-users"
                                    route="store.vendors.index" link="{{ route('store.vendors.index') }}"
                                    wire:navigate />
                                <x-mary-menu-item title="{{ __('Purchase orders') }}" icon="o-document-plus"
                                    route="store.purchase-orders.index"
                                    link="{{ route('store.purchase-orders.index') }}" wire:navigate />
                                <x-mary-menu-item title="{{ __('Monitoring') }}" icon="o-clipboard-document-list"
                                    route="store.sales-orders.index"
                                    link="{{ route('store.sales-orders.index') }}" wire:navigate />

                            </x-mary-menu>
                        </div>
                    </div>
                    <div class="hidden lg:block">
                        @if ($user = auth()->user())
                            <x-mary-list-item :item="$user" value="name" sub-value="email" no-separator no-hover
                                class="pt-2">
                                <x-slot:avatar>
                                    <x-avatar {{-- :image="'https://avatar.iran.liara.run/public'" --}} placeholder="RT"
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
                            <x-mary-menu-item title="{{ __('Dashboard') }}" icon="o-home" route="store.dashboard"
                                link="{{ route('store.dashboard') }}" wire:navigate />
                            <x-mary-menu-item title="{{ __('Items') }}" icon="o-shopping-cart"
                                route="store.items.index" link="{{ route('store.items.index') }}" wire:navigate />
                            <x-mary-menu-item title="{{ __('Invoices') }}" icon="o-document-currency-dollar"
                                route="store.invoices.index" link="{{ route('store.invoices.index') }}"
                                wire:navigate />
                            <x-mary-menu-item title="{{ __('Customers') }}" icon="o-user-group"
                                route="store.customers.index" link="{{ route('store.customers.index') }}"
                                wire:navigate />
                            <x-mary-menu-item title="{{ __('Vendors') }}" icon="o-users" route="store.vendors.index"
                                link="{{ route('store.vendors.index') }}" wire:navigate />
                            <x-mary-menu-item title="{{ __('Purchase orders') }}" icon="o-document-plus"
                                route="store.purchase-orders.index"
                                link="{{ route('store.purchase-orders.index') }}" wire:navigate />
                            <x-mary-menu-item title="{{ __('Sales orders') }}" icon="o-clipboard-document-list"
                                route="store.sales-orders.index" link="{{ route('store.sales-orders.index') }}"
                                wire:navigate />

                        </x-mary-menu>
                    </div>
                </x-slot:sidebar>

                <x-slot:content>
                    {{ $slot }}
                </x-slot:content>
            </x-mary-main>
        </div>
    </div>


    <livewire:toast-handler />
    <x-mary-toast />
    <x-mary-spotlight search-text="Find docs, app actions or users" no-results-text="Ops! Nothing here." />

    @php $myModal1 = false; @endphp
    <x-modal wire:model="myModal1" title="Hey" class="backdrop-blur">
        Press `ESC`, click outside or click `CANCEL` to close.

        <x-slot:actions>
            <x-button label="Cancel" @click="$wire.myModal1 = false" />
        </x-slot:actions>
    </x-modal>

    <x-footer />

</body>

</html>
