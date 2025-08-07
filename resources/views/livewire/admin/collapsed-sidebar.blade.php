<div
    class="flex flex-col justify-between h-[calc(100vh-65px)] w-16 border-base-content/10 border-r-[length:var(--border)]">
    <x-mary-menu activate-by-route active-bg-color="bg-primary text-white" vertical
        class="space-y-2 {{-- bg-base-100  --}}{{-- border-base-content/10 border-r-[length:var(--border)] --}}">

        <x-mary-popover position="right-start" offset="0">
            <x-slot:trigger>
                <x-mary-menu-item icon="o-home" :tooltip="__('Home')" route="dashboard" link="{{ route('dashboard') }}" :active="request()->is('admin*')"
                    wire:navigate />
            </x-slot:trigger>
            <x-slot:content>
                {{ __('Home') }}
            </x-slot:content>
        </x-mary-popover>

        <x-mary-popover position="right-start" offset="0">
            <x-slot:trigger>
                <x-mary-menu-item icon="o-building-storefront" :tooltip="__('Zoho')" :active="request()->is('store/admin*')"
                    link="{{ route('store.dashboard') }}" wire:navigate />
            </x-slot:trigger>
            <x-slot:content>
                {{ __('Zoho') }}
            </x-slot:content>
        </x-mary-popover>

        <x-mary-popover position="right-start" offset="0">
            <x-slot:trigger>
                <x-mary-menu-item icon="o-arrow-trending-up" :tooltip="__('Invoices')" :active="request()->is('invoices/admin*')"
                    link="{{ route('invoices.dashboard') }}" wire:navigate />
            </x-slot:trigger>
            <x-slot:content>
                {{ __('Digital Arrow') }}
            </x-slot:content>
        </x-mary-popover>

        <x-mary-popover position="right-start" offset="0">
            <x-slot:trigger>
                <x-mary-menu-item icon="o-user-group" :tooltip="__('User Management')" :active="request()->is('users/admin*')"
                    link="{{ route('users.dashboard') }}" wire:navigate />
            </x-slot:trigger>
            <x-slot:content>
                {{ __('User Management') }}
            </x-slot:content>
        </x-mary-popover>

        <x-mary-popover position="right-start" offset="0">
            <x-slot:trigger>
                <x-mary-menu-item icon="o-table-cells" :tooltip="__('Ads Management')" link="#" wire:navigate />
            </x-slot:trigger>
            <x-slot:content>
                {{ __('Ads Management') }}
            </x-slot:content>
        </x-mary-popover>

        <x-mary-popover position="right-start" offset="0">
            <x-slot:trigger>
                <x-mary-menu-item icon="o-finger-print" :tooltip="__('HR Management')" link="#" wire:navigate />
            </x-slot:trigger>
            <x-slot:content>
                {{ __('HR Management') }}
            </x-slot:content>
        </x-mary-popover>

        <x-mary-popover position="right-start" offset="0">
            <x-slot:trigger>
                <x-mary-menu-item icon="o-document-text" :tooltip="__('Editors')" link="#" wire:navigate />
            </x-slot:trigger>
            <x-slot:content>
                {{ __('Editors') }}
            </x-slot:content>
        </x-mary-popover>
        <x-mary-popover position="right-start" offset="0">
            <x-slot:trigger>
                <x-mary-menu-item icon="o-ticket" :tooltip="__('Events')" link="#" wire:navigate />
            </x-slot:trigger>
            <x-slot:content>
                {{ __('Events') }}
            </x-slot:content>
        </x-mary-popover>
        <x-mary-popover position="right-start" offset="0">
            <x-slot:trigger>
                <x-mary-menu-item icon="o-cloud" :tooltip="__('Developers')" link="{{ route('developers.dashboard') }}"
                    :active="request()->is('developers/admin*')" wire:navigate>
                </x-mary-menu-item>
            </x-slot:trigger>
            <x-slot:content>
                {{ __('Developers') }}
            </x-slot:content>
        </x-mary-popover>
         <x-mary-popover position="right-start" offset="0">
            <x-slot:trigger>
                <x-mary-menu-item icon="o-photo" :tooltip="__('Media')" link="#" wire:navigate />
            </x-slot:trigger>
            <x-slot:content>
                {{ __('Media') }}
            </x-slot:content>
        </x-mary-popover>
        {{--  <x-mary-popover position="right-start" offset="0">
            <x-slot:trigger>
                <x-mary-menu-item icon="o-paint-brush" :tooltip="__('Fun Area')" link="#" wire:navigate />
            </x-slot:trigger>
            <x-slot:content>
                {{ __('Fun Area') }}
            </x-slot:content>
        </x-mary-popover> --}}

    </x-mary-menu>

    <x-mary-menu activate-by-route vertical
        class="justify-items-center space-y-2 {{-- bg-base-100 --}} {{-- border-base-content/10 border-r-[length:var(--border)] --}}">
        {{-- <livewire:theme /> --}}

        <x-mary-popover position="right-start" offset="0">
            <x-slot:trigger>
                <x-mary-menu-item icon="o-chart-pie" :tooltip="__('App Monitoring')" link="#" wire:navigate />
            </x-slot:trigger>
            <x-slot:content>
                {{ __('App Monitoring') }}
            </x-slot:content>
        </x-mary-popover>

        <x-mary-popover position="right-start" offset="0">
            <x-slot:trigger>
                <x-mary-menu-item icon="o-book-open" link="/api/docs" no-wire-navigate />
            </x-slot:trigger>
            <x-slot:content>
                {{ __('API Documentation!') }}
            </x-slot:content>
        </x-mary-popover>
        <x-mary-dropdown
            class="justify-content-center justify-items-center justify-center btn-ghost btn-sm cursor-pointer"
            responsive no-x-anchor top>
            <x-slot:trigger>
                <x-mary-avatar placeholder="{{ auth()->user()->initials() }}"
                    class="!w-8 !rounded-lg cursor-pointer" />
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
    </x-mary-menu>
</div>
