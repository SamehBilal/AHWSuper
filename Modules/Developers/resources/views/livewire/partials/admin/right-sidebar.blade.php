<?php

use Livewire\Volt\Component;

new class extends Component {

    public function mount()
    {
        //
    }

}; ?>

<div class="lg:col-span-1 flex flex-col min-h-screen">
    <div class="space-y-6 sticky top-20 ">
        <!-- Quick Start -->
        <livewire:partials.admin.widgets.quick-start />

        <!-- OAuth Endpoints -->
        <livewire:partials.admin.widgets.oauth-endpoints />

        <!-- Supported Scopes -->
        <livewire:partials.admin.widgets.supported-scopes />

        <!-- Support -->
        <livewire:partials.admin.widgets.support />
    </div>
</div>
