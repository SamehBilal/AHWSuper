<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Mary\Traits\Toast;

new #[Layout('invoices::components.layouts.admin', ['pageTitle' => 'Arabhardware | Invoices Management'])] class extends Component {
    use Toast;

    public function mount()
    {
        //
    }
}; ?>

<div>

    <!-- Dashboard Cards -->
    <div class="grid grid-cols-8 gap-x-8 gap-y-4 mt-5 min-h-[300px]">
        <div class="col-span-6">
            <livewire:partials.admin.widgets.welcome-back-card />
        </div>
        
        <livewire:partials.admin.widgets.recent-activity />

        <div class="col-span-6 row-span-3">

        </div>

        <div class="col-span-2">
            <x-calendar />
        </div>

        <livewire:partials.admin.widgets.quotes />
    </div>

</div>
