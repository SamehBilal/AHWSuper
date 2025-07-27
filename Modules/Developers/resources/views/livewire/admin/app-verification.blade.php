<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Mary\Traits\Toast;

new #[Layout('developers::components.layouts.admin', ['pageTitle' => 'Arabhardware | App Verification'])] class extends Component {
    use Toast;

    public $user;
    public $clients;
    public $selectedApp;
    public $selectedAppId;
    public $pageTitle = 'Arabhardware | App Verification';

    // Verification form fields
    public $appName = '';
    public $termsOfServiceUrl = '';
    public $privacyPolicyUrl = '';
    public $ownershipConfirmation = false;
    public $tosAgreement = false;

    // Verification criteria
    public $verificationCriteria = [
        'belongs_to_team' => false,
        'no_harmful_content' => false,
        'has_terms_of_service' => false,
        'has_privacy_policy' => false,
        'team_verified_2fa' => false,
    ];

    public function mount($appId = null)
    {
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
            $this->appName = $app->name;
            $this->termsOfServiceUrl = $app->terms_of_service_url ?? '';
            $this->privacyPolicyUrl = $app->privacy_policy_url ?? '';
            $this->checkVerificationCriteria();
        }
    }

    public function resetAppData()
    {
        $this->selectedApp = null;
        $this->appName = '';
        $this->termsOfServiceUrl = '';
        $this->privacyPolicyUrl = '';
        $this->ownershipConfirmation = false;
        $this->tosAgreement = false;
        $this->verificationCriteria = [
            'belongs_to_team' => false,
            'no_harmful_content' => false,
            'has_terms_of_service' => false,
            'has_privacy_policy' => false,
            'team_verified_2fa' => false,
        ];
    }

    public function checkVerificationCriteria()
    {
        if (!$this->selectedApp) return;

        // Check each criterion based on your app logic
        $this->verificationCriteria['belongs_to_team'] = $this->selectedApp->team_id ? true : false;
        $this->verificationCriteria['no_harmful_content'] = $this->checkContentModeration();
        $this->verificationCriteria['has_terms_of_service'] = !empty($this->selectedApp->terms_of_service_url);
        $this->verificationCriteria['has_privacy_policy'] = !empty($this->selectedApp->privacy_policy_url);
        $this->verificationCriteria['team_verified_2fa'] = $this->checkTeam2FA();
    }

    private function checkContentModeration()
    {
        // Implement your content moderation logic here
        return true; // Placeholder
    }

    private function checkTeam2FA()
    {
        // Check if all team members have 2FA enabled
        return $this->user->two_factor_secret ? true : false;
    }

    public function getFailedCriteriaCount()
    {
        return count(array_filter($this->verificationCriteria, fn($value) => !$value));
    }

    public function canSubmitVerification()
    {
        return $this->getFailedCriteriaCount() === 0 &&
               $this->ownershipConfirmation &&
               $this->tosAgreement &&
               $this->selectedApp;
    }

    public function submitVerification()
    {
        if (!$this->canSubmitVerification()) {
            $this->error('Please complete all requirements before submitting verification.');
            return;
        }

        // Update app with verification request
        try {
            $this->selectedApp->update([
                'terms_of_service_url' => $this->termsOfServiceUrl,
                'privacy_policy_url' => $this->privacyPolicyUrl,
                'verification_status' => 'pending',
                'verification_requested_at' => now(),
            ]);

            $this->success('Verification request submitted successfully! We will review your application within 5-7 business days.');
        } catch (\Exception $e) {
            $this->error('Failed to submit verification request. Please try again.');
        }
    }
}; ?>

<div class="max-w-7xl mx-auto min-h-screen">
    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">

            <!-- Header -->
            <x-mary-card class="col-span-2 border border-dashed bg-base-100 border-base-content/10 border-b-[length:var(--border)]">
                <x-slot:title>
                    <h2 class="text-2xl flex gap-1 mb-4">
                        <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        App Verification
                    </h2>
                </x-slot:title>
                <p class="text-sm mb-5">
                    Get your application verified to unlock additional features and increase user trust.
                    Verified applications have access to higher rate limits and enhanced functionality.
                </p>

                <x-mary-alert title="Important Notice"
                    description="After verification, you cannot modify your app's name or transfer ownership without contacting support."
                    icon="o-exclamation-triangle"
                    class="alert-warning" />
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
                    placeholder="Select an application to verify"
                    class="mb-4" />

                @if($selectedApp)
                <x-mary-card class="bg-base-200/50">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="font-medium">{{ $selectedApp->name }}</h4>
                            <p class="text-sm text-base-content/60">{{ $selectedApp->description ?? 'No description' }}</p>
                            <p class="text-xs text-base-content/40 mt-1">Client ID: {{ $selectedApp->id }}</p>
                        </div>
                        <div class="flex flex-col items-end gap-2">
                            @if($selectedApp->verification_status === 'verified')
                                <x-mary-badge value="Verified" class="badge-success" />
                            @elseif($selectedApp->verification_status === 'pending')
                                <x-mary-badge value="Pending Review" class="badge-warning" />
                            @else
                                <x-mary-badge value="Unverified" class="badge-ghost" />
                            @endif
                        </div>
                    </div>
                </x-mary-card>
                @endif
            </x-mary-card>
            @endif

            @if($selectedApp)
            <!-- Verification Qualifications -->
            <x-mary-card class="border border-dashed bg-base-100 border-base-content/10">
                <x-slot:title>
                    <h3 class="text-xl mb-4">Verification Qualifications</h3>
                </x-slot:title>

                @if($this->getFailedCriteriaCount() > 0)
                <div class="alert alert-error mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Your app is missing {{ $this->getFailedCriteriaCount() }} criteria and cannot be verified</span>
                </div>
                @else
                <div class="alert alert-success mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Your app meets all verification requirements!</span>
                </div>
                @endif

                <div class="space-y-4">
                    <!-- Belongs to Team -->
                    <div class="flex items-center gap-3">
                        @if($verificationCriteria['belongs_to_team'])
                            <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        @else
                            <svg class="w-5 h-5 text-error" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        @endif
                        <span class="{{ $verificationCriteria['belongs_to_team'] ? 'text-success' : 'text-error' }}">
                            Your app must belong to a Team
                        </span>
                    </div>

                    <!-- No Harmful Content -->
                    <div class="flex items-center gap-3">
                        @if($verificationCriteria['no_harmful_content'])
                            <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        @else
                            <svg class="w-5 h-5 text-error" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        @endif
                        <span class="{{ $verificationCriteria['no_harmful_content'] ? 'text-success' : 'text-error' }}">
                            Your app must not contain any harmful or bad language in its name, description, commands, or role connection metadata
                        </span>
                    </div>

                    <!-- Terms of Service -->
                    <div class="flex items-center gap-3">
                        @if($verificationCriteria['has_terms_of_service'])
                            <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        @else
                            <svg class="w-5 h-5 text-error" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        @endif
                        <span class="{{ $verificationCriteria['has_terms_of_service'] ? 'text-success' : 'text-error' }}">
                            Your app must have a link to Terms of Service
                        </span>
                    </div>

                    <!-- Privacy Policy -->
                    <div class="flex items-center gap-3">
                        @if($verificationCriteria['has_privacy_policy'])
                            <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        @else
                            <svg class="w-5 h-5 text-error" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        @endif
                        <span class="{{ $verificationCriteria['has_privacy_policy'] ? 'text-success' : 'text-error' }}">
                            Your app must have a link to your Privacy Policy
                        </span>
                    </div>

                    <!-- Team 2FA -->
                    <div class="flex items-center gap-3">
                        @if($verificationCriteria['team_verified_2fa'])
                            <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        @else
                            <svg class="w-5 h-5 text-error" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        @endif
                        <span class="{{ $verificationCriteria['team_verified_2fa'] ? 'text-success' : 'text-error' }}">
                            All members of your developer team must have a verified email and 2FA set up
                        </span>
                    </div>
                </div>
            </x-mary-card>

            <!-- App Identity & Verification Form -->
            <x-mary-card class="border border-dashed bg-base-100 border-base-content/10">
                <x-slot:title>
                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-6 h-6 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        <h3 class="text-xl">App Identity</h3>
                    </div>
                </x-slot:title>

                <x-mary-alert title="Caution"
                    description="After verification, you cannot modify the app's name or transfer ownership without the assistance of Arabhardware's support team."
                    icon="o-exclamation-triangle"
                    class="alert-warning mb-6" />

                <div class="space-y-6">
                    <!-- App Name -->
                    <x-mary-input
                        label="APP NAME"
                        wire:model="appName"
                        disabled
                        class="mb-1" />

                    <!-- Ownership -->
                    <x-mary-input
                        label="OWNERSHIP"
                        value="{{ $user->name }}"
                        disabled
                        class="mb-1" />

                    <!-- Terms of Service URL -->
                    <x-mary-input
                        label="TERMS OF SERVICE URL"
                        wire:model="termsOfServiceUrl"
                        placeholder="https://yourapp.com/terms"
                        type="url"
                        class="mb-1" />

                    <!-- Privacy Policy URL -->
                    <x-mary-input
                        label="PRIVACY POLICY URL"
                        wire:model="privacyPolicyUrl"
                        placeholder="https://yourapp.com/privacy"
                        type="url"
                        class="mb-1" />

                    <!-- Agreements -->
                    <div class="space-y-4">
                        <x-mary-checkbox
                            label="I affirm that my application abides by the Arabhardware Developer Terms of Service and Developer Policy"
                            wire:model="tosAgreement" />

                        <x-mary-checkbox
                            label="I am the owner of this app. I recognize that after verification, I cannot modify the app's name or transfer ownership without the assistance of Arabhardware's support team"
                            wire:model="ownershipConfirmation" />
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <x-mary-button
                            label="Verify App"
                            wire:click="submitVerification"
                            :disabled="!$this->canSubmitVerification()"
                            class="btn-primary"
                            icon="o-check-circle" />

                        @if(!$this->canSubmitVerification())
                        <p class="text-sm text-base-content/60 mt-2">
                            Complete all requirements and agreements to submit verification
                        </p>
                        @endif
                    </div>
                </div>
            </x-mary-card>
            @else
            <!-- No App Selected -->
            <x-mary-card class="border border-dashed bg-base-100 border-base-content/10">
                <div class="text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-base-content/40 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <h3 class="text-xl font-medium mb-2">No Application Selected</h3>
                    <p class="text-base-content/60">
                        @if($clients->count() === 0)
                            You don't have any applications yet. Create an application first to request verification.
                        @else
                            Select an application above to begin the verification process.
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
