<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Mary\Traits\Toast;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

new #[Layout('developers::components.layouts.admin', ['pageTitle' => 'Arabhardware | App Testers'])] class extends Component {
    use Toast;

    public $author;
    public $message;
    public $user;
    public $clients;
    public $selectedApp;
    public $selectedAppId;
    public $pageTitle = 'Arabhardware | App Testers';

    // Invite form
    public $inviteEmail = '';
    public $inviteMessage = '';
    public $showInviteForm = false;

    // Testers data
    public $testers = [];
    public $maxTesters = 50;

    // Bulk actions
    public $selectedTesters = [];
    public $selectAll = false;

    public function mount($appId = null)
    {
        [$this->message, $this->author] = str(Illuminate\Foundation\Inspiring::quotes()->random())->explode('-');
        $this->user = Auth::user();
        $this->loadClients($this->user);

        if ($appId) {
            $this->selectedAppId = $appId;
            $this->loadSelectedApp();
        }
    }

    public function loadClients($user)
    {
        $this->clients = $user->oauthApps()->get();
    }

    public function updatedSelectedAppId($value)
    {
        if ($value) {
            $this->loadSelectedApp();
        } else {
            $this->resetAppData();
        }
    }

    public function loadSelectedApp()
    {
        $app = $this->user->oauthApps()->find($this->selectedAppId);
        if ($app) {
            $this->selectedApp = $app;
            $this->loadTesters();
        }
    }

    public function resetAppData()
    {
        $this->selectedApp = null;
        $this->testers = [];
        $this->selectedTesters = [];
    }

    public function loadTesters()
    {
        if (!$this->selectedApp) return;

        // Load testers from database
        // Assuming you have a app_testers table or relationship
        $this->testers = $this->selectedApp->testers()->with('user')->get()->map(function($tester) {
            return [
                'id' => $tester->id,
                'user_id' => $tester->user_id,
                'email' => $tester->user->email ?? $tester->email,
                'name' => $tester->user->name ?? 'Unknown User',
                'avatar' => $tester->user->avatar ?? null,
                'status' => $tester->status, // pending, accepted, rejected
                'invited_at' => $tester->created_at,
                'joined_at' => $tester->accepted_at,
            ];
        })->toArray();
    }

    public function sendInvite()
    {
        $this->validate([
            'inviteEmail' => 'required|email',
            'inviteMessage' => 'nullable|string|max:500'
        ]);

        if (!$this->selectedApp) {
            $this->error('Please select an application first.');
            return;
        }

        if (count($this->testers) >= $this->maxTesters) {
            $this->error("You have reached the maximum limit of {$this->maxTesters} testers.");
            return;
        }

        // Check if user already invited
        if (collect($this->testers)->where('email', $this->inviteEmail)->count() > 0) {
            $this->error('This user has already been invited.');
            return;
        }

        try {
            // Check if user exists in system
            $existingUser = User::where('email', $this->inviteEmail)->first();

            if (!$existingUser) {
                $this->error('User with this email does not exist on Arabhardware. They must register first.');
                return;
            }

            if (!$existingUser->email_verified_at) {
                $this->error('The invited user must have a verified email address.');
                return;
            }

            $testerService = new Modules\Developers\Services\TesterService();
            $testerService->inviteTester(
                $this->selectedApp,
                $this->user,
                $this->inviteEmail,
                $this->inviteMessage
            );

            $this->success('Invitation sent successfully!');
            $this->inviteEmail = '';
            $this->inviteMessage = '';
            $this->showInviteForm = false;
            $this->loadTesters();

        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    public function resendInvite($testerId)
    {
        $tester = collect($this->testers)->where('id', $testerId)->first();
        if (!$tester || $tester['status'] !== 'pending') {
            $this->error('Cannot resend invitation.');
            return;
        }

        try {
            $tester = AppTester::findOrFail($testerId);
            $testerService = new Modules\Developers\Services\TesterService();
            $testerService->resendInvitation($tester);

            $this->success('Invitation resent successfully!');
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    public function removeTester($testerId)
    {
        try {
            $tester = AppTester::findOrFail($testerId);
            $testerService = new Modules\Developers\Services\TesterService();
            $testerService->removeTester($tester);
            $this->success('Tester removed successfully!');
            $this->loadTesters();
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    public function bulkRemoveTesters()
    {
        if (empty($this->selectedTesters)) {
            $this->error('Please select testers to remove.');
            return;
        }

        try {
            $this->selectedApp->testers()->whereIn('id', $this->selectedTesters)->delete();
            $this->success(count($this->selectedTesters) . ' tester(s) removed successfully!');
            $this->selectedTesters = [];
            $this->selectAll = false;
            $this->loadTesters();
        } catch (\Exception $e) {
            $this->error('Failed to remove selected testers.');
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedTesters = collect($this->testers)->pluck('id')->toArray();
        } else {
            $this->selectedTesters = [];
        }
    }

    public function getStatusBadgeClass($status)
    {
        return match($status) {
            'pending' => 'badge-warning',
            'accepted' => 'badge-success',
            'rejected' => 'badge-error',
            default => 'badge-ghost'
        };
    }

    public function getCurrentTesterCount()
    {
        return count($this->testers);
    }

    public function getRemainingSlots()
    {
        return $this->maxTesters - $this->getCurrentTesterCount();
    }
}; ?>

<div class="max-w-7xl mx-auto min-h-screen">
    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">

            <!-- Header -->
            <x-mary-card class="border border-dashed bg-base-100 border-base-content/10 border-b-[length:var(--border)]">
                <x-slot:title>
                    <h2 class="text-2xl flex gap-1 mb-4">
                        <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.196-2.196M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.196-2.196M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Application Testers
                    </h2>
                </x-slot:title>
                <p class="text-sm mb-5">
                    You can invite up to {{ $maxTesters }} Arabhardware users to test your application.
                    They must have a registered email and a positive attitude! 😊
                </p>

                <x-mary-alert title="Testing Guidelines"
                    description="Invited testers will have access to your application's test environment and can provide valuable feedback before your public launch."
                    icon="o-light-bulb"
                    class="alert-info" />
            </x-mary-card>

            <!-- App Selection -->
            @if($clients->count() > 0)
            <x-mary-card class="border border-dashed bg-base-100 border-base-content/10">
                <x-slot:title>
                    <h3 class="text-xl mb-4">Select Application</h3>
                </x-slot:title>

                <x-mary-select
                    label="Choose Application"
                    wire:model.live="selectedAppId"
                    :options="$clients"
                    option-value="id"
                    option-label="name"
                    placeholder="Select an application to manage testers"
                    class="mb-4" />
            </x-mary-card>
            @endif

            @if($selectedApp)
            <!-- Invite Section -->
            <x-mary-card class="border border-dashed bg-base-100 border-base-content/10">
                <x-slot:title>
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl">Invite Testers</h3>
                        <div class="flex items-center gap-4">
                            <span class="text-sm text-base-content/60">
                                {{ $this->getRemainingSlots() }} slots remaining
                            </span>
                            <x-mary-button
                                label="Send Invite"
                                wire:click="$set('showInviteForm', true)"
                                class="btn-primary"
                                :disabled="$this->getRemainingSlots() <= 0"
                                icon="o-paper-airplane" />
                        </div>
                    </div>
                </x-slot:title>

                @if($showInviteForm)
                <div class="bg-base-200 p-6 rounded-lg mb-6">
                    <h4 class="font-medium mb-4">Send Invitation</h4>
                    <div class="space-y-4">
                        <x-mary-input
                            label="Email Address"
                            wire:model="inviteEmail"
                            placeholder="user@example.com"
                            type="email"
                            required />

                        <x-mary-textarea
                            label="Personal Message (Optional)"
                            wire:model="inviteMessage"
                            placeholder="Hi! I'd love for you to test my new application..."
                            rows="3" />

                        <div class="flex gap-2">
                            <x-mary-button
                                label="Send Invitation"
                                wire:click="sendInvite"
                                class="btn-primary"
                                icon="o-paper-airplane" />
                            <x-mary-button
                                label="Cancel"
                                wire:click="$set('showInviteForm', false)"
                                class="btn-ghost" />
                        </div>
                    </div>
                </div>
                @endif

                @if($this->getRemainingSlots() <= 0)
                <x-mary-alert title="Tester Limit Reached"
                    description="You have reached the maximum number of testers. Remove existing testers to invite new ones."
                    icon="o-exclamation-triangle"
                    class="alert-warning" />
                @endif
            </x-mary-card>

            <!-- Testers List -->
            <x-mary-card class="border border-dashed bg-base-100 border-base-content/10">
                <x-slot:title>
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl">Invited Testers ({{ $this->getCurrentTesterCount() }} of {{ $maxTesters }})</h3>
                        @if(count($this->testers) > 0)
                        <div class="flex items-center gap-2">
                            @if(count($selectedTesters) > 0)
                            <x-mary-button
                                label="Remove Selected ({{ count($selectedTesters) }})"
                                wire:click="bulkRemoveTesters"
                                class="btn-error btn-sm"
                                wire:confirm="Are you sure you want to remove the selected testers?"
                                icon="o-trash" />
                            @endif
                        </div>
                        @endif
                    </div>
                </x-slot:title>

                @if(count($this->testers) > 0)
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox"
                                           class="checkbox checkbox-sm"
                                           wire:model.live="selectAll">
                                </th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Invited</th>
                                <th>Joined</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($testers as $tester)
                            <tr class="hover">
                                <td>
                                    <input type="checkbox"
                                           class="checkbox checkbox-sm"
                                           wire:model.live="selectedTesters"
                                           value="{{ $tester['id'] }}">
                                </td>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div class="mask mask-squircle w-12 h-12">
                                                @if($tester['avatar'])
                                                <img src="{{ $tester['avatar'] }}" alt="{{ $tester['name'] }}" />
                                                @else
                                                <div class="bg-primary/10 flex items-center justify-center w-12 h-12">
                                                    <span class="text-primary font-bold">
                                                        {{ substr($tester['name'], 0, 1) }}
                                                    </span>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-bold">{{ $tester['name'] }}</div>
                                            <div class="text-sm text-base-content/60">{{ $tester['email'] }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <x-mary-badge
                                        :value="ucfirst($tester['status'])"
                                        :class="$this->getStatusBadgeClass($tester['status'])" />
                                </td>
                                <td>
                                    <span class="text-sm">
                                        {{ $tester['invited_at']->format('M j, Y') }}
                                    </span>
                                </td>
                                <td>
                                    @if($tester['joined_at'])
                                    <span class="text-sm">
                                        {{ $tester['joined_at']->format('M j, Y') }}
                                    </span>
                                    @else
                                    <span class="text-sm text-base-content/40">-</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="flex gap-1">
                                        @if($tester['status'] === 'pending')
                                        <x-mary-button
                                            icon="o-arrow-path"
                                            wire:click="resendInvite({{ $tester['id'] }})"
                                            class="btn-ghost btn-xs"
                                            tooltip="Resend invitation" />
                                        @endif
                                        <x-mary-button
                                            icon="o-trash"
                                            wire:click="removeTester({{ $tester['id'] }})"
                                            class="btn-error btn-xs"
                                            wire:confirm="Are you sure you want to remove this tester?"
                                            tooltip="Remove tester" />
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Summary Stats -->
                <div class="flex justify-between items-center mt-4 pt-4 border-t border-base-300">
                    <div class="text-sm text-base-content/60">
                        Showing {{ count($this->testers) }} tester(s)
                    </div>
                    <div class="flex gap-4 text-sm">
                        <span class="flex items-center gap-1">
                            <div class="w-2 h-2 bg-warning rounded-full"></div>
                            Pending: {{ collect($this->testers)->where('status', 'pending')->count() }}
                        </span>
                        <span class="flex items-center gap-1">
                            <div class="w-2 h-2 bg-success rounded-full"></div>
                            Active: {{ collect($this->testers)->where('status', 'accepted')->count() }}
                        </span>
                        <span class="flex items-center gap-1">
                            <div class="w-2 h-2 bg-error rounded-full"></div>
                            Declined: {{ collect($this->testers)->where('status', 'rejected')->count() }}
                        </span>
                    </div>
                </div>
                @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-base-content/40 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.196-2.196M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.196-2.196M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <h3 class="text-xl font-medium mb-2">No Testers Yet</h3>
                    <p class="text-base-content/60 mb-4">
                        Start building your testing team by inviting Arabhardware users to test your application.
                    </p>
                    <x-mary-button
                        label="Send First Invite"
                        wire:click="$set('showInviteForm', true)"
                        class="btn-primary"
                        icon="o-paper-airplane" />
                </div>
                @endif
            </x-mary-card>

            @else
            <!-- No App Selected -->
            <x-mary-card class="border border-dashed bg-base-100 border-base-content/10">
                <div class="text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-base-content/40 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.196-2.196M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.196-2.196M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <h3 class="text-xl font-medium mb-2">No Application Selected</h3>
                    <p class="text-base-content/60">
                        @if($clients->count() === 0)
                            You don't have any applications yet. Create an application first to manage testers.
                        @else
                            Select an application above to manage testers and send invitations.
                        @endif
                    </p>
                </div>
            </x-mary-card>
            @endif

        </div>

        <!-- Sidebar -->
        <livewire:partials.admin.right-sidebar />
    </div>
</div>
