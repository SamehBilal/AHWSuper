<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Mary\Traits\Toast;

new #[Layout('developers::components.layouts.admin', ['pageTitle' => 'Arabhardware | Developers'])] class extends Component {
    use Toast;

    public function mount()
    {
        //
    }
}; ?>

<div>
    <!-- Dashboard Cards -->
    <div class="grid grid-cols-8 gap-x-8 gap-y-4 mt-5 min-h-[300px]">
        <div class="col-span-8">
            <livewire:partials.admin.widgets.welcome-back-developers-card />
        </div>
        <div class="col-span-6 row-span-3">
            <livewire:partials.admin.widgets.live-sign-in-demo />
        </div>

        <livewire:partials.admin.widgets.recent-activity />

        <div class="col-span-2">
            <x-calendar />
        </div>

        <livewire:partials.admin.widgets.quotes />
    </div>
</div>
