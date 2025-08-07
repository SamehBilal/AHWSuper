<?php

use Livewire\Volt\Component;

new class extends Component {
    public $badge;
    public $logoText;

    public function mount($badge = false, $logoText = true)
    {
        $this->badge = $badge;
        $this->logoText = $logoText;
    }

}; ?>

<x-mary-nav sticky full-width>

    <x-slot:brand>
        <label for="main-drawer" class="lg:hidden mr-3">
            <x-mary-icon name="o-bars-3" class="cursor-pointer" />
        </label>

        <a href="{{ route('developers.dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse"
            wire:navigate>
            <x-app-logo :noText="!$logoText" />
            @if(@$badge)
                <div class="badge badge-neutral badge-outline ">for developers</div>
            @endif
        </a>

    </x-slot:brand>

    <x-slot:actions>

        <x-mary-button icon="o-magnifying-glass" class="btn-primary-content btn-dash"
            @click.stop="$dispatch('mary-search-open')">
            Search <x-mary-kbd>Ctrl</x-mary-kbd> <x-mary-kbd>K</x-mary-kbd>
        </x-mary-button>
        <x-mary-menu-separator />
        <x-mary-dropdown>

            <x-mary-card class="border border-dashed bg-base-100 border-base-content/10">
                <div class="text-center py-12">
                    <x-mary-icon name="o-bell-slash" class="w-16 h-16 mx-auto mb-4" />
                    <h3 class="text-xl font-medium mb-2">No Notifications</h3>
                    <p class="text-base-content/60">
                        You don't have any Notifications yet.
                    </p>
                </div>
            </x-mary-card>

           {{--  <x-mary-menu-item title="Archive" />
            <x-mary-menu-item title="Move" /> --}}

            <x-slot:trigger>
                <x-mary-button icon="o-bell" class="btn btn-circle btn-ghost !w-8 !rounded-lg" />
            </x-slot:trigger>
        </x-mary-dropdown>

        <livewire:theme />
        {{-- <x-mary-theme-toggle class="btn btn-circle btn-ghost !w-8 !rounded-lg" /> --}}

        <x-mary-dropdown class="btn-ghost btn-sm cursor-pointer" responsive right>
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

    </x-slot:actions>
</x-mary-nav>
