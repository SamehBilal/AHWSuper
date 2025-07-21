<?php

use Livewire\Volt\Component;

new class extends Component {

    public function mount()
    {
        //
    }

}; ?>

<div>
<x-slot:sidebar drawer="main-drawer" collapsible
    class="border-r bg-base-100 border-base-content/10 border-b-[length:var(--border)] ">

    {{-- User --}}
    @if ($user = auth()->user())
        <x-mary-list-item :item="$user" value="name" sub-value="email" no-separator no-hover class="pt-2">
            <x-slot:avatar>
                <x-mary-avatar placeholder="RT" class="!w-10 !rounded-lg" alt="My image" />
            </x-slot:avatar>
            <x-slot:actions>
                <x-mary-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="logoff"
                    @click.prevent="document.getElementById('logout').submit();" />
            </x-slot:actions>
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
</div>