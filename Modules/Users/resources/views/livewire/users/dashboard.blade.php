<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Mary\Traits\Toast;

new #[Layout('users::components.layouts.admin', ['pageTitle' => 'Arabhardware | Users Management'])] class extends Component {
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
        <div class="stats col-span-2 bg-base-100 border-base-300 border">

  <div class="stat">
    <div class="stat-title">Current balance</div>
    <div class="stat-value">$89,400</div>
    <div class="stat-actions">
      <button class="btn btn-xs">Withdrawal</button>
      <button class="btn btn-xs">Deposit</button>
    </div>
  </div>
</div>

            
        <div class="col-span-6 row-span-3">
            
        </div>

        <div class="col-span-2">
            <x-calendar />
        </div>

        <livewire:partials.admin.widgets.quotes />
        </div>
    
</div>
