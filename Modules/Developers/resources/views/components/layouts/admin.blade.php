<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen overflow-x-hidden">
    {{-- The navbar with `sticky` and `full-width` --}}
    <x-mary-nav sticky full-width>

        <x-slot:brand>
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-mary-icon name="o-bars-3" class="cursor-pointer" />
            </label>

            <a href="{{ route('developers.dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse"
                wire:navigate>
                <x-app-logo :text="false" /> <div class="badge badge-neutral badge-outline ">for developers</div>
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

    {{-- The main content with `full-width` --}}
    <x-mary-main with-nav full-width>

        {{-- This is a sidebar that works also as a drawer on small screens --}}
        {{-- Notice the `main-drawer` reference here --}}
        @php
    $users = [
        ['id' => 1, 'name' => 'Joe'],
        ['id' => 2,'name' => 'Mary','disabled' => true] // <-- this
    ];
@endphp
        <x-slot:sidebar drawer="main-drawer" collapsible class="border-r bg-base-100 border-base-content/10 border-b-[length:var(--border)] ">


            {{-- User --}}
            @if ($user = auth()->user())
            <x-mary-select label="Inline label" class="pt-2" wire:model="selectedUser" icon="o-user" :options="$users" inline />
            <x-mary-list-item :item="$user" value="name" sub-value="email" no-separator no-hover class="pt-2">
                <x-mary-select label="Inline label" wire:model="selectedUser" icon="o-user" :options="$users" inline />
               {{--  <x-slot:avatar>
                    <x-mary-avatar placeholder="RT" class="!w-10 !rounded-lg" alt="My image" />
                </x-slot:avatar>
                <x-slot:actions>
                    <x-mary-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="logoff"
                        @click.prevent="document.getElementById('logout').submit();" />
                </x-slot:actions> --}}
            </x-mary-list-item>
            <x-mary-menu-separator />
        @endif

            {{-- Activates the menu item when a route matches the `link` property --}}
            <x-mary-menu activate-by-route>
                <x-mary-menu-item title="General information" icon="o-home" link="###" />
                <x-mary-menu-item title="OAuth2" icon="o-envelope" link="###" />
                <x-mary-menu-sub title="App Verification" icon="o-cog-6-tooth">
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

    {{--  TOAST area --}}
    <x-mary-toast />
</body>

</html>
