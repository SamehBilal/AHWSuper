<?php

use Livewire\Volt\Component;
use Modules\Developers\Models\AppAnalytic;
use Carbon\Carbon;

new class extends Component {
    public $user;
    public $apps;
    public $apiRequestsToday;
    public $errorsThisMonth;
    public $pendingApprovals;
    public $lastErrorDate;

    public function mount()
    {
        $this->user = Auth::user();
        $this->loadApps($this->user);
        $this->loadStatistics();
    }

    public function loadApps($user)
    {
        $this->apps = $user->developerApps()->get();
    }

    public function loadStatistics()
    {
        $appIds = $this->apps->pluck('id');

        // API Requests Today
        $this->apiRequestsToday = AppAnalytic::whereIn('app_id', $appIds)
            ->whereDate('created_at', Carbon::today())
            ->count();

        // Errors/Incidents This Month (4xx and 5xx status codes)
        $errorsQuery = AppAnalytic::whereIn('app_id', $appIds)
            ->where('status_code', '>=', 400)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year);

        $this->errorsThisMonth = $errorsQuery->count();

        // Get last error date
        $lastError = $errorsQuery->orderBy('created_at', 'desc')->first();
        $this->lastErrorDate = $lastError ?
            Carbon::parse($lastError->created_at)->diffForHumans() :
            'No errors';

        // Pending Approvals/Reviews (apps with pending status)
        $this->pendingApprovals = $this->apps->where('status', 'pending')->count();
    }

    public function getFormattedTime()
    {
        return Carbon::now()->format('g:i A');
    }

    public function refresh()
    {
        $this->loadStatistics();
        $this->dispatch('stats-refreshed');
    }
}; ?>

<div
    class="stats stats-vertical border border-dashed bg-base-100 border-base-content/10 border-b-[length:var(--border)] col-span-2">
    <div class="stat">
        <div class="stat-figure text-primary">
            <x-mary-icon name="o-arrow-top-right-on-square" class="inline-block h-10 w-10 stroke-current" />
        </div>
        <div class="stat-title">API Requests Today</div>
        <div class="stat-value">{{ number_format($apiRequestsToday) }}</div>
        <div class="stat-desc">As of {{ $this->getFormattedTime() }}</div>
        <div class="stat-actions">
            <button wire:click="refresh" class="btn btn-xs ">
                <x-mary-icon name="o-arrow-path" class="w-4 h-4" />
                Refresh
            </button>
        </div>
    </div>

    <div class="stat">
        <div class="stat-figure text-{{ $errorsThisMonth > 0 ? 'error' : 'primary' }}">
            <x-mary-icon name="o-exclamation-triangle" class="inline-block h-10 w-10 stroke-current" />
        </div>
        <div class="stat-title">Errors/Incidents This Month</div>
        <div class="stat-value text-{{ $errorsThisMonth > 10 ? 'error' : ($errorsThisMonth > 0 ? 'warning' : 'success') }}">
            {{ $errorsThisMonth }}
        </div>
        <div class="stat-desc">
            @if($errorsThisMonth > 0)
                Last: {{ $lastErrorDate }}
            @else
                <span class="text-success">No errors this month</span>
            @endif
        </div>
        <div class="stat-actions">
            <button wire:click="refresh" class="btn btn-xs ">
                <x-mary-icon name="o-arrow-path" class="w-4 h-4" />
                Refresh
            </button>
        </div>
    </div>

    <div class="stat">
        <div class="stat-figure text-{{ $pendingApprovals > 0 ? 'warning' : 'primary' }}">
            <x-mary-icon name="o-speaker-wave" class="inline-block h-10 w-10 stroke-current" />
        </div>
        <div class="stat-title">Pending Approvals/Reviews</div>
        <div class="stat-value text-{{ $pendingApprovals > 0 ? 'warning' : 'success' }}">
            {{ $pendingApprovals }}
        </div>
        <div class="stat-desc {{ $pendingApprovals > 0 ? 'text-warning' : 'text-success' }}">
            @if($pendingApprovals > 0)
                Awaiting your action
            @else
                All apps approved
            @endif
        </div>
        <div class="stat-actions">
            <button wire:click="refresh" class="btn btn-xs ">
                <x-mary-icon name="o-arrow-path" class="w-4 h-4" />
                Refresh
            </button>
        </div>
    </div>
</div>
