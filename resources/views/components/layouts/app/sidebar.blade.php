<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800" x-data>
        <input type="hidden" name="userId" value="{{ auth()->user()->id ?? '' }}" />



        <x-mary-nav sticky full-width >

        <x-slot:brand>
            {{-- Drawer toggle for "main-drawer" --}}
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-mary-icon name="o-bars-3" class="cursor-pointer" />
            </label>

            {{-- Brand --}}
            <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <x-app-logo />
            </a>
        </x-slot:brand>

        {{-- Right side actions --}}
        <x-slot:actions>
                <x-mary-theme-toggle  class="btn btn-circle" />
 <x-mary-button label="Search" @click.stop="$dispatch('mary-search-open')" />
            <x-mary-button label="Messages" icon="o-envelope" link="###" class="btn-ghost btn-sm" responsive />
            <x-mary-button label="Notifications" icon="o-bell" link="###" class="btn-ghost btn-sm" responsive />
            <x-mary-dropdown label="{{ auth()->user()->name }}" {{-- icon="o-bell" --}} class="btn-ghost btn-sm" responsive >
                <x-mary-avatar placeholder="{{ auth()->user()->initials() }}" title="{{ auth()->user()->name }}" subtitle="{{ auth()->user()->email }}" class="!w-10" />

                {{-- By default any click closes dropdown --}}
                <x-mary-menu-item title="Close after click" />

                <x-mary-menu-separator />

                <x-mary-menu-item icon="o-cog-8-tooth" title="Profile" route="settings.profile" link="{{ route('settings.profile') }}" wire:navigate />

                {{-- Use `@click.STOP` to stop event propagation --}}
                <x-mary-menu-item title="Keep open after click" @click.stop="alert('Keep open')" />

                {{-- Or `wire:click.stop`  --}}
                <x-mary-menu-item title="Call wire:click" wire:click.stop="delete" />

                <x-mary-menu-separator />

                <x-mary-menu-item @click.stop="">
                    <x-mary-checkbox label="Hard mode" hint="Make things harder" />
                </x-mary-menu-item>

                <x-mary-menu-item @click.stop="">
                    <x-mary-checkbox label="Transparent checkout" hint="Make things easier" />
                </x-mary-menu-item>

                <form id="logout" method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
{{--                         <x-mary-button label="{{ __('Log Out') }}"  type="submit" icon="o-envelope" link="###" class="btn-ghost w-full" responsive />
 --}}                        <x-mary-menu-item icon="o-arrow-right-start-on-rectangle" title="Log Out" class="w-full" wire:submit="#logout" />
                    </form>
            </x-mary-dropdown>

        </x-slot:actions>
    </x-mary-nav>

    {{-- The main content with `full-width` --}}
    <x-mary-main with-nav full-width>

        {{-- This is a sidebar that works also as a drawer on small screens --}}
        {{-- Notice the `main-drawer` reference here --}}
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-200 border-e border-zinc-200">

            {{-- User --}}
            @if($user = auth()->user())
                <x-mary-list-item :item="$user" value="name" sub-value="email" no-separator no-hover class="pt-2">
                    <x-slot:actions>
                        <x-mary-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="logoff" no-wire-navigate link="/logout" />
                    </x-slot:actions>
                </x-mary-list-item>

                <x-mary-menu-separator />
            @endif

            {{-- Activates the menu item when a route matches the `link` property --}}
            <x-mary-menu activate-by-route {{-- active-bg-color="font-black " --}}>
                <x-mary-menu-item title="{{ __('Dashboard') }}" icon="o-home" route="dashboard" link="{{ route('dashboard') }}" wire:navigate />
                <x-mary-menu-item title="Messages" icon="o-envelope" link="###" />
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

        {{-- {{ $slot }} --}}
        <x-mary-toast />
        <x-mary-spotlight
    search-text="Find docs, app actions or users"
    no-results-text="Ops! Nothing here." />
    </body>
</html>
