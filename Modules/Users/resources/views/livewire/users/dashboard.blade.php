<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Mary\Traits\Toast;
use App\Models\User;

new #[Layout('users::components.layouts.admin', ['pageTitle' => 'Arabhardware | Users Management'])] class extends Component {
    use Toast;
    public $activeAdmins;

    public function mount()
    {
        $this->activeAdmins = /* User::role('admin')->where('is_active', true)->count() */0;
    }
}; ?>

<div>



    <!-- Dashboard Cards -->
    <div class="grid grid-cols-8 gap-x-8 gap-y-4 mt-5 min-h-[300px]">
        <div class="col-span-6">
            <livewire:partials.admin.widgets.welcome-back-card :model="['name' => 'User', 'count' => User::count()]" :link="[
                'route' => '#',
                'data' => 'Start adding more users to your system',
            ]" />
        </div>
        <div class="stats col-span-2 bg-base-100 border-base-300 border">

            <div class="stat">
                <div class="stat-figure text-primary">
                    <x-mary-icon name="o-shield-check" class="inline-block h-10 w-10 stroke-current" />
                </div>
                <div class="stat-title">Active Admins</div>
                <div class="stat-value">{{ $activeAdmins }}</div>
                <div class="stat-desc">Admins currently active</div>
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
