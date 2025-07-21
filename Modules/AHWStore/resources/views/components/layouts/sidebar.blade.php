<!-- Module-specific Collapsible Sidebar -->
<x-slot:sidebar drawer="main-drawer" collapsible class="border-e border-zinc-200 dark:border-[#1E2938]">
    <!-- Mobile Layout -->
    <div class="flex flex-row lg:hidden">
        <div class="w-16 flex-shrink-0 flex flex-col items-center py-2 border-e border-zinc-200 dark:border-[#1E2938]">
            <x-mary-menu vertical class="space-y-2">
                <x-mary-menu-item icon="o-home" :tooltip="__('Dashboard')" route="ahwstore.dashboard"
                    link="{{ route('ahwstore.dashboard') }}" wire:navigate />
                <x-mary-menu-item icon="o-shopping-cart" :tooltip="__('Items')"
                    route="ahwstore.items.index" link="{{ route('ahwstore.items.index') }}" wire:navigate />
                <x-mary-menu-item icon="o-document-currency-dollar" :tooltip="__('Invoices')"
                    route="ahwstore.invoices.index" link="{{ route('ahwstore.invoices.index') }}" wire:navigate />
                <x-mary-menu-item icon="o-user-group" :tooltip="__('Customers')"
                    route="ahwstore.customers.index" link="{{ route('ahwstore.customers.index') }}" wire:navigate />
                <x-mary-menu-item icon="o-users" :tooltip="__('Vendors')" route="ahwstore.vendors.index"
                    link="{{ route('ahwstore.vendors.index') }}" wire:navigate />
                <x-mary-menu-item icon="o-document-plus" :tooltip="__('Purchase orders')"
                    route="ahwstore.purchase-orders.index"
                    link="{{ route('ahwstore.purchase-orders.index') }}" wire:navigate />
                <x-mary-menu-item title="{{ __('Sales Orders') }}" icon="o-clipboard-document-list"
                    route="ahwstore.sales-orders.index"
                    link="{{ route('ahwstore.sales-orders.index') }}" wire:navigate />
            </x-mary-menu>
        </div>
        <div class="flex-1">
            @if ($user = auth()->user())
                <x-mary-list-item :item="$user" value="name" sub-value="email" no-separator no-hover class="pt-2">
                    <x-slot:avatar>
                        <x-avatar placeholder="RT" alt="My image" />
                    </x-slot:avatar>
                    <x-slot:actions>
                        <x-mary-button icon="o-power" class="btn-circle btn-ghost btn-xs"
                            tooltip-left="logoff" no-wire-navigate link="/logout" />
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
                    route="ahwstore.invoices.index" link="{{ route('ahwstore.invoices.index') }}" wire:navigate />
                <x-mary-menu-item title="{{ __('Customers') }}" icon="o-user-group"
                    route="ahwstore.customers.index" link="{{ route('ahwstore.customers.index') }}" wire:navigate />
                <x-mary-menu-item title="{{ __('Vendors') }}" icon="o-users"
                    route="ahwstore.vendors.index" link="{{ route('ahwstore.vendors.index') }}" wire:navigate />
                <x-mary-menu-item title="{{ __('Purchase orders') }}" icon="o-document-plus"
                    route="ahwstore.purchase-orders.index"
                    link="{{ route('ahwstore.purchase-orders.index') }}" wire:navigate />
                <x-mary-menu-item title="{{ __('Sales orders') }}" icon="o-clipboard-document-list"
                    route="ahwstore.sales-orders.index"
                    link="{{ route('ahwstore.sales-orders.index') }}" wire:navigate />
            </x-mary-menu>
        </div>
    </div>

    <!-- Desktop Layout -->
    <div class="hidden lg:block">
        @if ($user = auth()->user())
            <x-mary-list-item :item="$user" value="name" sub-value="email" no-separator no-hover class="pt-2">
                <x-slot:avatar>
                    <x-mary-avatar placeholder="{{ $user->initials() }}" alt="My image" />
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
            <x-mary-menu-item title="{{ __('Items') }}" icon="o-shopping-cart"
                route="ahwstore.items.index" link="{{ route('ahwstore.items.index') }}" wire:navigate />
            <x-mary-menu-item title="{{ __('Invoices') }}" icon="o-document-currency-dollar"
                route="ahwstore.invoices.index" link="{{ route('ahwstore.invoices.index') }}" wire:navigate />
            <x-mary-menu-item title="{{ __('Customers') }}" icon="o-user-group"
                route="ahwstore.customers.index" link="{{ route('ahwstore.customers.index') }}" wire:navigate />
            <x-mary-menu-item title="{{ __('Vendors') }}" icon="o-users"
                route="ahwstore.vendors.index" link="{{ route('ahwstore.vendors.index') }}" wire:navigate />
            <x-mary-menu-item title="{{ __('Purchase orders') }}" icon="o-document-plus"
                route="ahwstore.purchase-orders.index"
                link="{{ route('ahwstore.purchase-orders.index') }}" wire:navigate />
            <x-mary-menu-item title="{{ __('Sales orders') }}" icon="o-clipboard-document-list"
                route="ahwstore.sales-orders.index" link="{{ route('ahwstore.sales-orders.index') }}" wire:navigate />
        </x-mary-menu>
    </div>
</x-slot:sidebar>
