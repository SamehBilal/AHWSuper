<x-layouts.app.sidebar :pageTitle="$title ?? null">
        <x-mary-main full-width>

        {{-- This is a sidebar that works also as a drawer on small screens --}}
        {{-- Notice the `main-drawer` reference here --}}
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-200 border-e border-zinc-200">

            

            {{-- Activates the menu item when a route matches the `link` property --}}
            <x-mary-menu activate-by-route {{-- active-bg-color="font-black " --}}>
                <x-mary-menu-item title="{{ __('Dashboard') }}" icon="o-home" route="dashboard"
                    link="{{ route('dashboard') }}" wire:navigate />
                <x-mary-menu-item title="{{ __('Items') }}" icon="o-shopping-cart" route="ahwstore.items.index"
                    link="{{ route('ahwstore.items.index') }}" wire:navigate />
                <x-mary-menu-item title="{{ __('Invoices') }}" icon="o-document-currency-dollar"
                    route="ahwstore.invoices.index" link="{{ route('ahwstore.invoices.index') }}" wire:navigate />
                <x-mary-menu-item title="{{ __('Customers') }}" icon="o-user-group" route="ahwstore.customers.index"
                    link="{{ route('ahwstore.customers.index') }}" wire:navigate />
                <x-mary-menu-item title="{{ __('Vendors') }}" icon="o-users" route="ahwstore.vendors.index"
                    link="{{ route('ahwstore.vendors.index') }}" wire:navigate />
                <x-mary-menu-item title="{{ __('Purchase orders') }}" icon="o-document-plus"
                    route="ahwstore.purchase-orders.index" link="{{ route('ahwstore.purchase-orders.index') }}"
                    wire:navigate />
                <x-mary-menu-item title="{{ __('Sales orders') }}" icon="o-clipboard-document-list"
                    route="ahwstore.sales-orders.index" link="{{ route('ahwstore.sales-orders.index') }}"
                    wire:navigate />
                {{-- <x-mary-menu-item title="Messages" icon="o-envelope" link="###" /> --}}
                <x-mary-menu-sub title="Settings" icon="o-cog-6-tooth">
                    <x-mary-menu-item title="Wifi" icon="o-wifi" link="####" />
                    <x-mary-menu-item title="Archives" icon="o-archive-box" link="####" />
                </x-mary-menu-sub>
            </x-mary-menu>
        </x-slot:sidebar>

        {{-- The `$slot` goes here --}}
        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-mary-main>
</x-layouts.app.sidebar>
