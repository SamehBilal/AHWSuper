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
            <livewire:partials.admin.widgets.welcome-back-card :model="['name' => 'Invoices', 'count' => 0]" :link="[
                'route' => '#',
                'data' => 'Start submitting more invoices to get the maximum use of our system',
            ]" />
        </div>

        <div
            class="stats stats-vertical border border-dashed bg-base-100 border-base-content/10 border-b-[length:var(--border)] col-span-2 row-span-2">
            <div class="stat">
                <div class="stat-figure text-primary">
                    <x-mary-icon name="o-document-check" class="inline-block h-10 w-10 stroke-current" />
                </div>
                <div class="stat-title">Submitted Invoices</div>
                <div class="stat-value">0</div>
                <div class="stat-desc">Invoices sent for approval</div>
            </div>
            <div class="stat">
                <div class="stat-figure text-warning">
                    <x-mary-icon name="o-clock" class="inline-block h-10 w-10 stroke-current" />
                </div>
                <div class="stat-title">Pending Invoices</div>
                <div class="stat-value">0</div>
                <div class="stat-desc">Awaiting review</div>
            </div>
            <div class="stat">
                <div class="stat-figure text-error">
                    <x-mary-icon name="o-x-circle" class="inline-block h-10 w-10 stroke-current" />
                </div>
                <div class="stat-title">Rejected Invoices</div>
                <div class="stat-value">0</div>
                <div class="stat-desc">Needs correction</div>
            </div>
        </div>

        <div class="col-span-6 row-span-3">
            <x-placeholder-pattern
                class="size-full rounded-xl border b--dashed stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>

        <div class="col-span-2">
            <x-calendar />
        </div>

        <livewire:partials.admin.widgets.quotes />
    </div>

</div>
