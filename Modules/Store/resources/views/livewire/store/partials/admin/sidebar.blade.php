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

                <x-mary-list-item :item="['title' => 'Create Item', 'subtitle' => 'New item']" value="title" sub-value="subtitle" no-separator no-hover
                    class="pt-2 cursor-pointer">
                    <x-slot:avatar>
                        {{-- <x-mary-avatar :image="asset('new2.webp')" class="!w-10 !rounded-lg" alt="My image" /> --}}
                        <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center">
                            <x-mary-icon name="o-plus" class="w-6 h-6 text-white" />
                        </div>
                    </x-slot:avatar>
                    <x-slot:actions>
                        <a {{-- href="{{ route('developers.apps.create') }}" --}}>
                            <x-mary-button icon="o-plus" class="btn-circle btn-ghost btn-xs" tooltip-left="Create" />
                        </a>
                    </x-slot:actions>
                </x-mary-list-item>
                <x-mary-menu-separator />


                <x-mary-menu activate-by-route active-bg-color="bg-primary text-white" class="flex-2">
                    <x-mary-menu-item title="{{ __('Dashboard') }}" icon="o-home" route="store.dashboard"
                        link="{{ route('store.dashboard') }}" wire:navigate />
                    <x-mary-menu-item title="{{ __('Items') }}" icon="o-shopping-cart" route="store.items.index"
                        link="{{ route('store.items.index') }}" wire:navigate />
                    <x-mary-menu-item title="{{ __('Invoices') }}" icon="o-document-currency-dollar"
                        route="store.invoices.index" link="{{ route('store.invoices.index') }}"
                        wire:navigate />
                    <x-mary-menu-item title="{{ __('Customers') }}" icon="o-user-group"
                        route="store.customers.index" link="{{ route('store.customers.index') }}"
                        wire:navigate />
                    <x-mary-menu-item title="{{ __('Vendors') }}" icon="o-users" route="store.vendors.index"
                        link="{{ route('store.vendors.index') }}" wire:navigate />
                    <x-mary-menu-item title="{{ __('Purchase orders') }}" icon="o-document-plus"
                        route="store.purchase-orders.index" link="{{ route('store.purchase-orders.index') }}"
                        wire:navigate />
                    <x-mary-menu-item title="{{ __('Sales orders') }}" icon="o-clipboard-document-list"
                        route="store.sales-orders.index" link="{{ route('store.sales-orders.index') }}"
                        wire:navigate />
                </x-mary-menu>

            </div>
        </div>

    </x-slot:sidebar>
</div>
